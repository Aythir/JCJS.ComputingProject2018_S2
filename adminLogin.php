<?php
  //connect to database
  $title = "Login Page";
  $clearBackground = true;
?>
<?php include 'databaseConnection.php';?>
<?php include 'guestHeader.php';?>

      <div class= "login-form offset-md-3">
        <h3 class="h3-responsive font-weight-bold" style="color:grey" >Administration Login</h3>    

       <!--Login form-->  
       <form method="post" action="adminLoginProcessor.php">
         <div class="form-group">
            <div class="container">
             
             <div class="form-group">
              <label for="uname" style="font-weight:bold">Username:</label>
              <input type="text" class="form control" maxlength = "30" placeholder="Enter username" id="username" name="username" required>
              </div>
              
              <div class="form-group">
                <label for="pwd" style="font-weight:bold">Password:</label>
                <input type="password" class="form-control" maxlength = "10" placeholder="Enter password" id="password" name="password" required>
              </div>
              
              <div class="checkbox">
               <label><input type="checkbox"> Remember me</label>
              </div>
              
              <button type="submit" class="btn">Submit</button>
               
               <div style="padding:15px 0px 0px 0px"> 
                <span class="pwd">Forgot <a href="#">password?</a></span>       
               </div>
            </div>
          </div>
        </form>
      </div>
   </div>
  </div> 

 </body>
</html>
