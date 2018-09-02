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
      <div class="container">
       <!--center buttons<div class="text-center d-flex justify-content-center" style="font-size:25px">-->
        <div id="default-buttons"> <!-- Wrapper div required for show/hide functions to work-->        
         <!-- Save Gif to device-->
          <button class="btn btn-default" onclick="#">Save to Device</button>
          <!--  return to gallery-->
          <button class="btn" onclick="goBack()">< Back to gallery</button>
          
         <!--Facebook supplied button-->
         <div class="fb-share-button" style="top-margin:10px"
         data-href="<?php echo $filePath?>" data-layout="button_count" data-size="large" data-mobile-iframe="false">
             <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
             class="fb-xfbml-parse-ignore">Share</a>
         </div>
          <!-- end Facebook supplied button-->
      
        </div>
      <!--</div>-->
    </div>
   </div>
  </div>
  
 <script>
 var fileName = "<?php echo $filePath?>";
 
  function goBack() {
    window.history.back()
   }
  </script>
</body>
