<?php
declare(strict_types=1);
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";
$postID = $_POST['postID'];
$postTitle = $_POST['postTitle'];
    $stmt = $pdo->prepare('DELETE FROM comments WHERE commentID = :commentID') ;
    $stmt->execute(array(':commentID' => $_POST['commentID']));
    if (!function_exists('cleanURL')) {
        function cleanURL($textURL)
        {
            $URL = strtolower(preg_replace(array('/[^a-z0-9\- ]/i', '/[ \-]+/'), array('', '_'), $textURL));
            return $URL;
        }
    }
    $url = '../../viewlink&id='.$postID.'&title='.cleanURL($postTitle).'';
    header("location: $url");
    exit;
