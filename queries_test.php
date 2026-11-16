<?php
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/queries.php';
echo '<pre>';
print_r(getEngineerSchedule($pdo, 1));   // use the id of alice
print_r(searchKnowledge($pdo, 'printer'));
echo '</pre>';