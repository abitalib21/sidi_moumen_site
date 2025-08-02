<?php
$filename = 'data/customers.csv';
$updated = false;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $customers = [];

    // قراءة البيانات
    if (($handle = fopen($filename, 'r')) !== FALSE) {
        while (($data = fgetcsv($handle)) !== FALSE) {
            if ($data[0] == $id) {
                $current = $data;
            }
            $customers[] = $data;
        }
        fclose($handle);
    }
}

if (isset($_POST['submit'])) {
    $updatedData = [
        $_POST['id'],
        $_POST['name'],
        $_POST['phone'],
        $_POST['email'],
        $_POST['membership']
    ];

    // تحديث البيانات
    foreach ($customers as &$cust) {
        if ($cust[0] == $_POST['id']) {
            $cust = $updatedData;
            $updated = true;
            break;
        }
    }

    // حفظ الملف
    $handle = fopen($filename, 'w');
    foreach ($customers as $cust) {
        fputcsv($handle, $cust);
    }
    fclose($handle);

    header("Location: dashboard_customers.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تعديل بيانات العميل</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>تعديل بيانات العميل</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?= $current[0] ?>">
        <label>الاسم: <input type="text" name="name" value="<?= $current[1] ?>" required></label><br>
        <label>الهاتف: <input type="text" name="phone" value="<?= $current[2] ?>" required></label><br>
        <label>البريد الإلكتروني: <input type="email" name="email" value="<?= $current[3] ?>" required></label><br>
        <label>نوع الانخراط: 
            <select name="membership" required>
                <option value="عادي" <?= $current[4]=="عادي" ? "selected" : "" ?>>عادي</option>
                <option value="ذهبي" <?= $current[4]=="ذهبي" ? "selected" : "" ?>>ذهبي</option>
                <option value="مميز" <?= $current[4]=="مميز" ? "selected" : "" ?>>مميز</option>
            </select>
        </label><br><br>
        <button type="submit" name="submit">تحديث</button>
    </form>
</body>
</html>
