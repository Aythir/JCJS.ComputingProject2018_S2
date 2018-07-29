<?php include 'databaseConnection.php';?>
<?php include("GifCreator.php"); ?>
<?php
session_start();
if(isset($_SESSION["EventID"])) {
    $eventID = (int)$_SESSION["EventID"];
} else {
    header("Location: enterEventCode.php?error=1");
}

$photoCount = 0;
$frameArray = array();
$durationArray = array();
$animationDuration = 100;

if(isset($_GET["Photo1"])) {
    $photo1 = (int)$_GET["Photo1"];
    array_push($frameArray,"eventPhotos/".$eventID."/"."photo".$photo1.".jpg");
    array_push($durationArray,$animationDuration);
    $photoCount++;
}
if(isset($_GET["Photo2"])) {
    $photo2 = (int)$_GET["Photo2"];
    array_push($frameArray,"eventPhotos/".$eventID."/"."photo".$photo2.".jpg");
    array_push($durationArray,$animationDuration);
    $photoCount++;
}
if(isset($_GET["Photo3"])) {
    $photo3 = (int)$_GET["Photo3"];
    array_push($frameArray,"eventPhotos/".$eventID."/"."photo".$photo3.".jpg");
    array_push($durationArray,$animationDuration);
    $photoCount++;
}

$timestamp = date('Y-m-d G:i:s');
$sql = "INSERT INTO Photos (EventID, ImageType, Timestamp) VALUES ($eventID,3,'$timestamp')";
if ($conn->query($sql) === TRUE) {
    // get the ID of the inserted row
    $photoID = $conn->insert_id;

    // Initialize and create the GIF !
    $gc = new GifCreator();
    $gc->create($frameArray, $durationArray, 0);
    $gifBinary = $gc->getGif();

    // save the animated gif to a file using animationID number in filename
    file_put_contents("eventPhotos/".$eventID."/"."animation".$photoID.".gif", $gifBinary);

    // update database row with filename
    $sql = "UPDATE Photos SET Filename = 'animation".$photoID.".gif' WHERE PhotoID = $photoID;";
    //echo $sql;
    $result = $conn->query($sql);     

    header("Location: showGif.php?PhotoID=".$photoID);
} else {
    echo "Error inserting to database";
}

$conn->close();
?>