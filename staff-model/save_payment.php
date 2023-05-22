<?php
include_once '../database/connection.php';
include_once "../phpqrcode/qrlib.php";

if (isset($_POST['save-payment'])) {
	$std_id = mysqli_real_escape_string($con, $_POST['std_id']);
	$cid = mysqli_real_escape_string($con, $_POST['cid']);
	$balance = mysqli_real_escape_string($con, $_POST['balance']);
	$amount = mysqli_real_escape_string($con, $_POST['amount']);
	$type = mysqli_real_escape_string($con, $_POST['type']);
	$bal = (int)$balance - (int)$amount;
	$location = "../payment_qrcode/".time().".png";
	$qrimage = time().".png";
	$due = date("Y-m-d", strtotime("+1 month"));
	$prefix = (sprintf("%'.03d",rand(1,20)));
	$code = $prefix."-".(sprintf("%'.012d",rand(1,999999999999)));

	$insert = mysqli_query($con, "INSERT INTO payment_history (OR_Number, Student_ID, Cashier_ID, Payment_Type, Paid_Amount, Balance, QR_Code) VALUES ('$code', '$std_id', '$cid', '$type', '$amount', '$bal', '$qrimage')");

	if ($insert) {
		mysqli_query($con, "UPDATE payments Set Due_Date = '$due', Balance = '$bal' WHERE Student_ID = '$std_id'");
		QRcode::png($code, $location, 150, 150);
		header('location: ../reports/payment-reciept.php?std_id='.$std_id.'&cid='.$cid.'');
	}


}
?>