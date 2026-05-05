<?php
// ==============================
// DATABASE CONNECTION (db.php)
// ==============================

// Database details
$host = "localhost";
$username = "root";
$password = "";
$database = "dogs_db
"; // change this

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: set charset to avoid encoding issues
$conn->set_charset("utf8");

// Success message (optional - remove in production)
// echo "Connected successfully!";
?>