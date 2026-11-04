<?php
$tickets = [
    ['id' => 1, 'title' => 'Printer offline', 'priority' =>
'high', 'status' => 'open'],
    ['id' => 2, 'title' => 'Password reset', 'priority' =>
'low', 'status' => 'resolved'],
    ['id' => 3, 'title' => 'Server unreachable', 'priority' =>
'urgent', 'status' => 'open'],
    ['id' => 4, 'title' => 'Software installation', 'priority' =>
'medium', 'status' => 'in progress'],
    ['id'=> 5, 'title'=> 'HA', 'priority'=>
'high', 'status'=> 'open'],
    ['id'=> 6, 'title'=> 'HAH', 'priority'=>
'low', 'status'=> 'resolved'],
    ['id'=> 7, 'title'=> 'HAHAAAAAA', 'priority'=>
'urgent', 'status'=> 'open'],
    ['id'=> 8, 'title'=> 'HAHAA', 'priority'=>
'medium', 'status'=> 'in progress'],
];

$allowed = ['low', 'medium', 'high', 'urgent'];
$priority = $_GET['priority'] ?? '';

if ($priority && in_array($priority, $allowed)) {
    $tickets = array_filter($tickets, function($ticket) use ($priority) {
        return $ticket['priority'] === $priority;
    });
}
?>

<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Tickets</title></head>
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

</table>
</body>
</html>