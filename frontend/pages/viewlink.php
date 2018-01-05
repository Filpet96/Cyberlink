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
    .profile-image {
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

	    <div class="col-md-8 col-md-offset-2">
        <?php
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


        echo '<div>';
        echo '<h1>'.$row['postTitle'].'</h1>';
        echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
        echo '<p>'.$row['postCont'].'</p>';
        echo '</div>';
         ?>

		</div>
	</div>
</div>
<?php

         ?>
  </body>
</html>
