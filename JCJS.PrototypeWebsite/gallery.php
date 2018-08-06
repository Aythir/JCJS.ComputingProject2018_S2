<?php
include 'databaseConnection.php';
include 'functionList.php';

  $title = "Gallery";
  $navbarlinks = createNavLink("Upload Photo","upload_photo.php");
  $navbarlinks .= createNavLink("Slideshow","slideshow.php");
  $navbarlinks .= createNavLink("Host Login","host_login.php");

  session_start();
  if(isset($_POST["code"])) {
    //check database for code, either in events...
    $enteredCode = $_POST["code"];
    $codeFound = false;
    $sql = "SELECT EventID FROM events WHERE GuestAccessCode = '$enteredCode';";
    //echo $sql;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $codeFound = true;
        $row = mysqli_fetch_row($result);
        $_SESSION["EventID"] = (int)$row[0];
    }

    mysqli_free_result($result);
    //...or if not found above, in photos
    if ($codeFound == false) {
        $sql = "SELECT EventID, UniqueCode FROM photos WHERE UniqueCode = '$enteredCode';";
        //echo $sql;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $codeFound = true;
            $row = mysqli_fetch_row($result);
            $_SESSION["EventID"] = (int)$row[0];
            $_SESSION["UniqueCodes"] = array($enteredCode);
        }
    }
  }
  if(isset($_SESSION["EventID"])) {
    $eventID = (int)$_SESSION["EventID"];
  } else {
    header("Location: enterEventCode.php?error=1");
  }  
?>
<?php include "guestHeader.php";?>
 <!--Main content-->
 <div class="container-fluid">

    <div class="personal-gallery tz-gallery">
        <h3 class= "responsive-text">Your Photobooth Session</h3>
        <hr>
        <div class= "row">
            <?php
                $sql = "SELECT PhotoID,Filename FROM Photos WHERE EventID = '$eventID' AND IsUserUpload = 0;";
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
            $sql = "SELECT PhotoID,Filename FROM Photos WHERE EventID = '$eventID' AND IsUserUpload = 1;";
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
            <button onclick= "img_selection()" id="create" type="button" class="btn btn-default">Create GIF</button>
        </div>
    </div>
</div>
<!-- Intialization Modal-->
<div class="modal fade right" id="ModalDanger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="t`rue">
    <div class="modal-dialog modal-notify modal-danger modal-side modal-top-right" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading">Select your photos</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">

                <div class="row">
                    <div class="col-3">
                    </div>

                    <div class="col-9">
                        <p>Select three desired photos to be placed in your own custom GIF..</p>
                    </div>
                </div>
            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <a type="button" class="btn btn-primary">Get it now <i class="fa fa-diamond ml-1"></i></a>
                <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">No, thanks</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>

<!--'Have you selected all desired photos?' modal--> 

<div class="modal fade right" id="SelectedPhotos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="t`rue">
    <div class="modal-dialog modal-notify modal-danger modal-side modal-top-right" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading">Have you selected all desired photos?</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">

                <div class="row">
                    <div class="col-3">
                    </div>

                    <div class="col-9">
                        <p>Have you selected all desired photos?</p>
                        
                    </div>
                </div>
            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <a  id= "YesButton" type="button" class="btn btn-primary">Yes <i class="fa fa-diamond ml-1"></i></a>
                <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">No</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>

<!--'Please select three photos' modal--> 

<div class="modal fade right" id="SelectPhotosError" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="t`rue">
    <div class="modal-dialog modal-notify modal-danger modal-side modal-top-right" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading">Please select three photos</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">

                <div class="row">
                    <div class="col-3">
                    </div>

                    <div class="col-9">
                        <p>Please select three photos.</p>
                        
                    </div>
                </div>
            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <a type="button" class="btn btn-primary">OK<i class="fa fa-diamond ml-1"></i></a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- End main content-->
<!--End of Main content-->
<?php include 'ppFooter.php';?>