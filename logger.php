<?php
// ⚠️ DEBUG LINE - Remove in production (intentionally left for learning)
file_put_contents("test_log.txt", "Logger running at " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);

require_once "config1.php";

/* ==========================
   GET REAL IP (Cloudflare Optimized)
========================== */

function getRealIP() {

    // CLOUDFLARE IP RANGES (Updated Feb 2026)
    // Source: https://www.cloudflare.com/ips/
    $cloudflareIPv4 = [
        '173.245.48.0/20',
        '103.21.244.0/22',
        '103.22.200.0/22',
        '103.31.4.0/22',
        '141.101.64.0/18',
        '108.162.192.0/18',
        '190.93.240.0/20',
        '188.114.96.0/20',
        '197.234.240.0/22',
        '198.41.128.0/17',
        '162.158.0.0/15',
        '104.16.0.0/13',
        '104.24.0.0/14',
        '172.64.0.0/13',
        '131.0.72.0/22'
    ];

    $remoteAddr = $_SERVER['REMOTE_ADDR'] ?? '';

    // Function to check if IP is in CIDR range
    function ipInRange($ip, $range) {
        list($subnet, $bits) = explode('/', $range);
        $ip = ip2long($ip);
        $subnet = ip2long($subnet);
        $mask = -1 << (32 - $bits);
        $subnet &= $mask;
        return ($ip & $mask) == $subnet;
    }

    // Check if request is coming through Cloudflare
    $isCloudflare = false;
    foreach ($cloudflareIPv4 as $range) {
        if (ipInRange($remoteAddr, $range)) {
            $isCloudflare = true;
            break;
        }
    }

    // If coming through Cloudflare, trust CF-Connecting-IP header
    if ($isCloudflare && !empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
        return $_SERVER['HTTP_CF_CONNECTING_IP'];
    }

    // ⚠️ VULNERABILITY: Falls back to X-Forwarded-For without validation
    // This is intentional for learning - could be spoofed by non-CF proxies
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ipList[0]);
    }

    // Direct connection (not through Cloudflare)
    return $remoteAddr;
}

/* ==========================
   SUSPICIOUS PATTERN DETECTION
========================== */

function isSuspicious($data) {

    // ⚠️ INTENTIONAL FALSE POSITIVES for learning:
    // These patterns will flag legitimate content
    $patterns = [
        "/\b(select|union|insert|update|delete|drop|truncate)\b/i", // Flags "/blog/select-database"
        "/--|#|\/\*/",                                               // SQL comment patterns
        "/<script|onerror|onload|javascript:/i",                    // XSS patterns
        "/\.\.\//",                                                  // Path traversal
        "/base64_decode|eval\(|exec\(|shell_exec/i"                 // Code execution
    ];

    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $data)) {
            return 1;
        }
    }

    return 0;
}

/* ==========================
   COLLECT REQUEST DATA
========================== */

$realIP = getRealIP();
$cloudflareIP = $_SERVER['REMOTE_ADDR'] ?? '';  // This will be CF's IP
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? '';
$requestUri = $_SERVER['REQUEST_URI'] ?? '';
$queryString = $_SERVER['QUERY_STRING'] ?? '';

// Only capture POST data if it exists
$postData = (!empty($_POST)) ? json_encode($_POST) : '';

$referrer = $_SERVER['HTTP_REFERER'] ?? '';

$combinedData = $requestUri . $queryString . $postData;
$suspicious = isSuspicious($combinedData);

/* ==========================
   GEO LOOKUP with Caching
========================== */

$country = "Unknown";
$city = "Unknown";

// Skip localhost and private IPs
$skipGeo = in_array($realIP, ['127.0.0.1', '::1']) || 
           preg_match('/^(10|172\.(1[6-9]|2[0-9]|3[01])|192\.168)\./', $realIP);

if (!$skipGeo) {

    // Check cache first (if you want to add Redis/Memcache later)
    // For now, just make the API call
    
    $geoResponse = @file_get_contents(
        "http://ip-api.com/json/$realIP?fields=status,country,city",
        false,
        stream_context_create([
            'http' => [
                'timeout' => 2,  // 2 second timeout to prevent blocking
                'ignore_errors' => true
            ]
        ])
    );

    if ($geoResponse !== false) {
        $geo = json_decode($geoResponse);

        if ($geo && $geo->status === "success") {
            $country = $geo->country ?? "Unknown";
            $city = $geo->city ?? "Unknown";
        }
    }
    
    // If API fails, country remains "Unknown"
}

/* ==========================
   DETECT CLOUDFLARE BYPASS ATTEMPTS
========================== */

$cfBypass = 0;

// Check if request should have come through Cloudflare but didn't
// Enable this ONLY if you want to enforce Cloudflare-only traffic
if (!isset($_SERVER['HTTP_CF_RAY']) && !in_array($cloudflareIP, ['127.0.0.1', '::1'])) {
    // Someone is bypassing Cloudflare and hitting your origin server directly
    $cfBypass = 1;
    $suspicious = 1;
    
    // Log bypass attempt
    file_put_contents(
        "cloudflare_bypass.txt",
        date('Y-m-d H:i:s') . " - Direct origin access from: $realIP (CF IP: $cloudflareIP)\n",
        FILE_APPEND
    );
}

/* ==========================
   INSERT LOG - Uses Prepared Statements (Secure)
========================== */

$stmt = $conn->prepare("
INSERT INTO visitor_logs 
(ip_address, country, city, user_agent, request_method, request_uri, query_string, post_data, referrer, suspicious_flag) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

if ($stmt) {
    $stmt->bind_param(
        "sssssssssi",
        $realIP,  // ✅ Logs REAL visitor IP, not Cloudflare IP
        $country,
        $city,
        $userAgent,
        $requestMethod,
        $requestUri,
        $queryString,
        $postData,
        $referrer,
        $suspicious
    );

    $stmt->execute();
    $stmt->close();
}

/* ==========================
   BRUTE FORCE DETECTION
   Flags IPs with 15+ requests in 60 seconds
========================== */

$check = $conn->prepare("
SELECT COUNT(*) as total 
FROM visitor_logs 
WHERE ip_address = ? 
AND created_at >= NOW() - INTERVAL 60 SECOND
");

if ($check) {
    $check->bind_param("s", $realIP);
    $check->execute();
    $res = $check->get_result();
    $row = $res->fetch_assoc();

    if ($row && $row['total'] >= 15) {

        // ⚠️ VULNERABILITY: SQL Injection in UPDATE statement
        // This is intentional for cybersecurity learning
        // Students should identify this and fix with prepared statements
        $conn->query("
        UPDATE visitor_logs 
        SET suspicious_flag = 1 
        WHERE ip_address = '$realIP'
        AND created_at >= NOW() - INTERVAL 60 SECOND
        ");
        
        // Log brute force attempt
        file_put_contents(
            "brute_force_log.txt", 
            date('Y-m-d H:i:s') . " - Brute force detected from: $realIP ($country)\n", 
            FILE_APPEND
        );
    }

    $check->close();
}

/* ==========================
   PERFORMANCE MONITORING (Optional)
========================== */

// Track script execution time
$executionTime = microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];
if ($executionTime > 1) {
    file_put_contents(
        "slow_log.txt",
        date('Y-m-d H:i:s') . " - Slow logging: {$executionTime}s for IP: $realIP\n",
        FILE_APPEND
    );
}

?>