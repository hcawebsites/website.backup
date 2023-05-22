<?php
include_once('../database/connection.php');

$data = explode(',', $_POST['data']);
$message = $data[0];
$myID = $data[1];
$fid = $data[2];
$friend_role = $data[3];
$cid = $data[4];

$insert = mysqli_query($con, "INSERT INTO online_chat (Conversation_ID, User_ID , Message, Type)
    VALUES ( '$cid','$myID','$message','$friend_role')");

if ($insert) {
	echo "sent";
}
?>