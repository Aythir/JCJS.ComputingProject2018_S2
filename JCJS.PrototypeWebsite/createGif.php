<?php include 'databaseConnection.php';?>
<?php include("GifCreator.php"); ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

session_start();
if(isset($_SESSION["EventID"])) {
    $eventID = (int)$_SESSION["EventID"];
} else {
    header("Location: index.php?error=1");
}

$photoCount = 0;
$frameArray = array();
$durationArray = array();
$animationDuration = 100;

if(isset($_GET["sel"])) {
    $photoArray = explode(",",$_GET["sel"]);

    foreach ($photoArray as &$value) {
        $sql = "SELECT Filename FROM photos WHERE EventID = $eventID AND PhotoID = ".(int)$value.";";
        //echo $sql."<br>";
        $result = $conn->query($sql);
      
        if ($result->num_rows > 0) {
          $row = mysqli_fetch_assoc($result);
          $fileName = $row["Filename"];
          echo $fileName."<br>";
          array_push($frameArray,"eventPhotos/".$eventID."/".$fileName);
          array_push($durationArray,$animationDuration);
        }        
    }
    $photoID = round($eventID.time()/1000);

    // Initialize and create the GIF !
    $gc = new GifCreator();
    $gc->create($frameArray, $durationArray, 0);
    $gifBinary = $gc->getGif();
    $gifFilename = "animation".$photoID.".gif";
    $gifFilePath = "eventPhotos/".$eventID."/".$gifFilename;

    // save the animated gif to a file using animationID number in filename
    file_put_contents($gifFilePath, $gifBinary);

    header("Location: showGif.php?animationID=".$photoID);
}
else {
    echo "No images selected";
}
?>