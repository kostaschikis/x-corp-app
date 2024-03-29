<?php 

function getAvailableRadiologists(): array {
 
    $radiologists = getAllRadiologistAndExamNum();
    // print_r($radiologists);
 
    $max = findMax($radiologists);
    $availableRadiologists = array();

    if (radiologistsHaveEqualExamNum($max, $radiologists)) {
        $availableRadiologists = getAllRadiologists($radiologists);
    } else {
        $availableRadiologists = getRightRadiologists($max, $radiologists);
    };

    return $availableRadiologists;
}

function getAllRadiologistAndExamNum(): array {
    $root = '../../';

    // DB Connection
    require $root.'php/config.php';

    $radiologists = array();

    $stmt = $conn->prepare
    ( 
        "SELECT `name`, `last_name`, `email`, `appointments` 
         FROM `radiologist`"
    );
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            
            $radiologist = array();
            $radiologist['name'] = $row['name'];   
            $radiologist['last_name'] = $row['last_name'];
            $radiologist['email'] = $row['email'];
            $radiologist['appointments'] = $row['appointments'];
            $appsNum = ($radiologist['appointments'] == null ? 0 : count(json_decode($row['appointments'])));
            $radiologist['apps_number'] = $appsNum;
            array_push($radiologists, $radiologist);
        }
    }
    $stmt->close();

    return $radiologists;
}

function getRightRadiologists(int $max, array $radiologists): array {
    $radiologistsFinal = array();

    foreach($radiologists as $radiologist) {
        if ($radiologist['apps_number'] < $max) {

            $name = $radiologist['name'];
            $lastName = $radiologist['last_name'];
            $email = $radiologist['email'];
            $appsNumber = $radiologist['apps_number'];

            $radiologist = $name . ' ' . $lastName . ' ' . '(' . $email . ')' . ' - ' . 'Exam(s) to do: ' . $appsNumber;
            array_push($radiologistsFinal, $radiologist); 
        }   
    }
    return $radiologistsFinal;
}

function getRadiologistById(string $email): array {
    $root = '../../';

    // DB Connection
    require $root.'php/config.php';

    $radiologist = array();

    $stmt = $conn->prepare
    ( 
        "SELECT `name`, `last_name`, `appointments` 
         FROM `radiologist`
         WHERE `email` = ?"
    );
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            
            $radiologist['name'] = $row['name'];   
            $radiologist['last_name'] = $row['last_name'];
            $radiologist['appointments'] = $row['appointments'];
        }
    }
    $stmt->close();
    
    return $radiologist;
}

function getAllRadiologists(array $radiologists): array {
    $radiologistsFinal = array();

    foreach($radiologists as $radiologist) {
        
        $name = $radiologist['name'];
        $lastName = $radiologist['last_name'];
        $email = $radiologist['email'];
        $appsNumber = $radiologist['apps_number'];

        $radiologist = $name . ' ' . $lastName . ' ' . '(' . $email . ')' . ' - ' . 'Exam(s) to do: ' . $appsNumber;
        array_push($radiologistsFinal, $radiologist); 
    }   
    return $radiologistsFinal;
}

function radiologistsHaveEqualExamNum(int $max, array $radiologists): bool {
    foreach ($radiologists as $key=>$value) {
        if ($value['apps_number'] != $max) {
            return false;
        } 
    }
    return true;
}

function findMax(array $radiologists): int {
    $max = 0;
    foreach ($radiologists as $radiologist) {
        if ($radiologist['apps_number'] > $max) $max = $radiologist['apps_number'];
    }
    return $max;
}