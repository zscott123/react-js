<?php
require_once '../../../config/database.php';

$conn = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $productName = $_POST['name'];
    $description = $_POST['description'];
    $price = number_format($_POST['price'], 2);
    $stock = number_format($_POST['stock']);
    $imagUrl = '';
    $categoryId = number_format($_POST['category']);

    $file = $_FILES['image'] ?? null;
    $fileTmpName = $file['tmp_name'];

    $dir = './../product_image/';
    if (!file_exists($dir)) {
        mkdir($dir, 0755, true);
    }

    $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newFileName = time() . '.' . $fileExt;
    $destination = $dir . $newFileName;

    if (move_uploaded_file($fileTmpName, $destination)) {
        echo "File uploaded successfully as " . htmlspecialchars($newFileName);
        $imagUrl = $destination;
    } else {
        echo "Error uploading file.";
    }

    $insertQuery = 'INSERT INTO products (name, description, price, stock, image_url, category_id) VALUES (:name, :description, :price, :stock, :image_url, :category_id)';
    $conn->executeAssoc($insertQuery, [
        ':name' => $productName,
        ':description' => $description,
        ':price' => $price,
        ':stock' => $stock,
        ':image_url' => $imagUrl,
        ':category_id' => $categoryId
    ]);
    echo "<script><script>alert('Product added successfully!');swindow.history.back();</script>";
    exit();
} else {
    echo "error";
}

?>