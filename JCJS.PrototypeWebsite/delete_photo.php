<?php include 'databaseConnection.php';?>
<?php

error_reporting(E_ALL); ini_set('display_errors', 1);

$photoID = (int)$_GET["id"];

session_start();
if(isset($_SESSION["HostAccess"])) {

    $sql = "SELECT Filename FROM photos WHERE PhotoID = $photoID;";
    //echo $sql;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_row($result);
        $target_dir = $_SERVER['DOCUMENT_ROOT']."/"."eventPhotos/". (int)($_SESSION["EventID"]) . "/" . $row[0];
        echo $target_dir;
        unlink($target_dir);

        $sql = "DELETE FROM Photos WHERE PhotoID = $photoID;";
        echo $sql;
        $result = $conn->query($sql);     
    }
    $conn->close();

    //header("Location: gallery.php");
} else {
    header("Location: index.php?error=1");
}
?>