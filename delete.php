<?php
require 'config.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
?>
