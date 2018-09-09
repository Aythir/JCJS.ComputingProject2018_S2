<?php
  //connect to database
  $title = "Login Page";
  $clearBackground = true;

  $username = '';
  if(isset($_GET['username'])) {
    $username = $_GET['username'];
  }  
  $navbarlinks = "";

  $username = "";
  $remember_me = "";
  if(isset($_COOKIE["username"])) {
      $username = $_COOKIE["username"];
      $remember_me = " checked";
  }  
?>
<?php include 'databaseConnection.php';?>
<?php include 'guestHeader.php';?>
<!--content-->
  <!-- Logout Modal -->
  <div class="modal fade" id="responseModal" role="dialog">
  <div class="modal-dialog">
  <!-- Modal content-->
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Incorrect username and/or password</h4>            
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-error" data-dismiss="modal">OK</button>
      </div>
      </div>
  </div>
  </div>
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
                    <input type="text" class="form control" maxlength = "30" placeholder="Enter username" id="username" value="<?php echo $username ?>" name="username" required>
                    </div>

                    <div class="form-group">
                      <label for="pwd" style="font-weight:bold">Password:</label>
                      <input type="password" class="form-control" maxlength = "10" placeholder="Enter password" id="password" name="password" required>
                    </div>

                    <div class="checkbox">
                    <label><input type="checkbox" name="remember_me"<?php echo $remember_me ?>> Remember me</label>
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
  <?php
  if(isset($_GET['error'])) {
    if($_GET['error'] == "1") {
      echo "<script>$('#responseModal').modal('show');</script>";
    }
  }
  ?>
</body>
</html>
