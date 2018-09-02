<?php include 'databaseConnection.php';?>
<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

session_start();
$eventID = (int)$_SESSION["EventID"];

$photoID = (int)$_GET["PhotoID"];
$fileName = "photo".$photoID.".jpg";

$photoPath = getcwd ()."\\eventPhotos\\$eventID\\".$fileName;
//echo $photoPath

// Process download
if(file_exists($photoPath)) {
  $sql = "UPDATE Photos SET DownloadCount = DownloadCount+1 WHERE photoID = $photoID;";
  //echo $sql;
  $result = $conn->query($sql);   

  ob_clean();
  ob_end_flush();
  
  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename="'.basename($fileName).'"');
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . filesize($photoPath));
  flush(); // Flush system output buffer
  readfile($photoPath);
  exit;
}
?>