<?php
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";

    $stmt = $pdo->prepare('DELETE FROM posts WHERE postID = :postID') ;
    $stmt->execute(array(':postID' => $_POST['postID']));

    header('Location: ../../home');
    exit;
