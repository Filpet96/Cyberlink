<?php
declare(strict_types=1);
session_start();
unset($_SESSION['loggedin']);
session_destroy();
header('location: ../../index');
exit;
