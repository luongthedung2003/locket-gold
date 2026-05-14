<?php
$file = __DIR__ . '/../public/index.php';

if (file_exists($file)) {
    require $file;
} else {
    echo "<h1>Debug Info</h1>";
    echo "<b>Error:</b> public/index.php not found!<br>";
    echo "<b>Current Path:</b> " . __DIR__ . "<br>";
    echo "<b>Looking for:</b> " . realpath($file) . "<br>";
    echo "<b>Files in parent dir:</b><br>";
    print_r(scandir(__DIR__ . '/..'));
}
