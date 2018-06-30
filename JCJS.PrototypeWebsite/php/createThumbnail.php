<?php

    //This function will detect and create thumbnails of a given dimension for a given eventId
    //Assuming the event photos are in ../eventPhotos/$eventId relative to this script
    //A thumbnail subdirectory will be created in the eventId directory if it doesn't already exist
    //Thumbnails will not be created if they already exist
    function detectAndCreateThumbnails(int $eventId, int $width, int $height) {
        $filepath = '..eventPhotos/' . $eventId;
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
                //If thumbnail doesn't already exist
                if (!file_exists($thumbnailPath . '/thumb' . $width . '_' . $file)) {
                    //create thumbnail
                    $imagick = new Imagick($file);
                    $imagick->thumbnailImage($width, $height, false, false);

                    //Suffix thumbnail filename with thumb$width_ and place in thumbnail subdirectory
                    if (file_put_contents($thumbnailPath . '/thumb' . $width . '_' . $file, $imagick) === false) {
                        throw new Exception("Could not put contents.");
                    }
                }
                

            }
        } else {
            throw new Exception('No images found in {$filepath}');
        }
        
        
    }
    
?>