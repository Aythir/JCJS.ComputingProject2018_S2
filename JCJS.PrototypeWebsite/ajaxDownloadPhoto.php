<?php include 'databaseConnection.php';?>
<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

session_start();
$eventID = (int)$_SESSION["EventID"];

if(isset($_GET["PhotoID"])) {
  $photoID = (int)$_GET["PhotoID"];
  $sql = "SELECT Filename FROM photos WHERE EventID = $eventID AND PhotoID = $photoID;";
  //echo $sql;
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $fileName = $row["Filename"];
  } else {
      header("Location: 500.php?error=1");
  } 
} else {
  $animationID = (int)$_GET["animationID"];
  $fileName = "animation".$animationID.".gif";
}

$photoPath = getcwd ()."/eventPhotos/$eventID/".$fileName;
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
} else {
  echo "File not found: ".$photoPath;
}
?>