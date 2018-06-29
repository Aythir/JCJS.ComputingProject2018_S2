<?php
    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);

    function createThumbnails(string $filepath, int $width, int $height) {
        echo('filepath1' . realpath($filepath));
        $thumbnailPath = $filepath . '/thumbnails';
        $filepath = realpath($filepath);

        //If thumbnail subdirectory doesn't exist, create it
        echo('filepath4' . $thumbnailPath);
        echo('exist?' . file_exists($thumbnailPath));
        if (!file_exists($thumbnailPath)) {
            mkdir($thumbnailPath);
        } else {
            echo($thumbnailPath . 'exists');
        }

        //Foreach image file in $filepath...
        $files = glob($filepath . '/*.{jpg,jpeg,gif}', GLOB_BRACE);
        if(sizeof($files) > 0) {
            foreach($files as $file) {
                echo $file;
                //create thumbnail
                $imagick = new Imagick($file);
                $imagick->thumbnailImage($width, $height, false, false);

                //Suffix thumbnail filename with _thumb_$width and place in thumbnail subdirectory
                $format = $imagick->getFormat();
                $filename_no_ext = reset(explode('.', $file));
                if (file_put_contents($thumbnailPath . $filename_no_ext . '_thumb_' . $width . $format, $imagick) === false) {
                    throw new Exception("Could not put contents.");
                }

            }
        } else {
            throw new Exception('No images found in {$filepath}');
        }
        
        
    }
    
    //Test
    try {
        createThumbnails('../eventPhotos/1', 400, 300);
    }
    catch (ImagickException $e) {
        echo $e->getMessage();
    }
    catch (Exception $e) {
        echo("Exception");
        echo $e->getMessage();
    }
    
?>