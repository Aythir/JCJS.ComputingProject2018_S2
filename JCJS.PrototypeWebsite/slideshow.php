<?php include 'functionList.php';?>
<?php
  $title = "Slideshow";
  $navbarlinks = createNavLink("Event Gallery","gallery.php");
  $navbarlinks .= createNavLink("Upload Photo","upload_photo.php");
  $navbarlinks .= createNavLink("Host Login","host_login.php");
  $navbarlinks .= createNavLink("Logout","#");
?>
<?php include 'guestHeader.php';?>
  <!-- Content -->
   <div class="container-liquid">
        <!--Grid row-->
        <div class="row" style="margin-top:80px">
          <!--Grid column-->
         <div class="col black-text text-center">

         </div>
       </div>

   <!--Carousel-->

   <div class="container mt-3">
         <div id="myCarousel" class="carousel slide">

        <!-- Indicators -->
        <ul class="carousel-indicators">
          <li class="item1 active"></li>
          <li class="item2"></li>
          <li class="item3"></li>
        </ul>

   <!-- The slideshow -->
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="eventPhotos/1/photo1.jpg" alt="photo" width="100%" >
          </div>
          <div class="carousel-item">
            <img src="eventPhotos/1/photo2.jpg" alt="Photo" width="100%">
          </div>
          <div class="carousel-item">
            <img src="eventPhotos/1/photo3.jpg" alt="Photo" width="100%">
          </div>
          <div class="carousel-item">
            <img src="eventPhotos/1/photo4.jpg" alt="Photo" width="100%">
          </div>
           <div class="carousel-item">
            <img src="eventPhotos/1/photo5.jpg" alt="Photo" width="100%">
          </div>
           <div class="carousel-item">
            <img src="eventPhotos/1/photo6.jpg" alt="Photo" width="100%">
          </div>

        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#myCarousel" >
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#myCarousel">
          <span class="carousel-control-next-icon"></span>
        </a>

      </div>
   </div>

   <script>
   $(document).ready(function(){
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
   </script>

</div>
</body>
