<?php
    $connection = null;

    function get_all_events($conn, $sqlQuery) {
		$events = array();

        if(!isset($sqlQuery)) {
            $sqlQuery = "SELECT `id`, `image`, `name`, `location`, `type`, `category`, `start_date`, `end_date`, `start_time`, `description`, `tickets`
                        FROM `events` LIMIT 8";
        }

		$result = mysqli_query($conn, $sqlQuery, $resultmode = MYSQLI_STORE_RESULT);

		if(mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$events[] = $row;
			}
		}

		return $events;	
	}

    function get_events_by_name($search_q, $conn) {
        $events = array();
        
        $param = "%$search_q%";

        $stmt = $conn->prepare
        (
            "SELECT `id`, `image`, `name`, `location`, `type`, `category`, `start_date`, `end_date`, `start_time`, `description`, `tickets`
            FROM `events`
            WHERE `name` LIKE ?"
        );
        mysqli_stmt_bind_param($stmt, "s", $param);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $events[] = $row;
            }
        }

        return $events;
    }

    function get_org_name_by_org_id($conn, $id) {
        $stmt = $conn->prepare
        (
            "SELECT `name` FROM `accounts` WHERE `id`=?"
        );

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $user_name = '';

        if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $user_name = $row['name'];
            }
        }

        $stmt->close();

        return $user_name;
    }

    function get_event_name_by_event_id($conn, $id) {
        $stmt = $conn->prepare
        (
            "SELECT `name` FROM `events` WHERE `id`=?"
        );

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $event_name = '';

        if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $event_name = $row['name'];
            }
        }

        $stmt->close();

        return $event_name;
    }

    function get_org_by_event_id($conn, $id) {
        $stmt = $conn->prepare
        (
            "SELECT `org_name` FROM `org_events` WHERE `event`=(SELECT `name` FROM `events` WHERE `id`=?)"
        );

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $event_creator = '';

        if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $event_creator = $row['org_name'];
            }
        }

        $stmt->close();

        return $event_creator;
    }

    function generate_unique_id() {
        list($usec, $sec) = explode(' ', microtime());
        $val = $sec + $usec * 1000000;

        srand($val);
        $randval = rand(100000000, 1000000000 -1);

        return $randval;
    }

    function insert_event($id, $imagePublicId, $event_name, $location, $type, $category, $start_date, $end_date, $start_time, $end_time, $description, $tickets) {
        $connection = start_connection_db();

        $query = "INSERT INTO `events` (id, image, name, location, type, category, start_date, end_date, start_time, end_time, description, tickets)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($connection);

        if (!mysqli_stmt_prepare($stmt, $query)) {
            head("create-event.php?error=sqlerror");
        } else {
            mysqli_stmt_bind_param($stmt, "isssssssssss", $id, $imagePublicId, $event_name, $location, $type, $category, $start_date, $end_date, $start_time, $end_time, $description, $tickets);
            mysqli_stmt_execute($stmt);

            $user_name = get_user_name();
            head("my-events.php");
        }

        $stmt->close();
        exit();
    }

    function insert_bug_report($user, $email, $subject, $message, $date) {
        $connection = start_connection_db();

        $sqlQuery = "INSERT INTO bug_reports(`user`, `email`, `subject`, `message`, `date`) VALUES(?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($connection);

        if (!mysqli_stmt_prepare($stmt, $sqlQuery)) {
            $_SESSION['reportBugMessage'] = "<p class='p-3 mb-2 bg-danger text-white'>Sorry. An error occured while submitting your report!</p>";
            head("bug-report.php?error=sqlerror");
        } else {
            $date = date('Y-m-d H:i:s');

            mysqli_stmt_bind_param($stmt, "sssss", $user, $email, $subject, $message, $date);
            mysqli_stmt_execute($stmt);

            $_SESSION['reportBugMessage'] = "<p class='p-3 mb-2 bg-success text-white'>Thank you for submitting the report! We will check it as soon as possible.</p>";
        }

        $stmt->close();
    }

    function register_user($id, $name, $email, $password, $logo, $about, $category, $validation_code, $active) {
        $connection = start_connection_db();

        $sqlQuery = "INSERT INTO accounts(id, name, email, password, logo, about, category, validation_code, active) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($connection);

        if (!mysqli_stmt_prepare($stmt, $sqlQuery)) {
            head("register.php?error=sqlerror");
        } else {
            // Hash The Password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($stmt, "issssssss", $id, $name, $email, $hashedPassword, $logo, $about, $category, $validation_code, $active);
            mysqli_stmt_execute($stmt);

            $_SESSION['activationLinkSentMessage'] = "<p class='p-3 mb-2 bg-secondary text-white'>An activation link has been sent to your email account. Please check your spam folder as well.</p>";
        }

        $stmt->close();
    }

    function register_user_info($name) {
        $connection = start_connection_db();

        $query = "INSERT INTO contact_info(org_name) VALUES (?)";
        $stmt = mysqli_stmt_init($connection);

        if (!mysqli_stmt_prepare($stmt, $query)) {
            head("register.php?error=sqlerror");
        } else {
            mysqli_stmt_bind_param($stmt, "s", $name);
            mysqli_stmt_execute($stmt);
        }

        $stmt->close();
        head("../index.php");
    }

    function is_valid_password($password, $upperCaseCheck, $lowerCaseCheck, $numbersCheck, $specialCharsAllowed, $specialCharsNotAllowed, $whitespaceCheck) {
        if (strlen($password) < 8 || strlen($password) > 12) {
            return false;
        }

        return $upperCaseCheck && $lowerCaseCheck && $numbersCheck && $specialCharsAllowed && !$specialCharsNotAllowed && !$whitespaceCheck;
    }

    function insert_validation_code_into_db($email, $code) {
        $connection = start_connection_db();

        $query = "UPDATE `accounts` SET `validation_code`=? WHERE `email`=?";
        $stmt = mysqli_stmt_init($connection);

        if (!mysqli_stmt_prepare($stmt, $query)) {
            head("recoverPassword.php?error=sqlerror");
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $code, $email);
            mysqli_stmt_execute($stmt);
            $stmt->close();
        }

    }

    function delete_event($event_name) {
        $conn = start_connection_db();
        
        # 1. Delete Image From the Cloud

        // Find image's public id
        $stmt = $conn->prepare
        (
            "SELECT `image` FROM `events` WHERE `name` = ?"
        );

        mysqli_stmt_bind_param($stmt, 's', $event_name);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                $public_id = $data["image"];
            }
        }

        # 2. Delete Record From Table -> 'events'
        $query = "DELETE FROM `events` WHERE `name`=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $query)) {
            head("my-events.php?error=sqlerror");
        } else {
            mysqli_stmt_bind_param($stmt, "s", $event_name);
            mysqli_stmt_execute($stmt);
            
            // record deleted successfully
            head("my-events.php");
        }
        
        exit();
    }

    function edit_event($imagePublicId, $new_event_name, $location, $type, $category, $start_date, $end_date, $start_time, $end_time, $description, $tickets, $event_name) {
        $conn = start_connection_db();
        
        $query = "UPDATE `events`
                SET `image`=?,`name`=?,`location`=?,`type`=?,`category`=?,`start_date`=?,`end_date`=?,`start_time`=?,`end_time`=?,`description`=?,`tickets`=?
                WHERE `name`=?";
        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt, $query)) {
            head("edit-event.php?event=" . $event_name . "&error=sqlerror");
        } else {
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $imagePublicId, $new_event_name, $location, $type, $category, $start_date, $end_date, $start_time, $end_time, $description, $tickets, $event_name);
            mysqli_stmt_execute($stmt);

            head("my-events.php");
        }

        $stmt->close();
        exit();
    }

    function get_organizer_info_by_event_name($event_name, $conn) {
        $stmt = $conn->prepare
        (
            "SELECT `accounts`.`id`, `accounts`.`logo` , `accounts`.`name`
            FROM `accounts` , `org_events` , `events`
            WHERE `events`.`name` = `org_events`.`event`
            AND `accounts`.`name` = `org_events`.`org_name`
            AND `org_events`.`event` = ?"
        );
        mysqli_stmt_bind_param($stmt, 's', $event_name);
        mysqli_stmt_execute($stmt);

        $info = array();

        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                $info['id'] = $data['id'];
                $info['name'] = $data['name'];
                $info['logo'] = $data['logo'];
            }
        }

        return $info;
    }

    function validate_user_code($code, $email) {
        $conn = start_connection_db();

        $stmt = $conn->prepare
        (
            "SELECT `name` FROM `accounts` WHERE `validation_code`=? AND `email`=?"
        );
        mysqli_stmt_bind_param($stmt, "ss", $code, $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                $name = $data['name'];
            }
            return $name;
        } else {
            echo "Wrong Validation Code";
        }
    }

    function generate_token() {
        $token = $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        return $token;
    }

    function email_exists($email) {
        $connection = start_connection_db();

        $query = "SELECT `name` FROM `accounts` WHERE `email` = ?";
        $stmt = mysqli_stmt_init($connection);

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            
            $result = mysqli_stmt_get_result($stmt);
            $rows = mysqli_num_rows($result);
        }
        
        $stmt->close();

        return ($rows == 1) ? true : false;
    }

    function get_user_name() {
        if (isset($_SESSION['name'])) {
            return $_SESSION['name'];
        } else if (isset($_COOKIE['user'])) {
            return $_COOKIE['user'];
        }

        return null;
    }

    function login_user($name, $remember) {
        // if 'remember me' is checked

        if ($remember == "on") {
            include_once 'global-data.php';

            $EXPIRATION_DATE = time() + $EXPIRE_AFTER;
            // set cookie to remember user everytime he logs in
            setcookie('user', $name, $EXPIRATION_DATE, '/');
        }

        // start a session and store some data about the user
        session_start();
        $_SESSION['name'] = $name;
        
        head("../index.php");
        exit();
    }

    function is_user_logged_in() {
        return isset($_SESSION['name']) || isset($_COOKIE['user']);
    }

    function user_exists($email) {
        $connection = start_connection_db();

        // check if email exists in the database
        $query = "SELECT * FROM `accounts` WHERE `email`=?";
        $stmt = mysqli_stmt_init($connection);

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $rows = mysqli_num_rows($result);
        }

        $stmt->close();

        // if user exists return its info, else null.
        if ($rows == 1) {
            return mysqli_fetch_assoc($result);
        } else {
            return null;
        }
    }

    function username_already_exists($username) {
        $connection = start_connection_db();

        // check if email exists in the database
        $query = "SELECT * FROM `accounts` WHERE `name`=?";
        $stmt = mysqli_stmt_init($connection);

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $rows = mysqli_num_rows($result);
        }

        $stmt->close();

        // if user exists return its info, else null.
        return ($rows == 1) ? true : false;
    }

    function email_already_exists($email) {
        $connection = start_connection_db();

        // check if email exists in the database
        $query = "SELECT * FROM `accounts` WHERE `email`=?";
        $stmt = mysqli_stmt_init($connection);

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $rows = mysqli_num_rows($result);
        }

        $stmt->close();

        // if user exists return its info, else null.
        return ($rows == 1) ? true : false;
    }

    function head($location) {
        header("Location: " . $location);
    }

    function is_valid_email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    

    /*          CONNECTION DB FUNCTIONS          */
    function start_connection_db() {
        include 'config.php';
       
       return $conn;
    }

    function close_connection_db($connection) {
        mysqli_close($connection);
    }
?>