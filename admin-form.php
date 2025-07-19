<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Product</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f2f2f2;
      padding: 20px;
    }

    .container {
      max-width: 500px;
      background: white;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      margin: auto;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #007bff;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    @media (max-width: 600px) {
      .container {
        padding: 15px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Add New Product</h2>
    <form action="insert_admin.php" method="post" enctype="multipart/form-data">
      <label for="image">Product Image:</label>
      <input type="file" name="image" id="image" required>

      <label for="product_name">Product Name:</label>
      <input type="text" name="product_name" id="product_name" required>

      <label for="price">Price (in ₹):</label>
      <input type="number" name="price" id="price" required>

      <button type="submit">Add Product</button>
    </form>
  </div>
</body>
</html>

