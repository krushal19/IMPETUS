<?php
include 'db.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $pname = $_POST['pname'];
    $price = $_POST['price'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

        $sql = "UPDATE products SET pname='$pname', price='$price', image='$image' WHERE id=$id";
    } else {
        $sql = "UPDATE products SET pname='$pname', price='$price' WHERE id=$id";
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Product updated successfully'); window.location.href='product.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
