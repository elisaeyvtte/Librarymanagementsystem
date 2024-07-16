<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function isAuthenticated () {
    return isset($_SESSION['user_id']);

}

function redirectIfNotAuthenticated($location){
    if (!isAuthenticated()) {
        header("Location: $location");
        exit();
    }
}