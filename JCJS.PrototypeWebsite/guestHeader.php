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
    <style>

form {border: 3px solid  #e6e6e6;
      max-width:550px;
      padding: 5px;
      box-shadow: 2px 2px 1px 1px #cc0052;
      border-radius: 10px;

     }

input[type=text], input[type=password]   {
       width: 100%;
       padding: 12px 20px;
       margin: 3px 0;
       display: inline-block;
       border: 1px solid #ccc;
       box-sizing: border-box;

   }

button{
    background-color: #cc0052;
    margin: 8px 0;
    cursor: pointer;
}

button:hover {
    opacity: 0.8;
}


.container {
    padding: 16px;
}

.container-fluid {
    width: 100%;
    padding-bottom: 10px;
    background-repeat: no-repeat;
    background-size: cover;
    background: #EC6F66;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #F3A183, #EC6F66);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #F3A183, #EC6F66); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
     }

.user-gallery {
       border: 3px solid  #e6e6e6;
       padding: 5px;
       box-shadow: 1px 1px 1px 1px black;
       border-radius: 10px;
       background-color: white;
       position: relative;
     }
.personal-gallery {
       border: 3px solid  #e6e6e6;
       padding: 5px;
       box-shadow: 1px 1px 1px 1px black;
       border-radius: 10px;
       background-color: white;
       position: relative;
       margin-bottom: 15px;
     }

.row {
         margin: 0;
     }


* {
         margin: 0;
         padding: 0;
     }

/* Styles for showPhoto.php */

   .mySlides
   {
      display: none;
   }

   
   figure
      {
        cursor: pointer;
      }

</style>
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
      <a class="navbar-brand" href="gallery.php"> <!-- Little Red Logo -->
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
