<?php
require 'config.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
$stmt->execute([$id]);
$contact = $stmt->fetch();

if (!$contact) {
    die("Contact not found!");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    $stmt = $pdo->prepare("UPDATE contacts SET name = ?, email = ?, phone = ? WHERE id = ?");
    $stmt->execute([$name, $email, $phone, $id]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Contact</title>
</head>
<body>
    <h1>Edit Contact</h1>
    <form method="post">
        Name: <input type="text" name="name" value="<?= htmlspecialchars($contact['name']) ?>" required><br><br>
        Email: <input type="email" name="email" value="<?= htmlspecialchars($contact['email']) ?>" required><br><br>
        Phone: <input type="text" name="phone" value="<?= htmlspecialchars($contact['phone']) ?>" required><br><br>
        <input type="submit" value="Update Contact">
    </form>
    <a href="index.php">Back to List</a>
</body>
</html>
