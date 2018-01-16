<?php
declare(strict_types=1);
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";

    $post = $pdo->prepare('DELETE FROM posts WHERE postID = :postID') ;
    $votes = $pdo->prepare('DELETE FROM votes WHERE votesID = :postID') ;
    $comments = $pdo->prepare('DELETE FROM comments WHERE postID = :postID') ;
    $post->execute(array(':postID' => $_POST['postID']));
    $votes->execute(array(':postID' => $_POST['postID']));
    $comments->execute(array(':postID' => $_POST['postID']));

    header('Location: ../../home');
    exit;
