<?php

function getPage()
{
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if ($page == "index") {
            require_once "frontend/pages/index.php";
        } elseif ($page == "home") {
            require_once "frontend/pages/home.php";
        } elseif ($page == "profile-settings") {
            require_once "frontend/pages/profile-settings.php";
        } elseif ($page == "account-settings") {
            require_once "frontend/pages/account-settings.php";
        } elseif ($page == "Logging-in") {
            require_once "backend/account/formredirect.php";
        } elseif ($page == "Logging-out") {
            require_once "frontend/templates/logout-loading.php";
        } elseif ($page == "viewlink") {
            require_once "frontend/pages/viewlink.php";
        }
    } else {
        require_once "frontend/pages/index.php";
    }
}
