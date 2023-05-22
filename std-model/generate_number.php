<?php  
include_once '../database/connection.php';

if (isset($_POST['btn_generate'])) {
	$myID = mysqli_real_escape_string($con, $_POST['myID']);
	$contact = mysqli_real_escape_string($con, $_POST['number']);
	$purpose = mysqli_real_escape_string($con, $_POST['purpose']);
	$cashier = mysqli_real_escape_string($con, $_POST['cashier']);
	$get = mysqli_query($con, "SELECT Emp_ID as cid FROM staff_tb Where Cashier ='$cashier'");
	$row = mysqli_fetch_assoc($get);
	$id = $row['cid'];

	$date = date('Y-m-d');
	
	$check = mysqli_query($con, "SELECT * FROM queuing WHERE Student_ID = '$myID' AND Date = '$date'");
	if (mysqli_num_rows($check) > 0) {
		$std_row = mysqli_fetch_assoc($check);
		$myNum = $std_row['Number'];
		echo "
			<script>
			alert('You already have number!')
			window.location.href= '../reports/print_queue.php?number=".$myNum."&std_id=".$myID."'
			</script>
		";
	}else{
		$code = sprintf("%'.04d",1);
    while(true){
        $chk = mysqli_query($con, "SELECT count(id) as count FROM queuing where Number = '".$code."' and Date = '".date('Y-m-d')."'")->fetch_array()['count'];
        if($chk > 0){
            $code = sprintf("%'.04d",abs($code) + 1);
        }else{
            break;
        }
    }
	$insert = mysqli_query($con, "INSERT INTO queuing (Student_ID, Contact, Purpose, Number, Status, Cashier) VALUES('$myID', '$contact', '$purpose', '$code', 1, '$id')");

	if ($insert) {
		echo "
			<script>
			alert('Please download your number!')
			window.location.href= '../reports/print_queue.php?number=".$code."&std_id=".$myID."'
			</script>
		";
	}
	}
}

?>