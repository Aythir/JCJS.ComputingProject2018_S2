<?php include 'databaseConnection.php';?>
<?php

error_reporting(E_ALL); ini_set('display_errors', 1);

session_start();
if(isset($_SESSION["EventID"])) {
    $eventID = (int)$_SESSION["EventID"];
} else {
    header("Location: index.php?error=1");
}

$errorMsg;
$target_dir = $_SERVER['DOCUMENT_ROOT']."/"."eventPhotos/". $eventID . "/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
$uploadOk = 1;
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $errorMsg = "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $errorMsg = "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size (max 5mb file size)
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    $errorMsg = "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $errorMsg = "Sorry, only JPG, JPEG, PNG and GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
    header("Location: upload_photo.php?errorMsg=".$errorMsg);
// if everything is ok, try to upload file
} else {
    $timestamp = date('Y-m-d G:i:s');
    $sql = "INSERT INTO Photos (EventID, IsUserUpload, Timestamp) VALUES ($eventID,1,'$timestamp')";
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

        if (is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$newFilename)) {
                //resize image if necessary
                // Uploaded landscape photos should be cropped to 1620 x 1080 or closest possible 3:2 aspect ratio.
                // Portrait orientation should be cropped to 720 x 1080 or closest possible 2:3 aspect ratio.
                list($width, $height) = getimagesize($target_dir.$newFilename);
                echo "width: " . $width . "<br />";
                echo "height: " .  $height;
                if($width > $height) {
                    // landscape format
                    if ($width > 1620) {
                        resizeImage($newFilename,1620,1080,$target_dir);
                    }
                } else {
                    // portrait format
                    if ($width > 720) {
                        resizeImage($newFilename,720,1080,$target_dir);
                    }                    
                }

                header("Location: showPhoto.php?PhotoID=".$photoID);
            } else {
                echo "Sorry, there was an error renaming your file.<br>";
                echo "[".$target_dir.$newFilename."]<br>";
                echo "[".$_FILES["fileToUpload"]["tmp_name"]."]<br>";
            }
        }
        else {
            echo "Sorry, file not uploaded.".$_FILES["fileToUpload"]["tmp_name"]."<br>";
        }
    } else {
        //echo "Error inserting to database";
        echo "Error inserting to database:" . $sql . "<br>" . $conn->error;
    }    
}

function resizeImageOld($imageFolder,$imageName) {
    $image = $_FILES["image"]["tmp_name"];
    $resizedDestination = $imageFolder."_RESIZED.jpg";

    copy($imageFolder.$imageName, $resizedDestination);

    $imageSize = getImageSize($image);
    $imageWidth = $imageSize[0];
    $imageHeight = $imageSize[1];
    if($imageWidth > $imageHeight) {
        // landscape format
        $newImageHeight = round( (1620/$imageWidth)*$imageHeight, 0);
        $newImageWidth = 1620;
    } else {
        // portrait format
        $newImageWidth = round( (720/$imageHeight)*$imageWidth, 0);
        $newImageHeight = 720;
    }   

    $resizedImage = imageCreateTrueColor($newImageWidth, $newImageHeight);

    imageCopyResampled($images_fin, $originalImage, 0, 0, 0, 0, $DESIRED_WIDTH+1, $proportionalHeight+1, $imageWidth, $imageHeight);
    imageJPEG($resizedImage, $resizedDestination);

    imageDestroy($imageFolder.$imageName);
    imageDestroy($resizedImage);
}

function resizeImage($imageName,$newWidth,$newHeight,$imageDir)
{
    $path = $imageDir . '/' . $imageName;

    $mime = getimagesize($path);

    if($mime['mime']=='image/png'){ $src_img = imagecreatefrompng($path); }
    if($mime['mime']=='image/jpg'){ $src_img = imagecreatefromjpeg($path); }
    if($mime['mime']=='image/jpeg'){ $src_img = imagecreatefromjpeg($path); }
    if($mime['mime']=='image/pjpeg'){ $src_img = imagecreatefromjpeg($path); }

    $old_x = imageSX($src_img);
    $old_y = imageSY($src_img);

    if($old_x > $old_y)
    {
        $thumb_w = $newWidth;
        $thumb_h = $old_y/$old_x*$newWidth;
    }

    if($old_x < $old_y)
    {
        $thumb_w = $old_x/$old_y*$newHeight;
        $thumb_h = $newHeight;
    }

    if($old_x == $old_y)
    {
        $thumb_w = $newWidth;
        $thumb_h = $newHeight;
    }

    $dst_img = ImageCreateTrueColor($thumb_w,$thumb_h);

    imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);

    // New save location
    $new_thumb_loc = $imageDir . $imageName;

    if($mime['mime']=='image/png'){ $result = imagepng($dst_img,$new_thumb_loc,8); }
    if($mime['mime']=='image/jpg'){ $result = imagejpeg($dst_img,$new_thumb_loc,80); }
    if($mime['mime']=='image/jpeg'){ $result = imagejpeg($dst_img,$new_thumb_loc,80); }
    if($mime['mime']=='image/pjpeg'){ $result = imagejpeg($dst_img,$new_thumb_loc,80); }

    imagedestroy($dst_img);
    imagedestroy($src_img);
    return $result;
}
?>