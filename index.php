<?php
session_start();
require_once "system/page-routing.php";
require_once "system/connection.php";

if ($maintenance === true) {
    echo "This site is currently under maintenance!!";
} elseif ($maintenance === false) {
    getPage();
}
