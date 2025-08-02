<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

$filename = 'clients.csv';
$clients = [];

if (($handle = fopen($filename, 'r')) !== false) {
    $header = fgetcsv($handle);
    while (($data = fgetcsv($handle)) !== false) {
        $clients[] = array_combine($header, $data);
    }
    fclose($handle);
}

$total_clients = count($clients);

$type_counts = [];
$date_counts = [];

foreach ($clients as $client) {
    $type = $client['type_client'];
    if (!isset($type_counts[$type])) {
        $type_counts[$type] = 0;
    }
    $type_counts[$type]++;

    $month = date('Y-m', strtotime($client['date_inscription']));
    if (!isset($date_counts[$month])) {
        $date_counts[$month] = 0;
    }
    $date_counts[$month]++;
}

ksort($date_counts);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <title>إحصائيات العملاء - لوحة التحكم</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            max-width: 900px;
            margin: auto;
            padding: 20px;
            background: #f9f9f9;
            color: #333;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #004085;
        }
        .top-bar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }
        .logout-btn {
            background-color: #dc3545;
            border: none;
            padding: 8px 15px;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .stat-box {
            background: #e9f5ff;
            border: 1px solid #b8daff;
            border-radius: 8px;
            padding: 15px 25px;
            margin-bottom: 30px;
            text-align: center;
            font-size: 1.3em;
            color: #003766;
        }
        canvas {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 40px;
            max-width: 100%;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <a href="logout.php" class="logout-btn">تسجيل الخروج</a>
</div>

<h1>إحصائيات العملاء</h1>

<div class="stat-box">
    إجمالي عدد العملاء: <strong><?= $total_clients ?></strong>
</div>

<canvas id="typeChart" width="600" height="300"></canvas>

<canvas id="dateChart" width="600" height="300"></canvas>

<script>
const typeCtx = document.getElementById('typeChart').getContext('2d');
const dateCtx = document.getElementById('dateChart').getContext('2d');

const typeLabels = <?= json_encode(array_keys($type_counts)) ?>;
const typeData = <?= json_encode(array_values($type_counts)) ?>;

const dateLabels = <?= json_encode(array_keys($date_counts)) ?>;
const dateData = <?= json_encode(array_values($date_counts)) ?>;

new Chart(typeCtx, {
    type: 'doughnut',
    data: {
        labels: typeLabels,
        datasets: [{
            label: 'عدد العملاء حسب النوع',
            data: typeData,
            backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545'],
            borderColor: '#fff',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'right',
                labels: {font: {size: 16}}
            },
            title: {
                display: true,
                text: 'عدد العملاء حسب النوع',
                font: {size: 18}
            }
        }
    }
});

new Chart(dateCtx, {
    type: 'bar',
    data: {
        labels: dateLabels,
        datasets: [{
            label: 'عدد التسجيلات',
            data: dateData,
            backgroundColor: '#17a2b8',
            borderColor: '#117a8b',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {beginAtZero: true, stepSize: 1}
        },
        plugins: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: 'توزيع تسجيل العملاء حسب الشهر',
                font: {size: 18}
            }
        }
    }
});
</script>

</body>
</html>
