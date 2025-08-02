<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$csvFile = "data/cooperatives.csv";

// تحميل البيانات
$rows = [];
$headers = [];
if (($handle = fopen($csvFile, "r")) !== FALSE) {
    $headers = fgetcsv($handle);
    while (($data = fgetcsv($handle)) !== FALSE) {
        $rows[] = $data;
    }
    fclose($handle);
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : -1;
if ($id < 0 || $id >= count($rows)) {
    echo "تعاونية غير موجودة.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($headers as $index => $header) {
        $rows[$id][$index] = $_POST[$header] ?? "";
    }

    $fp = fopen($csvFile, 'w');
    fputcsv($fp, $headers);
    foreach ($rows as $row) {
        fputcsv($fp, $row);
    }
    fclose($fp);

    header("Location: dashboard_cooperatives.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>تعديل تعاونية</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <?php include 'sidebar.php'; ?>
  <div class="main-content">
    <h1>تعديل بيانات التعاونية</h1>
    <form method="post">
      <?php foreach ($headers as $index => $header): ?>
        <label><?= htmlspecialchars($header) ?>:</label><br>
        <input type="text" name="<?= htmlspecialchars($header) ?>" value="<?= htmlspecialchars($rows[$id][$index]) ?>"><br><br>
      <?php endforeach; ?>
      <button type="submit">حفظ التعديلات</button>
    </form>
  </div>
</body>
</html>
