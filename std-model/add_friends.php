<?php
error_reporting(0);
include_once('../database/connection.php');
if ($_POST) {
	$data = explode(",", $_POST['data']);
	$role = $data[0];
	$myID = $data[1];
	$friend_role = $data[2];
	$fid = $data[3];

	$id = mysqli_query($con, "SELECT ID FROM my_friends ORDER BY ID DESC LIMIT 1");
	$row=mysqli_fetch_assoc($id);
	$last_id=$row['ID'];
	$conversation_id=$last_id+1; 

	$insert = mysqli_query($con, "INSERT INTO my_friends(My_ID, Friend_ID , Status, Conversation_ID , My_type, Friend_Type) VALUES ('$myID', '$fid', 'Friend_Request_Sent', '$conversation_id', '$role', '$friend_role')");

	$insert1 = mysqli_query($con, "INSERT INTO my_friends(My_ID, Friend_ID , Status, Conversation_ID , My_type, Friend_Type) VALUES ('$fid', '$myID', 'Pending', '$conversation_id', '$friend_role', '$role')");

	if ($insert && $insert1) {
		echo "Friend_Request_Sent";
	}
}
?>