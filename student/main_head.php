<?php session_start(); 
require ('../database/connection.php');
include("../classes/post.php");
?>

<?php 
 
if (!isset($_SESSION['username'])) {
   echo "
   <script>
   alert('Access Denied!');
   window.location.href='std_login.php';
   </script>
   ";
 }
?>

<!DOCTYPE html>
<html>
 
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HCAMIS</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <script src="https://www.paypal.com/sdk/js?client-id=AYG8b9yzQoTiwvCW-ciiAusjV2bJuMm17KLloxtSDfDqBB-h4JeGVNWen1joJozH-IY-q-863iwLxP7L"></script>
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
 
  <!--Charts Links-->
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <!-- End -->


  <!-- Camera Links -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <!-- END -->


  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/student/main.css">

  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  
  
  <link rel="icon" href="../assets/image/logo.png">
    
  <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>

  <script src="../bootstrap/js/bootstrap.min.js"></script>
 
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
  <script src="../plugins/iCheck/icheck.min.js"></script>

  <script src="../dist/js/app.min.js"></script>
    
  <script src="../dist/js/demo.js"></script>

  <script src="html2canvas.js"></script>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" >
  <script src="https://cdnjs.cloudflare.com/ajax/libs/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  
</head>

