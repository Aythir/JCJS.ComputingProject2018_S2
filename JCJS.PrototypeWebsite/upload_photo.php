<?php include 'functionList.php';?>
<?php
  $title = "Upload Photo";
  $navbarlinks = createNavLink("Event Gallery","gallery.php");
  $navbarlinks .= createNavLink("Slideshow","slideshow.php");
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
            <h6 class="mb-3 animated fadeInLeft">Choose an exisiting photo(s) from your device
            or take a photo now to upload to the event collection</h6>
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
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
      <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" style="color:red" id='modalText'></h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>  
    <?php
    if(isset($_GET['errorMsg'])) {
      echo "<script>";
      echo "document.getElementById('modalText').innerHTML = '".$_GET['errorMsg']."';";
      echo "$('#myModal').modal('show');";
      echo "</script>";
    }
    ?>      
    <script>
      $("#photoSelect").change(function(){
          document.getElementById("photoForm").submit();
      });
    </script>
