<?php

function getPage()
{
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if ($page == "index") {
            require_once "frontend/pages/index.php";
        } elseif ($page == "home") {
            require_once "frontend/pages/home.php";
        }
    } else {
        require_once "frontend/pages/index.php";
    }
}
