<?php 
session_start(); 
$root = '../..';

// Includes
include $root.'php/functions.php';

// Protect The Route
if (!is_user_logged_in()) {
  header("Location:" . $root);  
  exit();
}

trait FinishExam {

    private static function setExamCompletion(string $appId) {
        
        $root = '../../';
        include $root.'php/config.php';

        $query = 'UPDATE `appointment` SET `completed` = 1 WHERE `id` = ?';
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            head("./StoreAppointment.php?dbReqError=true");
        } else {
            mysqli_stmt_bind_param($stmt, "s", $appId);
            $stmt->execute();
            if ($stmt->error) echo $stmt->error;
        }
        $stmt->close();
    }
}

FinishExam::setExamCompletion($_GET['appId']);
header("Location: $root/views/radiologist/success.php");