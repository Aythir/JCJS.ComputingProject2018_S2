<?php 
  require 'Cloudinary.php';
  require 'Uploader.php';
  require 'Api.php';
  include '../databaseConnection.php';

  \Cloudinary::config(array( 
    "cloud_name" => "littleredphotobooth", 
    "api_key" => "831219221732949", 
    "api_secret" => "lNdOEX5stZEosAsWZjv2bkqQlkM" 
  ));

  if (isset($_GET["photoID"])) {
    $photoID = $_GET["photoID"];
    $sql = "SELECT fileName, eventID FROM photos WHERE photoID = $photoID;";
    //echo $sql;
    $result = $conn->query($sql);
    $conn->close(); 
    if ($result->num_rows > 0) {
      $row = mysqli_fetch_assoc($result);
      $fileName = $row["fileName"];
      $eventID = $row["eventID"];
      $filePath = "../eventPhotos/" . $eventID . "/" . $fileName;
      $upload = \Cloudinary\Uploader::upload($filePath, array("public_id" => $photoID, "overwrite" => true));
      echo $upload['url'];
    }

    
  }
      
?>