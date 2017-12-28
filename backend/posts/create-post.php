<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// ASSIGN VARIABLE FROM FORM
$email = $_SESSION['loggedin'];

$postTitle = $_POST['title'];
$postCont = $_POST['content'];
$postDate = date("Y-m-d H:i:s");


if (empty($postTitle) && empty($postCont)) {
    echo "You must have a title and content!";
} else {
    //INSERT DATA INTO DATABASE
    $sqlPost = $pdo->prepare("INSERT INTO posts ( email, postTitle, postCont, postDate, votes )
                           VALUES ( :email, :postTitle, :postCont, :postDate, 0 )");

    // EXECUTE AND PREPARE
    $sqlPost->bindParam(':email', $email);
    $sqlPost->bindParam(':postTitle', $postTitle);
    $sqlPost->bindParam(':postCont', $postCont);
    $sqlPost->bindParam(':postDate', $postDate);
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
