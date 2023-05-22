<?php
include_once('../database/connection.php');

$data = explode(',', $_POST['data']);
$myID = $data[0];
$fid = $data[1];

$update = mysqli_query($con, "UPDATE my_friends set Status='Friend', isread='1' where My_ID ='$myID' and Friend_ID = '$fid'");
$update1 = mysqli_query($con, "UPDATE my_friends set Status='Friend', isread='1' where My_ID ='$fid' and Friend_ID = '$myID'");

if ($update && $update1) {
	echo "Success";
}
?>