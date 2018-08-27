<?php include 'databaseConnection.php';?>
<?php
  session_start();
  $eventCode = mysqli_real_escape_string($conn,$_POST["eventCode"]);

  $sql = "SELECT EventID FROM Events WHERE GuestAccessCode = '$eventCode';";
  //echo $sql;
  $result = $conn->query($sql);

  $response = "false";
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {    
      $_SESSION["EventID"] = $row["EventID"];
      $response = "true";  
    }
  }
  echo $response;
?>