<?php include 'databaseConnection.php';?>
<?php include 'functionList.php';?>
<?php
  $title = "Animated Gif";
  $animationID = (int)$_GET["animationID"];
  session_start();
  if(isset($_SESSION["EventID"])) {
    $eventID = (int)$_SESSION["EventID"];
  } else {
    header("Location: enterEventCode.php?error=1");
  }

  $navbarlinks = createNavLink("Event Gallery","gallery.php");
  $navbarlinks .= createNavLink("Upload Photo","upload_photo.php");
?>
<?php include 'guestHeader.php';?>          
  <!-- Content -->
   <div class="container-liquid">
      <img src='eventPhotos/<?php echo $eventID."/animation".$animationID?>.gif'>
   </div>
</div>
</body>
