<?php
include 'db.php';

$id = $_GET['id'];
$query = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3 class="text-center mb-4">Edit Product</h3>
    <form action="update_admin.php" method="POST" enctype="multipart/form-data" class="p-4 bg-white border rounded">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="pname" value="<?= $row['pname'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Price (₹)</label>
            <input type="number" name="price" value="<?= $row['price'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Current Image:</label><br>
            <img src="uploads/<?= $row['image'] ?>" width="100">
        </div>
        <div class="mb-3">
            <label>Change Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" name="update" class="btn btn-success">Update Product</button>
        <a href="product.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
