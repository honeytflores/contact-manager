<?php
require 'config.php';

// Search
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$whereSQL = '';
$params = [];

if ($search !== '') {
    $whereSQL = "WHERE name LIKE ? OR email LIKE ? OR phone LIKE ?";
    $params = ["%$search%", "%$search%", "%$search%"];
}

// Pagination
$limit = 5; // contacts per page
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Count total for pagination
$countSQL = "SELECT COUNT(*) FROM contacts " . ($whereSQL ? $whereSQL : '');
$countStmt = $pdo->prepare($countSQL);
$countStmt->execute($params);
$totalContacts = $countStmt->fetchColumn();
$totalPages = ceil($totalContacts / $limit);

// Fetch contacts
$dataSQL = "SELECT * FROM contacts " . ($whereSQL ? $whereSQL : '') . " ORDER BY id DESC LIMIT $limit OFFSET $offset";
$dataStmt = $pdo->prepare($dataSQL);
$dataStmt->execute($params);
$contacts = $dataStmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Manager</title>
</head>
<body>
    <h1>Contact Manager</h1>
    <form method="get">
        <input type="text" name="search" placeholder="Search..." value="<?= htmlspecialchars($search) ?>">
        <input type="submit" value="Search">
        <a href="index.php">Reset</a>
    </form>
    <br>
    <a href="add.php">Add New Contact</a>
    <br><br>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Actions</th></tr>
        <?php foreach ($contacts as $contact): ?>
        <tr>
            <td><?= htmlspecialchars($contact['id']) ?></td>
            <td><?= htmlspecialchars($contact['name']) ?></td>
            <td><?= htmlspecialchars($contact['email']) ?></td>
            <td><?= htmlspecialchars($contact['phone']) ?></td>
            <td>
                <a href="edit.php?id=<?= $contact['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $contact['id'] ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- Pagination -->
    <div>
        <?php if ($totalPages > 1): ?>
            <p>Pages:
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?search=<?= urlencode($search) ?>&page=<?= $i ?>"<?= $i === $page ? ' style="font-weight:bold;"' : '' ?>><?= $i ?></a>
                <?php endfor; ?>
            </p>
        <?php endif; ?>
    </div>
</body>
</html>
