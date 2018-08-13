<?php
//remove PHPSESSID from browser
if (isset($_COOKIE[session_name()])) setcookie(session_name(), "",time()-3600, "/");

//clear session from globals
$_SESSION = array();

//clear session from disk
session_destroy();

//redirect user to login page
header("Location: index.php?error=2");
?>