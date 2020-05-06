<?php

$root = '../../';

include $root.'php/app/FetchRadiologists.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get Form Information
    $appId = $_POST['appointmentId'];

    // Get Radiologist Info
    $radiologist = $_POST['available-radiologist'];
    preg_match('#\((.*?)\)#', $radiologist, $match);
    $email = $match[1];
    $radiologistInfo = getRadiologistById($email);

    // Decode Appointmetns Array & Push New Appointment
    $radiologistInfo['appointments'] = json_decode($radiologistInfo['appointments']);
    array_push($radiologistInfo['appointments'], $appId);

    insertIntoTest($radiologistInfo['appointments']);

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