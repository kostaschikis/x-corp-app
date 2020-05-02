<?php

function is_user_logged_in() {
    return isset($_SESSION['name']) || isset($_COOKIE['user']);
}

function transformPriority($priority) {
    if ($priority == 'Low Priority') return 'low';
    if ($priority == 'High Priority') return 'high';
}

function getCurrentDate() {
    date_default_timezone_set('Europe/Athens');
    $t=time();
    return date("d-m-Y h:i:s", $t);
}