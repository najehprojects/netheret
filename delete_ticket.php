<?php
require __DIR__ . '/includes/db.php';
$id = (int) ($_POST['id'] ?? 0);

if ($id === 0) {
    http_response_code(400); exit; 
    }
    $stmt = $pdo->prepare("DELETE FROM tickets WHERE id = ?");
    $stmt->execute([$id]);

header('Location: tickets.php');
exit;