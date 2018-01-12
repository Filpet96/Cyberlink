<?php
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";

    $stmt = $pdo->prepare('DELETE FROM comments WHERE commentID = :commentID') ;
    $stmt->execute(array(':commentID' => $_POST['commentID']));

    header('Location: ../../home');
    exit;
