<?php
  function createNavLink($linkText,$linkURL) {
    return '<li><a class="nav-link" href="'.$linkURL.'">'.$linkText.'</a></li>';
  }
  function createLogout() {
    return '<li><a class="nav-link" onclick="$(\'#logoutModal\').modal(\'show\');">Logout</a></li>';
  }
  function createMergeButton() {
    return '<li><a class="nav-link" onclick="enableSelector();">Create Animation</a></li>';
  }  
  function createModalLink() {
    return '<li><a class="nav-link" onclick="$(\'#hostModal\').modal(\'show\');">Download All</a></li>';
  }  
  function enterUniqueCode() {
    return '<li><a class="nav-link" onclick="$(\'#codeModal\').modal(\'show\');">Enter Unique Code</a></li>';
  }
?>m