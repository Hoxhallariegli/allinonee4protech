<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$structure = file_get_contents('DB_STRUCTURE.txt');
preg_match_all('/Table: (.+?)\n/', $structure, $matches);
$tables = array_unique($matches[1]);

$missing = [];
foreach ($tables as $table) {
    if (!Schema::hasTable($table)) {
        $missing[] = $table;
    }
}

if (empty($missing)) {
    echo "All tables exist.";
} else {
    echo "Missing tables: " . implode(', ', $missing);
}
