<?php include 'databaseConnection.php';?>
<?php include 'functionList.php';?>
<?php    
  $title = "Admin Change Password";
  $navbarlinks = createNavLink("Create Event","admin_create_event.php");
  $navbarlinks .= createNavLink("Event List","admin_event_details.php");
  $navbarlinks .= createNavLink("Logout","#");
?>
<?php include 'adminHeader.php';?>
  <!-- Content -->
 <div class="container-liquid" >
    <!--Grid row-->
  <div class="row" style="margin-top:80px">
          <!--Grid column-->
    
     <div class=" container col-md-6">
      <div class= "login-form">
        <h3 class="h3-responsive font-weight-bold" style="color:white" ><?php echo $title?></h3>
    
       <!--Reset password form-->  
       <form action="admin_change_password_processor.php" method="post">
         <div class="form-group">
            <div class="container">
            
              <div class="form-group">
              <label for="pwd" style="font-weight:bold">Current password:</label>
              <input type="password" class="form control" maxlength = "10" placeholder="Enter your current password" name="pwd" id="pwd" required>
              </div>
              
              <div class="form-group">
                <label for="pwd1"style="font-weight:bold">New Password:</label>
                <input type="password" class="form-control" maxlength = "10" placeholder="Enter new password" name="pwd1" id="pwd1" required>
              </div>
              
              <div class="form-group">
                <label for="pwd1"style="font-weight:bold">Confirm new password:</label>
                <input type="password" class="form-control" maxlength = "10" placeholder="Re-enter new password" name="pwd2" id="pwd2" required>
              </div>
              
              <button type="submit" class="btn">Reset Password</button>
              
               <h6 style="padding-top:15px">Password must contain:</h6>
               <ul>
                 <li>8 - 10 characters</li>
                 <li>At least 1 uppercase letter</li>
                 <li>At least 1 lowercase letter</li>
                 <li>At least 1 number</li>
                 <li>At least 1 special character</li>
               </ul>
              
            </div>
          </div>
        </form>
      </div>
   </div>
   </div>
  </div>
<?php include 'ppFooter.php';?>
