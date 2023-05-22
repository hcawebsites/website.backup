<?php

if (!isset($_SESSION['username'])) {
    $error = "Enter Username and Password to use our System...!";
    header('location: index.php');
  }

?>