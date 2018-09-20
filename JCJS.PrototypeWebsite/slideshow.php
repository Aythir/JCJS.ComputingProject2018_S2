<?php
    include 'databaseConnection.php';
    include 'functionList.php';

    $title = "Slideshow";
    $navbarlinks = createNavLink("Event Gallery","gallery.php");
    $navbarlinks .= createNavLink("Upload Photo","upload_photo.php");
    $navbarlinks .= createFullscreenLink();

    session_start();
    if(isset($_SESSION["EventID"])) {
        $eventID = (int)$_SESSION["EventID"];
    }  
?>
<?php include 'guestHeader.php';?>
<div class="container">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="2500" data-wrap="true">
        <div class="carousel-inner">
            <?php
            $sql = "SELECT FileName FROM `photos` WHERE eventID = ".$eventID." AND IsUserUpload = 1;";
            //echo $sql;
            $result = $conn->query($sql);

            $idx = 0;
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    if($idx == 0) {
                        echo '<div class="carousel-item active">';
                    }
                    else {
                        echo '<div class="carousel-item">';
                    }
                    echo "<img src='eventPhotos/".$eventID."/".$row["FileName"]."' alt='photo' style='width:100%;'>";
                    echo "</div>\r\n";
                    $idx++;
                }
            }
            ?>            
        </div>
        <a class="carousel-control-prev" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" role="button" onclick="$('.carousel').carousel('next');" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<?php include 'guestFooter.php';?>
<script>
    var elem = document.getElementById("carouselExampleControls");

    /* View in fullscreen */
    function openFullscreen() {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) { /* Firefox */
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { /* IE/Edge */
            elem.msRequestFullscreen();
        }
        setTimeout(function() {
            $('.carousel').carousel('cycle');
        }, 300);
    }

    /* Close fullscreen */
    function closeFullscreen() {
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.mozCancelFullScreen) { /* Firefox */
        document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
        document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) { /* IE/Edge */
        document.msExitFullscreen();
    }
    }
</script>
</body>