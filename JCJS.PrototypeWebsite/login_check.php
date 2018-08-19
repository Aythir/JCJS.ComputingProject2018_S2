<?php
    session_start();

    // check that user is logged in before proceeding
    if(isset($_SESSION['EventID'])) {
        // proceed as the guest has entered a valid event code
    } else {
        // if user not logged in then redirect to login page
        header("Location: index.php?error=8");
    }
?>