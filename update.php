<?php
// Database connection
$host = "localhost";
$dbname = "dog_system";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate inputs
    if (!isset($_POST['id'], $_POST['breed_name'], $_POST['size'], $_POST['description'])) {
        die("Missing data.");
    }

    $id = $_POST['id'];
    $breed_name = trim($_POST['breed_name']);
    $size = $_POST['size'];
    $description = trim($_POST['description']);

    // Basic validation
    if (empty($breed_name) || empty($size)) {
        die("Breed name and size are required.");
    }

    // Update query
    $stmt = $conn->prepare("
        UPDATE dogs 
        SET breed_name = :breed_name, size = :size, description = :description 
        WHERE id = :id
    ");

    $stmt->execute([
        'breed_name' => $breed_name,
        'size' => $size,
        'description' => $description,
        'id' => $id
    ]);

    // Redirect after update
    header("Location: index.php?message=updated");
    exit();

} else {
    die("Invalid request.");
}
?>