<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel | IMIPETUS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #0b2f18;
      color: white;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #103b20;
      padding: 10px 20px;
    }

    .navbar .logo {
      font-size: 20px;
      font-weight: bold;
      color: #fdd835;
    }

    .navbar .admin {
      display: flex;
      align-items: center;
    }

    .navbar .admin span {
      margin-right: 10px;
    }

    .panel-title {
      font-size: 24px;
      font-weight: bold;
      padding: 20px;
    }

    .cards {
      display: flex;
      gap: 20px;
      padding: 0 20px 20px;
      flex-wrap: wrap;
    }

    .card {
      background-color: #1e4427;
      padding: 20px;
      border-radius: 8px;
      flex: 1 1 250px;
      text-align: center;
    }

    .card h3 {
      margin: 0;
      font-size: 16px;
      color: #c1c1c1;
    }

    .card p {
      margin: 10px 0 0;
      font-size: 22px;
      font-weight: bold;
    }

    .table-container {
      background-color: white;
      color: black;
      margin: 0 20px 20px;
      padding: 20px;
      border-radius: 8px;
      overflow-x: auto;
    }

    .table-container h3 {
      margin-top: 0;
      font-size: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      min-width: 600px;
    }

    table, th, td {
      border: 1px solid #ddd;
    }

    th, td {
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    .action-btn {
      color: #007bff;
      cursor: pointer;
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .panel-title {
        text-align: center;
      }

      .cards {
        flex-direction: column;
      }

      .card {
        width: 100%;
      }
    }

    @media (max-width: 480px) {
      .navbar {
        flex-direction: column;
        align-items: flex-start;
      }

      .navbar .admin {
        margin-top: 10px;
      }

      .card p {
        font-size: 18px;
      }

      .panel-title {
        font-size: 20px;
      }

      th, td {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>

  <div class="navbar">
    <div class="logo">IMIPETUS</div>
    <div class="admin">
      <span>Admin</span>
      <i>&#128100;</i>
    </div>
  </div>

  <div class="panel-title">Admin Panel</div>

  <div class="cards">
    <div class="card">
      <h3>Total Users</h3>
      <p>$</p>
    </div>
    <div class="card">
      <h3>Total Orders</h3>
      <p>$5</p>
    </div>
    <div class="card">
      <h3>Payments</h3>
      <p>$1,800<sup>00</sup></p>
    </div>
  </div>

  <div class="table-container">
    <h3>User Management</h3>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>John Doc</td>
          <td>jtote@impecora.com</td>
          <td>Admin</td>
          <td><span class="action-btn">Edit</span></td>
        </tr>
        <tr>
          <td>Jone Smith</td>
          <td>splroy@mpcora.com</td>
          <td>Solta</td>
          <td><span class="action-btn">Details</span></td>
        </tr>
        <tr>
          <td>Mont.acnlroan</td>
          <td>desigray@impecora.com</td>
          <td>Designar</td>
          <td><span class="action-btn">Editor</span></td>
        </tr>
        <tr>
          <td>Luk Room</td>
          <td>delivivey@mpcera.com</td>
          <td>Delivery</td>
          <td><span class="action-btn">Boaats</span></td>
        </tr>
      </tbody>
    </table>
  </div>

</body>
</html>
