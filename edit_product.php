<?php include 'header.php'; ?>

<?php
$csvFile = 'products.csv';
$error = '';
$success = '';

if (!isset($_GET['id'])) {
    die("معرف المنتج غير موجود.");
}

$id = $_GET['id'];
$products = [];
$productData = null;

if (($handle = fopen($csvFile, 'r')) !== FALSE) {
    while (($data = fgetcsv($handle)) !== FALSE) {
        if ($data[0] == $id) {
            $productData = $data;
        }
        $products[] = $data;
    }
    fclose($handle);
}

if (!$productData) {
    die("المنتج غير موجود.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $desc = trim($_POST['desc']);
    $imagePath = $productData[4];

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
        foreach ($products as &$row) {
            if ($row[0] == $id) {
                $row[1] = $name;
                $row[2] = $price;
                $row[3] = $desc;
                $row[4] = $imagePath;
                break;
            }
        }

        $handle = fopen($csvFile, 'w');
        foreach ($products as $row) {
            fputcsv($handle, $row);
        }
        fclose($handle);

        $success = "تم تحديث المنتج بنجاح.";
        $productData = [$id, $name, $price, $desc, $imagePath];
    } elseif (!$error) {
        $error = "المرجو تعبئة جميع الحقول.";
    }
}
?>

<div class="main-content">
    <h2>تعديل المنتج</h2>

    <?php if ($success): ?>
        <div class="msg success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="msg error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <label>اسم المنتج:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($productData[1]) ?>" required>

        <label>السعر (درهم):</label>
        <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($productData[2]) ?>" required>

        <label>الوصف:</label>
        <textarea name="desc" rows="4" required><?= htmlspecialchars($productData[3]) ?></textarea>

        <label>صورة المنتج:</label>
        <?php if (!empty($productData[4])): ?>
            <img src="<?= htmlspecialchars($productData[4]) ?>" alt="صورة حالية" style="max-width:120px; margin-bottom:10px;">
        <?php else: ?>
            لا توجد صورة
        <?php endif; ?>
        <input type="file" name="image" accept="image/*">

        <button type="submit" class="btn edit">تحديث</button>
    </form>
</div>

<?php include 'footer.php'; ?>
