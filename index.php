<?php
declare(strict_types=1);
session_start();
require_once "system/page-routing.php";
require_once "system/connection.php";

// Check if maintenance variable is set
if ($maintenance === true) {
    echo "This site is currently under maintenance!!";
} elseif ($maintenance === false) {
    // Call get page function from page-routing.php
    getPage();
}
