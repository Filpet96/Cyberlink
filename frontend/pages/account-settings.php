<?php
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../../index");
}
include 'frontend/templates/biography.php';
include 'backend/account/update-account.php';

$Password_Email_Changed = $_SESSION['Password_Email_Changed'] ?? '';
$Email_Changed = $_SESSION['Email_Changed'] ?? '';
$Password_Changed = $_SESSION['Password_Changed'] ?? '';
unset($_SESSION['Password_Email_Changed']);
unset($_SESSION['Email_Changed']);
unset($_SESSION['Password_Changed']);
?>
 <?php if ($Password_Email_Changed !== ''): ?>
 <?php echo "<script>alert('$Password_Email_Changed');</script>" ?>
 <?php endif;?>
 <?php if ($Email_Changed !== ''): ?>
 <?php echo "<script>alert('$Email_Changed');</script>" ?>
 <?php endif;?>
 <?php if ($Password_Changed !== ''): ?>
 <?php echo "<script>alert('$Password_Changed');</script>" ?>
 <?php endif;?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Cyberlink</title>
    <link href="frontend/css/account-settings.css" rel="stylesheet">
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
  <div class="settings-container">
    <nav>
      <a href="../../profile-settings"><li class="left">Profile</li></a>
      <a href="../../account-settings"><li class="right">Account</li></a>
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
        <form class="" name="email" action="backend/account/update-account.php" method="post">
      <fieldset>
        <input type="password" name="old_password" id="old_password" placeholder="Old password" required>
      </fieldset>
      <fieldset>
        <input type="text" name="email" id="email" placeholder="Email" value="<?php if (!empty($biography_info[0]['email'])): ?><?php echo $biography_info[0]['email'];?><?php else: echo "Email";?>
      <?php endif; ?>">
      </fieldset>
      <fieldset>
        <input type="password" name="new_password" id="new_password" placeholder="New password" required >
      </fieldset>
      </div>
      <div class="save-information">
        <input type="submit" name="update_account" value="SAVE">
      </div>
      </form>
    </div>
  </div>
</div>
  </body>
</html>
