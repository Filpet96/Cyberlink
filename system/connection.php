<?php
$maintenance = false;
$config = [
    $dbname = "sqlite:../cyberlink.sql",
    // $user = "root",
    // $pass = "root",
];
try {
    $pdo = new PDO(...$config);
} catch (Exception $ex) {
    throw new Exception("Could not connect to DB");
}
