<?php include_once ('../database/connection.php');?>
<?php include_once "../phpqrcode/qrlib.php"; 
use PHPMailer\PHPMailer\PHPMailer;?>


<?php
    $std_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $account_name = mysqli_real_escape_string($con, $_POST['name']);
    $type = mysqli_real_escape_string($con, $_POST['type']);
    $amount = mysqli_real_escape_string($con, $_POST['amount']);

    $prefix = (sprintf("%'.03d",rand(1,20)));
	$code = $prefix."-".(sprintf("%'.012d",rand(1,999999999999)));
    $get = mysqli_query($con, "SELECT * from student inner join student_fees on student.Student_ID = student_fees.Student_ID WHERE student_fees.Student_ID = '$std_id'");
    $row = mysqli_fetch_assoc($get);
    $total = $row['Total_Fees'];
    $bal = (int)$total - (int)$amount;
    $std_email = $row['Email'];
    $firstname = $row['Firstname'];
    $location1 = "../payment_qrcode/".time().".png";

    $year=date("Y");
	$month=date("F");
	$date=date("Y-m-d");
    $newdate = strtotime($date);

    $date1 = date('M d Y', $newdate);
    
    $qrimage = time().".png";

    $location = "../student_qrcode/".$std_id.".png";
    $stdqr = $std_id.".png";
    $due = date("Y-m-d", strtotime("+1 month"));

    $sql = "UPDATE  std_account SET Access = 'Student', Status = '0' Where Student_ID = '$std_id'";
    $result1 = mysqli_query($con, $sql);
    
    $sql = "UPDATE student SET QR_Code = '$stdqr', Enrollment_Status = 'Enrolled', Enrolled_Month = '$month', Enrolled_Year = '$year', Enrolled_Date = '$date' Where Student_ID = '$std_id'";
    $enrolled = mysqli_query($con, $sql);
    if ($enrolled && $result1) {
        $sql = "INSERT INTO payment_history (OR_Number, Student_ID, Account_Name, Account_Email, Payment_Type, Paid_Amount, Balance,
        QR_Code) Values ('$code', '$std_id', '$account_name', '$email', '$type', '$amount', '$bal', '$qrimage')";
        $query_payment = mysqli_query($con, "INSERT INTO payments (Due_Date, Student_ID, Total, Balance) VALUES ('$due', '$std_id', '$total', '$bal')");
        $payment = mysqli_query($con, $sql);
        if ($payment) {
                    
                    $subject = "Payment Notification";
                    $htmlContent = '
                       <html> 
                            <body style="margin: 0; padding: 0; font-weight: 300; list-style-type: none; background-color: #d9d9d9;"> 
                                <div style="padding: 2rem 2rem 2rem 2rem; text-align: center;">
                                    <img src="https://portalhcamis.000webhostapp.com/assets/image/holy_logo.jpg" width="100px" height="100px" style="border-radius: 100%;">
                                    <h1 style="color: #5c5c5c; font-size: 33px; font-weight: 600;">Payment Confirmation</h1>
                                    <p style="color: #333; font-size: 16px; font-weight: 300;">This is to confirm that your payment has been completed!</b></p>
                                    <p style="color: #333; font-size: 16px; font-weight: 300;">To login you may click the button below.</p>

                                    <p>O.R Number: <b>'.$code.'</b></p>
                                    <p>Date of Payment: <b>'.$date1.'</b></p>
                                    <p>Payment Type: <b>'.$type.'</b></p>
                                    <p>Credit: <b>'.$total.'</b></p>
                                    <p>Advance: <b>'.$amount.'</b></p>
                                    <p>Balance: <b>'.$bal.'</b></p>
                                   <p style="color: #333; font-size: 16px; font-weight: 300;">Thank You and God Blessed!.</p>
                                </div>
                            </body> 
                        </html>
                    ';
                    $headers = "MIME-Version: 1.0" . "\r\n"; 
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    
                    if(mail($std_email, $subject, $htmlContent, $headers)){
                        echo 'success';
                        
                        QRcode::png($code, $location1 , 150, 150);
                        QRcode::png($std_id, $location , 150, 150);
                        mysqli_query($con, "DELETE from student_fees WHERE Student_ID = '$std_id'");
                    }
            }
        }


?>