<?php 

function getAppointmentInfo(string $appId, string $reqId): array {
    $root = '../../'; 

    // DB Connection
    require $root.'php/config.php';
    
    $appointment = [
        'examId' => '',
        'examType' => '',
        'description' => '',
        'comments' => '',
        'priority' => ''
    ];

    // Get Actinology Request Info
    $stmt = $conn->prepare
    ( 
      "SELECT * FROM `appointment`, `actinology_requests` 
       WHERE appointment.id = ? AND actinology_requests.id = ?" 
    );
    mysqli_stmt_bind_param($stmt, "ss", $appId, $reqId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $appointment['examId'] = $row['id'];
            $appointment['examType'] = $row['examination'];
            $appointment['description'] = $row['description'];
            $appointment['priority'] = $row['priority'];
            $appointment['comments'] = $row['comments'];
        }
    }
    $stmt->close();

    return $appointment;
}
