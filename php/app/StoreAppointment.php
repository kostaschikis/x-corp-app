<?php

$root = '../../';

include $root.'php/app/FetchRadiologists.php';
include $root.'php/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get Form Information
    $data = [
        'appId' => $_POST['appointmentId'],
        'reqId' => $_GET['reqId'],
        'priority' => $_GET['priority'],
        'examDate' => $_POST['examDate'],
        'radiologist' => '',
        'ssn' => $_GET['ssn'],
        'comments' => $_POST['comments']
    ];

    
    // Get Radiologist Info
    $radiologist = $_POST['available-radiologist'];
    preg_match('#\((.*?)\)#', $radiologist, $match);
    $data['radiologist'] = $match[1];
    
    $radiologistInfo = getRadiologistById($data['radiologist']);
      
    // Decode Appointments Array & Push New Appointment
    $radiologistInfo['appointments'] = json_decode($radiologistInfo['appointments']);
    if ($radiologistInfo['appointments'] == null) {
        $appId = $data['appId'];
        $radiologistInfo['appointments'] = ["$appId"];
    } else {
        array_push($radiologistInfo['appointments'], $data['appId']);
    }

    // print_r($radiologistInfo['appointments']);

    storeAppointment($data);
    updateRequestApproval($data['reqId']);
    updateRadiologistAppointments($data['radiologist'], $radiologistInfo['appointments']);

    header("Location: $root/views/actinology_center/home.php?appStored=success");
}


function storeAppointment(array $data): bool {
    $root = '../../';
    include $root.'/php/config.php';

    $error = '';

    $query = "INSERT INTO `appointment` (id, request_id, priority, exam_date, radiologist, patient_ssn, comments)
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        head("./StoreActinoRequest?dbError=true");
    } else {
        mysqli_stmt_bind_param($stmt, "sssssss", $data['appId'], $data['reqId'], $data['priority'], $data['examDate'], $data['radiologist'], $data['ssn'], $data['comments']);
        mysqli_stmt_execute($stmt);
        $error = mysqli_stmt_error($stmt);
    }
    $stmt->close();

    if ($error) {
        echo $error;   
    } else {
        return true;
    } 

}

function updateRadiologistAppointments(string $email, array $appointments): bool {
    $root = '../../';
    include $root.'/php/config.php';

    $appointments = json_encode($appointments);

    $query = 'UPDATE `radiologist` SET `appointments` = ? WHERE `email` = ?'; 

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        head("./StoreAppointment.php?dbError=true");
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $appointments, $email);
        mysqli_stmt_execute($stmt);
        $error = mysqli_stmt_error($stmt);
    }
    $stmt->close();

    if ($error) {
        echo $error;
    } else {
        return true;
    }
}

function updateRequestApproval(string $reqId): bool {
    $root = '../../';
    include $root.'/php/config.php';

    $query = 'UPDATE `actinology_requests` SET `approval` = 1 WHERE `id` = ?';
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        head("./StoreAppointment.php?dbReqError=true");
    } else {
        mysqli_stmt_bind_param($stmt, "s", $reqId);
        mysqli_stmt_execute($stmt);
        $error = mysqli_stmt_error($stmt);
    }
    $stmt->close();
    
    if ($error) {
        echo $error;
    } else {
        return true;
    }
}