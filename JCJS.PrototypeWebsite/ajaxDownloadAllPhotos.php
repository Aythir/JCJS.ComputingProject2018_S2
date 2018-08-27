<?php include 'databaseConnection.php';?>
<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

  session_start();
  if(isset($_SESSION["HostAccess"])) {  
    $eventID = (int)$_SESSION["EventID"];

    $zipDirectory = getcwd ()."\\eventPhotos\\";
    //echo $zipDirectory;
    $photoDirectory = getcwd ()."//eventPhotos//$eventID//";
    //echo $photoDirectory;
    $zipFile = "allPhotos.zip";
    
    // Initialize archive object
    $zip = new ZipArchive();
    $zip->open($zipDirectory.$zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE);

    // Create recursive directory iterator
    /** @var SplFileInfo[] $files */
    $files = new RecursiveIteratorIterator(
      new RecursiveDirectoryIterator($photoDirectory),
      RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file)
    {
      // Skip directories (they would be added automatically)
      if (!$file->isDir())
      {
          // Get real and relative path for current file
          $filePath = $file->getRealPath();
          //echo $filePath."<br>";
          $relativePath = substr($filePath, strlen($photoDirectory));
          //echo $relativePath."<br>";

          // Add current file to archive
          $zip->addFile($filePath, $relativePath);
      }
    }

    // Zip archive will be created only after closing object
    $zip->close();

    // Process download
    if(file_exists($zipDirectory.$zipFile)) {
        ob_clean();
        ob_end_flush();
        
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($zipDirectory.$zipFile).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($zipDirectory.$zipFile));
        flush(); // Flush system output buffer
        readfile($zipDirectory.$zipFile);
        exit;
    }
  }
?>