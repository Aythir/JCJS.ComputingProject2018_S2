<?php
  //connect to database
  $title = "Event Login";
?>
<?php include 'databaseConnection.php';?>
<?php include 'guestHeader.php';?>
      <div class= "login-form offset-md-3">
        <h3 class="h3-responsive font-weight-bold" style="color:grey" ><?php echo $title?></h3>    

       <!--Login form-->  
       <form method="post" action="guestLoginProcessor.php">
         <div class="form-group">
            <div class="container">
             
              <div class="form-group">
                <label for="pwd" style="font-weight:bold">Access Code:</label>
                <input type="password" class="form-control" maxlength = "10" placeholder="Enter Access Code" id="Password" name="Password" required>
              </div>
              
              <button type="submit" class="btn">Submit</button>
               
            </div>
          </div>
        </form>
      </div>
   </div>
  </div> 

 </body>
</html>
