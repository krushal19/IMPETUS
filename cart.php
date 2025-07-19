<?php
include 'db.php';

// Fetch all cart items
$sql = "SELECT * FROM cart ORDER BY created_at DESC";
$result = $conn->query($sql);

$totalPrice = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart | IMPETUS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .cart-box {
      text-align: center;
      background: #fff;
      border: 1px solid #eee;
      border-radius: 8px;
      padding: 25px 15px;
      transition: all 0.3s ease-in-out;
      height: 100%;
    }
    .cart-box:hover {
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      transform: translateY(-5px);
    }
    .cart-image {
      height: 140px;
      object-fit: contain;
      margin-bottom: 10px;
    }
    .cart-title {
      font-weight: bold;
      font-size: 1.1rem;
      color: #333;
      margin: 10px 0 5px;
    }
    .cart-price {
      color: #28a745;
      font-size: 1.2rem;
      margin-bottom: 10px;
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
    .text-muted-small {
      font-size: 0.85rem;
      color: #999;
    }
    .remove-btn {
      margin-top: 10px;
    }
  </style>
</head>
<body>

<?php include 'head.php'; ?>

<div class="container py-5">
  <h2 class="section-title">Your <span class="highlight">Cart</span></h2>
  <p class="text-center mb-5 text-muted">Here are the products you've added to your cart.</p>

  <div class="row">
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while ($item = $result->fetch_assoc()): ?>
        <?php $totalPrice += $item['product_price']; ?>
        <div class="col-md-3 col-sm-6 mb-4">
          <div class="cart-box">
            <img src="uploads/<?= htmlspecialchars($item['product_image']) ?>" alt="<?= htmlspecialchars($item['product_name']) ?>" class="cart-image w-100">
            <div class="cart-title"><?= strtoupper(htmlspecialchars($item['product_name'])) ?></div>
            <div class="cart-price">₹<?= number_format($item['product_price'], 2) ?></div>
            <div class="text-muted-small">Added on: <?= date('d M Y', strtotime($item['created_at'])) ?></div>
            <form action="remove_from_cart.php" method="POST" class="remove-btn">
              <input type="hidden" name="cart_id" value="<?= $item['id'] ?>">
              <button type="submit" class="btn btn-outline-danger btn-sm">Remove</button>
            </form>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="col-12 text-center">
        <p>No products in your cart.</p>
      </div>
    <?php endif; ?>
  </div>

  <?php if ($totalPrice > 0): ?>
    <div class="row mt-4">
      <div class="col-md-6 offset-md-3 text-center">
        <h4>Total Amount: <span class="text-success">₹<?= number_format($totalPrice, 2) ?></span></h4>
        <a href="cart_summary.php" class="btn btn-success mt-3">Proceed to Checkout</a>
      </div>
    </div>
  <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
