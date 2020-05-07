<?php 

function getAppointmentInfo(string $appId): array {
    $root = '../../'; 

    // DB Connection
    require $root.'php/config.php';
    
    $appointment = [
        'examId' => '',
        'examType' => '',
        'Description' => '' 
    ];

    print_r($patientInfo);

    return $appointment;
}
