<?php include 'header.php'; ?>

<?php
$csvFile = 'clients.csv';
$error = '';
$success = '';

if (!isset($_GET['id'])) {
    die("معرف العميل غير موجود.");
}

$id = $_GET['id'];
$clients = [];
$clientData = null;

if (($handle = fopen($csvFile, 'r')) !== FALSE) {
    while (($data = fgetcsv($handle)) !== FALSE) {
        if ($data[0] == $id) {
            $clientData = $data;
        }
        $clients[] = $data;
    }
    fclose($handle);
}

if (!$clientData) {
    die("العميل غير موجود.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $type = trim($_POST['type']);

    if ($name && $email && $phone && $type) {
        foreach ($clients as &$row) {
            if ($row[0] == $id) {
                $row[1] = $name;
                $row[2] = $email;
                $row[3] = $phone;
                $row[4] = $type;
                break;
            }
        }

        $handle = fopen($csvFile, 'w');
        foreach ($clients as $row) {
            fputcsv($handle, $row);
        }
        fclose($handle);

        $success = "تم تحديث بيانات العميل بنجاح.";
        $clientData = [$id, $name, $email, $phone, $type];
    } else {
        $error = "المرجو تعبئة جميع الحقول.";
    }
}
?>

<div class="main-content">
    <h2>تعديل بيانات العميل</h2>

    <?php if ($success): ?>
        <div class="msg success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="msg error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <label>الاسم الكامل:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($clientData[1]) ?>" required>

        <label>البريد الإلكتروني:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($clientData[2]) ?>" required>

        <label>رقم الهاتف:</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($clientData[3]) ?>" required>

        <label>نوع الحساب:</label>
        <select name="type" required>
            <option value="فردي" <?= $clientData[4] === 'فردي' ? 'selected' : '' ?>>فردي</option>
            <option value="تعاونية" <?= $clientData[4] === 'تعاونية' ? 'selected' : '' ?>>تعاونية</option>
        </select>

        <button type="submit" class="btn edit">تحديث</button>
    </form>
</div>

<?php include 'footer.php'; ?>
