<?php  include_once ('../staff-model/two-factor-authentication.php');  ?>

<?php 
$id=$_SESSION["username"];
$sql = "SELECT * FROM user Where Username = '$id'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/image/logo.png">
    <link rel="stylesheet" href="../css/admin/otp.css">
    <title>Otp Verification</title>
    <script>
    window.history.forward();
  </script>
</head>
<body>
    <div class="image">
        <img src="../assets/image/otp.png" width="300px">
    </div>

    <div class="info">
        <p>Please enter your code that have sent to your</p>
        <h4>Email Address</h4>
        <h3><?=$email?></h3>
    </div>
    <form action="" method="POST">
        <div class="otp">
            <input type="text" id="ist" name="otp1" maxlength="1" onkeyup="clickEvent(this, 'sec')">
            <input type="text" id="sec" name="otp2" maxlength="1" onkeyup="clickEvent(this, 'third')">
            <input type="text" id="third" name="otp3" maxlength="1" class="spacing" onkeyup="clickEvent(this, 'fourth')">
            <input type="text" id="fourth" name="otp4" maxlength="1" onkeyup="clickEvent(this, 'fifth')">
            <input type="text" id="fifth" name="otp5" maxlength="1" onkeyup="clickEvent(this, 'sixth')">
            <input type="text" id="sixth" name="otp6" maxlength="1">
        </div>

        <input type="submit"  name="verify" value="Validate">

       
    </form>

    <div class="resendCode">
           <p>Didn't receive CODE? <a id="btn">Resend Code</a></p>
    </div>
</body>

<script>

    var timer = 60;
    var myTimer = setInterval(() => {
        document.getElementById('btn').innerHTML = timer-- + " " + "Seconds";
        document.getElementById('btn').href = '#';
        document.getElementById('btn').style.color = 'rgb(224, 224, 224)'

        if (timer == -1) {
            clearInterval(myTimer);
            document.getElementById('btn').innerHTML = "Resend Code";
            document.getElementById('btn').href = '../std-model/resendCode.php';
            document.getElementById('btn').style.color='rgb(31, 75, 251)';
        }
    }, 1000);

    function clickEvent(first,last) {
        if (first.value.length) {
            document.getElementById(last).focus();
        }
    }
</script>
</html>