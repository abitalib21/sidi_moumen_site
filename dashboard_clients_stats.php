<?php include 'header.php'; ?>
<?php
// تحميل بيانات العملاء
$clientsFile = fopen("data/clients.csv", "r");
$clients = [];
$headers = fgetcsv($clientsFile);
while (($data = fgetcsv($clientsFile)) !== false) {
    $clients[] = array_combine($headers, $data);
}
fclose($clientsFile);

// تحضير بيانات الرسم البياني (حسب الشهر)
$monthlyCounts = [];
foreach ($clients as $client) {
    $date = date("Y-m", strtotime($client['date_inscription']));
    if (!isset($monthlyCounts[$date])) {
        $monthlyCounts[$date] = 0;
    }
    $monthlyCounts[$date]++;
}
ksort($monthlyCounts); // ترتيب حسب التاريخ
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>إحصائيات العملاء</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include 'navbar_admin.php'; ?>

  <div class="container">
    <h2>إحصائيات تسجيل العملاء</h2>
    <canvas id="clientChart" width="400" height="200"></canvas>
  </div>

  <script>
    const ctx = document.getElementById('clientChart').getContext('2d');
    const chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?= json_encode(array_keys($monthlyCounts)) ?>,
        datasets: [{
          label: 'عدد العملاء الجدد',
          data: <?= json_encode(array_values($monthlyCounts)) ?>,
          backgroundColor: 'rgba(255, 99, 132, 0.5)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            stepSize: 1
          }
        }
      }
    });
  </script>
</body>
</html>
