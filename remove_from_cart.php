<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'])) {
    $cartId = intval($_POST['cart_id']);
    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ?");
    $stmt->bind_param("i", $cartId);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
header("Location: cart.php");
exit;
