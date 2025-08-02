<?php include 'header.php'; ?>
<?php
session_start();
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: login.php");
    exit;
}

// قراءة ملف المنتجات
$products = array_map('str_getcsv', file('data/products.csv'));
array_shift($products); // حذف السطر الأول (رؤوس الأعمدة)

$monthly_counts = [];
$category_counts = [];

foreach ($products as $product) {
    $date = $product[4];
    $category = $product[2];

    $month = date('Y-m', strtotime($date));
    $monthly_counts[$month] = ($monthly_counts[$month] ?? 0) + 1;
    $category_counts[$category] = ($category_counts[$category] ?? 0) + 1;
}

// ترتيب الأشهر حسب التاريخ
ksort($monthly_counts);
ksort($category_counts);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إحصائيات المنتجات</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body style="margin:0; font-family:Arial, sans-serif; background:#f8f9fa;">

<!-- الشريط الجانبي -->
<?php include("admin_sidebar.php"); ?>

<div style="margin-right: 240px; padding: 20px;">
    <h2 style="text-align: center;">إحصائيات المنتجات</h2>

    <!-- الرسم البياني الأول: حسب الأشهر -->
    <div style="margin: 40px auto; width: 80%;">
        <h3 style="text-align: center;">عدد المنتجات حسب الشهر</h3>
        <canvas id="monthlyChart"></canvas>
    </div>

    <!-- الرسم البياني الثاني: حسب الفئة -->
    <div style="margin: 40px auto; width: 80%;">
        <h3 style="text-align: center;">عدد المنتجات حسب الفئة</h3>
        <canvas id="categoryChart"></canvas>
    </div>
</div>

<script>
    const monthlyData = {
        labels: <?= json_encode(array_keys($monthly_counts)) ?>,
        datasets: [{
            label: 'عدد المنتجات',
            data: <?= json_encode(array_values($monthly_counts)) ?>,
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            fill: true,
            tension: 0.3
        }]
    };

    const categoryData = {
        labels: <?= json_encode(array_keys($category_counts)) ?>,
        datasets: [{
            label: 'عدد المنتجات',
            data: <?= json_encode(array_values($category_counts)) ?>,
            backgroundColor: [
                '#ff6384', '#36a2eb', '#ffcd56', '#4bc0c0', '#9966ff', '#f67019'
            ]
        }]
    };

    new Chart(document.getElementById('monthlyChart'), {
        type: 'line',
        data: monthlyData,
        options: {
            responsive: true,
            plugins: {
                legend: { display: true, position: 'bottom' },
                title: { display: false }
            }
        }
    });

    new Chart(document.getElementById('categoryChart'), {
        type: 'bar',
        data: categoryData,
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: false }
            }
        }
    });
</script>

</body>
</html>
