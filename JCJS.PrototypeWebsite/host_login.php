<?php include 'functionList.php';?>
<?php
  $title = "Host Login Page";
  $navbarlinks = "";
  $navbarlinks .= createNavLink("Event Gallery","gallery.php");
  $navbarlinks .= createNavLink("Upload Photo","upload_photo.php");
  $navbarlinks .= createNavLink("Slideshow","slideshow.php");
?>
<?php include 'guestHeader.php';?>        
      <!-- Content -->
      <div class="container-liquid">
        <!--Grid row-->
        <div class="row">
          <!--Grid column-->
          <div class="col-sm-12 col-md-6 white-text text-center text-md-left">
            <div class="leftcol ml-auto">
            <h1 class="h1-responsive font-weight-bold animated fadeInLeft">Host Login</h1>
            <hr class="hr-light animated fadeInLeft">
            <h6 class="mb-3 animated fadeInLeft">Enter your host code to access event photos.</h6>
          </div>

          </div>
          <!--Grid column-->
          <!--Grid column-->
          <div class="col-sm-12 col-md-6 col-xl-5 mb-4">
            <!--Form for event code-->
            <div class="rightcol card animated fadeInRight">
              <div class="card-body">
                <!--Heading for event code container-->
                <div class="text-center">
                  <h3 class="white-text">
                    <i class="fa fa-user white-text"></i>  Enter your host code:</h3>
                  <hr class="hr-light">
                </div>
                <!--Body of event code form-->
                <div class="md-form">
                  <i class="fa fa-user prefix white-text active"></i>
                  <input type="text" id="hostCode" class="white-text form-control">
                  <label for="form3" class="active">Code</label>

                </div>

                <div class="text-center mt-4">
                  <button id="enterButton" class="btn btn-white">Enter</button> <!-- Event code button -->
                  <!-- Social media links to client's social media pages (if any) -->
                  <hr class="hr-light mb-3 mt-4">
                  <div class="inline-ul text-center d-flex justify-content-center">
                    <a class="p-2 m-2 tw-ic">
                      <i class="fa fa-twitter white-text"></i>
                    </a>
                    <a class="p-2 m-2 ins-ic">
                      <i class="fa fa-instagram white-text"> </i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!--Form-->
          </div>
          <!--Grid column-->
        </div>
        <!--Grid row-->
      </div>
      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" style="color:red" id='modalText'>New Event Created</h4>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-error" data-dismiss="modal">OK</button>
            </div>
          </div>
        </div>
      </div>          

    <!-- SCRIPTS -->
    <script>
      $("enterButton").click(function(){
        console.log(3);
          $.post("demo_test_post.asp",
          {
              hostCode: document.getElementById('hostCode').value
          },
          function(data, status){
              alert("Data: " + data + "\nStatus: " + status);
          });
      }); 

      $(document).ready(function() {
          $("#enterButton").click(function(){
            $.post("ajaxSubmitHostCode.php",
            {
                hostCode: document.getElementById('hostCode').value
            },
            function(data, status){
                if(data === "true") {
                  document.getElementById('modalText').innerHTML = "Host code accepted";
                } else {
                  document.getElementById('modalText').innerHTML = "Invalid host code";
                }
                $('#myModal').modal('show');
            });
          }); 
      });         
    </script>
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
</body>
</html>
