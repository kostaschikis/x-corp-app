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
    
    // print_r($data);
    
    // Decode Appointmetns Array & Push New Appointment
    $radiologistInfo['appointments'] = json_decode($radiologistInfo['appointments']);
    array_push($radiologistInfo['appointments'], $data['appId']);

    storeAppointment($data);
    updateRequestApproval($data['reqId']);
    updateRadiologistAppointments($data['radiologist'] ,$radiologistInfo['appointments']);

}


function storeAppointment(array $data) {
    print_r($data);
    echo "<br>";
}

function updateRadiologistAppointments(string $email,array $appointments) {
    print_r($appointments);
    echo ", ";
    echo $email;
  
}

function updateRequestApproval(string $reqId) {
    echo $reqId;
    echo "<br>";
}

function insertIntoTest(array $testArray) {
    $root = '../../';

    
    // DB Connection
    require $root.'php/config.php';
    
    $testArray = json_encode($testArray);
   
    $error = '';

    $query = "INSERT INTO `test` (testing)
              VALUES (?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        head("./StoreAppointment?dbError=true");
    } else {
        mysqli_stmt_bind_param($stmt, "s", $testArray);
        mysqli_stmt_execute($stmt);
        $error = mysqli_stmt_error($stmt);
    }
    $stmt->close();
    if ($error) echo $error;
}