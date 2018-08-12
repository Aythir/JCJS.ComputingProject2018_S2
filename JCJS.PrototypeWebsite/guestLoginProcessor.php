<?php include 'databaseConnection.php';?>
<?php
  $password = mysqli_real_escape_string($conn,$_POST["Password"]);

  $sql = "SELECT EventID FROM Events WHERE GuestAccessCode = '$password';";
  //echo $sql;
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION["EventID"] = $row["EventID"];
        $_SESSION["HostAccess"] = false;

        header("Location: gallery.php");
  } else {
      header("Location: enterEventCode.php?error=1");
  }
  $conn->close();  
?>