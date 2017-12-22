<?php

function getPage()
{
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if ($page == "index") {
            require_once "frontend/pages/index.php";
        } elseif ($page == "home") {
            require_once "frontend/pages/home.php";
        } elseif ($page == "settings") {
            require_once "frontend/pages/settings.php";
        } elseif ($page == "Logging-in") {
            require_once "backend/account/formredirect.php";
        } elseif ($page == "Logging-out") {
            require_once "frontend/templates/logout-loading.php";
        }
    } else {
        require_once "frontend/pages/index.php";
    }
}
