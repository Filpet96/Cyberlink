<?php
if (!isset($_SESSION)) {
    session_start();
}
require $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";

$email = $_SESSION['loggedin'];

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $biography_info = $pdo->prepare("SELECT * FROM user_biography WHERE email=:email");
    $biography_info->bindParam(':email', $email);
    $biography_info->execute();
    $biography_info = $biography_info->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database error" . "<br>" . $e->getMessage();
}

$pdo = null;
