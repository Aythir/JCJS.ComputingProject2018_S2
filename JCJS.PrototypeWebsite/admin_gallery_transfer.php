<?php
    session_start();

    // check that user is logged in before proceeding
    if(isset($_SESSION['AdminID'])) {
        $_SESSION["EventID"] = (int)$_GET["eventID"];
        $_SESSION["HostAccess"] = true;
      
        header("Location: gallery.php");
    } else {
        // if user not logged in then redirect to login page
        header("Location: adminLogin.php?error=1");
    }
?>