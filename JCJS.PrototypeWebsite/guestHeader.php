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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $title?></title>
    <!-- Import jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- Import bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Custom style -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Import font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Are you sure you want to log out now?</h4>            
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-error" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="location.href='logout.php';">Yes</button>
        </div>
        </div>
    </div>
    </div>
        
    <!-- Navbar -->
   <nav class="navbar navbar-expand-sm navbar-light">
      <a class="navbar-brand" href="#"> <!-- Little Red Logo -->
          <img src="img/logo.png" height= "51" width= "60" alt="Little Red Photobooth"></a>
      <!-- Toggler/collapsibe Button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
         <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar Links -->
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <?php
        if(isset($navbarlinks)) {
            echo '<ul class="navbar-nav">';
            echo $navbarlinks;
            echo '</ul>';
        }
      ?>
      </div>
   </nav>

  <!-- Content -->
  <?php if(isset($clearBackground)) {
    echo '<div class="container-liquid-none">';
  } else {
    echo '<div class="container-liquid">';
  }
  ?>
    <!--Grid row-->
    <div class="row" style="margin-top:80px">
          <!--Grid column-->
      <div class="col black-text text-center"></div>
    </div>

   <div class="container">
