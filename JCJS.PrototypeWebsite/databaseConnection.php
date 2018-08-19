<?php
    //connect to database
    $servername = $_SERVER['SERVER_NAME'];
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "ppb";
    //echo $servername."<br>".$dbUsername."<br>".$dbPassword."<br>".$dbname;

    // Create connection
    $conn = new mysqli($servername, $dbUsername, $dbPassword,$dbname);

    // Check connection was successful
    if ($conn->connect_error) {        
        die("*** Connection failed: " . $conn->connect_error);
    } else {
        //die("*** Connected");
    }
?>