<?php
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../../index");
}
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
    <link href="frontend/css/home.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
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
<header>
  <nav>
    <li><a class="home" href="../../home"><div class="homeicon"></div></a></li>
    <li><a class="settings" href="../../profile-settings"><div class="settingsicon"></div></a></li>
    <li class="logoutli"><a class="logout" href="../../Logging-out"><div class="logouticon"></div></a></li>
  </nav>
</header>
<div class="container">
  <div class="my-profile">
    <div class="username">
      <h1>Filip Petersson</h1>
    </div>
    <div class="profile-image"></div>
    <hr>
    <div class="information">
      <table>
      <tr><td><span class="profession">Designer, UI</span></td></tr>
      <tr><td><span class="location">London, UK</span></td></tr>
      <tr><td><span class="birthday">May 23, 1996</span></td></tr>
    </div>
  </table>
  </div>
</div>
<form class="" action="backend/posts/create-post.php" method="post">
<div class="create-post-container">
  <h1>Create Post</h1>
  <input type="text" name="title" value="" placeholder="Title">
  <textarea class="text" type="text" name="content" value="Text" rows="5" placeholder="Text area"></textarea>
  <div class="create-post">
    <input type="submit" name="submit" value="Post">
  </div>
</div>
</form>
<div class="post-container">
  <div class="post-profile-image"></div>
  <h1 class="post-fullname">Filip Petersson</h1>
  <div class="time-since-post">1 min</div>
  <hr>
  <div class="post-content">
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
  </div>
<form class="like-comment" action="frontend/templates/vote-or-comment.php" method="post">
    <div class="main">
      <label class="label_downVote">
  <input  type="submit" name="voteUp" onclick="upVote()" class="vote" style="display:none;">
    <svg class="upArrow vote" id="upButton" viewBox="0 0 11.5 6.4" xml:space="preserve">
    <path d="M11.4,5.4L6,0C5.9-0.1,5.8-0.1,5.8-0.1c-0.1,0-0.2,0-0.2,0.1
	L0.1,5.4C0,5.6,0,5.7,0.1,5.9l0.4,0.4c0.1,0.1,0.3,0.1,0.4,0l4.8-4.8l4.8,4.8c0.1,0.1,0.3,0.1,0.4,0l0.4-0.4
	C11.5,5.7,11.5,5.6,11.4,5.4z"/>
    </svg>
</label>
  <h1 id="scoreCounter"></h1>
  <label class="label_downVote">
  <input  type="submit" name="voteDown" onclick="downVote()" class="vote" style="display:none;">
  <svg class="downArrow vote" id="downButton" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 11.5 6.4" xml:space="preserve">
    <path d="M0.1,0.9l5.4,5.4c0.1,0.1,0.1,0.1,0.2,0.1c0.1,0,0.2,0,0.2-0.1
	l5.4-5.4c0.1-0.1,0.1-0.3,0-0.4L11,0c-0.1-0.1-0.3-0.1-0.4,0L5.8,4.8L0.9,0C0.8-0.1,0.6-0.1,0.5,0L0.1,0.4C0,0.6,0,0.7,0.1,0.9z"/>
  </svg>
  </label>
</div>

    <input class="comment" type="submit" name="submit" value="Comment">
  </form>
</div>

  </body>
  <script>
  var score = document.getElementById("scoreCounter");
score.innerHTML = "0";
var scoreValue = 0;
checkScore();

function upVote() {
// scoreValue++;
score.innerHTML = scoreValue;
checkScore();
}

function downVote() {
// scoreValue--;
score.innerHTML = scoreValue;
checkScore();
}

function checkScore() {
if (scoreValue < 0) {
  score.style.color = "#FF586C";
} else if (scoreValue > 0) {
  score.style.color = "#6CC576";
} else {
  score.style.color = "#666666";
}
}
  </script>
</html>
