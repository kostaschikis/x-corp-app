<?php 

// Includes
require '../config.php';

// Get Form Data from POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $speciality = str_replace(' ', '', $_POST['specialty']);
}

// Find The Right Table for the query
$table = find_table($speciality);

login_user($email, $password, $table, $conn);

/**
 * function login_user 
 * function redirectUser 
 * function find_table 
 */
function login_user($email, $password, $table, $conn) {

    $root = '../..';
    // Check if that username exist in DB 
    $sql = "SELECT * FROM $table WHERE email=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: $root/index.php?error=sqlerror");
    } else {
        // Get the row that contain the user's info
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        // Store row's data
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) { 

            // Verify the password
            $hash = $row['password'];
            if (password_verify($password, $hash)) {

                /** Start a session and store some data about the user
                 * @param name 
                 * @param logstatus
                 */
                session_start();
                $_SESSION["name"] = $row['name'];
                $_SESSION["logStatus"] = true;
                redirectUser($table);
                // header("Location: ../../index.php?login=success");
                exit();
            
            } else {
                header("Location: $root/index.php?error=wrongpass");
                exit();
            }
        } else {
            header("Location: $root/index.php?error=nouser");
            exit();
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn); 
}

function redirectUser($speciality) {
    $root = '../..';
    
    if ($speciality == 'doctor') {
        header("Location: $root/views/doctor/");
    } else if ($speciality == 'actinology_center') {
        header("Location: $root/views/actinology_center/");
    } else if ($speciality == 'radiologist') {
        header("Location: $root/views/radiologist/");
    }
}

function find_table($speciality) {
    if ($speciality == 'Doctor') {
        return 'doctor';
    } else if ($speciality == 'RadiologyCenterStaff') {
        return 'actinology_center';
    } else if ($speciality == 'Radiologist') {
        return 'radiologist';
    }
}