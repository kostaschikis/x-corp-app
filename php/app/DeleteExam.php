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

if ( (isset($_GET['appId'])) && ($_SESSION['speciality'] == 'radiologist') ) {
    deleteRadiologistAppointment($_GET['appId'], $_SESSION['email']);
}


// Remove appointment from radiologist's appointments array
function deleteRadiologistAppointment(string $appId, string $radiologist) {
    $root = '../../';
    $altroot = '../..';

    // DB Connection
    require $root.'php/config.php';
    $appointments = array();

    // 1. Get Appointments Array
    $query = "SELECT `appointments` FROM `radiologist` WHERE `email` = ?"; 
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $radiologist);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) exit('No rows');
    while ($row = $result->fetch_assoc()) {
        $appointments = $row;
    }
    $appointments = json_decode($appointments['appointments']);
    $stmt->close();

    // 2. Remove Specified Appointment (appId) from Appointments Array
    if (($key = array_search($appId, $appointments)) !== false) {
        unset($appointments[$key]);
    }
    
    // 3. Update Comlumn
    $query = 'UPDATE `radiologist` SET `appointments` = ? WHERE `email` = ?'; 
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        head("./DeleteExam.php?dbError=true");
    } else {
        $stmt->bind_param("ss", json_encode($appointments), $radiologist);
        $stmt->execute();
        if ($stmt->error) echo $stmt->error;
    }
    $stmt->close();
    header("Location: $altroot/views/radiologist/home.php?deleteApp=success");
    
}

function deleteActinologyRequest(string $reqId) {

}