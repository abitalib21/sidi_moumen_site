<?php include 'header.php'; ?>
<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

$requests = [];
$csvFile = 'training_requests.csv';

if (file_exists($csvFile)) {
    $file = fopen($csvFile, 'r');
    while (($data = fgetcsv($file)) !== false) {
        $requests[] = $data;
    }
    fclose($file);
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>طلبات التكوين - لوحة التحكم</title>
    <link rel="stylesheet" href="dashboard_style.css">
</head>
<body>
    <?php include("navbar.php"); ?>
    <div class="container">
        <h1 class="page-title">طلبات التسجيل في التكوينات</h1>
        <?php if (count($requests) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>الاسم الكامل</th>
                        <th>رقم الهاتف</th>
                        <th>البريد الإلكتروني</th>
                        <th>الدورة المطلوبة</th>
                        <th>تاريخ التسجيل</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $row): ?>
                        <tr>
                            <?php foreach ($row as $cell): ?>
                                <td><?= htmlspecialchars($cell) ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>لا توجد أي طلبات مسجلة حالياً.</p>
        <?php endif; ?>
    </div>
</body>
</html>
