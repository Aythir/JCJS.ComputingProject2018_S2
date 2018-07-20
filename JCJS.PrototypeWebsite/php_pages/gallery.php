<?php include 'functionList.php';?>
<?php
  $title = "Gallery";
  $navbarlinks = createNavLink("Create Event","admin_create_event.php");
  $navbarlinks .= createNavLink("Change Password","admin_change_password.php");
  $navbarlinks .= createNavLink("Logout","#");
?>
<?php include 'guestHeader.php';?>
 <!-- Content -->
   <main>
    <!--Grid row-->
    <div class="row">
      <!--Gallery container-->
      <div class="col-lg-12 col-md-12 mb-12">
      <!--Gallery columns-->
      <div class= "col-lg-3 col-md-6 mb-4">
        <!--Card-->
            <div class="card">

              <!--Card image-->
              <div class="view overlay">
                <img class= "img-fluid" src="img/logo.png" alt= "logo">
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
              <!--Card image-->

            </div>
            <!--Card-->

          </div>
          <!--Firstcolumn-->

      </div>

    </div>
    <!--End of row-->
  </main>
  <!--End of Main content-->
<?php include 'ppFooter.php';?>