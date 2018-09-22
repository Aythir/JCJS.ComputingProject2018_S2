<?php include 'databaseConnection.php';?>
<?php
  session_start();
  $uniqueCode = mysqli_real_escape_string($conn,$_POST["uniqueCode"]);

  $sql = "SELECT photoID,UniqueCode FROM photos WHERE UniqueCode = '$uniqueCode' AND EventID = '$_SESSION["EventID"]';";
  //echo $sql;
  $result = $conn->query($sql);

  $response = "false";
  if($uniqueCode != "" && $uniqueCode != NULL) {
    if ($result->num_rows > 0) { 
      array_push($_SESSION["UniqueCodes"], $uniqueCode);
      $response = "true":
    }
  }
  
  echo $response;
?>