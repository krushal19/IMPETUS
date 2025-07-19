<?php
// Enable error reporting for debugging (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// STEP 1: Define MySQL database credentials
$host = 'localhost';       
$user = 'root';            
$password = '';            
$dbname = 'impetus';       

// STEP 2: Create a MySQL connection
$conn = mysqli_connect($host, $user, $password, $dbname);

// STEP 3: Check the connection
if (!$conn) {
    die("❌ Database connection failed: " . mysqli_connect_error());
}

// Optional: Set charset to UTF-8
mysqli_set_charset($conn, 'utf8');
?>
