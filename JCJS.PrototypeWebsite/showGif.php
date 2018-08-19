<?php include 'functionList.php';?>
<?php
  $title = "Animated Gif";
  $animationID = (int)$_GET["animationID"];
  $navbarlinks = createNavLink("Event Gallery","gallery.php");
  $navbarlinks .= createNavLink("Upload Photo","upload_photo.php");
?>
<?php include 'guestHeader.php';?>          
  <!-- Content -->
    <div class="container-liquid">
    <?php
        if(isset($_SESSION["EventID"])) {
        $eventID = (int)$_SESSION["EventID"];
      } else {
        header("Location: index.php?error=1");
      }
    ?>
    <img src='eventPhotos/<?php echo $eventID."/animation".$animationID?>.gif'>
   </div>
</div>
</body>
