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
========================== */

$where = "1=1";

if (isset($_GET['suspicious']) && $_GET['suspicious'] == 1) {
    $where .= " AND suspicious_flag = 1";
}

if (!empty($_GET['ip'])) {
    $ip = mysqli_real_escape_string($conn, $_GET['ip']);
    $where .= " AND ip_address = '$ip'";
}

if (!empty($_GET['country'])) {
    $country = mysqli_real_escape_string($conn, $_GET['country']);
    $where .= " AND country = '$country'";
}

/* ==========================
   FETCH LOGS
========================== */

$logsQuery = "SELECT * FROM visitor_logs WHERE $where ORDER BY id DESC LIMIT 200";
$logsResult = mysqli_query($conn, $logsQuery);

$totalLogs = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) as total FROM visitor_logs")
)['total'];

$totalSuspicious = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) as total FROM visitor_logs WHERE suspicious_flag=1")
)['total'];

/* ==========================
   ATTACK GRAPH (24H)
========================== */

$chartLabels = [];
$chartData = [];

$graphQuery = "
SELECT DATE_FORMAT(created_at, '%H:00') as hour, COUNT(*) as total
FROM visitor_logs
WHERE created_at >= NOW() - INTERVAL 24 HOUR
GROUP BY hour
ORDER BY hour ASC
";

$graphResult = mysqli_query($conn, $graphQuery);

while ($row = mysqli_fetch_assoc($graphResult)) {
    $chartLabels[] = $row['hour'];
    $chartData[] = $row['total'];
}

/* ==========================
   GEO DATA
========================== */

$geoLabels = [];
$geoData = [];

$geoQuery = "
SELECT country, COUNT(*) as total
FROM visitor_logs
WHERE country IS NOT NULL AND country != ''
GROUP BY country
ORDER BY total DESC
";

$geoResult = mysqli_query($conn, $geoQuery);

while ($row = mysqli_fetch_assoc($geoResult)) {
    $geoLabels[] = $row['country'];
    $geoData[] = $row['total'];
}
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
</head>

<body>

<h1>🛡 Hackdrac SOC Dashboard</h1>
<hr>

<h2>🚨 Security Monitoring</h2>

<div class="security-stats">
<div class="stat-box">
<h3>Total Visits</h3>
<p><?php echo $totalLogs; ?></p>
</div>
<div class="stat-box">
<h3>Suspicious Attempts</h3>
<p style="color:red;"><?php echo $totalSuspicious; ?></p>
</div>
</div>

<br>

<!-- FILTERS -->
<form method="GET" style="margin-bottom:15px;">
    <select name="country">
        <option value="">All Countries</option>
        <?php
        $countryList = mysqli_query($conn, "SELECT DISTINCT country FROM visitor_logs ORDER BY country ASC");
        while ($row = mysqli_fetch_assoc($countryList)) {
            $selected = (isset($_GET['country']) && $_GET['country'] == $row['country']) ? "selected" : "";
            echo "<option value='{$row['country']}' $selected>{$row['country']}</option>";
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
</form>

<a href="export_logs.php"><button>📁 Export Logs as CSV</button></a>

<!-- LOG TABLE -->
<div class="logs-window">
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
<td><?php echo $log['country']; ?></td>
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
            data: <?php echo json_encode($chartData); ?>,
            borderColor: '#00ff99',
            backgroundColor: 'rgba(0,255,153,0.1)',
            tension: 0.3
        }]
    },
    options: { maintainAspectRatio: false }
});
</script>

<h2>🌍 Global Attack Distribution</h2>
<div class="chart-container" style="height:600px;">
<canvas id="geoChart"></canvas>
</div>

<script>
(async () => {

if (!window.Chart || !window.ChartGeo) {
    console.error("Chart or ChartGeo not loaded");
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

// PHP data
const geoLabels = <?php echo json_encode($geoLabels ?? []); ?>;
const geoData   = <?php echo json_encode($geoData ?? []); ?>;

// Build lookup
const dataMap = {};
for (let i = 0; i < geoLabels.length; i++) {
    if (!geoLabels[i]) continue;
    dataMap[geoLabels[i].toLowerCase().trim()] = geoData[i];
}

// Country name fixes
const fixes = {
    "united states": "united states of america",
    "the netherlands": "netherlands",
    "south korea": "republic of korea",
    "russia": "russian federation",
    "vietnam": "viet nam"
};

Object.keys(fixes).forEach(key => {
    if (dataMap[key]) {
        dataMap[fixes[key]] = dataMap[key];
    }
});

const maxValue = Math.max(...geoData, 1);

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
                    return {
                        feature: feature,
                        value: dataMap[name] || 0
                    };
                }),
                backgroundColor: ctx => {
                    const value = ctx.raw?.value || 0;
                    if (!value) return "rgba(25,25,25,0.4)";
                    const intensity = value / maxValue;
                    return `rgba(255,0,0,${0.25 + intensity * 0.75})`;
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
                            " : " + ctx.raw.value + " hits"
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

})();
</script>
<hr>
<p>Hackdrac Security Console v3.0</p>

</body>
</html>