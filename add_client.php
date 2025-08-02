<?php include 'header.php'; ?>

<?php
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $type = trim($_POST['type']);

    if ($name && $email && $phone && $type) {
        $csvFile = 'clients.csv';
        $lastId = 0;

        if (file_exists($csvFile)) {
            $lines = file($csvFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if (!empty($lines)) {
                $lastLine = explode(',', end($lines));
                $lastId = (int)$lastLine[0];
            }
        }

        $newId = $lastId + 1;
        $entry = [$newId, $name, $email, $phone, $type];

        $fp = fopen($csvFile, 'a');
        fputcsv($fp, $entry);
        fclose($fp);

        $success = "تم إضافة العميل بنجاح.";
    } else {
        $error = "المرجو تعبئة جميع الحقول.";
    }
}
?>

<div class="main-content">
    <h2>إضافة عميل جديد</h2>

    <?php if ($success): ?>
        <div class="msg success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="msg error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <label>الاسم الكامل:</label>
        <input type="text" name="name" required>

        <label>البريد الإلكتروني:</label>
        <input type="email" name="email" required>

        <label>رقم الهاتف:</label>
        <input type="text" name="phone" required>

        <label>نوع الحساب:</label>
        <select name="type" required>
            <option value="فردي">فردي</option>
            <option value="تعاونية">تعاونية</option>
        </select>

        <button type="submit" class="btn add">إضافة</button>
    </form>
</div>

<?php include 'footer.php'; ?>
