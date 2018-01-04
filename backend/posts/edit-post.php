<?php
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";
try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $postTitle = $_POST['title'];
    $postUrl = $_POST['url'];
    $postCont = $_POST['content'];
    $postID = $_POST['postID'];

    //insert into database
    $edit_post = $pdo->prepare('UPDATE posts SET postTitle = :postTitle, postCont = :postCont, postUrl = :postUrl WHERE postID = :postID') ;
    $updatePost = $edit_post->execute(array(
        ':postTitle' => $postTitle,
        ':postCont' => $postCont,
        ':postUrl' => $postUrl,
        ':postID' => $postID
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
