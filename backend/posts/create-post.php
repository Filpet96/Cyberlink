<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// ASSIGN VARIABLE FROM FORM
$email = $_SESSION['loggedin'];
$user_id = $_SESSION['user_id'];

$postTitle = $_POST['title'];
$postCont = $_POST['content'];
$postDate = date("Y-m-d H:i:s");
$postUrl = $_POST['url'];


if (empty($postTitle) && empty($postCont)) {
    echo "You must have a title and content!";
} else {
    //INSERT DATA INTO DATABASE
    $sqlPost = $pdo->prepare("INSERT INTO posts ( userid, postTitle, postCont, postDate, postUrl, votes )
                           VALUES ( :user_id, :postTitle, :postCont, :postDate, :postUrl, 0 )");

    // EXECUTE AND PREPARE
    $sqlPost->bindParam(':user_id', $user_id);
    $sqlPost->bindParam(':postTitle', $postTitle);
    $sqlPost->bindParam(':postCont', $postCont);
    $sqlPost->bindParam(':postDate', $postDate);
    $sqlPost->bindParam(':postUrl', $postUrl);
    $result = $sqlPost->execute();
    //EXECUTE QUERY
    if ($result) {
        $_SESSION['PostCreated'] = "Post Created!";
        header("location: ../../home");
        exit;
    } else {
        echo "Error database failure";
    }
}
