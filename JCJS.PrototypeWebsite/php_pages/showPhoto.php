<?php include 'databaseConnection.php';?>
<?php include 'functionList.php';?>
<?php
  $title = "Uploaded Image";
  $photoID = (int)$_GET["PhotoID"];
  session_start();
  if(isset($_SESSION["EventID"])) {
    $eventID = (int)$_SESSION["EventID"];
  } else {
    header("Location: enterEventCode.php?error=1");
  }

  $sql = "SELECT Filename FROM photos WHERE EventID = $eventID AND PhotoID = $photoID;";
  //echo $sql;
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $fileName = $row["Filename"];
  } else {
      header("Location: 500.php?error=1");
  }  

  $navbarlinks = createNavLink("Event Gallery","gallery.php");
  $navbarlinks .= createNavLink("Create Gif","#");
  $navbarlinks .= createNavLink("Upload Photo","upload_photo.php");
  $navbarlinks .= createNavLink("Apply Filters","#");
  $navbarlinks .= createNavLink("Host Login","host_login.php");
?>
<?php include 'guestHeader.php';?>          
  <!-- Content -->
   <div class="container-liquid">
      <img src='eventPhotos/<?php echo $eventID."/".$fileName?>'>"
   </div>
</div>
</body>
