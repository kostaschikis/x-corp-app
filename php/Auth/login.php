<?php 

// Includes
require '../config.php';

// Get Form Data from POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $speciality = str_replace(' ', '', $_POST['specialty']);
}

// Finc The Right Table for the query
$table = null;
if ($speciality == 'Doctor') {
    $table = 'doctor';
} else if ($speciality == 'RadiologyCenterStaff') {
    $table = 'actinology_center';
} else if ($speciality == 'Radiologist') {
    $table = 'radiologist';
}

login_user($email, $password, $table, $conn);


function login_user($email, $password, $table, $conn) {
    // Check if that username exist in DB 
    $sql = "SELECT * FROM $table WHERE email=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../../index.php?error=sqlerror");
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
                // header("Location: ../../index.html?login=success");
                exit();
            
            } else {
                header("Location: ../../index.php?error=wrongpass");
                exit();
            }
        } else {
            header("Location: ../../index.php?error=nouser");
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