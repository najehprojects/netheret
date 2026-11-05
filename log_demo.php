<?php
$path = __DIR__ . '/logs/app.log';

// WRITE: add a line to the log (creates the file if needed)
$line = date('c') . ' | Ticket form opened' . PHP_EOL;
$handle = fopen($path, 'a');        // 'a' = append

fwrite($handle, $line);
fclose($handle);

// READ: show the log
if (file_exists($path)) {
    echo '<pre>' . htmlspecialchars(file_get_contents($path)) .
'</pre>';
}

// DELETE: only when ?clear=1 is in the address
if (isset($_GET['clear']) && file_exists($path)) {
    // TODO 3: delete the file with unlink($path);
    echo 'Log cleared.';
}