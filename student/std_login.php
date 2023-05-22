<?php include_once ('../std-model/std-login-model.php');  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script>
    window.history.forward();
  	</script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/student/login.css">
    <link rel="icon" href="../assets/image/logo.png">
    <title>HCAMIS Portal | Login</title>
</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <img src="../assets/image/holy_logo.jpg" width="100px">
                </div>
                <div class="col-lg-12 login-title">
                    Welcome To Holy Child Academy Portal
                    
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form method="POST" action="">
                            <div class="form-group">
                                <label class="form-control-label">USERNAME</label>
                                <input type="username" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group password">
                                <label class="form-control-label">PASSWORD</label>
                                <input type="password" name="password" id="password" class="form-control"required>
                                <i class="fa fa-eye icon2" onclick="showHide()"></i>
                                <a href="../forgot-password.php">Forgot Password?</a>
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-12 login-btm login-button">
                                    <button type="submit" name="login" id="login" class="btn btn-outline-primary form-control">LOGIN</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>





</body>
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