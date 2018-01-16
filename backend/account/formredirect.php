<?php
declare(strict_types=1);
// If button register clicked
if (isset($_POST["register"])) {
    require './registration.php';
}
// If button login clicked
if (isset($_POST["login"])) {
    require 'backend/account/login.php';
}
