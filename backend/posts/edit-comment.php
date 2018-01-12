<?php
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";
try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $comment = $_POST['comment'];
    $commentID = $_POST['commentID'];

    //insert into database
    $edit_post = $pdo->prepare('UPDATE comments SET comment = :comment WHERE commentID = :commentID') ;
    $updatePost = $edit_post->execute(array(
        ':comment' => $comment,
        ':commentID' => $commentID
    ));
    if ($updatePost) {
        header('Location: ../../home');
        exit;
    } else {
        echo "Error database failure";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
