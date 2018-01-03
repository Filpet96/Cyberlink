<?php
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";

    $stmt = $pdo->prepare('DELETE FROM posts WHERE id = :id') ;
    $stmt->execute(array(':id' => $_POST['id']));

    header('Location: ../../home');
    exit;
