<?php
// insert_admin.php (form processor)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $role = $_POST['role'];
  $password = $_POST['password'];

  // Replace these with your actual DB credentials
  $conn = new mysqli("localhost", "root", "", "impetus");

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $stmt = $conn->prepare("INSERT INTO admins (name, email, role, password) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $email, $role, $password);

  if ($stmt->execute()) {
    echo "<script>alert('Admin added successfully'); window.location.href='admin-form.php';</script>";
  } else {
    echo "Error: " . $stmt->error;
  }
  $stmt->close();
  $conn->close();
}
?>

<!-- admin-form.php (HTML Form) -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Admin | IMPETUS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #0b2f18;
      color: white;
    }
    .container {
      margin-top: 50px;
      background: #122000;
      padding: 30px;
      border-radius: 10px;
    }
    label {
      font-weight: 500;
    }
    .form-control {
      background: #f8f9fa;
    }
    .btn-warning {
      background-color: #fdd835;
      color: #000;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container col-md-6">
    <h2 class="mb-4 text-center text-warning">Add New Admin</h2>
    <form method="POST" action="insert_admin.php">
      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select class="form-select" id="role" name="role">
          <option value="Admin">Admin</option>
          <option value="Manager">Manager</option>
          <option value="Delivery">Delivery</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-warning w-100">Add Admin</button>
    </form>
  </div>
</body>
</html>
