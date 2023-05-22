<?php
include_once('../database/connection.php');
if(isset($_GET["do"])&&($_GET["do"]=="confirm_notifications_read")){

	$id = $_GET['id'];
	$msg=0;

	$sql = mysqli_query($con, "UPDATE main_notification SET isread = '1' Where Notification_ID = '$id'");

	if($sql){
		$msg+=1; 
	}else{
		$msg+=2; 	
	}
	
	$res=array($msg);
	echo json_encode($res);

}
?>