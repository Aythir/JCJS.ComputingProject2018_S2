<?php
  //connect to database
  $title = "Host Login Page";
?>
<?php include 'databaseConnection.php';?>
<?php include 'guestHeader.php';?>

      <div class= "login-form offset-md-3">
        <h3 class="h3-responsive font-weight-bold" style="color:grey" >Host Login</h3>    

       <!--Login form-->  
       <form method="post" action="hostLoginProcessor.php">
         <div class="form-group">
            <div class="container">
             
             <div class="form-group">
              <label for="uname" style="font-weight:bold">Event ID:</label>
              <input type="text" class="form control" maxlength = "30" placeholder="Enter Event ID" id="EventID" name="EventID" required>
              </div>
              
              <div class="form-group">
                <label for="pwd" style="font-weight:bold">Access Code:</label>
                <input type="password" class="form-control" maxlength = "10" placeholder="Enter Host Access Code" id="Password" name="Password" required>
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
