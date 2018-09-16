<?php include 'databaseConnection.php';?>
<?php include 'functionList.php';?>
<?php
  $title = "Admin Change Password";
  $navbarlinks = createNavLink("Create Event","admin_create_event.php");
  $navbarlinks .= createNavLink("Event List","admin_event_details.php");
  $navbarlinks .= createLogout();
?>
<?php include 'adminHeader.php';?>
<style>

/* The message box is shown when the user clicks on the password field */
#message {
    display:none;
    /* background: #f1f1f1; */
    color: #000;
    position: relative;
    padding: 5px;
}

#message p {
    padding: 0px 35px;
    font-size: 15px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
    color: green;
}

.valid:before {
    position: relative;
    left: -35px;
    content: "✔";
}

/* Add a red text color and an "x" icon when the requirements are wrong */
.invalid {
    color: red;
}

.invalid:before {
    position: relative;
    left: -35px;
    content: "✖";
}
</style>
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
              <input type="password" class="form control" maxlength = "20" placeholder="Enter your current password" name="pwd" id="pwd" required>
              </div>

              <div class="form-group">
                <label for="pwd1"style="font-weight:bold">New Password:</label>
                <input type="password" id="pwd1" name="pwd1" class="form-control" maxlength = "20" placeholder="Enter new password"
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
              </div>

              <div class="form-group">
                <label for="pwd2"style="font-weight:bold">Confirm new password:</label>
                <input type="password" class="form-control" maxlength = "20" placeholder="Re-enter new password" name="pwd2" id="pwd2"
                title="Must match the new password entered"required>
              </div>
              <button type="submit" class="btn">Reset Password</button>

              <div id="message">
                <h6 style="font-weight:bold; color:grey">Password must contain the following:</h6>
                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                <p id="number" class="invalid">A <b>number</b></p>
                <p id="length" class="invalid">Minimum <b>8 characters</b></p>
              </div>

                <script>
                var myInput = document.getElementById("pwd1");
                var letter = document.getElementById("letter");
                var capital = document.getElementById("capital");
                var number = document.getElementById("number");
                var length = document.getElementById("length");

                // When the user clicks on the password field, show the message box
                myInput.onfocus = function() {
                  document.getElementById("message").style.display = "block";
                }

                // When the user clicks outside of the password field, hide the message box
                myInput.onblur = function() {
                  document.getElementById("message").style.display = "none";
                }

                // When the user starts to type something inside the password field
                myInput.onkeyup = function() {
                  // Validate lowercase letters
                  var lowerCaseLetters = /[a-z]/g;
                  if(myInput.value.match(lowerCaseLetters)) {
                    letter.classList.remove("invalid");
                    letter.classList.add("valid");
                  } else {
                    letter.classList.remove("valid");
                    letter.classList.add("invalid");
                }

                  // Validate capital letters
                  var upperCaseLetters = /[A-Z]/g;
                  if(myInput.value.match(upperCaseLetters)) {
                    capital.classList.remove("invalid");
                    capital.classList.add("valid");
                  } else {
                    capital.classList.remove("valid");
                    capital.classList.add("invalid");
                  }

                  // Validate numbers
                  var numbers = /[0-9]/g;
                  if(myInput.value.match(numbers)) {
                    number.classList.remove("invalid");
                    number.classList.add("valid");
                  } else {
                    number.classList.remove("valid");
                    number.classList.add("invalid");
                  }

                  // Validate length
                  if(myInput.value.length >= 8) {
                    length.classList.remove("invalid");
                    length.classList.add("valid");
                  } else {
                    length.classList.remove("valid");
                    length.classList.add("invalid");
                  }
                }
                </script>
            </div>
          </div>
        </form>
      </div>
     </div>
   </div>
  </div>

<?php include 'ppFooter.php';?>
