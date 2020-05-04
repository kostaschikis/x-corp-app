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

function getAllActinologyRequests() {} 

function getRadiologistActinologyRequests() {}