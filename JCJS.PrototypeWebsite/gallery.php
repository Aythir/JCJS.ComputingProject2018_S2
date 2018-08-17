<?php
include 'databaseConnection.php';
include 'functionList.php';

  $title = "Gallery";
  $navbarlinks = createNavLink("Upload Photo","upload_photo.php");
  $navbarlinks .= createNavLink("Slideshow","slideshow.php");
  
  session_start();
  if(isset($_SESSION["HostAccess"])) {
    $navbarlinks .= createModalLink();
  } else {
    $navbarlinks .= createNavLink("Host Login","host_login.php");
  }

  $navbarlinks .= createLogout();

  if(isset($_SESSION["EventID"])) {
    $eventID = (int)$_SESSION["EventID"];
  }
  else {
    //header("Location: index.php?error=2");

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
  }
?>
<?php include "guestHeader.php";?>

<!-- Modal -->
<div class="modal fade" id="hostModal" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id='modalText'>Are you sure you want to download all photos for this event as a single ZIP file?</h4>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
    <button type="button" id='modalButton' class="btn btn-error" data-dismiss="modal">OK</button>
    </div>
    </div>
</div>
</div>

 <!--Main content-->
 <div onload= "img_selection()" class="container-fluid">
    <div class="personal-gallery tz-gallery">
        <h3 class= "responsive-text">Your Photobooth Session</h3>
        <hr>
        <div class= "row">
            <?php
                $sql = "SELECT PhotoID,Filename FROM Photos WHERE EventID = '$eventID' AND ImageType = 0;";
                //echo $sql;
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<div class= "col-lg-3 col-sm-6" onclick="location.href=\'showPhoto.php?PhotoID='.$row["PhotoID"].'\'" style="cursor:pointer;">';
                        echo '<div id="gallery" class="card">';
                        echo '<img src="eventPhotos/'.$eventID.'/';
                        //Check for existence of thumbnail and append filename if so
                        if (file_exists('eventPhotos/'.$eventID.'/thumbnails/thumb200_'.$row["Filename"])) {
                            echo 'thumbnails/thumb200_'
                        }
                        echo $row["Filename"];
                        echo '" class="card-img-top">';
                        echo "</div>";
                        echo "</div>";
                    }
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
                    echo '<img src="eventPhotos/'.$eventID.'/';
                        //Check for existence of thumbnail and append filename if so
                        if (file_exists('eventPhotos/'.$eventID.'/thumbnails/thumb200_'.$row["Filename"])) {
                            echo 'thumbnails/thumb200_'
                        }
                        echo $row["Filename"];
                    echo '" class="card-img-top">';
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
<script>
    $(document).ready(function() {
        $("#modalButton").click(function(){
            location.href='ajaxDownloadAllPhotos.php';
        });
    });    
</script>
<?php include 'ppFooter.php';?>
