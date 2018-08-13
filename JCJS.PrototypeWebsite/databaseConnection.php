<?php
    //connect to database
    $servername = $_SERVER['SERVER_NAME'];
    $dbUsername = "rwAccess";
    $dbPassword = "3toPIMuTRZzrO9vb";
    $dbname = "ppb";

    // Create connection
    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

    // Check connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        //die("Connected");
    }
?>