<?php
  function createNavLink($linkText,$linkURL) {
    return '<li><a class="nav-link" href="'.$linkURL.'">'.$linkText.'</a></li>';
  }
  function createLogout() {
    return '<li><a class="nav-link" onclick="$(\'#logoutModal\').modal(\'show\');">Logout</a></li>';
  }
  function createModalLink() {
    return '<li><a class="nav-link" onclick="$(\'#hostModal\').modal(\'show\');">Download All</a></li>';
  }  
?>