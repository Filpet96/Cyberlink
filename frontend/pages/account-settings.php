<?php
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../../index");
}
include 'frontend/templates/biography.php';
include 'backend/account/update-account.php';

$Password_Email_Changed = $_SESSION['Password_Email_Changed'] ?? '';
$Email_Changed = $_SESSION['Email_Changed'] ?? '';
$Password_Changed = $_SESSION['Password_Changed'] ?? '';
$Wrong_Password = $_SESSION['Wrong_Password'] ?? '';
unset($_SESSION['Password_Email_Changed']);
unset($_SESSION['Email_Changed']);
unset($_SESSION['Password_Changed']);
unset($_SESSION['Wrong_Password']);
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
 <?php if ($Wrong_Password !== ''): ?>
 <?php echo "<script>alert('$Wrong_Password');</script>" ?>
 <?php endif;?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Cyberlink</title>
    <link href="frontend/css/account-settings.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
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
        <input type="password" name="new_password" id="new_password" placeholder="New password" pattern=".{6,}" required title="6 characters min." >
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