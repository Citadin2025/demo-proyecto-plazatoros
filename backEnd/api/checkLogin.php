<?php
function checkLogin()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['username'])) {
        return 1;
    } else {
        return 0;
    }
}