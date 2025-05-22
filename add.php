<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    $stmt = $pdo->prepare("INSERT INTO contacts (name, email, phone) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $phone]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Contact</title>
</head>
<body>
    <h1>Add New Contact</h1>
    <form method="post">
        Name: <input type="text" name="name" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Phone: <input type="text" name="phone" required><br><br>
        <input type="submit" value="Add Contact">
    </form>
    <a href="index.php">Back to List</a>
</body>
</html>
