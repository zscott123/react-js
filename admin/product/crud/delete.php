<?php
require_once '../../../config/database.php';

$conn = new Database();
$productId = 0;

if (isset($_REQUEST['product_id']) && !empty($_REQUEST['product_id'])) {
    $productId = (int) $_REQUEST['product_id'];

    $selectQuery = "SELECT image_url FROM products WHERE product_id = :product_id";
    $result = $conn->executeAssoc($selectQuery, [':product_id' => $productId]);

    if (!empty($result)) {
        $imageUrl = $result[0]['image_url'];
        if (!empty($imageUrl) && file_exists($imageUrl)) {
            unlink($imageUrl);
        }
    }

    $deleteQuery = 'DELETE FROM products WHERE product_id = :product_id';
    $conn->executeAssoc($deleteQuery, [':product_id' => $productId]);

    echo "<script>alert('Product deleted successfully!');window.history.back();</script>";
    exit();
} else {
    echo "<script>alert('Error: No product ID provided!');window.history.back();</script>";
    exit();
}
?>