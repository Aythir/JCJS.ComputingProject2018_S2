<?php 
  require 'Cloudinary.php';
  require 'Uploader.php';
  require 'Api.php';

  \Cloudinary::config(array( 
    "cloud_name" => "littleredphotobooth", 
    "api_key" => "831219221732949", 
    "api_secret" => "lNdOEX5stZEosAsWZjv2bkqQlkM" 
  ));



  

  if (isset($_GET["photoID"]) && isset($_GET["filter"])) {
    $photoID = $_GET["photoID"];
    $filter = $_GET["filter"])
    $options = array("effect" => $filter);
    # Same image, uploaded with a public_id
    $transformation_url = cloudinary_url($photoID, $options);
    echo $transformation_url;
  }
      
?>