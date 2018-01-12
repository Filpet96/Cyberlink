<?php
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../../index");
}
include 'frontend/templates/biography.php';
include 'backend/account/profile-img.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Cyberlink</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
    <link href="frontend/css/home.css" rel="stylesheet">
    <link rel="icon" href="frontend/images/reddit-white.png">
    <style>
    .profile-image, .profile_image_comment {
  background: url(
  <?php if (!empty($edit_row['userPic'])): ?>
  <?php echo "frontend/user_images/".$edit_row['userPic']; ?>
  <?php else: echo "frontend/user_images/cyberlink.jpg"; ?>
  <?php endif; ?>
  );
  background-position: center;
  background-size: cover;
  border: 1px solid white;
  }
  .post-profile-image {
background: url(
<?php if (!empty($edit_row['userPic'])): ?>
<?php echo "frontend/user_images/".$edit_row['userPic']; ?>
<?php else: echo "frontend/user_images/cyberlink.jpg"; ?>
<?php endif; ?>
);
background-position: center;
background-size: cover;
}
  </style>
  </head>
  <body>
<?php include_once 'frontend/templates/header.php'; ?>
<div class="container">
  <div class="my-profile">

    <div class="profile-image"></div>
    <hr>
    <div class="information">
      <table>
      <tr><td><span class="profession"><?php echo $biography_info[0]['fullname'] ?></span></td></tr>
      <tr><td><span class="location"><?php if (!empty($biography_info[0]['country'])): ?><?php echo $biography_info[0]['country'] ?>
    <?php else: echo "Add location"; ?>
      <?php endif; ?></span></td></tr>
      <tr><td><span class="birthday"><?php echo $biography_info[0]['dateofbirth'] ?></span></td></tr>
    </div>
  </table>
  </div>
</div>
<div class="container_create_post">
	<div class="row">
        <?php
        include 'frontend/templates/time-ago.php';
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare('SELECT postID, userid, postTitle, postCont, postDate, postUrl, postImage, postVotes FROM posts WHERE postID = :postID');
            $stmt->execute(array(':postID' => $_GET['id']));
            $row = $stmt->fetch();


            if ($row['postID'] == '') {
                echo "ERROR";
                exit;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $postID_fetch = $row['postID'];
        $postTitle_fetch = $row['postTitle'];
?>

        <div class="viewlink_container">
          <div class="posted">
          <p>Posted <?php echo time_elapsed_string($row['postDate'], true) ?></p>
          </div>
          <div class="viewlink_title">
        <h1><?php echo $row['postTitle'] ?></h1>
      </div>
      <div class="viewlink_link">
        <a href="<?php echo $row['postUrl']; ?>" target="_blank">
          <img class="comment_link" src="frontend/images/link.svg" alt="">
        </a>
      </div>
      <div class="viewlink_content">
        <p><?php echo $row['postCont'] ?></p>
        </div>

        </div>
	</div>

</div>
<div class="viewlink_comments">
  <?php
  if (isset($_POST['edit_comment'])) {
      ?>
      <div class="create_comment">
        <form class="" action="backend/posts/edit-comment.php" method="post">
          <input type="hidden" name="postID" value="<?php echo $row['postID']; ?>" />
          <input type="hidden" name="postTitle" value="<?php echo $row['postTitle']; ?>" />
          <input type="hidden" name="commentID" value="<?php echo $_POST['commentID']; ?>" />
        <textarea name="comment"><?php echo $_POST['comment'] ?></textarea>
          <input type="submit" name="edit_comment" value="Edit comment">
        </form>
      </div>
      <?php
  } else {
      ?>
  <div class="create_comment">
    <form class="" action="backend/posts/comment.php" method="post">
      <input type="hidden" name="postID" value="<?=$row['postID']; ?>" />
      <input type="hidden" name="postTitle" value="<?=$row['postTitle']; ?>" />
    <textarea name="comment" placeholder="Add comment..."></textarea>
      <input type="submit" name="add_comment" value="Add comment">
    </form>
  </div>
  <?php
  }
 ?>
  <?php
  try {
      $stmt = $pdo->query('SELECT commentID, postID, userid, comment, commentDate FROM comments WHERE postID = :postID ORDER BY commentDate DESC');
      $stmt->execute(array(':postID' => $row['postID']));
      while ($row = $stmt->fetch()) {
          $name_comment = $pdo->prepare("SELECT fullname FROM user_biography WHERE userid=:userid");
          $userpic_comment = $pdo->prepare("SELECT userPic FROM users WHERE userid=:userid");
          $name_comment->execute(array(':userid'=>$row['userid']));
          $userpic_comment->execute(array(':userid'=>$row['userid']));
          $name_comment_fetched = $name_comment->fetch(PDO::FETCH_ASSOC);
          $userpic_comment_fetched = $userpic_comment->fetch(PDO::FETCH_ASSOC);
          extract($name_comment_fetched);
          extract($userpic_comment_fetched); ?>
  <div class="comment">
    <div class="post_footer">
      <?php if ($row['userid'] == $user_id) {
              ?>
        <!-- DELETE POST -->
      <form class="delete_comment" action="backend/posts/delete-comment.php" method="post">
        <button>Delete</button>
        <input type="hidden" name="commentID" value="<?php echo $row['commentID'] ?>">
        <input type="hidden" name="comment" value="<?php echo htmlspecialchars($row['comment']); ?>">
        <input type="hidden" name="postID" value="<?php echo $postID_fetch ?>">
        <input type="hidden" name="postTitle" value="<?php echo htmlspecialchars($postTitle_fetch); ?>">
    </form>
    <!-- EDIT POST -->
    <form class="edit_comment" action="" name="edit_comment" method="post">
      <button name="edit_comment">Edit</button>
      <input type="hidden" name="commentID" value="<?php echo $row['commentID'] ?>">
      <input type="hidden" name="comment" value="<?php echo htmlspecialchars($row['comment']); ?>">
  </form>
    <?php
          } ?>
    </div>
    <div class="profile_image_comment" <?php if (!empty($userpic_comment_fetched['userPic'])): ?> style="background:url(<?php echo "frontend/user_images/".$userpic_comment_fetched['userPic'] ?>);background-position:center;background-size:cover" <?php endif; ?>></div>
    <h1><?php echo $row['comment'] ?></h1>
    <p>Posted <?php echo time_elapsed_string($row['commentDate'], true); ?> by <?php echo $name_comment_fetched['fullname']?></p>
  </div>
  <?php
      }
  } catch (PDOException $e) {
      echo $e->getMessage();
  }
   ?>
</div>
<?php

         ?>
  </body>
  <script src="frontend/javascript/delete-comment.js" charset="utf-8"></script>
</html>
