<?php include 'databaseConnection.php';?>
<?php
    $eventID = mysqli_real_escape_string($conn,$_GET["EventID"]);
    if($eventID == "") $eventID = 0;
    $eventDate = mysqli_real_escape_string($conn,$_POST["eventDate"]);
    $eventName = mysqli_real_escape_string($conn,$_POST["eventName"]);
    $eventLocation = mysqli_real_escape_string($conn,$_POST["eventLocation"]);
    $guestAccessCode = mysqli_real_escape_string($conn,$_POST["guestAccessCode"]);
    $hostAccessCode = mysqli_real_escape_string($conn,$_POST["hostAccessCode"]);

    if($eventID > 0) {
        $sql = "UPDATE Events SET eventDate = '$eventDate',eventName = '$eventName',eventLocation = '$eventLocation',guestAccessCode = '$guestAccessCode',hostAccessCode = '$hostAccessCode' WHERE eventID = $eventID;";
        echo $sql;
        $result = $conn->query($sql);      
    } else {
        $sql = "INSERT INTO Events (eventDate,eventName,eventLocation,guestAccessCode,hostAccessCode) VALUES ('$eventDate','$eventName','$eventLocation','$guestAccessCode','$hostAccessCode');";
        echo $sql;
        $result = $conn->query($sql);            
    }
    $conn->close();  
    header("Location: admin_event_details.php");
?>