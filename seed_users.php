<?php
require __DIR__ . '/includes/db.php';
$users = [
    ['alice', 'Engineer123!', 'engineer'],
    ['bob', 'Manager123!', 'manager'],
];

foreach ($users as [$username, $password, $role]) {
    $stmt = $pdo->prepare("INSERT INTO users (username, password_hash, role) VALUES (?, ?, ?)");
    $stmt -> execute([$username, password_hash($password, PASSWORD_DEFAULT), $role]);
}
echo 'Done. Delete this file now.';