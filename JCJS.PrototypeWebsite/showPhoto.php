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
    $filePath = "eventPhotos/".$eventID."/".$fileName;
    $thumbnailPath = "eventPhotos/".$eventID."/thumbnails/thumb500_".$fileName;
    if (file_exists($thumbnailPath)) {
      $filePath = $thumbnailPath;
    }
  } else {
      header("Location: 500.php?error=1");
  }  

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

function uploadToCloudinary() {
  var filePath = "<?php echo $filePath?>";
  var photoID = <?php echo $photoID?>;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("testDiv").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "./scripts/uploadToCloudinary.php?filePath=" + filePath +"&photoID="+ photoID, true);
  xhttp.send();
}

function applyFilter() {
  var photoID = <?php echo $photoID?>;
  var filter = document.getElementById("filterDropdown").value;
  if (filter != "") {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("showImage").src = this.responseText;
        document.getElementById("saveFilter").href = this.responseText;
        /* Update controls to allow download of filtered image */
        saveFilterResult();
      }
    };
    xhttp.open("GET", "./scripts/applyFilter.php?photoID="+ photoID + "&filter=" + filter, true);
    xhttp.send();
  }
  
}
  
</script>
<!-- Content -->
<div class="container-liquid">
  <div class="personal-gallery tz-gallery" style="margin-top:80px">
      <div class="row" style="margin-top:10px">
      <div class="container">
        <!-- <figure class=""> -->
          <img class="img-fluid col-md-12 p-1" id ="showImage" alt="picture" src='<?php echo $filePath?>' >
        <!-- </figure> -->
      </div>
    </div>

<div class="container text-center">
  <div id="default-buttons"> <!-- Wrapper div required for show/hide functions to work-->
  <!--  return to gallery-->
  <button class="btn " onclick="goBack()" style="width:185px;"><< Gallery</button>

  <!-- save button-->
  <a href="ajaxDownloadPhoto.php?PhotoID=<?php echo $photoID?>"><button id="saveButton" class="btn btn-default" style="width:185px;">Download Image</button></a>

  <!-- apply filter-->
  <button class="btn btn-default" onclick="filterMode()" style="width:185px;">Apply Filter</button>

  <!-- delete photo button (host access only)-->
  <?php
  if(isset($_SESSION["HostAccess"])) {
    echo '<button class="btn" onclick="deletePhoto('.$photoID.')" style="width:185px;">Delete</button>';
  }          
  ?>          
  <!--Facebook supplied button-->
      <br>
      <div class="fb-share-button" style="top-margin:10px"
      data-href="<?php echo $filePath?>" data-layout="button_count" data-size="large" data-mobile-iframe="false">
      <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
      class="fb-xfbml-parse-ignore">Share</a>
      </div>
  <!-- end Facebook supplied button-->
</div>
<div id="apply-filter-buttons"> <!-- Wrapper div required for show/hide functions to work-->
  <div class="text-center d-flex justify-content-center" style="font-size:25px">
    <!-- filter dropdown-->
    <div class="form-group" style="font-size:25px">
      <label for="filterDropdown">Select filter:</label>
      <select class="form-control" id="filterDropdown">
        <option value="grayscale">Black and White</option>
        <option value="sepia">Sepia</option>
        <option value="cartoonify">Cartoon</option>
      </select>
      <!-- apply filter button-->
      <button class="btn btn-lg btn-default" onclick="applyFilter()">Apply</button>
      <!-- cancel filter button-->
      <a href="#"><button class="btn btn-lg" onclick="cancelFilter()">Cancel</button></a>
    </div>
  </div>
</div>

<div id="save-filter-buttons"> <!-- Wrapper div required for show/hide functions to work-->
  <div class="text-center d-flex justify-content-center" style="font-size:25px">
    <!-- save filter button-->
        <a id="saveFilter" href="#" download><button class="btn btn-lg btn-default" >Save</button></a>
    <!-- discard filter result button-->
        <a href="#"><button class="btn btn-lg" onclick="cancelFilter()">Discard</button></a>
  </div>
</div>

<div id="testDiv"></div>

</div>

</div>
  <!-- Delete Modal -->
  <div class="modal fade" id="deleteModal" role="dialog">
  <div class="modal-dialog">
  <!-- Modal content-->
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Are you sure you want to permanently delete this image?</h4>            
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-error" data-dismiss="modal">No</button>
      <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="location.href='delete_photo.php?id=<?php echo $photoID ?>';">Yes</button>
      </div>
      </div>
  </div>
  </div>
<script>
  var fileName = "<?php echo $filePath?>";

  function cancelFilter() {
    //Show/hide relevant controls
    document.getElementById("default-buttons").style.display = "block";
    document.getElementById("apply-filter-buttons").style.display = "none";
    document.getElementById("save-filter-buttons").style.display = "none";
    document.getElementById("showImage").src = fileName;
  }

  function filterMode() {
    //Upload image early in preparation for applying filter
    uploadToCloudinary();
    //Show/hide relevant controls
    document.getElementById("default-buttons").style.display = "none";
    document.getElementById("apply-filter-buttons").style.display = "block";
    document.getElementById("save-filter-buttons").style.display = "none";
  }

  function saveFilterResult () {
    //Show/hide relevant controls
    document.getElementById("default-buttons").style.display = "none";
    document.getElementById("apply-filter-buttons").style.display = "none";
    document.getElementById("save-filter-buttons").style.display = "block";
  }

   function goBack() {
    window.history.back()
   }

   function deletePhoto() {
    $('#deleteModal').modal('show');
  }

  cancelFilter();
</script>
<?php include 'ppFooter.php';?>
