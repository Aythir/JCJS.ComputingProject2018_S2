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

  $filePath = "http://".$_SERVER['SERVER_NAME']."/eventPhotos/".$eventID."/animation".$animationID.".gif";

  $navbarlinks = createNavLink("Event Gallery","gallery.php");
  $navbarlinks .= createNavLink("Upload Photo","upload_photo.php");
   ?>
   <?php include 'guestHeader.php';?>    
<!--Facebook supplied code-->
<div id="fb-root"></div>
<!-- end Facebook supplied code-->
<script>

  //Facebook supplied code
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.1&appId=1023726461149386&autoLogAppEvents=1';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  //End Facebook supplied code
  

function shareToFacebook() {
  FB.getLoginStatus(function(response) {
    if (response.status === 'connected') {
      var accessToken = response.authResponse.accessToken;
    } 
  } );
  
  var imgURL="http://54.153.242.36/eventPhotos/1/2018-8-6-47253A.jpg";//change with your external photo url
  FB.api('/album_id/photos', 'post', {
    message:'photo description',
    url:imgURL        
  }, function(response){

    if (!response || response.error) {
        alert('Error occured');
    } else {
        alert('Post ID: ' + response.id);
    }

  });
}
</script>   
     <!-- Content -->
  <div class="container-liquid">
   <div class="personal-gallery tz-gallery" style="margin-top:80px">
     <div class="row" style="margin-top:10px">
      <div class="container">
         <img src='<?php echo $filePath."?t=" . round(microtime(true) * 1000); ?>' class="img-fluid col-md-12 p-1">
      </div>
     </div>
      <div class="container">
        <div class='row'>
          <div class='col-lg-4 col-sm-6'>
              <!--  return to gallery-->
              <button class="btn btn-block" onclick="goBack()"><< Gallery</button>

          </div>
          <div class='col-lg-4 col-sm-6'>
              <!-- Save Gif to device-->
              <a href="ajaxDownloadPhoto.php?animationID=<?php echo $animationID?>"><button id="saveButton" class="btn btn-default btn-block">Download Image</button></a>

          </div>
          <div class='col-lg-4 col-sm-6'>
              <div class="fb-share-button" style="top-margin:10px" data-href="<?php echo $filePath?>" data-layout="button_count" data-size="large" data-mobile-iframe="false">
              <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
              class="fb-xfbml-parse-ignore">Share</a>
              </div>
              <!-- end Facebook supplied button-->      
          </div>
        </div>
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
