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
        //Check for duplicate before update
        $sql = "SELECT eventName FROM Events WHERE NOT eventID = $eventID AND (guestAccessCode = '$guestAccessCode' OR hostAccessCode = '$hostAccessCode');";
        //echo $sql;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $eventName = $row["eventName"];
            //header("Location: admin_event_details.php?duplicate=".$eventName);
            echo "Duplicate host and/or guest code(s). Click Back and make sure they're not the same as another event already in the database.";
        } else {
            $sql = "UPDATE Events SET eventDate = '$eventDate',eventName = '$eventName',eventLocation = '$eventLocation',guestAccessCode = '$guestAccessCode',hostAccessCode = '$hostAccessCode' WHERE eventID = $eventID;";
            //echo $sql;
            $result = $conn->query($sql);      

            $conn->close();  
            header("Location: admin_event_details.php?saved=".$eventID);
        }
        
        
    } else {
        $sql = "SELECT eventName FROM Events WHERE guestAccessCode = '$guestAccessCode' OR hostAccessCode = '$hostAccessCode';";
        //echo $sql;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $eventName = $row["eventName"];
            //header("Location: admin_event_details.php?duplicate=".$eventName);
            echo "Duplicate host and/or guest code(s). Click Back and make sure they're not the same as another event already in the database.";
        } else {
            $sql = "INSERT INTO Events (eventDate,eventName,eventLocation,guestAccessCode,hostAccessCode) VALUES ('$eventDate','$eventName','$eventLocation','$guestAccessCode','$hostAccessCode');";
            //echo $sql;
            $result = $conn->query($sql);   
            
            $eventID = mysqli_insert_id($conn);
            $eventPath = getcwd ()."/eventPhotos/$eventID/";
            //echo $eventPath;
            if (!file_exists($eventPath)) {
                mkdir($eventPath, 0777, true);
                //echo "directory created: ".$eventPath;
            }
            $conn->close();  
            header("Location: admin_event_details.php?saved=".$eventID);
        }
    }
?>