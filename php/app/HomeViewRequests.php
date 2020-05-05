<?php


function getDoctorActinologyRequests($doctor) {
    $root = '../../';

    // DB Connection
    require $root.'php/config.php';

    $actRequests = array();
 
    $stmt = $conn->prepare
    (
        "SELECT * FROM `actinology_requests` WHERE `doctor` = ? ORDER BY date_sent DESC"
    );
    mysqli_stmt_bind_param($stmt, "s", $doctor);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $actRequests[] = $row;
        }
    }

    return $actRequests;
}

function getAllActinologyRequests() {
    $root = '../../';

    // DB Connection
    require $root.'php/config.php';

    $actRequests = array();
 
    $stmt = $conn->prepare
    (
        "SELECT * FROM `actinology_requests` ORDER BY date_sent DESC"
    );
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $actRequests[] = $row;
        }
    }

    return $actRequests;
} 

function getActinologyRequestsById($examId) {
    $root = '../../';

    // DB Connection
    require $root.'php/config.php';

    $actRequest = array();
    
    // 1. Get Actinology Request Info
    $stmt = $conn->prepare
    ( "SELECT * FROM `actinology_requests` WHERE `id` = ?" );
    mysqli_stmt_bind_param($stmt, "s", $examId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $actRequest = $row;
        }
    }

    // 2. Get Patient Name
    $stmt = $conn->prepare
    ( "SELECT `ssn`, `name`, `lastname` FROM `patient` WHERE `ssn` = ?" );
    mysqli_stmt_bind_param($stmt, "s", $actRequest['patient_ssn']);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $ssn = $row['ssn'];
            $name = $row['name'];
            $lastname = $row['lastname'];
    
            $patient = $name . ' ' . $lastname . ' ' . '(' . $ssn . ')';
            $actRequest['patient_info'] = $patient;
        }
    }

    return $actRequest;
} 

function getRadiologistAppointments() {}