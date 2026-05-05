<?php
// Database connection
$host = "localhost";
$dbname = "dogs_db";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if ID exists
if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$id = $_GET['id'];

// Fetch existing data
$stmt = $conn->prepare("SELECT * FROM dogs WHERE id = :id");
$stmt->execute(['id' => $id]);
$dog = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$dog) {
    die("Dog not found.");
}

// Update logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $breed_name = $_POST['breed_name'];
    $size = $_POST['size'];
    $description = $_POST['description'];

    $update = $conn->prepare("
        UPDATE dogs 
        SET breed_name = :breed_name, size = :size, description = :description 
        WHERE id = :id
    ");

    $update->execute([
        'breed_name' => $breed_name,
        'size' => $size,
        'description' => $description,
        'id' => $id
    ]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Dog</title>
</head>
<body>

<h2>Edit Dog Breed</h2>

<form method="POST">
    <label>Breed Name:</label><br>
    <input type="text" name="breed_name" value="<?php echo htmlspecialchars($dog['breed_name']); ?>" required><br><br>

    <label>Size:</label><br>
    <select name="size">
        <option value="Small" <?php if ($dog['size'] == "Small") echo "selected"; ?>>Small</option>
        <option value="Medium" <?php if ($dog['size'] == "Medium") echo "selected"; ?>>Medium</option>
        <option value="Large" <?php if ($dog['size'] == "Large") echo "selected"; ?>>Large</option>
    </select><br><br>

    <label>Description:</label><br>
    <textarea name="description"><?php echo htmlspecialchars($dog['description']); ?></textarea><br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>