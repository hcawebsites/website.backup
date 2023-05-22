<?php include_once 'session_login.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <link rel="stylesheet" href="css/admin/style.css">
    <link rel="icon" href="assets/image/logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>HCAMIS Portal | Forgot Password</title>
</head>
<body>
    
    <div class="container">
            <div class="col-md-6 login-box" id="login" style="display:block">

            <form action="" method="POST" id="forgot-form">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="col-lg-12 login-key text-center">
                            <img src="assets/image/holy_logo.jpg" width="100px">
                        </div>
                        <div class="col-lg-12 login-title text-center">
                           Forgot Password?
                           <p style="font-size:12px; margin-top:10px; font-weight: 400; margin-bottom: 10px;">Enter your Username and the E-mail you have registered. </p>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label">Username:</label>
                            <input type="username" name="username" id="username" class="form-control" required>
                        </div>

                        <div class="form-group password">
                            <label class="form-control-label">Email:</label>
                            <input type="username" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="form-group btmm">
                            <button type="submit" name="login" id="login" class="btn btn-info form-control">Reset Password</button>
                        </div>
                    </div>
                </div>
            </form>
            
            <div class="text-center" style="color:#fff">
                <a href="login.php">< Back to Login</a>
            </div>

                       
            </div>
                
            
    </div>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#forgot-form').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: "reset-password.php",
                type: "POST",
                data: $('#forgot-form').serialize(),
                success:function(data){
                    if(data == "Admin"){
                        const swalWithBootstrapButtons = Swal.mixin({
        				  customClass: {
        				    confirmButton: 'btn btn-success',
        				  },
        				  buttonsStyling: false
        				})
        
        				swalWithBootstrapButtons.fire({
        				  title: 'Password successfully reset!',
        				  text: "Please check your email thank you.",
        				  icon: 'success',
        				  showCancelButton: false,
        				  confirmButtonText: 'Close',
        				}).then((result) => {
        				  if (result.isConfirmed) {
        				    window.location.href="login.php";
        				    }
        				})
                    }else if(data == "Student"){
                        const swalWithBootstrapButtons = Swal.mixin({
        				  customClass: {
        				    confirmButton: 'btn btn-success',
        				  },
        				  buttonsStyling: false
        				})
        
        				swalWithBootstrapButtons.fire({
        				  title: 'Password successfully reset!',
        				  text: "Please check your email thank you.",
        				  icon: 'success',
        				  showCancelButton: false,
        				  confirmButtonText: 'Close',
        				}).then((result) => {
        				  if (result.isConfirmed) {
        				    window.location.href="student/std_login.php";
        				    }
        				})
                    }else{
                        Swal.fire(
            		      data,
            		      '',
            		      'error'
            	    	)
                    }
                }
            })
        })
        
    })
</script>

