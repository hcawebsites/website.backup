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
    <title>HCAMIS Portal | Login</title>
</head>
<body>
    
    <div class="container">
            <div class="col-md-6 login-box" id="login" style="display:block">

            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="col-lg-12 login-key text-center">
                            <img src="assets/image/holy_logo.jpg" width="100px">
                        </div>
                        <div class="col-lg-12 login-title text-center">
                            Welcome To Holy Child Academy Portal
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">USERNAME:</label>
                            <input type="username" name="username" id="username" class="form-control" required>
                        </div>

                        <div class="form-group password">
                            <label class="form-control-label">PASSWORD:</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                            <i class="fa fa-eye icon2" onclick="showHide()"></i>
                            <a href="forgot-password.php">Forgot Password?</a>
                        </div>

                        <div class="form-group btmm">
                            <button type="submit" name="login" id="login" class="btn btn-info form-control">LOGIN</button>
                        </div>

                        <div class="text-center createbtn">
                            <p style="color: #fff">Not yet a member?<b><a href="" data-toggle="modal" data-target="#signup">&nbspClick Here</a></b></p>
                        </div>
                        
                    </div>
                </div>
            </form>


                       
            </div>
                
            
    </div>





</body>

<div class="modal fade" id="signup" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h2 class="modal-title">Sign Up</h2>
        <p>It's quick and easy.</p>
      </div>
      <div class="modal-body">
        <form action="" method="Post">
          <div class="row">
          <div class="col-md-12">
              <label for="">Access:</label>
              <select name="access" id="access" class="form-control" required>
                <option value="" disabled selected>Select Access</option>
                <option value="Teacher">Teacher</option>
                <option value="Librarian">Librarian</option>
                <option value="Nurse">Nurse</option>
                <option value="Counsilor">Counsilor</option>
                <option value="Cashier">Cashier</option>
              </select>
            </div>

            <div class="col-md-12">
              <label for="">Lastname:</label>
              <input type="text" name="lastname" id="lastname" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label for="">Firstname:</label>
              <input type="text" name="firstname" id="firstname" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label for="">Middlname:</label>
              <input type="text" name="middlename" id="middlename" class="form-control" required>
            </div>
            
            <div class="col-md-12">
              <label for="">Contact:</label>
              <input type="tel" pattern="[+63]{3}-[0-9]{10}" value="+63-" required name="contact" id="contact" class="form-control" required>
              <small style="font-weight: 600;">Format: +63-9514762574</small>
            </div>
            <div class="col-md-12">
              <label for="">Email:</label>
              <input type="email" name="email" id="email" class="form-control" required>
            </div>

            
          </div>
       
      </div>
      <div class="modal-footer">
        <button type="submit" name="signup" id="signup" class="btn btn-success">Sign Up</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>

function showHide() {
  var x = document.getElementById("password");
  x.style.left = "40%";
  if (x.type === "password") {
    
    x.type = "username";
  } else {
 
    x.type = "password";
    
  }
}
</script>

</html>

