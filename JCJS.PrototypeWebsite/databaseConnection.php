<?php
    //connect to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ppb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>