<?php

$root = '../../';

// DB Connection
require $root.'php/config.php';
require $root.'php/app/PatientInfo.php';

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

$actRequestsFinal = array();

// For Each Actinology Request Get Completion Status
foreach ($actRequests as $actRequest) {
    $stmt = $conn->prepare("SELECT `completed` FROM `appointment` WHERE `request_id` = ?");
    $stmt->bind_param("s", $actRequest["id"]);
    $stmt->execute();        
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $actRequest['completed'] = $row['completed'];
        }
    } else {
        $actRequest['completed'] = 0;
    }
    $stmt->close();        

    // Get Patient Info
    $actRequest['patient_info'] = getFormatedPatientInfo($actRequest['patient_ssn']);
    array_push($actRequestsFinal, $actRequest);
}

header('Content-Type: application/json');
echo json_encode($actRequestsFinal);