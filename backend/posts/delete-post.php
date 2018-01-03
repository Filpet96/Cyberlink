<?php
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";
if (isset($_GET['delpost'])) {
    $stmt = $pdo->prepare('DELETE FROM posts WHERE id = :id') ;
    $stmt->execute(array(':id' => $_GET['delpost']));

    header('Location: ../../home');
    exit;
}
