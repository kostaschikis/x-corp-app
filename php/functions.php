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
    return date("Y-m-d h:i:s", $t);
}

function formatDate($date) {
    $date = new DateTime($date);
    return $date->format('d/m/Y H:i');
}

function formatPatientInfo($patientInfo) {
    preg_match('#\((.*?)\)#', $patientInfo, $match);
    return $match[1];
}