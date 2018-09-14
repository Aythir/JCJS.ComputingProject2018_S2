<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

      require './scripts/Cloudinary.php';
      require './scripts/Uploader.php';
      require './scripts/Api.php';
    
      \Cloudinary::config(array( 
        "cloud_name" => "littleredphotobooth", 
        "api_key" => "831219221732949", 
        "api_secret" => "lNdOEX5stZEosAsWZjv2bkqQlkM" 
      ));

    function addLogoByPhotoID(int $photoID) {

        include 'databaseConnection.php';

        //Upload latest version of logo
        $lrpLogoPath = './img/logo.png';
        $lrpLogoUpload = \Cloudinary\Uploader::upload($lrpLogoPath, array('overwrite' => true, 'public_id' => 'lrpLogo'));

        $filepath = './eventPhotos/' . $eventId . '/';
        $logoPath = $filepath . '/logo_originals/';

        //If logo subdirectory doesn't exist, create it
        if (!file_exists($logoPath)) {
            mkdir($logoPath);
        }


        
        //Database query all booth uploaded photos with event ID as above
        $sql = "SELECT PhotoID, Filename FROM photos WHERE EventID = '$eventId' AND IsUserUpload = 0;";
        $result = $conn->query($sql);

        if($result->num_rows > 0) { //Query is not empty

            while($row = $result->fetch_assoc()) {
                $photoID = $row['PhotoID'];
                $file = $row['Filename'];
                //For each file, if the logoified file doesn't already exist...
                if (!file_exists($logoPath . '/logo_' . $file)) {
                    //create it...
                    $upload = \Cloudinary\Uploader::upload($filepath . $file, array('public_id' => $photoID, 'transformation' => array(
                        'overlay' => 'lrpLogo',
                        'width' => 200,
                        'gravity' => 'south_east',
                        'x' => 10,
                        'y' => 10
                    )));

                    //...and prefix filename with logo_ and place in thumbnail subdirectory
                    if (file_put_contents($logoPath . '/logo_' . $file, file_get_contents($upload["url"])) === false) {
                        throw new Exception("Could not put thumbnail in correct directory.");
                    }
                }
            }
        }
    }

    //Test it
    addLogoByEventId(1);
    
?>