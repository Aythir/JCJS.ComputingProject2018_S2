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

    function addLogoByEventId(int $eventId) {

        //Upload latest version of logo
        $lrpLogoPath = '../img/logo.png';
        $lrpLogoUpload = \Cloudinary\Uploader::upload($lrpLogoPath, array('overwrite' => true, 'public_id' => 'lrpLogo'));

        $filepath = '../eventPhotos/' . $eventId;
        $logoPath = $filepath . '/logo_originals';
        $filepath = realpath($filepath);
        $logoPath = realpath($logoPath);

        //If logo subdirectory doesn't exist, create it
        if (!file_exists($logoPath)) {
            mkdir($logoPath);
        }


        
        //Database query all booth uploaded photos with event ID as above

        if() { //Query is not empty

            //For each file, if the logoified file doesn't already exist...
            if (!file_exists($logoPath . '/logo_' . $file)) {
                //create it...
                $upload = \Cloudinary\Uploader::upload($file, array('public_id' => $photoID, 'transformation' => array(
                    'overlay' => 'lrpLogo',
                    'width' => 200,
                    'gravity' => 'south_east',
                    
                )));

                //...and prefix filename with logo_ and place in thumbnail subdirectory
                if (file_put_contents($logoPath . '/logo_' . $file, file_get_contents($upload["url"])) === false) {
                    throw new Exception("Could not put thumbnail in correct directory.");
                }
            }
        }
    }

    addLogoByEventId(1);
    
?>