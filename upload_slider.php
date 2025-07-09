<?php
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = $_FILES['image'];
    $filename = basename($image['name']);
    $target = '../assets/' . $filename;

    if (move_uploaded_file($image['tmp_name'], $target)) {
        $stmt = $conn->prepare("INSERT INTO sliders (image, status) VALUES (?, 1)");
        $stmt->bind_param("s", $filename);
        if ($stmt->execute()) {
            echo "Image uploaded successfully.";
        } else {
            echo "DB insert failed.";
        }
    } else {
        echo "File upload failed.";
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="image" required>
    <button type="submit">Upload Slider</button>
</form>
