<?php 

function getAvailableRadiologists() {
    $root = '../../';

    // DB Connection
    require $root.'php/config.php';

    $radiologists = array();
    
    $max = findMaxAppointments();

    return $radiologists;
}

function findMaxAppointments() {
    $root = '../../';

    // DB Connection
    require $root.'php/config.php';

    $max = 0;

    return $max;
}

function desideQuery($max, $actinologists) {
    return true || false;
}