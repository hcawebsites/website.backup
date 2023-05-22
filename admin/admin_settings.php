<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); 
$my
?>

<div class="content-wrapper">
  <title>Account Settings | Change Password</title>
	
    <section class="content-header col-md-12">
    	<h1><i class="fa fa-lock" aria-hidden="true">
        	Admin's Account
        	<small>Preview</small></i>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Admin's Account</a></li>
    	</ol>
      <hr>
      <div class="title">
        <h4 class="text-center"><i class="fa fa-lock" aria-hidden="true"> Change Password</i></h4>
      </div>
      <hr>
	</section>

	 <section class="content">

<?php
$admin_id=$_SESSION["admin_id"];
$my_type=$_SESSION["access"];

include_once('../database/connection.php');

  $sql="SELECT * FROM admin where Admin_ID='$admin_id'";
  $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_assoc($result);
  $image=$row['Picture'];

?>

    <form method="POST" action="" enctype="multipart/form-data" id="change_form">
      <div class="form-row">
        <div class="form-group">
          <label>Administrator's Fullname:</label>
          <input type="text" name="" class="form-control" readonly value="<?php echo $row['Firstname'], " " , $row['Lastname'];?>"><br><br>

          <label>Username:</label>
          <input type="text" name="myID" value="<?php echo $admin_id; ?>" class="form-control" readonly><br>

          <label>Old Password:</label>
          <input type="password" name="oldpass" id="oldpass" placeholder="Input Old Password" class="form-control" minlength="8" maxlength="20" required><br>

          <label>New Password:</label>
          <input type="password" name="newpass" id="newpass" placeholder="Input New Password" class="form-control" minlength="8" maxlength="20" required><br>

          <label>Confirm Password:</label>
          <input type="password" name="cpass" cpass="cpass" placeholder="Confirm Password" class="form-control" minlength="8" maxlength="20" required><br>

          <input type="button" name="change" id="change" class="btn btn-success form-control" value="Submit">




        </div>
        
      </div>
      

    </form>
      
  </section>
      
     
</div>
 <?php include_once 'footer.php'?>
 <script>
     $(document).ready(function(){
         $('#change').click(function(){
             var old = $('#oldpass').val();
             var _new = $('#newpass').val();
             var cpass = $('#cpass').val();
             
             if(old == "" || _new == "" || cpass == ""){
                 Swal.fire(
    		      'All Fields Required!',
    		      '',
    		      'info'
    	    	)
             }else{
                 $.ajax({
                     url: "../model/change-password.php",
                     type: "POST", 
                     data: $('#change_form').serialize(),
                     success:function(data){
                         if(data == "success"){
                             const swalWithBootstrapButtons = Swal.mixin({
            				  customClass: {
            				    confirmButton: 'btn btn-success',
            				  },
            				  buttonsStyling: false
            				})
            
            				swalWithBootstrapButtons.fire({
            				  title: 'Password Change Successfully!',
            				  text: "",
            				  icon: 'success',
            				  showCancelButton: false,
            				  confirmButtonText: 'Close',
            				}).then((result) => {
            				  if (result.isConfirmed) {
            				  	location.reload();
            				    }
            				})
                         }else{
                             Swal.fire(
                		      data,
                		      '',
                		      'warning'
                	    	)
                         }
                     }
                 })
             }
         })
     })
 </script>