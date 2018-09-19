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
        <div class="row" style="margin-top:80px">
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
                  <br><br>
                  <!--Terms of Use and Privacy Policy text and links-->
                    <h6 style="color: white"><i>By continuing, you agree to the
                    <a style="color:white" data-toggle="modal" href="#myTermsModal">Terms of Use and Privacy Policy</i></a></h6>
                  <!-- line -->
                  <hr class="hr-light mb-3 mt-4">
                </div>
              </div>
            </div>
            <!--Form-->
          </div>
          <!--Grid column-->
        </div>
        <!--Grid row-->
      </div>
            <!-- Terms of Use ...Modal -->
      <div id="myTermsModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
           <!-- Modal content-->
          <div class="modal-content">
          
            <div class="modal-header">
                 <h4>Terms of Use and Privacy Notice</h4>
                 <button type="button" style ="align:right" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <p>Thanks for using Little Red Photobooth and our unique Photobooth Management System.
              The services we offer bring event photos to life, enabling guests to access and share
              photos taken in our photobooth during the event and photos uploaded by guests.</p>
              <p>By using the services, you indicate that you accept these Terms.</p>
              <p style="font-weight:bold">What information do we collect?</p>
              <p>No personal information is collected. Access to services are via a unique event code
              or photobooth session code supplied to you by the event host.
              No email or other data is required.</p>
              <p style="font-weight:bold">How do we keep event photos secure?</label>
              <p>All photos that are taken during Photobooth photo sessions or are uploaded from a device
              are kept confidential. Various electronic and physical security systems are maintained
              to ensure the safety of photos.
              Access to photos is restricted and protected by a secure server.
              Photos which we deem as inappropriate will be removed</p>
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
              <h4 class="modal-title" id='modalText'>New Event Created</h4>
            </div>
            <div class="modal-footer">
              <button type="button" id="modalButton" class="btn btn-error" data-dismiss="modal">OK</button>
            </div>
          </div>
        </div>
      </div>

    <!-- SCRIPTS -->
    <?php include 'guestFooter.php';?>
    <script>
      $(document).ready(function() {
          $("#enterButton").click(function(){
            $.post("ajaxSubmitHostCode.php",
            {
                hostCode: document.getElementById('hostCode').value
            },
            function(data, status){
                if(data === "true") {
                  document.getElementById('modalButton').className = "btn btn-success";
                  document.getElementById('modalText').innerHTML = "Host code accepted";
                  document.getElementById("modalButton").onclick = function() {
                    location.href='gallery.php';
                  }                  
                } else {
                  document.getElementById('modalButton').className = "btn btn-danger";
                  document.getElementById('modalText').innerHTML = "Invalid host code";
                }
                $('#myModal').modal('show');
            });
          });
      });
    </script>
</body>
</html>
