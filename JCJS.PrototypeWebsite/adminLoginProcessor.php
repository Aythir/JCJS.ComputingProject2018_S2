<?php include 'databaseConnection.php';?>
<?php
  $username = mysqli_real_escape_string($conn,$_POST["username"]);
  $password = mysqli_real_escape_string($conn,$_POST["password"]);

  $sql = "SELECT AdminID,AdminName,Password FROM admin WHERE UserID = '$username';";
  echo $sql."<br>";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      $row = mysqli_fetch_assoc($result);

      if (password_verify($password,$row["Password"]) ) { //|| $password == $row["Password"]) {
        session_start();
        $_SESSION["AdminID"] = $row["AdminID"];
        $_SESSION["AdminName"] = $row["AdminName"];

        //echo "Password matches";
        header("Location: admin_event_details.php");
      }
      else {
        header("Location: admin_Login.php?error=1&username=".$username);
      }        
  } else {
      header("Location: admin_Login.php?error=1&username=".$username);
  }
  $conn->close();  
?>