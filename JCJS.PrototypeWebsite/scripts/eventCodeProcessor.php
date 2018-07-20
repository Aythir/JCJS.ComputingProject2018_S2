<?php include 'databaseConnection.php';?>
<?php
  $eventCode = mysqli_real_escape_string($conn,$_POST["eventCode"]);

  $sql = "SELECT EventID FROM Events WHERE GuestAccessCode = '$eventCode';";
  echo $sql;
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          echo "Logged in!";
          session_start();
          $_SESSION["EventID"] = $row["EventID"];
          echo "?????????????[".$_SESSION["EventID"]."]";
          header("Location: gallery.php");
      }
  } else {
      header("Location: enterEventCode.php?error=1");
  }
  $conn->close();  
?>