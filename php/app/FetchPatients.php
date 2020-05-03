<?php
$root = '../../'; 

// DB Connection
require $root.'php/config.php';

$patients = array();

$stmt = $conn->prepare
(
    "SELECT `ssn`, `name`, `lastname` FROM `patient`"
);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $ssn = $row['ssn'];
        $name = $row['name'];
        $lastname = $row['lastname'];

        $patient = $name . ' ' . $lastname . ' ' . '(' . $ssn . ')';
        array_push($patients, $patient);
    }
}

// Transform '$patient' array to json and send it
header('Content-Type: application/json');
echo json_encode($patients);
