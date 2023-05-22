<?php include_once ('../std-model/std-forgot-password.php');  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/student/forgot.css">
    <link rel="icon" href="../assets/image/logo.png">
    <title>HCAMIS Portal | Forgot Password</title>
</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <img src="../assets/image/holy_logo.jpg" width="80px">
                </div>
                <div class="col-lg-12 login-title">
                    Forgot Password?
                </div>
				<div class="title-note" text-center>
					Enter your Username and the E-mail you have registered.
				</div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form method="POST" action="">
                            <div class="form-group">
                                <label class="form-control-label">USERNAME</label>
                                <input type="username" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group password">
                                <label class="form-control-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                               
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-12 login-btm login-button">
                                    <button type="submit" name="forgot" class="btn btn-outline-primary form-control">Send</button>
                                </div>
                            </div>

							<div class="back text-center">
								<a href="std_login.php">< Back To Login</a>
							</div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>





</body>
</html>