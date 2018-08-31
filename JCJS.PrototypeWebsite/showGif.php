<?php include 'functionList.php';?>
<?php
  $title = "Animated Gif";
  $animationID = (int)$_GET["animationID"];
  session_start();
  if(isset($_SESSION["EventID"])) {
    $eventID = (int)$_SESSION["EventID"];
  } else {
    header("Location: index.php?error=1");
  }

  $navbarlinks = createNavLink("Event Gallery","gallery.php");
  $navbarlinks .= createNavLink("Upload Photo","upload_photo.php");
   ?>
   <?php include 'guestHeader.php';?>          
     <!-- Content -->
  <div class="container-liquid">
   <div class="personal-gallery tz-gallery" style="margin-top:80px">
     <div class="row" style="margin-top:10px">
      <div class="container">
         <img src='eventPhotos/<?php echo $eventID."/animation".$animationID?>.gif' class="img-fluid col-md-12 p-1">
      </div>
     </div>
   </div>
  </div>
</body>
