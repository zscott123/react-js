<?php
require_once '../../../config/database.php';

$conn = new Database();
$updateId = 0;

$categoryQuery = 'SELECT * FROM categories';
$query = 'SELECT * FROM products';
$categories = $conn->executeAssoc($categoryQuery);
$products = $conn->executeAssoc($query);

$selectedId = 0;
$selectedName = '';
$selectedDescription = '';
$selectedCategory = 0;
$selectedCategoryName = '';
$selectedStock = 0.0;
$selectedPrice = 0;
$selectedImg = '';

if (isset($_REQUEST['product_id']) && !empty($_REQUEST['product_id'])) {
    $updateId = (int) $_REQUEST['product_id'];

    foreach ($products as $product) {
        if ($product['product_id'] == $updateId) {
            $selectedId = number_format($product['product_id']);
            $selectedName = $product['name'];
            $selectedDescription = $product['description'];
            $selectedCategory = number_format($product['category_id']);
            $selectedStock = number_format($product['stock']);
            $selectedPrice = number_format($product['price'], 2);
            $selectedImg = $product['image_url'];
            break;
        }
    }

    foreach ($categories as $category) {
        if ($category['category_id'] == $selectedCategory) {
            $selectedCategoryName = $category['name'];
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $updateName = $_POST['name'];
    $updateDescription = $_POST['description'];
    $updateCategory = number_format($_POST['category']);
    $updateStock = number_format($_POST['stock']);
    $updatePrice = number_format($_POST['price'], 2);

    $imageUrl = $selectedImg;

    if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $file = $_FILES['image'];
        if ($file['error'] === UPLOAD_ERR_OK) {
            $fileTmpName = $file['tmp_name'];
            $dir = './../product_image/';
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }

            $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newFileName = time() . '.' . $fileExt;
            $destination = $dir . $newFileName;

            if (move_uploaded_file($fileTmpName, $destination)) {

                // Delete the old image if it exists and is not the default placeholder
                if (!empty($selectedImg) && file_exists($selectedImg)) {
                    unlink($selectedImg);
                }
                $imageUrl = $destination;
            } else {
                echo "Error uploading file.";
                exit();
            }
        } else {
            echo "File upload error: " . $file['error'];
            exit();
        }
    }

    $updateQuery = 'UPDATE products
                    SET name = :name,
                        description = :description,
                        price = :price,
                        stock = :stock,
                        image_url = :image_url,
                        category_id = :category_id
                    WHERE product_id = :product_id';

    $params = [
        ':name' => $updateName,
        ':description' => $updateDescription,
        ':price' => $updatePrice,
        ':stock' => $updateStock,
        ':image_url' => $imageUrl,
        ':category_id' => $updateCategory,
        ':product_id' => $updateId,
    ];

    $conn->executeAssoc($updateQuery, $params);

    echo "<script>alert('Product updated successfully');window.history.back();</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Product</h2>
        <form method="POST" action="update.php" enctype="multipart/form-data" class="mb-4">
            <!-- Hidden fields for product id and current image -->
            <input type="hidden" name="product_id" value="<?php echo $updateId; ?>">
            <input type="hidden" name="current_image" value="<?php echo $selectedImg; ?>">

            <!-- Other form fields -->
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="name" value="<?php echo $selectedName; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" name="description" value="<?php echo $selectedDescription; ?>" class="form-control"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category" id="category" required>
                    <option value="<?php echo $selectedCategory; ?>"><?php echo $selectedCategoryName; ?></option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" value="<?php echo $selectedStock; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" step="0.01" name="price" value="<?php echo $selectedPrice; ?>" class="form-control"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <button type="submit" name="update" class="btn btn-success">Update</button>
        </form>
    </div>
</body>

</html>