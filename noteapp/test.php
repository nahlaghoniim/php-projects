<?php
require 'database.php';

$stmt = $pdo->query("SELECT * FROM notes");
$results = $stmt->fetchAll();

echo "<pre>";
print_r($results);
echo "</pre>";
