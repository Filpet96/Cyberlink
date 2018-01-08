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

?>

        <div class="viewlink_container">
          <div class="posted">
          <p>Posted <?php echo time_elapsed_string($row['postDate'], true) ?></p>
          </div>
          <div class="viewlink_title">
        <h1><?php echo $row['postTitle'] ?></h1>
      </div>
      <div class="viewlink_link">
        <p>Link:<?php echo $row['postUrl'] ?></p>
      </div>
      <div class="viewlink_content">
        <p><?php echo $row['postCont'] ?></p>
        </div>

        </div>
	</div>

</div>
<div class="viewlink_comments">
  <div class="create_comment">
    <div class="profile_image_comment"></div>
    <textarea name="name" placeholder="Add comment..."></textarea>
    <form class="" action="index.html" method="post">
      <input type="submit" name="add_comment" value="Add comment">
    </form>
  </div>
  <div class="comment">
    <div class="profile_image_comment"></div>
    <h1>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto temporibus iste nostrum dolorem natus recusandae incidunt voluptatum.</h1>
    <p>Feb 2, 2013 11:32:04 PM</p>
  </div>
  
</div>
<?php

         ?>
  </body>
</html>
