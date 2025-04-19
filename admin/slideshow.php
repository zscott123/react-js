<?php
require_once './../config/database.php';

$database = new Database();
$query = 'SELECT * FROM slideshow';
$slides = $database->executeAssoc($query);
// Handle form submission
if (isset($_FILES['img'])) {
    $img = isset($_FILES['img']) ? $_FILES['img'] : null;

    $targetDir = './../storage/photo/';
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = time() . '_' . basename($img['name']);
    $targetFilePath = $targetDir . $fileName;
    if (move_uploaded_file($img['tmp_name'], $targetFilePath)) {
        $query = "INSERT INTO slideshow (img) VALUES (:img)";
        $database->execute($query, ['img' => $fileName]);
        // exit;
    } else {
        echo "Error uploading file.";
    }
}
// ?>

<main class="content">
    <div class="container-fluid p-4">
        <h1 class="mb-4 text-center">Slideshow</h1>

        <!-- Form to insert new slide -->
        <form method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow-sm">
            <div class="mb-3">
                <label for="ssid" class="form-label">ID:</label>
                <input type="number" name="ssid" class="form-control" placeholder="Enter ID" required>
            </div>

            <div class="mb-3">
                <label for="img" class="form-label">Image URL:</label>
                <input type="file" name="img" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Add Slide</button>
        </form>
    </div>
</main>