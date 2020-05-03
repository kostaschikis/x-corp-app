<?php


function getPatientInfo($ssn) {
    $root = '../../';

    // DB Connection
    require $root.'php/config.php';

    $patientInfo = array();
 
    $stmt = $conn->prepare
    (
        "SELECT * FROM `patient` WHERE `ssn` = ?"
    );
    mysqli_stmt_bind_param($stmt, "s", $ssn);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $patientInfo = $row;
        }
    }

    return $patientInfo;
}