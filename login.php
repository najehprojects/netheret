<?php
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/auth.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT id, password_hash, role FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password_hash"])){
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header('Location: tickets.php');
        exit;
    }
    $error = 'Incorrect username or password.';

}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Log in</title>
    </head>
    <body>
        <h1>Log in</h1>
        <?php if ($error) : ?>
            <p class="error" role="alert">
            <?= htmlspecialchars($error) ?>
        <?php endif; ?>
        <form method="post" action="login.php">
            <label for="username">Username</label>
            <input type="text" id="username" name="username">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <button type="submit">Log in</button>
        </form>
    </body>
</html>