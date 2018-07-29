<?php include 'databaseConnection.php';?>
<?php
session_start();
if(isset($_SESSION["EventID"])) {
    $eventID = (int)$_SESSION["EventID"];
} else {
    header("Location: enterEventCode.php?error=1");
}

$target_dir = "eventPhotos/". $eventID . "/";
$uploadOk = 1;
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    $timestamp = date('Y-m-d G:i:s');
    $sql = "INSERT INTO Photos (EventID, ImageType, Timestamp) VALUES ($eventID,3,'$timestamp')";
    if ($conn->query($sql) === TRUE) {
        // get the ID of the inserted row
        $photoID = $conn->insert_id;

        // set the new filename
        $newFilename = "photo".$photoID.".jpg";

        // update database row with filename
        $sql = "UPDATE Photos SET Filename = '".$newFilename."' WHERE PhotoID = $photoID;";
        //echo $sql;
        $result = $conn->query($sql);     
        $conn->close();

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$newFilename)) {
            header("Location: showPhoto.php?PhotoID=".$photoID);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Error inserting to database";
    }    
}

/*
RESIZING THE IMAGE... TBC
$image = $_FILES["image"]["tmp_name"];
$resizedDestination = $uploadDirectory.md5($randomNumber.$filename)."_RESIZED.jpg";

copy($_FILES, $resizedDestination);

$imageSize = getImageSize($image);
$imageWidth = $imageSize[0];
$imageHeight = $imageSize[1];

$DESIRED_WIDTH = 100;
$proportionalHeight = round(($DESIRED_WIDTH * $imageHeight) / $imageWidth);

$originalImage = imageCreateFromJPEG($image);

$resizedImage = imageCreateTrueColor($DESIRED_WIDTH, $proportionalHeight);

imageCopyResampled($images_fin, $originalImage, 0, 0, 0, 0, $DESIRED_WIDTH+1, $proportionalHeight+1, $imageWidth, $imageHeight);
imageJPEG($resizedImage, $resizedDestination);

imageDestroy($originalImage);
imageDestroy($resizedImage);
*/
?>