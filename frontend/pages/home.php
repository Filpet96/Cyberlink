<?php
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../../index");
}
include 'frontend/templates/biography.php';
include 'backend/account/profile-img.php';
$PostCreated = $_SESSION['PostCreated'] ?? '';
unset($_SESSION['PostCreated']);
?>
<?php if ($PostCreated !== ''): ?>
<?php echo "<script>alert('$PostCreated');</script>" ?>
<?php endif;?>
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
        <?php  include 'frontend/templates/create-post-content.php'; ?>
		</div>
	</div>
</div>
<?php

 include 'frontend/templates/time-ago.php';
try {
    $stmt = $pdo->query('SELECT postID, userid, postTitle, postDate, postUrl, postVotes FROM posts ORDER BY postVotes DESC');
    while ($row = $stmt->fetch()) {
        $postID = $row['postID'];
        $fullname = $biography_info[0]['fullname'];
        $CheckVote = $pdo->prepare("SELECT * FROM votes WHERE userid=:user_id AND votesID=:postID");
        $CheckVote->bindParam(':user_id', $user_id);
        $CheckVote->bindParam(':postID', $postID);
        $CheckVote->execute();
        $CheckVote = $CheckVote->fetchAll(PDO::FETCH_ASSOC);
        $fetched_id = $row['userid'];
        $fullname_post = $pdo->prepare("SELECT fullname FROM user_biography WHERE userid=:fetched_id");
        $fullname_post->execute(array(':fetched_id'=>$fetched_id));
        $fullname_post_fetched = $fullname_post->fetch(PDO::FETCH_ASSOC);
        extract($fullname_post_fetched);
        $class = $row['postVotes'] == 0 ? 'zero' : ($row['postVotes'] < 0 ? 'neg' : 'pos'); ?>

        <div class="post-container">
        <div class="post_footer">
          <?php if ($row['userid'] == $user_id) {
            ?>
            <!-- DELETE POST -->
          <form class="deletepost" action="backend/posts/delete-post.php" method="post">
            <button>Delete post</button>
            <input type="hidden" name="postID" value="<?php echo htmlspecialchars($row['postID']); ?>">
            <input type="hidden" name="postTitle" value="<?php echo htmlspecialchars($row['postTitle']); ?>">
        </form>
        <!-- EDIT POST -->
        <form class="editpost" action="" name="edit_post" method="post">
          <button name="edit_post">Edit post</button>
          <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['postID']); ?>">
          <input type="hidden" name="postTitle" value="<?php echo htmlspecialchars($row['postTitle']); ?>">
      </form>
        <?php
        } ?>
        </div>
        <div class="main_content">
        <div class="main">
        <form class="" action="backend/posts/vote.php" method="post">
        <input type="hidden" name="postID" value="<?php echo $row['postID'] ?>">
        <label class="label_downVote">
        <input type="submit" name="voteUp" onclick="upVote()" class="vote" style="display:none;">
        <svg class="upArrow vote <?php if ($CheckVote[0][voteUP] == "true") {
            echo 'greenvote';
        } ?>" id="upButton" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        	 width="444.819px"  viewBox="0 0 444.819 444.819" style="enable-background:new 0 0 444.819 444.819;"
        	 xml:space="preserve">
        <path d="M434.252,208.708L248.387,22.843c-7.042-7.043-15.693-10.564-25.977-10.564c-10.467,0-19.036,3.521-25.697,10.564
      		L10.848,208.708C3.615,215.94,0,224.604,0,234.692c0,9.897,3.619,18.459,10.848,25.693l21.411,21.409
      		c6.854,7.231,15.42,10.855,25.697,10.855c10.278,0,18.842-3.624,25.697-10.855l83.939-83.651v200.998
      		c0,9.89,3.567,17.936,10.706,24.126c7.139,6.184,15.752,9.273,25.837,9.273h36.545c10.089,0,18.698-3.09,25.837-9.273
      		c7.139-6.188,10.712-14.236,10.712-24.126V198.144l83.938,83.651c6.848,7.231,15.413,10.855,25.7,10.855
      		c10.082,0,18.747-3.624,25.975-10.855l21.409-21.409c7.043-7.426,10.567-15.988,10.567-25.693
      		C444.819,224.795,441.295,216.134,434.252,208.708z"/>
        </svg>
        </label>
        <h1 id="scoreCounter" class="<?php echo $class ?>"><?php echo $row['postVotes']?></h1>
        <label class="label_downVote">
        <input type="submit" name="voteDown" onclick="downVote()" class="vote" style="display:none;">
        <svg class="downArrow vote <?php if ($CheckVote[0][voteUP] == "false") {
            echo 'redvote';
        } ?>" id="downButton" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        	 viewBox="0 0 444.8 444.8" style="enable-background:new 0 0 444.8 444.8;" xml:space="preserve">
        <path d="M10.6,236.1L196.4,422c7,7,15.7,10.6,26,10.6c10.5,0,19-3.5,25.7-10.6L434,236.1c7.2-7.2,10.8-15.9,10.8-26
      		c0-9.9-3.6-18.5-10.8-25.7L412.6,163c-6.9-7.2-15.4-10.9-25.7-10.9c-10.3,0-18.8,3.6-25.7,10.9l-83.9,83.7v-201
      		c0-9.9-3.6-17.9-10.7-24.1c-7.1-6.2-15.8-9.3-25.8-9.3h-36.5c-10.1,0-18.7,3.1-25.8,9.3c-7.1,6.2-10.7,14.2-10.7,24.1v201L83.7,163
      		c-6.8-7.2-15.4-10.9-25.7-10.9c-10.1,0-18.7,3.6-26,10.9l-21.4,21.4c-7,7.4-10.6,16-10.6,25.7C0,220,3.5,228.7,10.6,236.1z"/>
         </svg>
         </label>

         </div>
         <div class="link_svg_title">
         <a href="<?php echo $row['postUrl']; ?>" target="_blank">
           <img  src="frontend/images/link.svg" alt="">
         </a>
         <?php $url = urldecode('viewlink&id=' . $row['postID'] . '&title='. $row['postTitle'] .'');
        if (!function_exists('cleanURL')) {
            function cleanURL($textURL)
            {
                $URL = strtolower(preg_replace(array('/[^a-z0-9\- ]/i', '/[ \-]+/'), array('', '_'), $textURL));
                return $URL;
            }
        } ?>
        <h1 class="post-fullname"><a href="viewlink&id=<?php echo $row['postID'] ?>&title=<?php echo cleanURL($row['postTitle']) ?>"><?php echo $row['postTitle'] ?></a></h1>
         </div>
         </div>
         </form>

         <div class="time-since-post"><p> Posted <?php echo time_elapsed_string($row['postDate'], true); ?> by <?php echo $fullname_post_fetched['fullname']?></p></div>

         </div>
         </tr>

        <?php
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
         ?>
  </body>

  <script src="frontend/javascript/delete-post.js" charset="utf-8"></script>
</html>
