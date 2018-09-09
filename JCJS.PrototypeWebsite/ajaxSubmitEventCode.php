<?php include 'databaseConnection.php';?>
<?php
  session_start();
  $eventCode = mysqli_real_escape_string($conn,$_POST["eventCode"]);
  $eventCode = (int)$eventCode;

  $sql = "SELECT EventID,HostAccessCode FROM Events WHERE GuestAccessCode = '$eventCode' OR HostAccessCode = '$eventCode';";
  //echo $sql;
  $result = $conn->query($sql);

  $response = "false";
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {    
      $_SESSION["EventID"] = $row["EventID"];
      if($row["HostAccessCode"] == $eventCode) $_SESSION["HostAccess"] = true;
      $response = "true";  
    }
  }
  echo $response;
?>