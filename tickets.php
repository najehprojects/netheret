<?php
require __DIR__ . '/includes/auth.php';
requireLogin();
require __DIR__ . '/includes/db.php';

$allowed = ['open', 'in_progress', 'resolved'];
$status = $_GET['status'] ?? 'open';
if (!in_array($status, $allowed, true)) { $status = 'open';}

$stmt = $pdo->prepare("SELECT id, title, priority, status FROM tickets WHERE status = ? ORDER BY created_at DESC");
$stmt -> execute([$status]);
$tickets = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><title>Tickets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Tickets</h1>

    <p>Filter:
        <a href="tickets.php">All</a> |
        <a href="tickets.php?priority=high">High</a> |
        <a href="tickets.php?priority=urgent">Urgent</a>
    </p>

    <table>
        <tr><th>ID</th><th>Title</th><th>Priority</th><th>Status</th></tr>
        <?php foreach ($tickets as $ticket): ?>
            <tr>
                <td><?= htmlspecialchars($ticket['id']) ?></td>
                <td><?= htmlspecialchars($ticket['title']) ?></td>
                <td><?= htmlspecialchars($ticket['priority']) ?></td>
                <td><?= htmlspecialchars($ticket['status']) ?></td>
            </tr>
        <?php endforeach; ?>
        <td>
            <form method="post" action="update_status.php">
                <input type="hidden" name="id" value="<?= (int)$ticket['id'] ?>">
                <select name="status">
                    <option value="open">Open</option>
                    <option value="in_progress">In Progress</option>
                    <option value="resolved">Resolved</option>
                </select>
                <button type="submit">Update</button>
            </form>
            <form method="post" action="delete_ticket.php">
                <input type="hidden" name="id" value="<?= (int) $ticket['id'] ?>">
                <button type="submit">Delete</button>
            </form>
        </td>
    </table>
    <script>
        fetch("api_tickets.php")
            .then(response => response.json())
            .then(data => console.log(data))
            .catch(error => console.error("Network problem:", error));
    </script>
</body>
</html>