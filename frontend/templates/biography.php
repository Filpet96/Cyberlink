<?php
declare(strict_types=1);
if (!isset($_SESSION)) {
    session_start();
}
// connection file
require $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";

// current user's email
$email = $_SESSION['loggedin'];
// current users id number
$user_id = $_SESSION['user_id'];

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $biography_info = $pdo->prepare("SELECT * FROM user_biography WHERE userid=:user_id");
    $biography_info->bindParam(':user_id', $user_id);
    $biography_info->execute();
    $biography_info = $biography_info->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database error" . "<br>" . $e->getMessage();
}

$pdo = null;
