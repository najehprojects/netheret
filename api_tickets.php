<?php
require __DIR__ . '/includes/db.php';
header('Content-Type: application/json');

$stmt = $pdo->query(
    "SELECT id, title, priority, status FROM tickets ORDER BY created_at DESC LIMIT 10"
);
echo json_encode($stmt->fetchAll());

$body = json_decode(file_get_contents('php://input'), true) ?? [];

if ($method === 'POST') {
    // TODO 4: $errors = validateTicketInput($body); if there are errors respond(400, ['errors' => $errors]);
    // TODO 5: INSERT the ticket (title, description, priority) with a prepared statement,
    //         then respond(201, ['id' => (int)$pdo->lastInsertId()]);
}

if ($method === 'PUT' && $id > 0) {
    $allowed = ['open', 'in_progress', 'resolved'];
    $status  = $body['status'] ?? '';
    // TODO 6: if $status isn't in $allowed respond(400, ...)
    // TODO 7: check the ticket exists (SELECT id ...); if not respond(404, ...)
    //         then UPDATE tickets SET status = ? WHERE id = ? and respond(200, ['updated' => true]);
}

if ($method === 'DELETE' && $id > 0) {
    // TODO 8: DELETE FROM tickets WHERE id = ?
    //         if rowCount() is 0 respond(404, ...) otherwise respond(204);
}