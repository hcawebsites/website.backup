<?php
include_once('../database/connection.php');
if(isset($_GET["do"])&&($_GET["do"]=="add_friends")){
	
	$my_type=$_GET['my_type'];
	$my_index=$_GET['my_index'];
	$friend_access=$_GET['friend_access']; 
	$user_id=$_GET['user_id'];
	
	$msg=0;
	
	$sql1="SELECT * FROM my_friends ORDER BY id DESC LIMIT 1";
	$result1=mysqli_query($con,$sql1);
	$row1=mysqli_fetch_assoc($result1);
	$last_id=$row1['ID'];
	$conversation_id=$last_id+1; 
	
	$sql="INSERT INTO my_friends(My_ID, Friend_ID , Status, Conversation_ID , My_type, Friend_Type) 
          VALUES ( '".$my_index."','".$user_id."','Friend_Request_Sent','".$conversation_id."','".$my_type."','".$friend_access."')";
	  
	if(mysqli_query($con,$sql)){
		
		$sql1="INSERT INTO my_friends(My_ID, Friend_ID, Status, Conversation_ID, My_type, Friend_Type) 
          	  VALUES ( '".$user_id."','".$my_index."','Pending','".$conversation_id."','".$friend_access."','".$my_type."')";
		
		if(mysqli_query($con,$sql1)){
	  		$msg+=1; 
		}
	}else{
		$msg+=2; 	
	}
	
	$res=array($msg);
	echo json_encode($res);

}
?>