<?php include 'databaseConnection.php';?>
<?php
    session_start();

    // check that user is logged in before proceeding
    if(isset($_SESSION['AdminID'])) {
        // cast adminid as int to protect against sql injection
        $adminID = (int)$_SESSION["AdminID"];
    } else {
        // if user not logged in then redirect to login page
        header("Location: adminLogin.php?error=1");
    }

    $currentPassword = mysqli_real_escape_string($conn,$_POST["pwd"]);
    $newPassword1 = mysqli_real_escape_string($conn,$_POST["pwd1"]);
    $newPassword2 = mysqli_real_escape_string($conn,$_POST["pwd2"]);

    // check that new passwords match
    if($newPassword1 == $newPassword2) {
        // check password passes complexity requirements with regex
        $pattern = "/(?=(.*[0-9]){1,})(?=.*[\*^!])(?=.*[a-z]{1,})(?=(.*[A-Z]){1,}).{8,10}/";
        if(preg_match($pattern, $newPassword1)){
            //echo "Complexity passes regex check<br>";
            $sql = "SELECT Password FROM `admin` WHERE AdminID = $adminID;";
            //echo $sql;
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
                $verfied = false;
                if (password_verify($currentPassword, $row["Password"])) {
                    // hashed supplied password matches the hash of password in database
                    $verfied = true;
                    //echo "hash matches";
                }
                elseif ($currentPassword == $row["Password"]) {
                    // supplied password matches plaintext password in database
                    $verfied = true;
                    //echo 'password matches';
                }
                $verfied = true;

                if($verfied == true) {
                    // hash the new password before inserting into database
                    $hash = password_hash($newPassword1, PASSWORD_DEFAULT);
                    // update password field
                    $sql = "UPDATE admin SET Password = '$hash' WHERE AdminID = $adminID;";
                    //echo $sql;
                    $result = $conn->query($sql);      
                }
                else {
                    header("Location: admin_change_password.php?error=1a");        
                }
            } else {
                // admin id not found in database or password incorrect so redirect back
                header("Location: admin_change_password.php?error=1b");    
            }
        } else{
            // password does not meet complexity requirements
            header("Location: admin_change_password.php?error=2");
        }
    } else {
        //if new passwords don't match then redirect back to change page
        header("Location: admin_change_password.php?error=3");
    }

    // close database connection
    $conn->close();  

    // redirect to success page
    header("Location: admin_event_details.php?updated=1");
?>