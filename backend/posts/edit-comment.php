<?php
declare(strict_types=1);
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";
try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $comment = $_POST['comment'];
    $commentID = $_POST['commentID'];
    $postID = $_POST['postID'];
    $postTitle = $_POST['postTitle'];

    //insert into database
    $edit_post = $pdo->prepare('UPDATE comments SET comment = :comment WHERE commentID = :commentID') ;
    $updatePost = $edit_post->execute(array(
        ':comment' => $comment,
        ':commentID' => $commentID
    ));
    if (!function_exists('cleanURL')) {
        function cleanURL($textURL)
        {
            $URL = strtolower(preg_replace(array('/[^a-z0-9\- ]/i', '/[ \-]+/'), array('', '_'), $textURL));
            return $URL;
        }
    }
    $url = '../../viewlink&id='.$postID.'&title='.cleanURL($postTitle).'';
    if ($updatePost) {
        header("location: $url");
        exit;
    } else {
        echo "Error database failure";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
