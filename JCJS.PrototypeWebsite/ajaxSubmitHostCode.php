<?php include 'databaseConnection.php';?>
<?php
  session_start();
  if(isset($_SESSION["EventID"])) {
    $eventID = (int)$_SESSION["EventID"];
  } else {
    header("Location: enterEventCode.php?error=1");
  }

  $hostCode = mysqli_real_escape_string($conn,$_POST["hostCode"]);

  $sql = "SELECT EventID FROM Events WHERE EventID = '$eventID' AND HostAccessCode = '$hostCode';";
  //echo $sql;
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $_SESSION["HostAccess"] = true;
    echo "true";
  } else {
    echo "false";
  }
?>