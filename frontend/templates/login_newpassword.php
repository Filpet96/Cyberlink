<?php if (isset($_POST['forgot_password'])) {
    ?>
  <div class="user_forms-login">
    <h2 class="forms_title">Reset Password</h2>
    <form class="forms_form" action="../../backend/account/forgot-password.php" method="POST">
      <fieldset class="forms_fieldset">
        <div class="forms_field">
          <input type="email" placeholder="Email" name="email" class="forms_field-input" required autofocus />
        </div>
        <br>
        <br>
      </fieldset>
      <button type="button" onClick="window.location.href='../../index'" class="forms_buttons-forgot">Login?</button>
      <div class="forms_buttons">

        <input type="submit" value="Send Password" name="login" class="forms_buttons-action">
      </div>
    </form>
  </div>
  <?php
} else {
        ?>
  <div class="user_forms-login">
    <h2 class="forms_title">Login</h2>
    <form id="loginForm" class="forms_form" action="Logging-in" method="POST"></form>
    <form id="forgotPassword" class="" action="" method="POST"></form>
      <fieldset class="forms_fieldset">
        <div class="forms_field">
          <input type="email" placeholder="Email" name="email" form="loginForm" class="forms_field-input" required autofocus />
        </div>
        <div class="forms_field">
          <input type="password" placeholder="Password" name="password" form="loginForm" class="forms_field-input" required />
        </div>
      </fieldset>
      <button name="forgot_password" form="forgotPassword" class="forms_buttons-forgot">Forgot password?</button>
      <div class="forms_buttons">

        <input type="submit" value="login" name="login" form="loginForm" class="forms_buttons-action">
      </div>
  </div>
  <?php
    } ?>
