<?php
declare(strict_types=1);
if (!isset($_SESSION)) {
    session_start();
}
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";


  $email = $_SESSION['loggedin'];
  $user_id = $_SESSION['user_id'];


  $postID   = $_POST['postID'];
  $true = "true";
  $false = "false";
  $vote_info = $pdo->prepare("SELECT * FROM votes WHERE votesID=:votesID AND userid=:user_id");
  $vote_info->bindParam(':votesID', $postID);
  $vote_info->bindParam(':user_id', $user_id);
  $vote_info->execute();
  $vote_info = $vote_info->fetchAll(PDO::FETCH_ASSOC);
try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['voteUp'])) {
        if (! $vote_info) {
            $sqlVoteCheck = $pdo->prepare("INSERT INTO votes ( votesID, userid, voteDirection )
                               VALUES ( :votesID, :user_id, :true)");
            $sqlVoteCheck->bindParam(':votesID', $postID);
            $sqlVoteCheck->bindParam(':user_id', $user_id);
            $sqlVoteCheck->bindParam(':true', $true);
            $voteCheckResult = $sqlVoteCheck->execute();

            $sqlvoteUp = $pdo->prepare("UPDATE posts SET postVotes=(postVotes + 1) WHERE postID=:postID");
            $sqlvoteUp->bindParam(':postID', $postID);
            $voteUpresult = $sqlvoteUp->execute();
            if ($voteUpresult && $voteCheckResult) {
                header("location: ../../home");
                exit;
            }
        } elseif ($vote_info[0]['voteDirection'] == "false") {
            $sqlvoteUp = $pdo->prepare("UPDATE posts SET postVotes=(postVotes + 2) WHERE postID=:postID");
            $sqlVotedChange = $pdo->prepare("UPDATE votes SET voteDirection = :true WHERE votesID=:votesID AND userid=:user_id");
            $sqlvoteUp->bindParam(':postID', $postID);
            $sqlVotedChange->bindParam(':votesID', $postID);
            $sqlVotedChange->bindParam(':true', $true);
            $sqlVotedChange->bindParam(':user_id', $user_id);
            $voteUpresult = $sqlvoteUp->execute();
            $sqlVotedChangeResult = $sqlVotedChange->execute();
            if ($voteUpresult && $sqlVotedChangeResult) {
                header("location: ../../home");
                exit;
            }
        } else {
            header("location: ../../home");
            exit;
        }
    }
    if (isset($_POST['voteDown'])) {
        if (! $vote_info) {
            $sqlVoteCheck = $pdo->prepare("INSERT INTO votes ( votesID, userid, voteDirection )
                               VALUES ( :votesID, :user_id, :false)");
            $sqlVoteCheck->bindParam(':votesID', $postID);
            $sqlVoteCheck->bindParam(':user_id', $user_id);
            $sqlVoteCheck->bindParam(':false', $false);
            $voteCheckResult = $sqlVoteCheck->execute();

            $sqlvoteUp = $pdo->prepare("UPDATE posts SET postVotes=(postVotes - 1) WHERE postID=:postID");
            $sqlvoteUp->bindParam(':postID', $postID);
            $voteUpresult = $sqlvoteUp->execute();
            if ($voteUpresult && $voteCheckResult) {
                header("location: ../../home");
                exit;
            }
        } elseif ($vote_info[0]['voteDirection'] == "true") {
            $sqlvoteUp = $pdo->prepare("UPDATE posts SET postVotes=(postVotes - 2) WHERE postID=:postID");
            $sqlVotedChange = $pdo->prepare("UPDATE votes SET voteDirection = :false WHERE votesID=:votesID AND userid=:user_id");
            $sqlvoteUp->bindParam(':postID', $postID);
            $sqlVotedChange->bindParam(':votesID', $postID);
            $sqlVotedChange->bindParam(':false', $false);
            $sqlVotedChange->bindParam(':user_id', $user_id);
            $voteUpresult = $sqlvoteUp->execute();
            $sqlVotedChangeResult = $sqlVotedChange->execute();
            if ($voteUpresult && $sqlVotedChangeResult) {
                header("location: ../../home");
                exit;
            }
        } else {
            header("location: ../../home");
            exit;
        }
    }
} catch (PDOException $e) {
    echo "Database error" . "<br>" . $e->getMessage();
}

$pdo = null;
