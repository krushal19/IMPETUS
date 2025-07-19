<?php
// insert_admin.php
include 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pname = trim($_POST['pname']);
    $price = trim($_POST['price']);

    // Validate input
    if (!empty($pname) && is_numeric($price) && isset($_FILES['image'])) {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $upload_dir = 'uploads/';

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $target = $upload_dir . basename($image);

        if (move_uploaded_file($image_tmp, $target)) {
            // Use prepared statements for security
            $stmt = $conn->prepare("INSERT INTO products (pname, price, image) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $pname, $price, $image);

            if ($stmt->execute()) {
                $message = "<div class='alert alert-success text-center'>✅ Product added successfully!</div>";
                // Optionally redirect to product page
                // header("Refresh: 2; url=product.php");
            } else {
                $message = "<div class='alert alert-danger text-center'>❌ Database Error: " . $stmt->error . "</div>";
            }
            $stmt->close();
        } else {
            $message = "<div class='alert alert-warning text-center'>❌ Failed to upload image.</div>";
        }
    } else {
        $message = "<div class='alert alert-warning text-center'>⚠️ Please fill all fields correctly.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product | IMPETUS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 60px;
            padding: 30px;
            background: #fff;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 16px;
        }
        .btn-custom {
            background-color: #0b2f18;
            color: #fff;
            border-radius: 12px;
            font-weight: bold;
        }
        .btn-custom:hover {
            background-color: #094a27;
        }
        h2 {
            color: #0b2f18;
        }
    </style>
</head>
<body>

<?php include 'head.php'; ?>

<div class="container">
    <h2 class="text-center mb-4">➕ Add New Product</h2>

    <?= $message; ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="pname" class="form-label">Product Name</label>
            <input type="text" name="pname" id="pname" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price (₹)</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-custom w-100">Add Product</button>
    </form>
</div>

</body>
</html>
