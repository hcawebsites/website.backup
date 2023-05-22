<?php
include_once('../database/connection.php');

if(isset($_GET["do"])&&($_GET["do"]=="add_message")){

	$conversation_id = $_GET['conversation_id'];
	$user_index = $_GET['my_index'];
	$msg = $_GET['msg'];
	$user_type = $_GET['user_type'];
	
	$alert=0;
	$msg_count=0;
	
	$sql = mysqli_query($con, "INSERT INTO group_message (Chatroom_ID, User_ID , Message, Type)
    VALUES ( '$conversation_id','$user_index','$msg','$user_type')");
		
	if($sql){

		$alert+=1;
			   
		$result1=mysqli_query($con, "SELECT count(id) FROM group_message
        WHERE User_ID = '$user_index' AND Chatroom_ID = '$conversation_id'");
		$row1=mysqli_fetch_assoc($result1);
		$msg_count=$row1['count(id)'];
		
		
	}else{
		$alert+=2;
	}
				
$res=array($alert,$conversation_id,$msg_count);
echo json_encode($res);//MSK-000143-U-7

}
?>