<?php
$maintenance = false;
$config = [
    $dbname = "sqlite:../systemcyberlink.sql",
    // $user = "root",
    // $pass = "root",
];
$fileName = __DIR__ . "cyberlink.sql";
$dsn = "sqlite:$fileName";
try {
    $pdo = new PDO($dsn);
} catch (Exception $ex) {
    throw new Exception("Could not connect to DB");
}
