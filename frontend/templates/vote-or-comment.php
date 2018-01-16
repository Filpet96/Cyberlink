<?php
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";

try {
    $stmt = $pdo->query('SELECT postID, postTitle, postDate FROM posts ORDER BY postID DESC');
    while ($row = $stmt->fetch()) {
        echo '<div class="post-container">';
        echo '<form class="like-comment" action="frontend/templates/vote-or-comment.php" method="post">';
        echo '<input class="comment" type="submit" name="submit" value="Comment">';
        echo '<div class="main">';
        echo '<label class="label_downVote">';
        echo '<input  type="submit" name="voteUp" onclick="upVote()" class="vote" style="display:none;">';
        echo '<svg class="upArrow vote" id="upButton" viewBox="0 0 11.5 6.4" xml:space="preserve">';
        echo '<path d="M11.4,5.4L6,0C5.9-0.1,5.8-0.1,5.8-0.1c-0.1,0-0.2,0-0.2,0.1
      L0.1,5.4C0,5.6,0,5.7,0.1,5.9l0.4,0.4c0.1,0.1,0.3,0.1,0.4,0l4.8-4.8l4.8,4.8c0.1,0.1,0.3,0.1,0.4,0l0.4-0.4
      C11.5,5.7,11.5,5.6,11.4,5.4z"/>';
        echo '</svg>';
        echo '<h1 id="scoreCounter"></h1>';
        echo '<label class="label_downVote">';
        echo '<input  type="submit" name="voteDown" onclick="downVote()" class="vote" style="display:none;">';
        echo '<svg class="downArrow vote" id="downButton" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 11.5 6.4" xml:space="preserve">';
        echo '<path d="M0.1,0.9l5.4,5.4c0.1,0.1,0.1,0.1,0.2,0.1c0.1,0,0.2,0,0.2-0.1
      l5.4-5.4c0.1-0.1,0.1-0.3,0-0.4L11,0c-0.1-0.1-0.3-0.1-0.4,0L5.8,4.8L0.9,0C0.8-0.1,0.6-0.1,0.5,0L0.1,0.4C0,0.6,0,0.7,0.1,0.9z"/>';
        echo '</svg>';
        echo '</label>';
        echo '</div>';
        echo '<h1 class="post-fullname">'.$row['postTitle'].'</h1>';
        echo '<div class="time-since-post"><p> Posted '.$row['postDate'].' by Filip Petersson</p></div>';
        echo '</div>';

        echo '<td>'.$row['postTitle'].'</td>';
        echo '<td>'.date('jS M Y', strtotime($row['postDate'])).'</td>'; ?>
        <?php
        echo '</tr>';
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
