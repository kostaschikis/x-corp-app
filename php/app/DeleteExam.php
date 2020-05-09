<?php 
session_start(); 
$root = '../../';

// Includes
include $root.'php/functions.php';

// Protect The Route
if (!is_user_logged_in()) {
  header("Location:" . $root);  
  exit();
}

class DeleteExam {
    static $root = '../../';

    public static function getAppointments(string $radiologist):array {
        // DB Connection
        require self::$root.'php/config.php';
        $appointments = array();

        // Get Appointments Array
        $query = "SELECT `appointments` FROM `radiologist` WHERE `email` = ?"; 
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $radiologist);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) exit('No rows');
        while ($row = $result->fetch_assoc()) {
            $appointments = $row;
        }
        $appointments = json_decode($appointments['appointments']);
        $stmt->close();

        return $appointments;
    }

    public static function updateAppointments(string $radiologist, array $appointments) {
       
        // DB Connection
        require self::$root.'php/config.php';

        $query = 'UPDATE `radiologist` SET `appointments` = ? WHERE `email` = ?'; 
        $stmt = mysqli_stmt_init($conn);
    
        if (!mysqli_stmt_prepare($stmt, $query)) {
            head("./DeleteExam.php?dbError=true");
        } else {
            $stmt->bind_param("ss", json_encode($appointments), $radiologist);
            $stmt->execute();
            if ($stmt->error) echo $stmt->error;
        }
        $stmt->close();
    }

    public static function centerDeleteExam(string $requestId) {
        // DB Connection
        require self::$root.'php/config.php';

        $query = 'DELETE FROM `actinology_requests` WHERE `id` = ?'; 
        $stmt = mysqli_stmt_init($conn);
    
        if (!mysqli_stmt_prepare($stmt, $query)) {
            head("./DeleteExam.php?dbError=true");
        } else {
            $stmt->bind_param("s", $requestId);
            $stmt->execute();
            if ($stmt->error) echo $stmt->error;
        }
        $stmt->close();
    }
}

// Radiologist Complete Exam Request
if ( (isset($_GET['appId'])) && ($_SESSION['speciality'] == 'radiologist') ) {
    deleteRadiologistAppointment($_GET['appId'], $_SESSION['email']);
}

// Actinology Center Delete Exam Request
if ( (isset($_GET['reqId'])) && ($_SESSION['speciality'] == 'actinology_center') ) {
    deleteActinologyRequest($_GET['reqId']);
}

// Remove appointment from radiologist's appointments array
function deleteRadiologistAppointment(string $appId, string $radiologist) {
    $altroot = '../..';

    // 1. Get Appointments Array
    $appointments = DeleteExam::getAppointments($radiologist);
    
    // 2. Remove Specified Appointment (appId) from Appointments Array
    if (($key = array_search($appId, $appointments)) !== false) unset($appointments[$key]);

    // 3. Update Comlumn
    DeleteExam::updateAppointments($radiologist, $appointments);

    header("Location: $altroot/views/radiologist/home.php?deleteApp=success");
}

function deleteActinologyRequest(string $reqId) {
    $altroot = '../..';
    
    DeleteExam::centerDeleteExam($reqId);
    header("Location: $altroot/views/actinology_center/home.php?deleteReq=success");
}