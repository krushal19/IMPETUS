<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "gogalse"; // Use your DB name

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $product_name = $_POST['product_name'];
  $price = $_POST['price'];

  // Upload image
  $target_dir = "uploads/";
  if (!is_dir($target_dir)) {
    mkdir($target_dir);
  }

  $image_name = basename($_FILES["image"]["name"]);
  $target_file = $target_dir . time() . "_" . $image_name;

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $sql = "INSERT INTO products (image, product_name, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $target_file, $product_name, $price);

    if ($stmt->execute()) {
      echo "Product added successfully!";
    } else {
      echo "Error: " . $stmt->error;
    }

    $stmt->close();
  } else {
    echo "Image upload failed.";
  }
}

$conn->close();
?>
