<?php

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "actinology_app";
    
    // Connect
    $conn = new mysqli($hostname , $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>