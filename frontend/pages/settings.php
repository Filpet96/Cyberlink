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
    <link href="frontend/css/settings.css" rel="stylesheet">
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
    <li><a class="settings" href="../../settings"><div class="settingsicon"></div></a></li>
    <li class="logoutli"><a class="logout" href="../../Logging-out"><div class="logouticon"></div></a></li>
  </nav>
</header>
<div class="container">
  <div class="settings-container">
    <nav>
      <li class="left">Profile</li>
      <li class="right">Account</li>
    </nav>
    <div class="profile-content">
      <div class="picture-container">
        <div class="picture-circle"></div>
        <form class="" action="index.html" method="post">
          <label class="select-file" for="profile-img">Select File</label>
          <input type="file" id="profile-img" name="user_image"   accept="image/*" style="display:none" />
        </form>
      </div>
      <div class="information-container">
      <fieldset>
        <input type="text" name="" value="<?php echo $_SESSION['user_fullname']; ?>">
      </fieldset>
      <fieldset>
        <input type="text" name="" value="<?php echo $_SESSION['loggedin']; ?>">
      </fieldset>
      <fieldset>
        <input type="text" name="" placeholder="Password">
      </fieldset>
      <fieldset>
        <input type="text" name="" value="<?php echo $_SESSION['user_dateofbirth']; ?>">
      </fieldset>
      </div>
      <div class="save-information">
        <input type="submit" name="" value="SAVE">
      </div>
    </div>
  </div>
</div>
  </body>
</html>
