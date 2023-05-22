<?php
include_once '../database/connection.php';

extract($_POST);

if ($_POST) {
	$criteria = mysqli_real_escape_string($con, $_POST['criteria']);
	$question = mysqli_real_escape_string($con, $_POST['question']);
	$id = mysqli_real_escape_string($con, $_POST['id']);
	
	if ($id == "") {
		$lastOrder= mysqli_query($con, "SELECT * FROM ev_questionnaire ORDER BY abs(Order_By) desc limit 1");
		$lastOrder = $lastOrder->num_rows > 0 ? $lastOrder->fetch_array()['Order_By'] + 1 : 0;

	mysqli_query($con, "INSERT INTO ev_questionnaire (Question, Order_By, Criteria_ID) Values ('$question', '$lastOrder', '$criteria')");
	}else{
		mysqli_query($con, "UPDATE ev_questionnaire SET Question = '$question' WHERE ID = '$id'");
	}
}
?>