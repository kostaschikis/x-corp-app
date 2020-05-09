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

if (isset($_GET['appId']) && isset($_GET['radioEmail'])) {
    deleteRadiologistAppointment($_GET['appId']);
}


// Remove appointment from radiologist's appointments array
function deleteRadiologistAppointment(string $appId) {
    
}

function deleteActinologyRequest(string $reqId) {

}