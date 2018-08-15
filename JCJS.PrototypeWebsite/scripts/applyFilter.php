<?php 
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  require 'Cloudinary.php';
  require 'Uploader.php';
  require 'Api.php';

  \Cloudinary::config(array( 
    "cloud_name" => "littleredphotobooth", 
    "api_key" => "831219221732949", 
    "api_secret" => "lNdOEX5stZEosAsWZjv2bkqQlkM" 
  ));

    $photoID = $_GET["photoID"];
    $filter = $_GET["filter"];
    $result = cloudinary_url($photoID, array("effect" => $filter));
    echo $result;
      
?>