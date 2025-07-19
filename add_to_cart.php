<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['product_name'], $_POST['product_price'], $_POST['product_image'])) {
        $name = $_POST['product_name'];
        $price = $_POST['product_price'];
        $image = $_POST['product_image'];

        $sql = "INSERT INTO cart (product_name, product_price, product_image) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sds", $name, $price, $image);
            $stmt->execute();
            $stmt->close();

            // Redirect to cart page
            header("Location: cart.php");
            exit();
        } else {
            // Show SQL error
            echo "❌ SQL Prepare failed: " . $conn->error;
        }
    } else {
        echo "⛔ Missing required product data!";
    }
} else {
    echo "⛔ Invalid request!";
}
?>
