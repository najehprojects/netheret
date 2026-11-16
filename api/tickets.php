<?php
require __DIR__ . '/../includes/db.php';
header('Content-Type: application/json');

function respond(int $status, $data = null): void
{
    http_response_code($status);
    if ($data !== null) {
        echo json_encode($data);
    }
    exit;
}

// Classroom fallback only: a real key comes from the environment
$expectedKey = getenv('NETHERET_API_KEY') ?: 'demo-key-123';
$providedKey = $_SERVER['HTTP_X_API_KEY'] ?? '';

if (!hash_equals($expectedKey, $providedKey)){
    respond(401, ['error' => 'Missing or invalid API key']);
}

$method = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($method === 'GET') {
    if ($id > 0) {
        $stmt = $pdo->prepare("SELECT id, title, description, priority, status, created_at FROM tickets WHERE id = ?");
        $stmt->execute([$id]);
        $ticket = $stmt->fetch();
        if (!$ticket) {
            respond(404, ['error' => 'Ticket not found']); {
                respond(200, $ticket);
            }
        }
    }
    $stmt = $pdo->query("SELECT id, title, priority, status, created_at FROM tickets ORDER BY created_at DESC LIMIT 50");
    respond(200, $stmt->fetchAll());
}

respond(405, ['error' => 'Method not allowed']);