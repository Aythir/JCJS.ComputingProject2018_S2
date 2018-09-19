<?php
include 'databaseConnection.php';
include 'functionList.php';
include './scripts/prepareImageByPhotoID.php';

session_start();

$title = "Gallery";
$navbarlinks = createNavLink("Upload Photo","upload_photo.php");
$navbarlinks .= createNavLink("Slideshow","slideshow.php");
if(isset($_SESSION["AdminID"])) $navbarlinks .= createNavLink("Event List","admin_event_details.php");
$navbarlinks .= createMergeButton();

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
        <h4 class="modal-title" id='selectorModalText'>Modal</h4>
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
        <div id="animationText"></div> 
        <div class= "row">
            <?php
                $sql = "SELECT PhotoID,Filename FROM Photos WHERE EventID = '$eventID' AND IsUserUpload = 0;";
                //echo $sql;
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<div class= " col-4 col-lg-3 col-sm-4" style="cursor:pointer; padding:0">';
                        echo '<div class="card">';
                        echo '<img src="eventPhotos/'.$eventID.'/';
                        if(file_exists("eventPhotos/".$eventID."/thumbnails/thumb200_".$row["Filename"])) {
                            echo '/thumbnails/thumb200_';
                        } else {
                            prepareImageByPhotoID($row["PhotoID"]);
                        }
                        echo $row["Filename"].'" class="card-img-top" id="'.$row["PhotoID"].'" alt="Booth Uploaded Photo" style="border:2px solid white">';
                        echo "</div>";
                        echo "</div>";
                    }
                }
            ?>
        </div>
    </div>
   </div>
    <!-- Public event photo gallery-->
    <div class="user-gallery tz-gallery" id='publicGallery'>
        <h3>Public Event Photos: <?php echo $eventName ?></h3>
        <hr>
        <div class="row">
        <?php
            $sql = "SELECT PhotoID,Filename FROM Photos WHERE EventID = '$eventID' AND IsUserUpload = 1;";
            //echo $sql;
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    //echo '<div class= "col-4 col-lg-3 col-sm-4" style="padding:0" onclick="location.href=\'showPhoto.php?PhotoID='.$row["PhotoID"].'\'" style="cursor:pointer;">';
                    echo '<div class= "col-4 col-lg-3 col-sm-4 " style="cursor:pointer; padding:0">';
                    echo '<div class="card">';
                    echo '<img src="eventPhotos/'.$eventID.'/';
                    if(file_exists("eventPhotos/".$eventID."/thumbnails/thumb200_".$row["Filename"])) {
                        echo '/thumbnails/thumb200_';
                    } else {
                        prepareImageByPhotoID($row["PhotoID"]);
                    }
                    echo $row["Filename"].'" class="card-img-top" id="'.$row["PhotoID"].'" alt="Public Gallery Photo" style="border:1px solid white">';
                    echo "</div>";
                    echo "</div>";
                }
            }
        ?>
        </div>
        <!-- End row-->
    </div>
</div>
</div>
<!-- End main content-->
<!--End of Main content-->
<script>
$(document).ready(function () {
    $("myButton").on("click", "a", function () {
        $('.navbar-collapse').collapse('hide');
    });
});

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
            document.getElementById("animationText").innerHTML = '<h5>Select two to five photos and click the button to generate your personal GIF!</h5>';
            document.getElementById("selectorModalText").innerHTML = "Image selection is now enabled. Please select 3-5 images and then click 'Create animation from selected images' to create an animated Gif file.";
            document.getElementById("gifButtons").innerHTML = '<button id="merge" type="button" class="btn btn-default py-2" onclick="mergeSelections();">Create</button><button id="reset" type="button" class="btn btn-secondary py-2" onclick=" clearSelections();">Reset</button><button type="button" class="btn btn-default py-2" onclick="enableSelector();">Cancel</button>';
            $('#selectorModal').modal('show');
            $('#publicGallery').hide();
            $('#bottomNav').show();
        } else {
            clearSelections();
            enableImageSelection = false;
            document.getElementById("selectorModalText").innerHTML = "Image selection is now disabled. Clicking an image will show you a full size copy of that photo";
            document.getElementById("gifButtons").innerHTML = '';
            $('#selectorModal').modal('show');
            $('#publicGallery').show();
            $('#bottomNav').hide();
        }
    }

    function imageSelector() {
        var currentSelection = this.id;

        if (enableImageSelection == false) {
            location.href='showPhoto.php?PhotoID='+currentSelection;
        } else {
            if(jQuery.inArray(currentSelection, selectionArray) == -1) {
                selectionArray.push(currentSelection);
                document.getElementById(currentSelection).style = "border:2px solid red";
            } else {
                document.getElementById(currentSelection).style = "border:2px solid white";
                selectionArray = $.grep(selectionArray, function(value) {
                    return value != currentSelection;
                });            
            }
        }
    }   
    
    function clearSelections() {
        $.each( selectionArray, function( key, value ) {
            document.getElementById(value).style = "border:2px solid white";
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
    $(window).on('load',function(){
        $('#bottomNav').hide();      
    });    
</script>
<nav class="navbar fixed-bottom navbar-expand-sm navbar-dark bg-dark py-0" id='bottomNav'>
    <div class="container py-0" id='gifButtons'>
        <button id="merge" type="button" class="btn btn-default py-2" onclick="mergeSelections();">Create</button>
    </div>
</nav>
<?php include 'ppFooter.php';?>