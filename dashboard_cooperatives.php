<?php include 'header.php'; ?>
<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include 'sidebar.php';

// تحميل بيانات التعاونيات من الملف
$csvFile = fopen("data/cooperatives.csv", "r");
$cooperatives = [];
$headers = fgetcsv($csvFile); // قراء عناوين الأعمدة

while (($row = fgetcsv($csvFile)) !== FALSE) {
    $cooperatives[] = array_combine($headers, $row);
}
fclose($csvFile);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>إدارة التعاونيات</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="main-content">
    <h1>قائمة التعاونيات</h1>
    <table border="1" cellpadding="10" cellspacing="0">
      <tr>
        <?php foreach ($headers as $header): ?>
          <th><?= htmlspecialchars($header) ?></th>
        <?php endforeach; ?>
        <th>تعديل</th>
        <th>حذف</th>
      </tr>
      <?php foreach ($cooperatives as $index => $coop): ?>
        <tr>
          <?php foreach ($coop as $value): ?>
            <td><?= htmlspecialchars($value) ?></td>
          <?php endforeach; ?>
          <td><a href="edit_cooperative.php?id=<?= $index ?>">تعديل</a></td>
          <td><a href="delete_cooperative.php?id=<?= $index ?>" onclick="return confirm('هل أنت متأكد من الحذف؟');">حذف</a></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>
