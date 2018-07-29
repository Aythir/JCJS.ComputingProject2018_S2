<?php include 'databaseConnection.php';?>
<?php include 'functionList.php';?>
<?php
  $title = "Gallery";
  $navbarlinks = createNavLink("Upload Photo","upload_photo.php");
  $navbarlinks .= createNavLink("Slideshow","slideshow.php");
  $navbarlinks .= createNavLink("Host Login","host_login.php");

  session_start();
  if(isset($_SESSION["EventID"])) {
    $eventID = (int)$_SESSION["EventID"];
  } else {
    header("Location: enterEventCode.php?error=1");
  }  
?>
<?php include 'guestHeader.php';?>
 <!--Main content-->
 <div onload= "img_selection()" class="container-fluid">
    <div class="personal-gallery tz-gallery">
        <h3 class= "responsive-text">Your Photobooth Session</h3>
        <hr>
        <div class= "row">
            <?php
                $sql = "SELECT PhotoID,Filename FROM Photos WHERE EventID = '$eventID' AND ImageType = 3;";
                //echo $sql;
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<div class= "col-lg-3 col-sm-6" onclick="location.href=\'showPhoto.php?PhotoID='.$row["PhotoID"].'\'" style="cursor:pointer;">';
                        echo '<div id="gallery" class="card">';
                        echo '<img src="eventPhotos/'.$eventID.'/'.$row["Filename"].'" class="card-img-top">';
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    header("Location: adminLogin.php?error=1");
                } 
            ?>
        </div>
    </div>
    <!-- Public event photo gallery-->
    <div class="user-gallery tz-gallery">
        <h3>Public Event Photos</h3>
        <hr>
        <div class="row">
        <?php
            $sql = "SELECT PhotoID,Filename FROM Photos WHERE EventID = '$eventID' AND ImageType = 1;";
            //echo $sql;
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<div class= "col-lg-3 col-sm-6" onclick="location.href=\'showPhoto.php?PhotoID='.$row["PhotoID"].'\'" style="cursor:pointer;">';
                    echo '<div id="gallery" class="card">';
                    echo '<img src="eventPhotos/'.$eventID.'/'.$row["Filename"].'" class="card-img-top">';
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                header("Location: adminLogin.php?error=1");
            } 
        ?>        
        </div>
        <!-- End row-->
    </div>
    <!-- End user gallery-->

    <div class= "create-gif">
        <div class="personal-gallery">
            <h5>Select two to five photos and click the button to generate your personal GIF!</h5>
            <button id="reset" type="button" class="btn btn-secondary">Reset</button>
            <button id="create" type="button" class="btn btn-default">Create GIF</button>
        </div>
    </div>
</div>
<!-- End main content-->
<!--End of Main content-->
<?php include 'ppFooter.php';?>