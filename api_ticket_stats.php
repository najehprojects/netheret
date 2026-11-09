<?php
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/auth.php';
requireRole('manager');
header('Content-Type: application/json');

// Column names can't be bound as parameters, so use a whitelist
$columns = ['status' => 'status', 'priority' => 'priority'];
$by      = $_GET['by'] ?? 'status';
$column  = $columns[$by] ?? 'status';

$stmt = $pdo->query("SELECT $column AS label, COUNT(*) AS total FROM tickets GROUP BY $column");
echo json_encode($stmt->fetchAll());
echo "HI";