<?php 


$root = '../../'; 

// DB Connection
require $root.'php/config.php';

$appointment = [
    'id' => '',
    'start_date' => '',
    'end_date' => '',
    'text' => '',
    'completion'
];

$appointments = array();

// Get Actinology Request Info
$stmt = $conn->prepare
( 
    "SELECT * FROM `appointment`" 
);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $appointment['id'] = $row['id'];
        $appointment['start_date'] = $row['exam_date'];
        $appointment['end_date'] = $row['exam_date'];

        // Construct Test Field
        $patient = $row['patient_ssn'];
        $radiologist = $row['radiologist'];
        $priority = $row['priority'];
        $appointment['type'] = ($row['completed'] == 0) ? 'waiting' : 'completed';

        $appointment['text'] = "Patient SSN: " . $patient . ', ' . "Radiologist: " . $radiologist . ", " . "Priority: " . $priority . ", " . "Completion: " . $appointment['type'];
        array_push($appointments, $appointment);
    }
}
$stmt->close();

header('Content-Type: application/json');
echo json_encode($appointments);