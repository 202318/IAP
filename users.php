<?php
require_once "db_conn.php";

$stmt = $pdo->query("SELECT id, name, email FROM users ORDER BY id ASC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html>
<body>
<h2>Registered Users</h2>
<ol>
<?php foreach ($users as $u): ?>
  <li><?= htmlspecialchars($u['name']) ?> — <?= htmlspecialchars($u['email']) ?></li>
<?php endforeach; ?>
</ol>
</body>
</html>
