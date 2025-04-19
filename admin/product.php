<?php
require_once './../config/database.php';

                $conn = new Database();
$categoryQuery = 'SELECT * FROM categories';
$productQuery = 'SELECT * FROM products';

$categories = $conn->executeAssoc($categoryQuery);
$products = $conn->executeAssoc($productQuery);

?>

<main class="content">
        <div class="container mt-5">
                <h2 class="text-center">Product</h2>

                <form method="POST" enctype="multipart/form-data" action="./product/crud/create.php" class="mb-4">
                        <div class="row">
                                <div class="col-md-3">
                                        <input type="text" name="name" class="form-control" placeholder="Product Name"
                                                required>
                                </div>
                                <div class="col-md-3">
                                        <input type="text" name="description" class="form-control"
                                                placeholder="Description" required>
                                </div>
                                <div class="col-md-3">
                                        <input type="number" step="0.01" name="price" class="form-control"
                                                placeholder="Price" required>
                                </div>
                                <div class="col-md-3">
                                        <input type="number" name="stock" class="form-control" placeholder="stock"
                                                required>
                                </div>
                                <div class="relative w-full md:w-1/4">
                                        <select name="category" id="category"
                                                class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                required>
                                                <option value="category">Select a category</option>
                                                <?php foreach ($categories as $category): ?>
                                                        <option value="<?php echo $category['category_id']; ?>">
                                                                <?php echo $category['name']; ?>
                                                        </option>
                                                <?php endforeach; ?>
                                        </select>
                                </div>

                                <div class="col-md-3">
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                </div>
                                <div class="col-md-3">
                                        <button type="submit" name="add" class="btn btn-primary">Add Product</button>
                                </div>
                        </div>
                </form>

                <table class="table table-bordered">
                        <thead class="table-dark">
                                <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Price ($)</th>
                                        <th>Stock</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                </tr>
                        </thead>
                        <tbody>
                                <?php foreach ($products as $row): ?>
                                        <tr>
                                                <td><?= $row["product_id"] ?? 'No data' ?></td>
                                                <td><?= $row["name"] ?? 'No data' ?></td>
                                                <td><?= $row["description"] ?? 'No data' ?></td>
                                                <td>
                                                        <?php
                                                        foreach ($categories as $category) {
                                                                if ($category['category_id'] == $row['category_id']) {
                                                                        echo $category['name'];
                                                                        break;
                                                                }
                                                        }
                                                        ?>
                                                </td>
                                                <td><?= $row["price"] ?? 'No data' ?></td>
                                                <td><?= $row["stock"] ?? 'No data' ?></td>
                                                <td><?= $row["image_url"] ?? 'No data' ?></td>
                                                <td>
                                                        <a href="product/crud/delete.php?product_id=<?= $row["product_id"] ?? 'No data' ?>"
                                                                class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')">Delete</a>
                                                        <a href="/webphp/admin/product/crud/update.php?product_id=<?= $row["product_id"] ?? 'No data' ?>"
                                                                class="btn btn-warning btn-sm">Edit</a>
                                                </td>
                                        </tr>
                                <?php endforeach; ?>
                        </tbody>
                </table>
                <a class="btn btn-primary mx-auto" href="index.php">
                        < Go back to Dashboard</a>

        </div>
</main>