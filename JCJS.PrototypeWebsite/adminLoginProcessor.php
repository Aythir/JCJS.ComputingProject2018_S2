<?php include 'databaseConnection.php';?>
<?php
  $username = mysqli_real_escape_string($conn,$_POST["username"]);
  $password = mysqli_real_escape_string($conn,$_POST["password"]);

  $sql = "SELECT AdminID,AdminName FROM admin WHERE UserID = '$username' AND Password = '$password';";
  echo $sql;
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        echo "Logged in!";
        session_start();
        $_SESSION["AdminID"] = $row["AdminID"];
        $_SESSION["AdminName"] = $row["AdminName"];

        header("Location: admin_event_details.php");
  } else {
      header("Location: admin_Login.php?error=1&username=".$username);
  }
  $conn->close();  
?>