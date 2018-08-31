<?php
include 'databaseConnection.php';
include 'functionList.php';

  $title = "Gallery";
  $navbarlinks = createNavLink("Upload Photo","upload_photo.php");
  $navbarlinks .= createNavLink("Slideshow","slideshow.php");
  
  session_start();
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
            $eventID = (int)$_SESSION["EventID"];
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
                $eventID = (int)$_SESSION["EventID"];
                $_SESSION["UniqueCodes"] = array($enteredCode);
            }
        }
      }
  }

  $sql = "SELECT EventName FROM Events WHERE EventID = '$eventID';";
  //echo $sql;
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // output data of each row
      $row = mysqli_fetch_row($result);
      $eventName = $row[0];
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

<div class="modal fade" id="selectorModal" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id='selectorModalText'></h4>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
    </div>
    </div>
</div>
</div>

 <!--Main content-->
 <div class="container-fluid">

    <div class="personal-gallery tz-gallery">
        <h3 class= "responsive-text">Your Photobooth Session: <?php echo $eventName ?></h3>
        <hr>
        <h5>Select two to five photos and click the button to generate your personal GIF!</h5>
        <div id="gifButtons1">
            <button id="create" type="button" class="btn btn-default" onclick="enableSelector();">Create Animation</button>
        </div> 
        <br>       
        <div class= "row">
            <?php
                $sql = "SELECT PhotoID,Filename FROM Photos WHERE EventID = '$eventID' AND IsUserUpload = 1;";
                //echo $sql;
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        //echo '<div class= "col-lg-3 col-sm-6" onclick="location.href=\'showPhoto.php?PhotoID='.$row["PhotoID"].'\'" style="cursor:pointer;">';
                        echo '<div class= "col-lg-3 col-sm-6" style="cursor:pointer;">';
                        echo '<div id="gallery" class="card">';
                        echo '<img src="eventPhotos/'.$eventID.'/'.$row["Filename"].'" class="card-img-top" id="'.$row["PhotoID"].'" style="border:1px solid white">';
                        echo "</div>";
                        echo "</div>";
                    }
                }
            ?>
        </div>
    </div>
    <!-- Public event photo gallery-->
    <div class="user-gallery tz-gallery">
        <h3>Public Event Photos: <?php echo $eventName ?></h3>
        <hr>
        <div class="row">
        <?php
            $sql = "SELECT PhotoID,Filename FROM Photos WHERE EventID = '$eventID' AND IsUserUpload = 0;";
            //echo $sql;
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    //echo '<div class= "col-lg-3 col-sm-6" onclick="location.href=\'showPhoto.php?PhotoID='.$row["PhotoID"].'\'" style="cursor:pointer;">';
                    echo '<div class= "col-lg-3 col-sm-6" style="cursor:pointer;">';
                    echo '<div id="gallery" class="card">';
                    echo '<img src="eventPhotos/'.$eventID.'/'.$row["Filename"].'" class="card-img-top" id="'.$row["PhotoID"].'" style="border:1px solid white">';
                    echo "</div>";
                    echo "</div>";
                }
            }
        ?>
        </div>
        <!-- End row-->
    </div>
    <!-- End user gallery-->

    <div class= "create-gif">
        <div class="personal-gallery">
            <h5>Select two to five photos and click the button to generate your personal GIF!</h5>
            <div id="gifButtons2">
                <button id="create" type="button" class="btn btn-default" onclick="enableSelector();">Create Animation</button>
            </div>
        </div>
    </div>
</div>
<!-- End main content-->
<!--End of Main content-->
<script>
    var selectionArray = [];
    var enableImageSelection = false;

    $(document).ready(function() {
        $("#modalButton").click(function(){
            location.href='ajaxDownloadAllPhotos.php';
        });
    });  
    
    var elems = document.querySelectorAll('.card-img-top');

    for (var i=elems.length; i--;) {
        elems[i].addEventListener('click', imageSelector, false);
    }

    function enableSelector() {
        if(enableImageSelection == false) {
            enableImageSelection = true;
            document.getElementById("selectorModalText").innerHTML = "Image selection is now enabled. Please select 3-5 images and then click 'Create animation from selected images' to create an animated Gif file.";
            document.getElementById("gifButtons1").innerHTML = '<button id="merge" type="button" class="btn btn-default" onclick="mergeSelections();">Merge</button><button id="reset" type="button" class="btn btn-secondary" onclick=" clearSelections();">Reset</button><button id="create" type="button" class="btn btn-default" onclick="enableSelector();">Cancel</button>';
            document.getElementById("gifButtons2").innerHTML = '<button id="merge" type="button" class="btn btn-default" onclick="mergeSelections();">Merge</button><button id="reset" type="button" class="btn btn-secondary" onclick=" clearSelections();">Reset</button><button id="create" type="button" class="btn btn-default" onclick="enableSelector();">Cancel</button>';
            $('#selectorModal').modal('show');
        } else {
            clearSelections();
            enableImageSelection = false;
            document.getElementById("selectorModalText").innerHTML = "Image selection is now disabled. Clicking an image will show you a full size copy of that photo";
            document.getElementById("gifButtons1").innerHTML = '<button id="create" type="button" class="btn btn-default" onclick="enableSelector();">Create Animation</button>';
            document.getElementById("gifButtons2").innerHTML = '<button id="create" type="button" class="btn btn-default" onclick="enableSelector();">Create Animation</button>';
            $('#selectorModal').modal('show');
        }
    }

    function imageSelector() {
        var currentSelection = this.id;

        if (enableImageSelection == false) {
            location.href='showPhoto.php?PhotoID='+currentSelection;
        } else {
            if(jQuery.inArray(currentSelection, selectionArray) == -1) {
                selectionArray.push(currentSelection);
                document.getElementById(currentSelection).style = "border:1px solid red";
            } else {
                document.getElementById(currentSelection).style = "border:1px solid white";
                selectionArray = $.grep(selectionArray, function(value) {
                    return value != currentSelection;
                });            
            }
        }
    }   
    
    function clearSelections() {
        $.each( selectionArray, function( key, value ) {
            document.getElementById(value).style = "border:1px solid white";
            selectionArray = [];
        });        
    }

    function mergeSelections() {
        if(selectionArray.length < 3) {
            document.getElementById("selectorModalText").innerHTML = "No images are selected. Please select 3-5 images and then click 'Create animation from selected images' to create an animated Gif file.";
            $('#selectorModal').modal('show');
        } else if (selectionArray.length > 5) {
            document.getElementById("selectorModalText").innerHTML = "Too many images are selected. Please select 3-5 images and then click 'Create animation from selected images' to create an animated Gif file.";
            $('#selectorModal').modal('show');
        } else {
            location.href='createGif.php?sel='+selectionArray;
        }
    };        
</script>
<?php include 'ppFooter.php';?>
