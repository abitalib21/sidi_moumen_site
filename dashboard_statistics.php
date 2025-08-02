<?php include 'header.php'; ?>

<?php
// قراءة ملفات CSV لحساب الإحصائيات الأساسية

function countCSVLines($filename) {
    if (!file_exists($filename)) return 0;
    $lines = file($filename, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
    return count($lines);
}

$totalCooperatives = countCSVLines('cooperatives.csv');
$totalProducts = countCSVLines('products.csv');
$totalClients = countCSVLines('clients.csv');
$totalTrainings = countCSVLines('trainings.csv');
?>

<div class="main-content">
    <h2>لوحة التحكم - الإحصائيات</h2>

    <ul>
        <li>عدد التعاونيات: <?= $totalCooperatives ?></li>
        <li>عدد المنتجات: <?= $totalProducts ?></li>
        <li>عدد العملاء: <?= $totalClients ?></li>
        <li>عدد طلبات التكوين: <?= $totalTrainings ?></li>
    </ul>
</div>

<?php include 'footer.php'; ?>
