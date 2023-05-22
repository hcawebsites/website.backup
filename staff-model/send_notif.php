<?php  
include_once '../js/smsApiController.php';
include_once '../database/connection.php';

if ($_POST) {
	$std_id = mysqli_real_escape_string($con, $_POST['std_id']);
	$get = mysqli_query($con, "SELECT queuing.Contact as contact, queuing.Number as ticket, staff_tb.Cashier as cashier from queuing inner join student on queuing.Student_ID = student.Student_ID inner join staff_tb on queuing.Cashier = staff_tb.Emp_ID WHERE queuing.Student_ID = '$std_id'");
	$row = mysqli_fetch_assoc($get);
	$number = $row['contact'];
	$ticket = $row['ticket'];
	$cashier = $row['cashier'];
	$message = 
	"
		Ticket No. ".$ticket." is now being served. Please proceed to ".$cashier."
	";

	$send = new smsApiController();
	$send -> text($number, $message);
}

?>