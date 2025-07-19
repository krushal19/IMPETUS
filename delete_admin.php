<?php
include 'db.php';

$id = $_GET['id'];

// Optionally delete image file
$imgResult = mysqli_query($conn, "SELECT image FROM products WHERE id = $id");
$imgRow = mysqli_fetch_assoc($imgResult);
$imagePath = 'uploads/' . $imgRow['image'];
if (file_exists($imagePath)) {
    unlink($imagePath);
}

$sql = "DELETE FROM products WHERE id = $id";
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Product deleted successfully'); window.location.href='product.php';</script>";
} else {
    echo "Error deleting product: " . mysqli_error($conn);
}
?>
