<?php
require __DIR__ . '/includes/db.php';
header('Content-Type: application/json');

$stmt = $pdo->query(
    "SELECT id, title, priority, status FROM tickets ORDER BY created_at DESC LIMIT 10"
);
echo json_encode($stmt->fetchAll());