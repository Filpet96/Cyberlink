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
  </style>
  </head>
  <body>
<header>
  <nav>
    <li><a class="home" href="#"><div class="homeicon"></div></a></li>
    <li><a class="settings" href="#"><div class="settingsicon"></div></a></li>
  </nav>
</header>
<div class="container">
  <div class="my-profile">
    <div class="username">
      <h1>Username</h1>
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
  </body>
</html>
