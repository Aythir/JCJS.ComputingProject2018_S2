<?php
    session_start();

    // check that user is logged in before proceeding
    if(isset($_SESSION['AdminID'])) {
        // proceed as the user has previously logged in as administrator
        //echo $_SESSION['AdminID'];
    } else {
        // if user not logged in then redirect to login page
        header("Location: admin_Login.php?error=8");
    }
?>