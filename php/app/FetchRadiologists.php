<?php 

function getAvailableRadiologists() {
    $root = '../../';

    // DB Connection
    require $root.'php/config.php';
    
    $radiologists = getRadiologistAndExamNum();

    $max = $radiologists[0]['totalcount'];

    if (equalExamNum($max, $radiologists)) {
        $radiologists = getAllRadiologists();
    } else {
        $radiologists = getAvailablelRadiologists($max, $radiologists);
    };

    return $radiologists;
}

function getRadiologistAndExamNum() {
    $root = '../../';

    // DB Connection
    require $root.'php/config.php';

    $stmt = $conn->prepare
    ( 
        "SELECT `radiologist`, count(radiologist) as totalcount 
         FROM `appointment`
         GROUP BY `radiologist` 
         ORDER BY `totalcount` DESC" 
    );
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $radiologists[] = $row;
        }
    }
    
    return $radiologists;
}

function getAllRadiologists() {
    $root = '../../';

    // DB Connection
    require $root.'php/config.php';

    $radiologists = array();

    $stmt = $conn->prepare
    ( 
        "SELECT `name`, `last_name`, `email` 
         FROM `radiologist`"
    );
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['name'];
            $lastName = $row['last_name'];
            $email = $row['email'];

            $radiologist = $name . ' ' . $lastName . ' ' . '(' . $email . ')';
            array_push($radiologists, $radiologist); 
        }
    }
    
    return $radiologists;
} 

function getAvailablelRadiologists($max, $radiologists) {
    $root = '../../';

    // DB Connection
    require $root.'php/config.php';

    $radiologistsFinal = array();

    foreach($radiologists as $radiologist) {
        if ($radiologist['totalcount'] < $max) {
            $stmt = $conn->prepare
            ( 
                "SELECT `name`, `last_name`
                 FROM `radiologist` WHERE `email` = ?"
            );
            mysqli_stmt_bind_param($stmt, "s", $radiologist['radiologist']);
            mysqli_stmt_execute($stmt);
    
            $result = mysqli_stmt_get_result($stmt);
        
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $name = $row['name'];
                    $lastName = $row['last_name'];
                    $email = $radiologist['radiologist'];
                    $appoints = $radiologist['totalcount'];
        
                    $radiologist = $name . ' ' . $lastName . ' ' . '(' . $email . ')' . ' ' . $appoints . ' - ' . 'Exam(s) to do';
                    array_push($radiologistsFinal, $radiologist); 
                }
            }
        }
    }

    return $radiologistsFinal;
}

function equalExamNum($max, $radiologists) {
    foreach ($radiologists as $key=>$value) {
        if ($value['totalcount'] != $max) {
            return false;
        } 
    }
    return true;
}