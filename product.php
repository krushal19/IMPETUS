<?php
// product.php
include 'db.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Our Engine Oil Products | IMPETUS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #fff;
      font-family: 'Segoe UI', sans-serif;
    }

    .product-box {
      text-align: center;
      background: #fff;
      border: 1px solid #eee;
      border-radius: 8px;
      padding: 25px 15px;
      transition: all 0.3s ease-in-out;
      height: 100%;
    }

    .product-box:hover {
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      transform: translateY(-5px);
    }

    .product-image {
      height: 140px;
      object-fit: contain;
      margin-bottom: 10px;
    }

    .product-title {
      font-weight: bold;
      font-size: 1.1rem;
      color: #333;
      margin: 10px 0 5px;
    }

    .product-price {
      color: #28a745;
      font-size: 1.2rem;
      margin-bottom: 10px;
    }

    .star-rating {
      color: #ffc107;
      font-size: 0.9rem;
      margin-bottom: 5px;
    }

    .order-now-btn {
      background-color: #ffc107;
      color: #000;
      border: none;
      padding: 8px 18px;
      font-weight: 500;
      border-radius: 6px;
      text-decoration: none;
      transition: 0.3s ease;
    }

    .order-now-btn:hover {
      background-color: #e0a800;
      color: #000;
    }

    h2.section-title {
      font-weight: 600;
      text-align: center;
      margin-bottom: 30px;
      color: #3e3e3e;
    }

    .highlight {
      color: #6ab04c;
    }
  </style>
</head>
<body>

<?php require 'head.php'; ?>

<div class="container py-5">
  <h2 class="section-title">Our Engine <span class="highlight">Oil Products</span></h2>
  <p class="text-center mb-5 text-muted">Explore our high-performance engine oils designed for superior protection and power across all vehicle types.</p>

  <div class="row">
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-md-3 col-sm-6 mb-4">
          <div class="product-box">
            <img src="uploads/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['pname']) ?>" class="product-image w-100">
            
            <div class="star-rating">
              ★★★★★ <span class="text-muted" style="font-size: 0.8rem;">(<?= rand(50, 150) ?>)</span>
            </div>
            
            <div class="product-title"><?= strtoupper(htmlspecialchars($row['pname'])) ?></div>
            <div class="product-price">₹<?= htmlspecialchars($row['price']) ?></div>

            <form method="POST" action="add_to_cart.php">
              <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
              <input type="hidden" name="product_name" value="<?= htmlspecialchars($row['pname']) ?>">
              <input type="hidden" name="product_price" value="<?= $row['price'] ?>">
              <input type="hidden" name="product_image" value="<?= htmlspecialchars($row['image']) ?>">
              <button type="submit" class="order-now-btn mt-2">Order Now</button>
            </form>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="col-12 text-center">
        <p>No products available.</p>
      </div>
    <?php endif; ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
