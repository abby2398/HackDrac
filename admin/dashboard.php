<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
require_once("../config1.php");

if (!isset($_SESSION['id']) || $_SESSION['id'] != 1){
    echo "Access Denied";
    exit;
}

/* ==========================
   SECURITY LOG FILTERS
   ⚠️ VULNERABLE: SQL Injection in WHERE clause (intentional for learning)
========================== */

$where = "1=1";

if (isset($_GET['suspicious']) && $_GET['suspicious'] == 1) {
    $where .= " AND suspicious_flag = 1";
}

// ⚠️ VULNERABILITY: SQL Injection - escaped but still concatenated into raw SQL
if (!empty($_GET['ip'])) {
    $ip = mysqli_real_escape_string($conn, $_GET['ip']);
    $where .= " AND ip_address = '$ip'";
}

// ⚠️ VULNERABILITY: SQL Injection - escaped but still concatenated into raw SQL
if (!empty($_GET['country'])) {
    $country = mysqli_real_escape_string($conn, $_GET['country']);
    $where .= " AND country = '$country'";
}

/* ==========================
   PAGINATION
========================== */

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 50;
$offset = ($page - 1) * $perPage;

/* ==========================
   FETCH LOGS
========================== */

$logsQuery = "SELECT * FROM visitor_logs WHERE $where ORDER BY id DESC LIMIT $perPage OFFSET $offset";
$logsResult = mysqli_query($conn, $logsQuery);

$totalLogs = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) as total FROM visitor_logs WHERE $where")
)['total'];

$totalPages = ceil($totalLogs / $perPage);

$totalAllLogs = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) as total FROM visitor_logs")
)['total'];

$totalSuspicious = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) as total FROM visitor_logs WHERE suspicious_flag=1")
)['total'];

/* ==========================
   ATTACK GRAPH (24H) - Fixed to show all hours
========================== */

$chartLabels = [];
$chartData = [];

// Generate all 24 hours
for ($i = 23; $i >= 0; $i--) {
    $hour = date('H:00', strtotime("-$i hours"));
    $chartLabels[] = $hour;
    $chartData[$hour] = 0; // Initialize with 0
}

$graphQuery = "
SELECT DATE_FORMAT(created_at, '%H:00') as hour, COUNT(*) as total
FROM visitor_logs
WHERE created_at >= NOW() - INTERVAL 24 HOUR
GROUP BY hour
ORDER BY hour ASC
";

$graphResult = mysqli_query($conn, $graphQuery);

while ($row = mysqli_fetch_assoc($graphResult)) {
    $chartData[$row['hour']] = $row['total'];
}

// Convert to array for JSON
$chartDataArray = array_values($chartData);

/* ==========================
   GEO DATA - Fixed for proper map rendering
========================== */

$geoData = [];

$geoQuery = "
SELECT country, COUNT(*) as total
FROM visitor_logs
WHERE country IS NOT NULL AND country != '' AND country != 'Unknown'
GROUP BY country
ORDER BY total DESC
";

$geoResult = mysqli_query($conn, $geoQuery);

while ($row = mysqli_fetch_assoc($geoResult)) {
    $geoData[$row['country']] = $row['total'];
}

/* ==========================
   TOP ATTACKING IPs
========================== */

