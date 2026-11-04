<?php
$allowed = ['light', 'dark'];
if (isset($_GET['theme']) && in_array($_GET['theme'], $allowed,
true)) {
// TODO 4: set a cookie called 'theme' with the chosen value for 30 days
// setcookie('theme', $_GET['theme'], [
// 'expires' => time() + 60 * 60 * 24 * 30,
// 'path' => '/',
// 'httponly' => true,
// 'samesite' => 'Lax',
// ]);
$theme = $_GET['theme'];
} else {
$theme = $_COOKIE['theme'] ?? 'light';

if (!in_array($theme, $allowed, true)) { $theme = 'light'; }
}
?>

<body style="background: <?= $theme === 'dark' ? '#222' : '#fff' ?>;
color: <?= $theme === 'dark' ? '#fff' : '#000' ?>;">
<p>Current theme: <?= htmlspecialchars($theme) ?></p>
<a href="theme.php?theme=light">Light</a> | <a
href="theme.php?theme=dark">Dark</a>
</body>