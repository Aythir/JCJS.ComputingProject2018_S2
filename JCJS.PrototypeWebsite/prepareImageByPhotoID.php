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

    if(isset($_GET['id'])) {

        $photoID = $_GET['id'];
        include 'databaseConnection.php';

        //Get image info from database
        $sql = "SELECT PhotoID, Filename, IsUserUpload, EventID FROM photos WHERE PhotoID = $photoID";
        $result = $conn->query($sql);

        //If query is not empty
        if($result->num_rows > 0) {
            
            $row = $result->fetch_assoc();
            $eventId = $row['EventID'];

            $filepath = './eventPhotos/' . $eventId . '/';
            $logoPath = $filepath . 'logo_originals/';
            $file = $row['Filename'];
            $cloudinary_options = array();
            
            //If photo is booth upload, add logo options to Cloudinary array
            if($row['IsUserUpload'] == 0) {

                //If logo subdirectory doesn't exist, create it
                if (!file_exists($logoPath)) {
                    mkdir($logoPath);
                }

                $cloudinary_options = array_merge($cloudinary_options, array(
                    'overlay' => 'lrpLogo',
                    'width' => 200,
                    'gravity' => 'south_east',
                    'x' => 10,
                    'y' => 10));
                
                $resultPath = $logoPath . '/logo_';
            }

            //Upload the image...
            $upload = \Cloudinary\Uploader::upload($filepath . $file, array('public_id' => $photoID, array('eager' => $cloudinary_options)));
            $logoified = cloudinary_url($photoID, $cloudinary_options);

            //Save the result if it's a booth upload
            if($row['IsUserUpload'] == 0) {
                //prefix filename with logo_ and place in logo subdirectory
                if (file_put_contents($logoPath . 'logo_' . $file, file_get_contents($logoified)) === false) {
                    throw new Exception("Could not put logoified in correct directory.");
                }
            }

            //Now create thumbnails
            $thumbnailPath = $filepath . 'thumbnails';
            $thumbnail_options = array("transformation" => $cloudinary_options, "background"=>"black", "crop"=>"pad", "width"=>0, "height"=>0);

            //If subdirectory doesn't exist, create it
            if (!file_exists($thumbnailPath)) {
                mkdir($thumbnailPath);
            }

            

            //Create 500 width thumbnail
            $thumbnail_options['width'] = 500;
            $thumbnail_options["height"] = 334;
            $thumb500 = cloudinary_url($photoID, array_merge($thumbnail_options));

            if (file_put_contents($thumbnailPath . '/thumb500_' . $file, file_get_contents($thumb500)) === false) {
                throw new Exception("Could not put thumbnail in correct directory.");
            }

            //Create 200 width thumbnail
            $thumbnail_options['width'] = 200;
            $thumbnail_options["height"] = 134;
            $thumb200 = cloudinary_url($photoID, array_merge($thumbnail_options));

            if (file_put_contents($thumbnailPath . '/thumb200_' . $file, file_get_contents($thumb200)) === false) {
                throw new Exception("Could not put thumbnail in correct directory.");
            }

            //And finally delete image from Cloudinary server
            \Cloudinary\Uploader::destroy($photoID);

            if(file_exists($thumbnailPath . '/thumb200_' . $file)) {
                echo $thumbnailPath . '/thumb200_' . $file;
            }

        }
    }
?>