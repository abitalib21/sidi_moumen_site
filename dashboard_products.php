<?php include 'header.php'; ?>

<div class="main-content">
    <h2>لوحة التحكم - المنتجات</h2>

    <a href="add_product.php" class="btn add">➕ إضافة منتج جديد</a>

    <?php
    $csvFile = 'products.csv';
    $products = [];

    if (file_exists($csvFile)) {
        $handle = fopen($csvFile, 'r');
        while (($data = fgetcsv($handle)) !== FALSE) {
            $products[] = $data;
        }
        fclose($handle);
    }
    ?>

    <table>
        <thead>
            <tr>
                <th>رقم</th>
                <th>اسم المنتج</th>
                <th>السعر</th>
                <th>الوصف</th>
                <th>الصورة</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product[0]) ?></td>
                        <td><?= htmlspecialchars($product[1]) ?></td>
                        <td><?= htmlspecialchars($product[2]) ?> درهم</td>
                        <td><?= htmlspecialchars($product[3]) ?></td>
                        <td>
                            <?php if (!empty($product[4])): ?>
                                <img src="<?= htmlspecialchars($product[4]) ?>" alt="صورة المنتج" style="max-width:80px; max-height:60px; border-radius:6px;">
                            <?php else: ?>
                                لا توجد صورة
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="edit_product.php?id=<?= $product[0] ?>" class="btn edit">✏️ تعديل</a>
                            <a href="delete_product.php?id=<?= $product[0] ?>" class="btn delete" onclick="return confirm('هل أنت متأكد من الحذف؟');">🗑️ حذف</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">لا توجد منتجات مسجلة حالياً.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
