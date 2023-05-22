<?php
include_once('../database/connection.php');
if(isset($_GET["do"])&&($_GET["do"]=="confirm_msg_read")){
	
	$conversation_id=$_GET['conversation_id'];
	$friend_index=$_GET['friend_index'];
	$msg=0;
	
	$sql="UPDATE group_message set isread = '1' where Chatroom_ID = '$conversation_id' and User_ID = '$friend_index'";
	  
	if(mysqli_query($con,$sql)){
		$msg+=1; 
	}else{
		$msg+=2; 	
	}
	
	$res=array($msg);
	echo json_encode($res);//MSK-000143-U-7

}
?>