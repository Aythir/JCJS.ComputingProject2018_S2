<?php include 'databaseConnection.php';?>
<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

session_start();
if(isset($_SESSION["AdminID"])) {  
  $eventID = (int)$_GET["EventID"];

  //event photos directory
  $photoDirectory = getcwd ()."\\eventPhotos\\$eventID\\";
  
  // delete all photos from event directory
  array_map('unlink', glob("$photoDirectory/*.*"));
  
  //delete event directory itself
  rmdir($photoDirectory);

  $sql = "DELETE FROM Events WHERE EventID = '$eventID';";
  //echo $sql;
  $result = $conn->query($sql);            
  $conn->close();  
}
header("Location: admin_event_details.php?deleted=".$eventID);  
?>