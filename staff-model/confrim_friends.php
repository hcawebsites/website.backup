<?php
include_once('../database/connection.php');
if(isset($_GET["do"])&&($_GET["do"]=="confirm_friends")){
	
	$my_index=$_GET['myID'];
	$friend_index=$_GET['user_id'];

	$msg=0;
	
	$sql="UPDATE my_friends set Status='Friend', isread='1' where My_ID ='$my_index' and Friend_ID = '$friend_index'";
	  
	if(mysqli_query($con,$sql)){
		
		$sql1="UPDATE my_friends set Status='Friend' , isread='1' where My_ID='$friend_index' and Friend_ID='$my_index'";
		
		if(mysqli_query($con,$sql1)){
	  		$msg+=1; 
		}
	}else{
		$msg+=2; 	
	}

	$res=array($msg);
	echo json_encode($res);//MSK-000143-U-7

}
?>