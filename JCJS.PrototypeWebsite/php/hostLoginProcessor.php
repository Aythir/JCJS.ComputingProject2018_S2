<?php include 'databaseConnection.php';?>
<?php
  $eventID = mysqli_real_escape_string($conn,$_POST["EventID"]);
  $password = mysqli_real_escape_string($conn,$_POST["Password"]);

  $sql = "SELECT EventID FROM Events WHERE EventID = '$eventID' AND HostAccessCode = '$password';";
  //echo $sql;
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION["EventID"] = $row["EventID"];
        $_SESSION["HostAccess"] = true;

        header("Location: gallery.php");
  } else {
      header("Location: hostLogin.php?error=1");
  }
  $conn->close();  
?>