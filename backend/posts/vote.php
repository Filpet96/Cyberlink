<?php
if (!isset($_SESSION)) {
    session_start();
}
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";


  $email = $_SESSION['loggedin'];
  $postID   = $_POST['postID'];
  $true = "true";
  $false = "false";
  $vote_info = $pdo->prepare("SELECT * FROM votes WHERE votesID=:votesID AND email=:email");
  $vote_info->bindParam(':votesID', $postID);
  $vote_info->bindParam(':email', $email);
  $vote_info->execute();
  $vote_info = $vote_info->fetchAll(PDO::FETCH_ASSOC);
try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['voteUp'])) {
        if (! $vote_info) {
            $sqlVoteCheck = $pdo->prepare("INSERT INTO votes ( votesID, email, voteUp )
                               VALUES ( :votesID, :email, :true)");
            $sqlVoteCheck->bindParam(':votesID', $postID);
            $sqlVoteCheck->bindParam(':email', $email);
            $sqlVoteCheck->bindParam(':true', $true);
            $voteCheckResult = $sqlVoteCheck->execute();

            $sqlvoteUp = $pdo->prepare("UPDATE posts SET votes=(votes + 1) WHERE id=:id");
            $sqlvoteUp->bindParam(':id', $postID);
            $voteUpresult = $sqlvoteUp->execute();
            if ($voteUpresult && $voteCheckResult) {
                header("location: ../../home");
                exit;
            }
        } elseif ($vote_info[0]['voteUP'] == "false") {
            $sqlvoteUp = $pdo->prepare("UPDATE posts SET votes=(votes + 2) WHERE id=:id");
            $sqlVotedChange = $pdo->prepare("UPDATE votes SET voteUP = :true WHERE votesID=:votesID");
            $sqlvoteUp->bindParam(':id', $postID);
            $sqlVotedChange->bindParam(':votesID', $postID);
            $sqlVotedChange->bindParam(':true', $true);
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
            $sqlVoteCheck = $pdo->prepare("INSERT INTO votes ( votesID, email, voteUp )
                               VALUES ( :votesID, :email, :false)");
            $sqlVoteCheck->bindParam(':votesID', $postID);
            $sqlVoteCheck->bindParam(':email', $email);
            $sqlVoteCheck->bindParam(':false', $false);
            $voteCheckResult = $sqlVoteCheck->execute();

            $sqlvoteUp = $pdo->prepare("UPDATE posts SET votes=(votes - 1) WHERE id=:id");
            $sqlvoteUp->bindParam(':id', $postID);
            $voteUpresult = $sqlvoteUp->execute();
            if ($voteUpresult && $voteCheckResult) {
                header("location: ../../home");
                exit;
            }
        } elseif ($vote_info[0]['voteUP'] == "true") {
            $sqlvoteUp = $pdo->prepare("UPDATE posts SET votes=(votes - 2) WHERE id=:id");
            $sqlVotedChange = $pdo->prepare("UPDATE votes SET voteUP = :false WHERE votesID=:votesID");
            $sqlvoteUp->bindParam(':id', $postID);
            $sqlVotedChange->bindParam(':votesID', $postID);
            $sqlVotedChange->bindParam(':false', $false);
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
