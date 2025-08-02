<?php include 'header.php'; ?>

<?php
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $desc = trim($_POST['desc']);

    // التعامل مع رفع الصورة
    $imagePath = '';
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imagePath = $targetFile;
        } else {
            $error = "فشل رفع الصورة.";
        }
    }

    if ($name && $price && $desc && !$error) {
        $csvFile = 'products.csv';
        $lastId = 0;

        if (file_exists($csvFile)) {
            $lines = file($csvFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if (!empty($lines)) {
                $lastLine = explode(',', end($lines));
                $lastId = (int)$lastLine[0];
            }
        }

        $newId = $lastId + 1;
        $entry = [$newId, $name, $price, $desc, $imagePath];

        $fp = fopen($csvFile, 'a');
        fputcsv($fp, $entry);
        fclose($fp);

        $success = "تم إضافة المنتج بنجاح.";
    } elseif (!$error) {
        $error = "المرجو تعبئة جميع الحقول.";
    }
}
?>

<div class="main-content">
    <h2>إضافة منتج جديد</h2>

    <?php if ($success): ?>
        <div class="msg success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="msg error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <label>اسم المنتج:</label>
        <input type="text" name="name" required>

        <label>السعر (درهم):</label>
        <input type="number" step="0.01" name="price" required>

        <label>الوصف:</label>
        <textarea name="desc" rows="4" required></textarea>

        <label>صورة المنتج:</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit" class="btn add">إضافة</button>
    </form>
</div>

<?php include 'footer.php'; ?>
