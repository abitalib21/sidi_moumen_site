
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = fopen("training_requests.csv", "a");
    fputcsv($file, [
        $_POST['fullname'],
        $_POST['phone'],
        $_POST['email'],
        $_POST['course'],
        date("Y-m-d H:i")
    ]);
    fclose($file);
    header("Location: thank_you.html");
    exit;
}
?>
