<?php
if (!isset($_SESSION)) {
    session_start();
}
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";


// ASSIGN VARIABLE FROM FORM
$email = $_SESSION['loggedin'];
$user_id = $_SESSION['user_id'];


if (isset($_POST['add_comment'])) {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $comment = $_POST['comment'];
    $commentDate = date("Y-m-d H:i:s");
    $postID = $_POST['postID'];
    $postTitle = $_POST['postTitle'];

    if (empty($comment)) {
        echo "You must write a comment";
    } else {
        //INSERT DATA INTO DATABASE
        $sqlComment = $pdo->prepare("INSERT INTO comments ( postID, userid, comment, commentDate )
                           VALUES ( :postID, :userid, :comment, :commentDate)");

        // EXECUTE AND PREPARE
        $sqlComment->bindParam(':postID', $postID);
        $sqlComment->bindParam(':userid', $user_id);
        $sqlComment->bindParam(':comment', $comment);
        $sqlComment->bindParam(':commentDate', $commentDate);
        $result = $sqlComment->execute();
        //EXECUTE QUERY
        if (!function_exists('cleanURL')) {
            function cleanURL($textURL)
            {
                $URL = strtolower(preg_replace(array('/[^a-z0-9\- ]/i', '/[ \-]+/'), array('', '_'), $textURL));
                return $URL;
            }
        }
        $url = '../../viewlink&id='.$postID.'&title='.cleanURL($postTitle).'';
        if ($result) {
            header("location: $url");
            exit;
        } else {
            echo "Error database failure";
        }
    }
}
