<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";



  $postID   = $_POST['postID'];

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['voteUp'])) {
        $sqlvoteUp = $pdo->prepare("UPDATE posts SET votes=(votes + 1) WHERE id=:id");
        $sqlvoteUp->bindParam(':id', $postID);
        $voteUpresult = $sqlvoteUp->execute();
        if ($voteUpresult) {
            header("location: ../../home");
            exit;
        }
    } elseif (isset($_POST['voteDown'])) {
        $sqlvoteDown = $pdo->prepare("UPDATE posts SET votes=(votes - 1) WHERE id=:id");
        $sqlvoteDown->bindParam(':id', $postID);
        $voteDownresult = $sqlvoteDown->execute();
        if ($voteDownresult) {
            header("location: ../../home");
            exit;
        }
    }
} catch (PDOException $e) {
    echo "Database error" . "<br>" . $e->getMessage();
}

$pdo = null;
