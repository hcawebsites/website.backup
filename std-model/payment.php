<?php include_once ('../database/connection.php');?>
<?php include_once "../phpqrcode/qrlib.php"; 
use PHPMailer\PHPMailer\PHPMailer;


$id = mysqli_real_escape_string($con, $_POST['std_id']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$account_name = mysqli_real_escape_string($con, $_POST['aname']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$type = mysqli_real_escape_string($con, $_POST['type']);
$balance = mysqli_real_escape_string($con, $_POST['balance']);
$amount = mysqli_real_escape_string($con, $_POST['amount']);

$totalBalance = (int)$balance - (int)$amount;
$location1 = "../payment_qrcode/".time().".png";
$qrimage = time().".png";

$prefix = substr(str_shuffle(implode("",range("A","Z"))),0,3);
$code = $prefix."-".(sprintf("%'.012d",rand(1,999999999999)));

$due = date("Y-m-d", strtotime("+1 month"));
$payment_date = date("F j, Y");

$query_history = mysqli_query($con, "INSERT INTO payment_history (OR_Number, Student_ID, Account_Name, Account_Email, Payment_Type, Paid_Amount, Balance,
QR_Code) Values ('$code', '$id', '$account_name', '$email', '$type', '$amount', '$totalBalance', '$qrimage')");
$last_id = mysqli_insert_id($con);

if ($query_history) {
        $subject = "Payment Notification";
        $htmlContent = '
           <html> 
                <body style="margin: 0; padding: 0; font-weight: 300; list-style-type: none; background-color: #d9d9d9;"> 
                    <div style="padding: 2rem 2rem 2rem 2rem; text-align: center;">
                        <img src="https://portalhcamis.000webhostapp.com/assets/image/holy_logo.jpg" width="100px" height="100px" style="border-radius: 100%;">
                        <h1 style="color: #5c5c5c; font-size: 33px; font-weight: 600;">Payment Confirmation</h1>
                        <p style="color: #333; font-size: 16px; font-weight: 300;">This is to confirm that your payment has been completed!</b></p>
                        <p style="color: #333; font-size: 16px; font-weight: 300;">To login you may click the button below.</p>
                        
                       <p>OR No: <b>'.$code.'</b></p>
                       <p>Date of Payment: <b>'.$payment_date.'</b></p>
                       <p>Payment Type: <b>'.$type.'</b></p>
                       <p>Total Credit: <b>'.$balance.'</b></p>
                       <p>Amount: <b>'.$amount.'</b></p>
                       <p>Balance: <b>'.$totalBalance.'</b></p>
                       <p style="color: #333; font-size: 16px; font-weight: 300;">Thank You and God Blessed!.</p>
   
                        <a href="https://portalhcamis.000webhostapp.com/student/std_login.php" style=" margin-top: 100px; text-decoration: none; color: #fff; background-color: #008CFF; padding: 1rem 1rem 1rem 1rem; border-radius: 10px;">Click Here!</a>
                    </div>
                </body> 
            </html>
        ';
        $headers = "MIME-Version: 1.0" . "\r\n"; 
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        if(mail($email, $subject, $htmlContent, $headers)){
            echo 'success';
            mysqli_query($con, "UPDATE payments SET Due_Date = '$due', Balance = '$totalBalance' WHERE Student_ID = '$id'");
            QRcode::png($code, $location1 , 150, 150);
            mysqli_query($con, "DELETE from student_fees WHERE Student_ID = '$id'");
        }

}











?>