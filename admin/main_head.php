<?php session_start(); ?>
<?php 
 
if (!isset($_SESSION['username'])) {
   echo "
   <script>
   alert('Access Denied!');
   window.location.href='../login.php';
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

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
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
  <link rel="stylesheet" type="text/css" href="../css/admin/main.css">

  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  
  <link rel="icon" href="../assets/image/logo.png">
    
  <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>

  <script src="../bootstrap/js/bootstrap.min.js"></script>
 
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
  <script src="../plugins/iCheck/icheck.min.js"></script>

  <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->

  <!-- date-range-picker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>

  <script src="../dist/js/app.min.js"></script>
    
  <script src="../dist/js/demo.js"></script>

  <script src="html2canvas.js"></script>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" >
  <script src="https://cdnjs.cloudflare.com/ajax/libs/3.3.1/jquery.min.js"></script>

  <script src="../dist/js/multiselect-dropdown.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

