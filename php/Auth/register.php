<?php

// Includes
require '../config.php';

// Get Form Data from POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fistName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $speciality = str_replace(' ', '', $_POST['specialty']);
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];
}

// Validate Form Data
// if ($password != $passwordConfirm) {
//     header("Location: ./register.php?error=passwordnotmatch");
//     exit();
// } else if ($speciality != 'Doctor' || $speciality != 'RadiologyCenterStuff' || $speciality != 'Radiologist') {
//     header("Location: ./register.php?error=wrongspeciality");
//     exit();
// }

register_user($fistName, $lastName, $email, $speciality, $password, $conn);


function register_user($firstName, $lastName, $email, $speciality, $password, $conn) {

    $table = null;

    if ($speciality == 'Doctor') {
        $table = 'doctor';
    } else if ($speciality == 'RadiologyCenterStaff') {
        $table = 'actinology_center';
    } else if ($speciality == 'Radiologist') {
        $table = 'radiologist';
    }
    
    $sqlQuery = "INSERT INTO $table (name, last_name, email, password) VALUES(?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sqlQuery)) {
        head("register.php?error=sqlerror");
    } else {
        // Hash The Password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $email, $hashedPassword);
        mysqli_stmt_execute($stmt);

        $_SESSION['activationLinkSentMessage'] = "<p class='p-3 mb-2 bg-secondary text-white'>An activation link has been sent to your email account. Please check your spam folder as well.</p>";
        header("Location: ../../index.php?regSuccess=true");
    }

    $stmt->close();
}