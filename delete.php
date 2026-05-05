<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "dog_system";

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed.");
}

// Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php?error=invalid_id");
    exit();
}

$id = intval($_GET['id']);

// Check if dog exists first
$check = $conn->prepare("SELECT id FROM dogs WHERE id = ?");
$check->bind_param("i", $id);
$check->execute();
$result = $check->get_result();

if ($result->num_rows === 0) {
    header("Location: index.php?error=not_found");
    exit();
}
$check->close();

// Delete dog
$stmt = $conn->prepare("DELETE FROM dogs WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php?success=deleted");
    exit();
} else {
    header("Location: index.php?error=delete_failed");
    exit();
}

$stmt->close();
$conn->close();
?>