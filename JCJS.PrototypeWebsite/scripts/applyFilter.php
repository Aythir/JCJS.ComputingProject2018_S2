<?php 
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  require 'Cloudinary.php';
  require 'Uploader.php';
  require 'Api.php';
  include '../databaseConnection.php';

  \Cloudinary::config(array( 
    "cloud_name" => "littleredphotobooth", 
    "api_key" => "831219221732949", 
    "api_secret" => "lNdOEX5stZEosAsWZjv2bkqQlkM" 
  ));

    $photoID = $_GET["photoID"];
    $filter = $_GET["filter"];

    //Only apply logo if image is booth upload
    $sql = "SELECT photoID, IsUserUpload FROM photos WHERE photoID = $photoID;";
    //echo $sql;
    $result = $conn->query($sql);
    $conn->close(); 
    if ($result->num_rows > 0) {
      $row = mysqli_fetch_assoc($result);
      if($row['IsUserUpload'] == 0) {
        $logo_options = array('overlay' => 'lrpLogo',
        'width' => 200,
        'gravity' => 'south_east',
        'x' => 10,
        'y' => 10);
        $result = cloudinary_url($photoID, array_merge(array("transformation" => array("effect" => $filter)), $logo_options));
      } else {
        $result = cloudinary_url($photoID, array("transformation" => array("effect" => $filter)));
      }
    }
    
    
    echo $result;
      
?>