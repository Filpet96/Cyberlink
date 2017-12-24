<?php
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../../index");
}

?>

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
  <?php else: echo "frontend/user-images/cyberlink.jpg"; ?>
  <?php endif; ?>
  );
  background-position: center;
  background-size: cover;
  }
  .post-profile-image {
background: url(
<?php if (!empty($edit_row['userPic'])): ?>
<?php echo "frontend/user_images/".$edit_row['userPic']; ?>
<?php else: echo "frontend/user-images/cyberlink.jpg"; ?>
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
<div class="create-post-container">
  <h1>Create Post</h1>
  <input type="text" name="" value="" placeholder="Title">
  <textarea class="text" type="text" name="" value="Text" placeholder="Text area"></textarea>
  <div class="create-post">
  <form class="" action="index.html" method="post">
    <input type="submit" name="submit" value="Post">
  </form>
  </div>
</div>
<div class="post-container">
  <div class="post-profile-image"></div>
  <h1>Filip Petersson</h1>
  <div class="time-since-post">1 min</div>
  <hr>
  <div class="post-content">
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
  </div>
  <form class="like-comment" action="index.html" method="post">
    <input class="like" type="submit" name="submit" value="Like">
    <input class="comment" type="submit" name="submit" value="Comment">
  </form>
</div>

  </body>
</html>
