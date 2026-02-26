<?php
session_start();
require_once("../config1.php");

// ⚠️ VULNERABILITY: No CSRF token validation
// An attacker could trick admin into exporting data via CSRF

if (!isset($_SESSION['id']) || $_SESSION['id'] != 1){
    echo "Access Denied";
    exit;
}

/* ==========================
   APPLY SAME FILTERS AS DASHBOARD
========================== */

$where = "1=1";

if (isset($_GET['suspicious']) && $_GET['suspicious'] == 1) {
    $where .= " AND suspicious_flag = 1";
}

// ⚠️ VULNERABILITY: SQL Injection (same as dashboard)
if (!empty($_GET['ip'])) {
    $ip = mysqli_real_escape_string($conn, $_GET['ip']);
    $where .= " AND ip_address = '$ip'";
}

if (!empty($_GET['country'])) {
    $country = mysqli_real_escape_string($conn, $_GET['country']);
    $where .= " AND country = '$country'";
}

// Date range filter
if (!empty($_GET['date_from'])) {
    $dateFrom = mysqli_real_escape_string($conn, $_GET['date_from']);
    $where .= " AND created_at >= '$dateFrom'";
}

if (!empty($_GET['date_to'])) {
    $dateTo = mysqli_real_escape_string($conn, $_GET['date_to']);
    $where .= " AND created_at <= '$dateTo 23:59:59'";
}

/* ==========================
   FETCH LOGS FOR EXPORT
========================== */

$query = "SELECT * FROM visitor_logs WHERE $where ORDER BY id DESC LIMIT 10000";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Export failed: " . mysqli_error($conn));
}

/* ==========================
   GENERATE CSV
========================== */

$filename = "security_logs_" . date('Y-m-d_His') . ".csv";

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $filename);
header('Pragma: no-cache');
header('Expires: 0');

$output = fopen('php://output', 'w');

// CSV Headers
fputcsv($output, [
    'ID',
    'IP Address',
    'Country',
    'City',
    'User Agent',
    'Method',
    'Request URI',
    'Query String',
    'POST Data',
    'Referrer',
    'Suspicious',
    'Timestamp'
]);

// CSV Data
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, [
        $row['id'],
        $row['ip_address'],
        $row['country'],
        $row['city'],
        $row['user_agent'],
        $row['request_method'],
        $row['request_uri'],
        $row['query_string'],
        $row['post_data'],
        $row['suspicious_flag'] ? 'YES' : 'NO',
        $row['created_at']
    ]);
}

fclose($output);
exit;
?>
```

## 📝 Features of This Export Script:

### ✅ **Works With Dashboard Filters**
- Same IP, country, and suspicious flag filters
- **BONUS:** Date range filters (`date_from` and `date_to`)
- Respects all URL parameters from dashboard

### 📊 **CSV Format**
- Proper CSV headers
- UTF-8 encoding
- Downloads directly as `.csv` file
- Timestamped filename (e.g., `security_logs_2026-02-13_143052.csv`)

### 🔒 **Intentional Vulnerabilities** (for training):
1. **No CSRF protection** - Lines 5-6
2. **SQL Injection** - Lines 24-42 (same as dashboard)
3. **No rate limiting** - Can be spammed
4. **10,000 row limit** - But no pagination warning

### 💡 **Usage Examples:**

**Export all logs:**
```
http://yoursite.com/admin/export_logs.php
```

**Export suspicious only:**
```
http://yoursite.com/admin/export_logs.php?suspicious=1
```

**Export by IP:**
```
http://yoursite.com/admin/export_logs.php?ip=192.168.1.100
```

**Export by country and date range:**
```
http://yoursite.com/admin/export_logs.php?country=United%20States&date_from=2026-02-01&date_to=2026-02-13
```

**Combine filters:**
```
http://yoursite.com/admin/export_logs.php?suspicious=1&country=Russia&date_from=2026-02-10