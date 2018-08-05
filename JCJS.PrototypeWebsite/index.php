<?php include 'functionList.php';?>
<?php
  $title = "Enter event code";
?>
<?php include 'guestHeader.php';?>
      <!-- Content -->
      <div class="container-liquid">
        <!--Grid row-->
        <div class="row" style="margin-top:80px">
          <!--Grid column-->
          <div class="col-sm-12 col-md-6 white-text text-center text-md-left">
            <div class="leftcol ml-auto">
            <h1 class="h1-responsive font-weight-bold animated fadeInLeft">Got your code? </h1>
            <hr class="hr-light animated fadeInLeft">
            <h6 class="mb-3 animated fadeInLeft">Enter your unique code or event code here to access your photos. The event code is set by your event host (look for a sign near the booth!). If there's a unique code printed on the top of your photo strip, you can enter that instead.</h6>
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
                    <i class="fa fa-user white-text"></i>  Enter your event or unique code:</h3>
                  <hr class="hr-light">
                </div>
                <!--Body of event code form-->
                <form method="post" action="gallery.php" class="md-form"> <!-- The action method will need to change according to the PHP code implemeneted, but this is a short work around now.-->
                  <i class="fa fa-user prefix white-text active"></i>
                  <input type="text" id="form3" name="code" class="white-text form-control">
                  <label for="form3" class="active">Code</label>

                  <div class="text-center mt-4">
                    <button type="submit" class="btn btn-white" href="gallery.html">Enter</button> <!-- Event code button -->
                  <br><br>
                    <!--Terms of Use and Privacy Policy text and links-->
                    <h6 style="color: white"><i>By continuing, you agree to the <a href="#"style="color: white">Terms of Use</a> and <a href="#"style="color: white">Privacy Policy</i></a></h6>
                  <!-- Social media links to client's social media pages (if any) -->
                  </div>
                </form>

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

    <!-- SCRIPTS -->
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
