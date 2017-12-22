<?php
if (isset($_POST["register"])) {
    require './registration.php';
}
if (isset($_POST["login"])) {
    require 'backend/account/login.php';
}
