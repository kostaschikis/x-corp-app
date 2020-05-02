<?php 

    $root = '../../';
    include $root.'php/functions.php';

    // Get POST Data
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Patient's Info
        $ssn = $_POST['ssn'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $fatherName = $_POST['fatherName'];
        $motherName = $_POST['motherName'];
        $zipCode = $_POST['zipCode'];
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
    }

    // echo $nsn . ' ' . $priority . ' ' . $examId . ' ' . $sendDate . ' ' . $sugExamDate . ' ' . $ssn; 