$topIPsQuery = "
SELECT ip_address, country, COUNT(*) as total
FROM visitor_logs
WHERE suspicious_flag = 1
GROUP BY ip_address
ORDER BY total DESC
LIMIT 10
";
$topIPsResult = mysqli_query($conn, $topIPsQuery);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Hackdrac SOC Dashboard</title>
<link rel="stylesheet" href="css/admin.css">
<link rel="icon" href="/images/favicon.ico" type="image/x-icon">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-chart-geo@4.2.0/build/index.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/topojson-client@3"></script>
<style>
.pagination {
    margin: 20px 0;
    text-align: center;
}
.pagination a {
    display: inline-block;
    padding: 10px 15px;
    margin: 0 5px;
    background: #2a2a2a;
    color: #00ff99;
    text-decoration: none;
    border-radius: 5px;
    border: 2px solid #00ff99;
    transition: all 0.3s ease;
    font-weight: bold;
}
.pagination a:hover {
    background: #1a1a1a;
    box-shadow: 0 0 10px rgba(0, 255, 153, 0.5);
    transform: translateY(-2px);
}
.pagination a.active {
    background: linear-gradient(135deg, #00ff99 0%, #00ccff 100%);
    color: #000;
    border-color: #00ccff;
}
.top-ips-box {
    background: #1a1a1a;
    padding: 20px;
    margin: 20px 0;
    border-radius: 8px;
    border: 2px solid #ff4444;
    box-shadow: 0 0 20px rgba(255, 68, 68, 0.2);
}
.top-ips-box h3 {
    color: #ff4444;
    margin-bottom: 15px;
    font-size: 1.3em;
}
.top-ips-box table {
    width: 100%;
}
.top-ips-box td {
    padding: 10px;
}
.top-ips-box tr:nth-child(1) td:first-child {
    color: #ffd700;
    font-size: 1.2em;
}
.top-ips-box tr:nth-child(2) td:first-child {
    color: #c0c0c0;
    font-size: 1.1em;
}
.top-ips-box tr:nth-child(3) td:first-child {
    color: #cd7f32;
    font-size: 1.05em;
}
</style>
</head>

<body>

<h1>🛡 Hackdrac SOC Dashboard</h1>
<hr>

<h2>🚨 Security Monitoring</h2>

<div class="security-stats">
<div class="stat-box">
<h3>Total Visits</h3>
<p><?php echo number_format($totalAllLogs); ?></p>
</div>
<div class="stat-box">
<h3>Suspicious Attempts</h3>
<p style="color:red;"><?php echo number_format($totalSuspicious); ?></p>
</div>
<div class="stat-box">
<h3>Threat Level</h3>
<p style="color:<?php echo ($totalSuspicious / max($totalAllLogs, 1) > 0.3) ? 'red' : 'orange'; ?>;">
<?php 
$threatPercent = ($totalAllLogs > 0) ? round(($totalSuspicious / $totalAllLogs) * 100, 1) : 0;
echo $threatPercent . '%';
?>
</p>
</div>
</div>

<br>

<!-- FILTERS -->
<form method="GET" style="margin-bottom:15px;">
    <!-- ⚠️ VULNERABILITY: No CSRF protection on form -->
    
    <input type="text" name="ip" placeholder="Filter by IP" 
           value="<?php echo htmlspecialchars($_GET['ip'] ?? ''); ?>" 
           style="padding:8px;">
    
    <select name="country">
        <option value="">All Countries</option>
        <?php
        $countryList = mysqli_query($conn, "SELECT DISTINCT country FROM visitor_logs WHERE country IS NOT NULL ORDER BY country ASC");
        while ($row = mysqli_fetch_assoc($countryList)) {
            $selected = (isset($_GET['country']) && $_GET['country'] == $row['country']) ? "selected" : "";
            // ⚠️ VULNERABILITY: XSS - country value not escaped in option value
            echo "<option value='{$row['country']}' $selected>" . htmlspecialchars($row['country']) . "</option>";
        }
        ?>
    </select>

    <select name="suspicious">
        <option value="">All</option>
        <option value="1" <?php if(isset($_GET['suspicious']) && $_GET['suspicious']==1) echo "selected"; ?>>
            Only Suspicious
        </option>
    </select>

    <button type="submit">Apply Filter</button>
    <a href="?"><button type="button">Clear Filters</button></a>
</form>

<a href="export_logs.php"><button>📁 Export Logs as CSV</button></a>

<!-- TOP ATTACKING IPs -->
<?php if (mysqli_num_rows($topIPsResult) > 0): ?>
<div class="top-ips-box">
<h3>🎯 Top 10 Attacking IPs</h3>
<table>
<thead>
<tr>
<th>Rank</th>
<th>IP Address</th>
<th>Country</th>
<th>Attack Count</th>
</tr>
</thead>
<tbody>
<?php 
$rank = 1;
while($ip = mysqli_fetch_assoc($topIPsResult)): 
?>
<tr>
<td><?php echo $rank++; ?></td>
<td><a href="?ip=<?php echo $ip['ip_address']; ?>"><?php echo $ip['ip_address']; ?></a></td>
<td><?php echo htmlspecialchars($ip['country']); ?></td>
<td style="color:red;font-weight:bold;"><?php echo $ip['total']; ?></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
<?php endif; ?>

<!-- LOG TABLE -->
<div class="logs-window">
<p style="margin-bottom:10px;">Showing <?php echo number_format($totalLogs); ?> result(s)</p>
<table>
<thead>
<tr>
<th>IP</th>
<th>Country</th>
<th>Method</th>
<th>URL</th>
<th>Status</th>
<th>Time</th>
</tr>
</thead>
<tbody>
<?php while($log = mysqli_fetch_assoc($logsResult)): ?>
<tr class="<?php echo $log['suspicious_flag'] ? 'danger-row' : ''; ?>">
<td>
<a href="?ip=<?php echo $log['ip_address']; ?>">
<?php echo $log['ip_address']; ?>
</a>
</td>
<td><?php echo htmlspecialchars($log['country']); ?></td>
<td><?php echo $log['request_method']; ?></td>
<td><?php echo htmlspecialchars($log['request_uri']); ?></td>
<td>
<?php
if ($log['suspicious_flag']) {
    echo "<span style='color:orange;font-weight:bold;'>⚠️ Suspicious</span>";
} else {
    echo "<span style='color:#00ff99;'>✔ Normal</span>";
}
?>
</td>
<td><?php echo $log['created_at']; ?></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>

<!-- PAGINATION -->
<?php if ($totalPages > 1): ?>
<div class="pagination">
<?php if ($page > 1): ?>
    <a href="?page=<?php echo ($page-1); ?><?php echo isset($_GET['country']) ? '&country='.urlencode($_GET['country']) : ''; ?><?php echo isset($_GET['ip']) ? '&ip='.urlencode($_GET['ip']) : ''; ?><?php echo isset($_GET['suspicious']) ? '&suspicious='.$_GET['suspicious'] : ''; ?>">« Previous</a>
<?php endif; ?>

<?php for ($i = max(1, $page-2); $i <= min($totalPages, $page+2); $i++): ?>
    <a href="?page=<?php echo $i; ?><?php echo isset($_GET['country']) ? '&country='.urlencode($_GET['country']) : ''; ?><?php echo isset($_GET['ip']) ? '&ip='.urlencode($_GET['ip']) : ''; ?><?php echo isset($_GET['suspicious']) ? '&suspicious='.$_GET['suspicious'] : ''; ?>" 
       class="<?php echo ($i == $page) ? 'active' : ''; ?>">
        <?php echo $i; ?>
    </a>
<?php endfor; ?>

<?php if ($page < $totalPages): ?>
    <a href="?page=<?php echo ($page+1); ?><?php echo isset($_GET['country']) ? '&country='.urlencode($_GET['country']) : ''; ?><?php echo isset($_GET['ip']) ? '&ip='.urlencode($_GET['ip']) : ''; ?><?php echo isset($_GET['suspicious']) ? '&suspicious='.$_GET['suspicious'] : ''; ?>">Next »</a>
<?php endif; ?>
</div>
<?php endif; ?>

<hr>

<h2>📈 Live Traffic (Last 24h)</h2>
<div class="chart-container">
<canvas id="attackChart"></canvas>
</div>

<script>
new Chart(document.getElementById('attackChart'), {
    type: 'line',
    data: {
        labels: <?php echo json_encode($chartLabels); ?>,
        datasets: [{
            label: 'Requests per Hour',
            data: <?php echo json_encode($chartDataArray); ?>,
            borderColor: '#00ff99',
            backgroundColor: 'rgba(0,255,153,0.1)',
            tension: 0.3,
            fill: true
        }]
    },
    options: { 
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});
</script>

<h2>🌍 Global Attack Distribution</h2>
<div class="chart-container" style="height:600px;">
<canvas id="geoChart"></canvas>
</div>

<script>
(async () => {

try {
    if (!window.Chart || !window.ChartGeo) {
        console.error("Chart or ChartGeo not loaded");
        document.getElementById('geoChart').parentElement.innerHTML = 
            '<p style="color:red;">Failed to load map libraries. Check CDN connection.</p>';
        return;
    }

    // Proper registration
    Chart.register(
        ChartGeo.ChoroplethController,
        ChartGeo.GeoFeature,
        ChartGeo.ProjectionScale,
        ChartGeo.ColorScale
    );

    // Load world data
    const world = await fetch(
        "https://cdn.jsdelivr.net/npm/world-atlas@2/countries-110m.json"
    ).then(res => res.json());

    const countries = ChartGeo.topojson.feature(
        world,
        world.objects.countries
    ).features;

    // PHP data - country names from ip-api.com
    const geoData = <?php echo json_encode($geoData); ?>;

    // Country name mapping (ip-api.com format → GeoJSON format)
    const countryMap = {
        'United States': 'United States of America',
        'Russia': 'Russian Federation',
        'South Korea': 'Republic of Korea',
        'North Korea': 'North Korea',
        'Vietnam': 'Viet Nam',
        'Iran': 'Iran',
        'Syria': 'Syria',
        'Tanzania': 'Tanzania',
        'Bolivia': 'Bolivia',
        'Venezuela': 'Venezuela',
        'Moldova': 'Moldova',
        'Laos': 'Laos',
        'Brunei': 'Brunei Darussalam',
        'Palestine': 'Palestine',
        'Czechia': 'Czech Republic',
        'Macedonia': 'Macedonia',
        'The Netherlands': 'Netherlands'
    };

    // Build lookup with normalized names
    const dataMap = {};
    const maxValue = Math.max(...Object.values(geoData), 1);

    for (const [country, count] of Object.entries(geoData)) {
        // Try direct match first
        let normalizedName = country.trim();
        
        // Then try mapping
        if (countryMap[normalizedName]) {
            normalizedName = countryMap[normalizedName];
        }
        
        dataMap[normalizedName.toLowerCase()] = count;
    }

    new Chart(
        document.getElementById("geoChart"),
        {
            type: "choropleth",
            data: {
                labels: countries.map(d => d.properties.name),
                datasets: [{
                    label: "Attack Count",
                    data: countries.map(feature => {
                        const name = feature.properties.name.toLowerCase().trim();
                        const value = dataMap[name] || 0;
                        return {
                            feature: feature,
                            value: value
                        };
                    }),
                    backgroundColor: ctx => {
                        const value = ctx.raw?.value || 0;
                        if (!value) return "rgba(25,25,25,0.4)";
                        const intensity = value / maxValue;
                        return `rgba(255,${Math.floor(50 * (1-intensity))},0,${0.25 + intensity * 0.75})`;
                    },
                    borderColor: "rgba(0,255,150,0.2)",
                    borderWidth: 0.5
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx =>
                                ctx.raw.feature.properties.name +
                                " : " + ctx.raw.value + " attacks"
                        }
                    }
                },
                scales: {
                    projection: {
                        axis: "x",
                        projection: "equalEarth"
                    }
                }
            }
        }
    );

} catch (error) {
    console.error('Failed to load geo map:', error);
    document.getElementById('geoChart').parentElement.innerHTML = 
        '<p style="color:red;">Failed to load map. Check console for details.</p>';
}

})();
</script>

<hr>
<p>Hackdrac Security Console v3.1 | ⚠️ Training Environment - Contains intentional vulnerabilities</p>

</body>
</html>