<?php 
    session_start();

    $root = '../..';
    include $root.'/php/config.php';
    include $root.'/php/functions.php';

    // Get POST Data
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Patient's Info
        $ssn = $_POST['ssn'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $fatherName = $_POST['fatherName'];
        $motherName = $_POST['motherName'];
        $isnId = $_POST['insId'];
        $gender = $_POST['gender'];
        $birthDay = $_POST['birthDay'];
        $homeAddress = $_POST['homeAddress'];
        $homePhone = $_POST['homePhone'];
        $workPhone = $_POST['workPhone'];
        $mobilePhone = $_POST['mobilePhone'];

        // Actinology Request Info
        $nsn = $_POST['nsn'];
        $priority = transformPriority($_POST['priority']); 
        $examId = $_POST['examId'];
        $sendDate = $_POST['sendDate'];
        $examType = $_POST['examType'];
        $sugExamDate = $_POST['sugExamDate'];
        $examDescription = $_POST['examDescription'];

        // Extra
        $doctor = $_SESSION['email'];
        $approval = 0;
    }

    if (patientExist($ssn)) {
        storeActinoRequest($examId, $priority, $sendDate, $examType, $sugExamDate, $examDescription, $ssn, $doctor, $approval);
        header("Location: $root/views/doctor/home.php?actStored=success");
    } else {
        storePatient(
            $ssn, $firstName, $lastName, $fatherName, $motherName, $isnId, 
            $gender, $birthDay, $homeAddress, $homePhone, $workPhone, $mobilePhone
        );
        storeActinoRequest($examId, $priority, $sendDate, $examType, $sugExamDate, $examDescription, $ssn, $doctor, $approval);
        header("Location: $root/views/doctor/home.php?actStored=success");
    };

    function storePatient($ssn, $firstName, $lastName, $fatherName, $motherName, $isnId, $gender, $birthDay, $homeAddress, $homePhone, $workPhone, $mobilePhone) {
        $root = '../../';
        include $root.'php/config.php';

        $error = '';

        $query = "INSERT INTO `patient` (ssn, name, lastname, father_name, mother_name, insurance_id, gender, birth_date, home_address, home_number, work_number, mobile_number)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $query)) {
            head("./StoreActinoRequest?dbError=true");
        } else {
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $ssn, $firstName, $lastName, $fatherName, $motherName, $isnId, $gender, $birthDay, $homeAddress, $homePhone, $workPhone, $mobilePhone);
            mysqli_stmt_execute($stmt);
            $error = mysqli_stmt_error($stmt);
        }
        $stmt->close();
        if ($error) echo $error;
    }

    function storeActinoRequest($examId, $priority, $sendDate, $examType, $sugExamDate, $examDescription, $ssn, $doctor, $approval) {
        $root = '../../';
        include $root.'php/config.php';

        $error = '';

        $query = "INSERT INTO `actinology_requests`(`id`, `priority`, `date_sent`, `examination`, `suggested_date`, `description`, `patient_ssn`, `doctor`, `approval`) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $query)) {
            head("./StoreActinoRequest?dbError=true");
        } else {
            mysqli_stmt_bind_param($stmt, "ssssssssi", $examId, $priority, $sendDate, $examType, $sugExamDate, $examDescription, $ssn, $doctor, $approval);
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
        
        return (mysqli_num_rows($result) > 0 ? true : false);  
    }