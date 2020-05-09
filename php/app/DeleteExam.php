<?php 
session_start(); 
$root = '../../';

// Includes
include $root.'php/functions.php';

// Protect The Route
if (!is_user_logged_in()) {
  header("Location:" . $root);  
  exit();
}

if (isset($_GET['appId'])) {
    deleteAppointment($_GET['appId']);
}

if (isset($_GET['reqId'])) {
    deleteActinologyRequest($_GET['reqId']);
}

function deleteAppointment(string $appId) {

}

function deleteActinologyRequest(string $reqId) {

}