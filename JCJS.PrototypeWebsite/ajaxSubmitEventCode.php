<?php include 'databaseConnection.php';?>
<?php
  session_start();
  $eventCode = mysqli_real_escape_string($conn,$_POST["eventCode"]);
  $eventCodeInt = (int)$eventCode;

  $sql = "SELECT EventID,HostAccessCode FROM Events WHERE GuestAccessCode = '$eventCodeInt' OR HostAccessCode = '$eventCodeInt';";
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
  else {
    $sql = "SELECT UniqueCode, EventID FROM photos WHERE UniqueCode = '$eventCode';";
    //echo $sql;
    $result = $conn->query($sql);
  
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {    
        $_SESSION["UniqueCodes"] = array($row["UniqueCode"]);
        $_SESSION["EventID"] = $row["EventID"];
        $response = "true";  
      }
    }    
  }
  echo $response;
?>