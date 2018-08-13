<?php include 'functionList.php';?>
<?php
  $title = "Upload Photo";
  $navbarlinks = createNavLink("Event Gallery","gallery.php");
  //$navbarlinks .= createNavLink("Create Gif","#");
  $navbarlinks .= createNavLink("Slideshow","slideshow.php");
  $navbarlinks .= createNavLink("Host Login","host_login.php");
  $navbarlinks .= createLogout();
?>
<?php include 'guestHeader.php';?>
  <!-- Content -->
  <div class="container-liquid">
        <!--Grid row-->
        <div class="row" style="margin-top:80px">
          <!--Grid column-->
          <div class="col-sm-12 col-md-6 white-text text-center text-md-left">
            <div class="leftcol ml-auto">
            <h1 class="h1-responsive font-weight-bold animated fadeInLeft">Upload your photo</h1>
            <hr class="hr-light animated fadeInLeft">
            <h5 class="mb-3 animated fadeInLeft">Choose an exisiting photo(s) from your device
            or take a photo now to upload to the event collection</h5>
          </div>

          </div>
          <!--Grid column-->
          <!--Grid column-->
          <div class="col-sm-12 col-md-6 col-xl-5 mb-4">
            <!--animate buttons-->
            <div class="rightcol card animated fadeInRight">
            <div class="card-body">

            <div class="text-center">
              <form action='uploadPhotoProcessor.php' method='post' id='photoForm' enctype="multipart/form-data">
                  <label class="btn btn-white btn-primary btn-file"><input type="file" id='photoSelect' name="fileToUpload" style="display: none;" />SELECT PHOTO(S)</label>
                  <br />
                  <label class="btn btn-white btn-primary btn-file"> TAKE A PHOTO NOW<input type="file" accept="image/*" name='capture' id="capture" capture="camera" style="display: none;"></label>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      $("#photoSelect").change(function(){
          document.getElementById("photoForm").submit();
      });
    </script>
