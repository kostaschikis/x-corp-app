<?php

/*
|--------------------------------------------------------------------------
| Home Views Requests
|--------------------------------------------------------------------------
|
| 1. getAllActinologyRequests() = Get All Actinology Requests Available
| 2. getDoctorActinologyRequests(doctor) = Get Specified Doctor's Actinology Requests
| 3. getActinologyRequestsById(requestId) = Get The Actinology Request With Sepcified ID
| 4. getRadiologistAppointments(radiologist) = Get Specified Radiologist's Appointments
|
*/

function getAllActinologyRequests(): array {
    $root = '../../';

    // DB Connection
    require $root.'php/config.php';

    // Get Actinology Requests
    $actRequests = array();
    $stmt = $conn->prepare("SELECT * FROM `actinology_requests` ORDER BY date_sent DESC");
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $actRequests[] = $row;
        }
    }
    $stmt->close();

    // For Each Actinology Request Get Completion Status
    $actRequestsFinal = array();
    foreach ($actRequests as $actRequest) {
        $stmt = $conn->prepare("SELECT `completed` FROM `appointment` WHERE `request_id` = ?");
        $stmt->bind_param("s", $actRequest["id"]);
        $stmt->execute();        
        $result = $stmt->get_result();
    
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $actRequest['completed'] = $row['completed'];
                array_push($actRequestsFinal, $actRequest);
            }
        } else {
            $actRequest['completed'] = 0;
            array_push($actRequestsFinal, $actRequest);
        }
        $stmt->close();        
    }
    
    return $actRequestsFinal;
} 

function getDoctorActinologyRequests(string $doctor): array {
    $root = '../../';

    // DB Connection
    require $root.'php/config.php';
    require $root.'php/app/PatientInfo.php';

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
            
            // 1. Get Patient Info
            $actRequest['patient_info'] = getFormatedPatientInfo($actRequest['patient_ssn']); 
            
            // 2. Get Completion Status
            $stmt2 = $conn->prepare("SELECT `completed` FROM `appointment` WHERE `request_id` = ?");
            mysqli_stmt_bind_param($stmt2, "s", $actRequest['id']);
            mysqli_stmt_execute($stmt2);
            
            $result2 = mysqli_stmt_get_result($stmt2);
            
            if (mysqli_num_rows($result2) > 0) {
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $actRequest['completed'] = $row2['completed'];
                }
            }
            $stmt2->close();
            array_push($actRequests, $actRequest);
        }
    }
    $stmt1->close();

    return $actRequests;
}

function getActinologyRequestsById(string $requestId): array {
    $root = '../../';

    // DB Connection
    require $root.'php/config.php';

    $actRequest = array();
    
    // 1. Get Actinology Request Info
    $stmt = $conn->prepare
    ( "SELECT * FROM `actinology_requests` WHERE `id` = ?" );
    mysqli_stmt_bind_param($stmt, "s", $requestId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $actRequest = $row;
        }
    }

    // 2. Get Patient Name
    $stmt2 = $conn->prepare
    ( "SELECT `ssn`, `name`, `lastname` FROM `patient` WHERE `ssn` = ?" );
    mysqli_stmt_bind_param($stmt2, "s", $actRequest['patient_ssn']);
    mysqli_stmt_execute($stmt2);
    
    $result = mysqli_stmt_get_result($stmt2);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row2 = mysqli_fetch_assoc($result)) {
            $ssn = $row2['ssn'];
            $name = $row2['name'];
            $lastname = $row2['lastname'];
    
            $patient = $name . ' ' . $lastname . ' ' . '(' . $ssn . ')';
            $actRequest['patient_info'] = $patient;
        }
    }
    $stmt->close();
    $stmt2->close();

    return $actRequest;
} 

function getRadiologistAppointments(string $radiologist): array {
    $root = '../../';

    // DB Connection
    require $root.'php/config.php';

    $actRequests = array();
    $appointments = array();

    // Get Appointments Array
    $query = "SELECT `appointments` FROM `radiologist` WHERE `email` = ?"; 
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $radiologist);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) exit('No rows');
    while ($row = $result->fetch_assoc()) {
        $actRequests = $row;
    }
    $actRequests = json_decode($actRequests['appointments']);
    $stmt->close();

    // Fetch Info For Each Appointment
    foreach ($actRequests as $actRequest) {
        $stmt = $conn->prepare( "SELECT * FROM `appointment` WHERE `id` = ?" );
        $stmt->bind_param("s", $actRequest);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $appointments[] = $row;
            }
        }
        $stmt->close();
    }

    return $appointments;
}