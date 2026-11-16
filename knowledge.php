<?php
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/queries.php';
requireLogin();

$term = trim($_GET['q'] ?? '');
// TODO 2: if $term is not empty, set $articles = searchKnowledge($pdo, $term);
//         otherwise load all articles ordered by title
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Knowledge base</title><link rel="stylesheet" href="css/ux.css"></head>
<body>
<main>
  <h1>Knowledge base</h1>
  <form method="get" action="knowledge.php">
    <label for="q">Search articles</label>
    <input type="search" id="q" name="q" value="<?= htmlspecialchars($term) ?>">
    <button type="submit">Search</button>
  </form>

  <?php /* TODO 3: loop over $articles. For each, show the title and category (escaped).
           If there are no results, show "No articles found." */ ?>
</main>
</body>
</html>