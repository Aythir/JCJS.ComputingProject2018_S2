<?php
    include 'databaseConnection.php';
    include 'functionList.php';

    $title = "Slideshow";
    $navbarlinks = createNavLink("Event Gallery","gallery.php");
    $navbarlinks .= createNavLink("Upload Photo","upload_photo.php");

    session_start();
    if(isset($_SESSION["EventID"])) {
        $eventID = (int)$_SESSION["EventID"];
    }  
?>
<?php include 'guestHeader.php';?>
<!--Carousel-->
<div class="container">
    <div id="myCarousel" class="carousel slide">
        <div class="carousel-inner">
            <!-- The slideshow -->
            <?php
            $sql = "SELECT FileName FROM `photos` WHERE eventID = ".$eventID." AND IsUserUpload = 1;";
            //echo $sql;
            $result = $conn->query($sql);

            $idx = 0;
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    if($idx == 0) {
                        echo '<div class="carousel-item active">'."\r\n";
                    }
                    else {
                        echo '<div class="carousel-item">'."\r\n";    
                    }
                    echo "<img src='eventPhotos/".$eventID."/".$row["FileName"]."' alt='photo' width='100%'>"."\r\n";
                    echo "</div>"."\r\n";
                    $idx++;
                }
            }
            ?>
        </div>
        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#myCarousel" ><span class="carousel-control-prev-icon"></span></a>
        <a class="carousel-control-next" href="#myCarousel"><span class="carousel-control-next-icon"></span></a>
    </div>
</div>
<script>
    setTimeout(function() {
        document.getElementById("mainHeader").style.top = "-90px";
        document.getElementById("myCarousel").style.top = "-150px";        
    }, 3000);

    // Activate Carousel
    $("#myCarousel").carousel();

    // Enable Carousel Indicators
    $(".item1").click(function(){
        $("#myCarousel").carousel(0);
    });
    $(".item2").click(function(){
        $("#myCarousel").carousel(1);
    });
    $(".item3").click(function(){
        $("#myCarousel").carousel(2);
    });

    // Enable Carousel Controls
    $(".carousel-control-prev").click(function(){
        $("#myCarousel").carousel("prev");
    });
    $(".carousel-control-next").click(function(){
        $("#myCarousel").carousel("next");
    });
});

// refresh page every 1 minute
setTimeout(function() {
    location.reload();
}, 100000);
</script>
</body>
