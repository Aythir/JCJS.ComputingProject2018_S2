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

    //This function will detect and create thumbnails of 200 and 500 width for a given eventId
    //Assuming the event photos are in ./eventPhotos/$eventId relative to this script
    //A thumbnail subdirectory will be created in the eventId directory if it doesn't already exist
    //Thumbnails will not be created if they already exist
    function detectAndCreateThumbnails(int $eventId) {
        $filepath = '../eventPhotos/' . $eventId;
        $thumbnailPath = $filepath . '/thumbnails';
        $filepath = realpath($filepath);

        //If thumbnail subdirectory doesn't exist, create it
        if (!file_exists($thumbnailPath)) {
            mkdir($thumbnailPath);
        }
        $thumbnailPath = realpath($thumbnailPath);
        //Foreach image file in $filepath...
        chdir($filepath);
        $files = glob('*.{jpg,jpeg,gif}', GLOB_BRACE);
        if(sizeof($files) > 0) {
            foreach($files as $file) {
                
                $cloudinary_options = array("background"=>"black", "crop"=>"pad", "width"=>0, "height"=>0);
                //If 200 thumbnail doesn't already exist
                if (!file_exists($thumbnailPath . '/thumb200_' . $file)) {
                    //create thumbnail
                    $cloudinary_options["width"] = 200;
                    $cloudinary_options["height"] = 134;
                    $upload = \Cloudinary\Uploader::upload($file, $cloudinary_options);

                    //Suffix thumbnail filename with thumb200_ and place in thumbnail subdirectory
                    if (file_put_contents($thumbnailPath . '/thumb200_' . $file, file_get_contents($upload["url"])) === false) {
                        throw new Exception("Could not put thumbnail in correct directory.");
                    }
                }

                //If 500 thumbnail doesn't already exist
                if (!file_exists($thumbnailPath . '/thumb500_' . $file)) {
                    //create thumbnail
                    $cloudinary_options["width"] = 500;
                    $cloudinary_options["height"] = 334;
                    $upload = \Cloudinary\Uploader::upload($file, $cloudinary_options);

                    //Suffix thumbnail filename with thumb500_ and place in thumbnail subdirectory
                    if (file_put_contents($thumbnailPath . '/thumb500_' . $file, file_get_contents($upload["url"])) === false) {
                        throw new Exception("Could not put thumbnail in correct directory.");
                    }
                }
                

            }
        } else {
            throw new Exception('No images found in {$filepath}');
        }
        
        
    }
    
?>