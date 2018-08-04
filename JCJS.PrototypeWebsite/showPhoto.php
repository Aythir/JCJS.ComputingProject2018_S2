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
  //$navbarlinks .= createNavLink("Create Gif","#");
  $navbarlinks .= createNavLink("Upload Photo","upload_photo.php");
  $navbarlinks .= createNavLink("Apply Filters","#");
  $navbarlinks .= createNavLink("Host Login","host_login.php");
?>
<?php include 'guestHeader.php';?>          
<!-- Content -->
<div class="container-liquid">


  <div class="personal-gallery tz-gallery" style="margin-top:80px">
    <!--Grid row-->
        
    <!-- selected large images -->
    <!-- original image -->
    <div class="row m-0" style="margin-top:10px">
      <figure class="col-md-12 p-1 ">
        <img alt="picture" src='eventPhotos/<?php echo $eventID."/".$fileName?>' class="img-fluid" >
      </figure>
    </div>

    <div class="text-center d-flex justify-content-center" style="font-size:25px">
      <!-- save button-->
          <a href="#"><button class="btn">Save To Device</button></a>
      <!-- save button-->
          <a href="#"><button class="btn">Apply Filter</button></a>

          <span class="align-middle">Share:</span>
      <!-- facebook-->
          <a class="p-2 m-2 fb-ic" >
             <i class="fa fa-facebook red-text"></i></a>
     <!-- instragram-->
          <a class="p-2 m-2 ins-ic">
            <i class="fa fa-instagram red-text"> </i></a>
    </div>

  </div>

</div>
<?php include 'ppFooter.php';?>
