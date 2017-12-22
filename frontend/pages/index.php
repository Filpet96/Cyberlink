<?php
if (isset($_SESSION['loggedin'])) {
    header('location:../../index');
}
$AccountsucessRegister = $_SESSION['Accountsucess'] ?? '';
$AccountfailRegister = $_SESSION['Accountfail'] ?? '';
unset($_SESSION['Accountsucess']);
unset($_SESSION['Accountfail']);
?>
 <?php if ($AccountsucessRegister !== ''): ?>
 <?php echo "<script>alert('$AccountsucessRegister');</script>" ?>
 <?php endif;?>
 <?php if ($AccountfailRegister !== ''): ?>
 <?php echo "<script>alert('$AccountfailRegister');</script>" ?>
 <?php endif;?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Cyberlink</title>
    <link href="frontend/css/index.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  </head>
  <body>
    <section class="user">
      <div class="user_options-container">
        <div class="user_options-text">
          <div class="user_options-unregistered">
            <h2 class="user_unregistered-title">Don't have an account?</h2>
            <p class="user_unregistered-text">Banjo tote bag bicycle rights, High Life sartorial cray craft beer whatever street art fap.</p>
            <button class="user_unregistered-signup" id="signup-button">Sign up</button>
          </div>

          <div class="user_options-registered">
            <h2 class="user_registered-title">Have an account?</h2>
            <p class="user_registered-text">Banjo tote bag bicycle rights, High Life sartorial cray craft beer whatever street art fap.</p>
            <button class="user_registered-login" id="login-button">Login</button>
          </div>
        </div>

        <div class="user_options-forms" id="user_options-forms">
          <div class="user_forms-login">
            <h2 class="forms_title">Login</h2>
            <form class="forms_form" action="Logging-in" method="POST">
              <fieldset class="forms_fieldset">
                <div class="forms_field">
                  <input type="email" placeholder="Email" name="email" class="forms_field-input" required autofocus />
                </div>
                <div class="forms_field">
                  <input type="password" placeholder="Password" name="password" class="forms_field-input" required />
                </div>
              </fieldset>
              <div class="forms_buttons">
                <button type="button" class="forms_buttons-forgot">Forgot password?</button>
                <input type="submit" value="login" name="login" class="forms_buttons-action">
              </div>
            </form>
          </div>
          <div class="user_forms-signup">
            <h2 class="forms_title">Sign Up</h2>
                        <form class="forms_form" action="backend/account/formredirect.php" method="POST">
    <div class="row">
      <h4>Account</h4>
      <div class="input-group input-group-icon">
        <input type="text" name="fullname" placeholder="Full Name"/>
        <div class="input-icon"><i class="fa fa-user"></i></div>
      </div>
      <div class="input-group input-group-icon">
        <input type="email" name="email" placeholder="Email Adress"/>
        <div class="input-icon"><i class="fa fa-envelope"></i></div>
      </div>
      <div class="input-group input-group-icon">
        <input type="password" name="password" placeholder="Password"/>
        <div class="input-icon"><i class="fa fa-key"></i></div>
      </div>
    </div>
    <div class="row">
      <div class="col-half">
        <h4>Date of Birth</h4>
        <div class="input-group">
          <div class="col-third">
            <input type="text" name="dd" placeholder="DD"/>
          </div>
          <div class="col-third">
            <input type="text" name="mm" placeholder="MM"/>
          </div>
          <div class="col-third">
            <input type="text" name="yy" placeholder="YYYY"/>
          </div>
        </div>
      </div>
      <div class="col-half submitinput">
  <div class="input-group">
    <input type="submit" value="register" name="register" class="forms_buttons-action">
  </div>
</div>
    </div>
  </form>
          </div>
        </div>
      </div>
    </section>
  </body>
  <script>
  // Variables
var signupButton = document.getElementById('signup-button'),
  loginButton = document.getElementById('login-button'),
  userForms = document.getElementById('user_options-forms')


// Add event listener to the "Sign Up" button
signupButton.addEventListener('click', () => {
userForms.classList.remove('login-click')
userForms.classList.add('signup-click')
}, false)


// Add event listener to the "Login" button
loginButton.addEventListener('click', () => {
userForms.classList.remove('signup-click')
userForms.classList.add('login-click')
}, false)
  </script>
</html>
