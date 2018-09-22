<?php include 'databaseConnection.php';?>
<?php
      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);
  session_start();
  $uniqueCode = mysqli_real_escape_string($conn,$_GET["uniqueCode"]);
  if(!isset($_SESSION["UniqueCodes"])) {
    $_SESSION["UniqueCodes"] = array();
  }
  if(in_array($uniqueCode,$_SESSION["UniqueCodes"])) {
    $response = true;
  } else {
    
    $eventID = (int)$_SESSION["EventID"];

    $sql = "SELECT photoID,UniqueCode FROM photos WHERE UniqueCode = '$uniqueCode' AND EventID = $eventID;";
    $result = $conn->query($sql);
    $response = "false";
    if($uniqueCode != "" && $uniqueCode != NULL) {
      if ($result->num_rows > 0) { 
        array_push($_SESSION["UniqueCodes"], $uniqueCode);
        $response = "true";
      }
    }
  }
  
  echo $response;
?>