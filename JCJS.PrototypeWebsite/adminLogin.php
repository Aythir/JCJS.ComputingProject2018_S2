<?php
  //connect to database
  $title = "Login Page";
  $clearBackground = true;
?>
<?php include 'databaseConnection.php';?>
<?php include 'guestHeader.php';?>
<!--content-->
 <div class="container-liquid" >
   <div class="row" style="margin-top:80px">
     <div class=" container col-md-6">
      <div class= "login-form ">
        <h3 class="h3-responsive font-weight-bold" style="color:white" >Administration Login</h3>

       <!--Login form-->
       <form method="post" action="adminLoginProcessor.php" style="background-color: white">
         <div class="form-group" >
            <div class="container" >

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

               
            </div>
          </div>
        </form>
      </div>
    </div>
    </div>
     </div>
 </div>
  </div>

 </body>
</html>
