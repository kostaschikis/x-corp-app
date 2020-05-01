<?php

function is_user_logged_in() {
    return isset($_SESSION['name']) || isset($_COOKIE['user']);
}