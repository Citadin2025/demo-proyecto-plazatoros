<?php
//IT'S JUST AN ENDPOINT THAT CHECKS IF THERE IS AN ACTIVE SESSION
session_start();
if (isset($_SESSION['username'])) {
    echo json_encode(['loggedIn' => true, 'username' => $_SESSION['user']['username']]);
} else {
    echo json_encode(['loggedIn' => false]);
}