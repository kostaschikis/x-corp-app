<?php


function getDoctorActinologyRequests(string $doctor): array {
    $root = '../../';

    // DB Connection
    require $root.'php/config.php';

    $actRequests = array();

    $actRequest = [
        'id' => '',
        'priority' => '',
        'date_sent' => '',
        'examination' => '',
        'suggested_date' => '',
        'description' => '',
        'patient_ssn' => '',
        'doctor' => '',
        'approval' => 0,
        'completed' => 0
    ];
    
    // Get actinology request Details
    $stmt1 = $conn->prepare
    (
        "SELECT * FROM `actinology_requests` WHERE `doctor` = ? ORDER BY date_sent DESC"
    );
    mysqli_stmt_bind_param($stmt1, "s", $doctor);
    mysqli_stmt_execute($stmt1);

    $result1 = mysqli_stmt_get_result($stmt1);

    if (mysqli_num_rows($result1) > 0) {
        while ($row = mysqli_fetch_assoc($result1)) {
            $actRequest['id'] = $row['id'];
            $actRequest['priority'] = $row['priority'];
            $actRequest['date_sent'] = $row['date_sent'];
            $actRequest['examination'] = $row['examination'];
            $actRequest['suggested_date'] = $row['suggested_date'];
            $actRequest['description'] = $row['description'];
            $actRequest['patient_ssn'] = $row['patient_ssn'];
            $actRequest['doctor'] = $row['doctor'];
            $actRequest['approval'] = $row['approval'];

            // print_r($actRequest);
            
            $stmt2 = $conn->prepare
            (
                "SELECT `completed` FROM `appointment` WHERE `request_id` = ?"
            );
            mysqli_stmt_bind_param($stmt2, "s", $actRequest['id']);
            mysqli_stmt_execute($stmt2);
        
            $result2 = mysqli_stmt_get_result($stmt2);
        
            if (mysqli_num_rows($result2) > 0) {
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $actRequest['completed'] = $row2['completed'];
                }
            }       
            array_push($actRequests, $actRequest);
        }
    }

    // print_r($actRequests);

    return $actRequests;
}

function getAllActinologyRequests(): array {
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

function getActinologyRequestsById(string $examId): array {
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