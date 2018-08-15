<?php 
  require 'Cloudinary.php';
  require 'Uploader.php';
  require 'Api.php';

  \Cloudinary::config(array( 
    "cloud_name" => "littleredphotobooth", 
    "api_key" => "831219221732949", 
    "api_secret" => "lNdOEX5stZEosAsWZjv2bkqQlkM" 
  ));



  $default_upload_options = array("tags" => "basic_sample", "effect" => "cartoonify");

  if (isset($_GET["filePath"]) && isset($_GET["photoID"])) {
    $filePath = "../".$_GET["filePath"];
    $photoID = $_GET["photoID"];
    # Same image, uploaded with a public_id
    $upload = \Cloudinary\Uploader::upload($filePath, array("public_id" => $photoID));
    echo $upload["url"];
  }
      
?>