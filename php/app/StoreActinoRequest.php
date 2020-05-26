<?php 
    session_start();

    $root = '../..';
    include $root.'/php/config.php';
    include $root.'/php/functions.php';

    $patient = array();
    $request = array();

    // Get POST Data
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Patient's Info 
        $patient['ssn'] = $request['ssn'] = $_POST['ssn'];
        $patient['firstName'] = $_POST['firstName'];
        $patient['lastName'] = $_POST['lastName'];
        $patient['fatherName'] = $_POST['fatherName'];
        $patient['motherName'] = $_POST['motherName'];
        $patient['isnId'] = $_POST['insId'];
        $patient['gender'] = $_POST['gender'];
        $patient['birthDay'] = $_POST['birthDay'];
        $patient['homeAddress'] = $_POST['homeAddress'];
        $patient['homePhone'] = $_POST['homePhone'];
        $patient['workPhone'] = $_POST['workPhone'];
        $patient['mobilePhone'] = $_POST['mobilePhone'];

        // Actinology Request Info
        $request['priority'] = transformPriority($_POST['priority']); 
        $request['examId'] = $_POST['examId'];
        $request['sendDate'] = $_POST['sendDate'];
        $request['examType'] = $_POST['examType'];
        $request['sugExamDate'] = $_POST['sugExamDate'];
        $request['examDescription'] = $_POST['examDescription'];

        // Extra
        $request['doctor'] = $_SESSION['email'];
        $request['approval'] = 0;
    
        // Store Actinolgy Request Simple Algorithm
        if (patientExist($patient['ssn'])) {
            storeActinoRequest($request);
            header("Location: $root/views/doctor/home.php?actStored=success");
        } else {
            storePatient($patient);
            storeActinoRequest($request); 
            header("Location: $root/views/doctor/home.php?actStored=success");
        }
    }

    function storePatient(array $info) {
        $root = '../../';
        include $root.'php/config.php';

        $error = '';

        $query = "INSERT INTO `patient` (ssn, name, lastname, father_name, mother_name, insurance_id, gender, birth_date, home_address, home_number, work_number, mobile_number)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $query)) {
            head("./StoreActinoRequest?dbError=true");
        } else {
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $info['ssn'], $info['firstName'], $info['lastName'], $info['fatherName'], $info['motherName'], $info['isnId'], $info['gender'], $info['birthDay'], $info['homeAddress'], $info['homePhone'], $info['workPhone'], $info['mobilePhone']);
            mysqli_stmt_execute($stmt);
            $error = mysqli_stmt_error($stmt);
        }
        $stmt->close();
        if ($error) echo $error;
    }

    function storeActinoRequest(array $info) {
        $root = '../../';
        include $root.'php/config.php';

        $error = '';

        $query = "INSERT INTO `actinology_requests`(`id`, `priority`, `date_sent`, `examination`, `suggested_date`, `description`, `patient_ssn`, `doctor`, `approval`) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $query)) {
            head("./StoreActinoRequest?dbError=true");
        } else {
            mysqli_stmt_bind_param($stmt, "ssssssssi", $info['examId'], $info['priority'], $info['sendDate'], $info['examType'], $info['sugExamDate'], $info['examDescription'], $info['ssn'], $info['doctor'], $info['approval']);
            mysqli_stmt_execute($stmt);
            $error = mysqli_stmt_error($stmt);
        }
        $stmt->close();
        if ($error) echo $error;
    }

    function patientExist(string $ssn): bool {
        $root = '../../';
        include $root.'php/config.php';

        $stmt = $conn->prepare( "SELECT `name` FROM `patient` WHERE `ssn` = $ssn" );
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $stmt->close();

        return (mysqli_num_rows($result) > 0 ? true : false);  
    }