<?php session_start(); ?>

<?php 
  
  if (!isset($_SESSION['username'])) {
    header('location: ../student/std_login.php');
  }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1.0,
    maximum-scale=1">
    <title>HCAMIS PORTAL</title>
  <script src="https://www.paypal.com/sdk/js?client-id=AYG8b9yzQoTiwvCW-ciiAusjV2bJuMm17KLloxtSDfDqBB-h4JeGVNWen1joJozH-IY-q-863iwLxP7L"></script>
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="main.css">

  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  
  
  <link rel="icon" href="../assets/image/logo.png">
    
  <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>

  <script src="../bootstrap/js/bootstrap.min.js"></script>
 
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
  <script src="../plugins/iCheck/icheck.min.js"></script>

  <script src="../dist/js/app.min.js"></script>
    
  <script src="../dist/js/demo.js"></script>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" >
  

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/3.3.1/jquery.min.js">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
</head>

