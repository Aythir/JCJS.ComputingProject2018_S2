<?php include 'functionList.php';?>
<?php
  $title = "Gallery";
  $navbarlinks = createNavLink("Create Event","admin_create_event.php");
  $navbarlinks .= createNavLink("Change Password","admin_change_password.php");
  $navbarlinks .= createNavLink("Logout","#");
?>
<?php include 'guestHeader.php';?>
<!--Main content-->
<div onload ="imageSelection()" class="container-fluid">
        <div class="personal-gallery tz-gallery">
            <h3 class= "responsive-text">Your photobooth session</h3>
            <hr>
            <div class= "row">
                <div class= "col-lg-3 col-sm-6">
                        <div id="gallery" class="card">
                     
                            <img src="eventPhotos/1/photo11.jpg"  class="card-img-top">
                            
                        </div>
                </div>

                <div  id="gallery" class= "col-lg-3 col-sm-6">
                        <div class="card">
                     
                            <img src="eventPhotos/1/photo10.jpg"  class="card-img-top">
                            
                        </div>

        </div>
        </div>
    </div>
        <!-- Public event photo gallery-->
       <div class="user-gallery tz-gallery">
            <h3>Public Event Photos</h3>
            <hr>
        <div class="row">
               
                         <div class="col-lg-3 col-sm-6">
                             <div id="gallery" class="card">
                          
                                 <img src="eventPhotos/1/photo12.jpg"  class="card-img-top">
                                 
                             </div>
                         </div>

                         <div class="col-lg-3 col-sm-6">
                             <div id="gallery" class="card">
                          
                                 <img src="eventPhotos/1/photo5.jpg" class="card-img-top">
                                 
                             </div>
                         </div>

                         <div class="col-lg-3 col-sm-6">
                             <div id="gallery" class="card">
                          
                                 <img src="eventPhotos/1/photo4.jpg"  class="card-img-top">
                                
                             </div>
                         </div>

                         <div class="col-lg-3 col-sm-6">
                             <div id="gallery" class="card">
                          
                                 <img src="eventPhotos/1/photo3.jpg" class="card-img-top">
                               
                             </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                                <div  id="gallery" class="card">
                                    <img src="eventPhotos/1/photo2.jpg" class="card-img-top">
                                </div>
                           </div>

                           <div class="col-lg-3 col-sm-6">
                                <div id="gallery" class="card">
                                    <img src="eventPhotos/1/photo1.jpg" class="card-img-top">
                                </div>
                           </div>
        </div>
        <!-- End row-->
       </div>
       <!-- End user gallery-->

       <div class= "create-gif">
            <div class="personal-gallery">
                <h5>Select three photos and click the button to generate your personal GIF!</h5>
                <button id="reset" type="button" class="btn btn-secondary">Reset</button>
            
                <button id="create" type="button" class="btn btn-default">Create GIF</button>
           </div>
           </div>
   
        </div>
    
     <!-- End main content-->
<?php include 'ppFooter.php';?>