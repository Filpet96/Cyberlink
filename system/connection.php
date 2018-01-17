<?php
declare(strict_types=1);
// Set maintenance variable to true if enable maintenance message
$maintenance = false;
// Database file dir
$fileName = __DIR__ . "cyberlink.sql";
$dsn = "sqlite:$fileName";
// pdo db connection
try {
    $pdo = new PDO($dsn);
} catch (Exception $ex) {
    throw new Exception("Could not connect to DB");
}
