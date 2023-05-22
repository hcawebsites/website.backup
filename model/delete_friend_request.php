
<?php include_once ('../database/connection.php');

if (isset($_GET["do"])&&($_GET["do"]=="delete_friends")){

	$my_index=$_GET['myID'];
	$friend_index=$_GET['user_id'];
	$msg=0;

	$sql="DELETE FROM my_friends WHERE My_ID='$my_index' AND Friend_ID='$friend_index'";

	if(mysqli_query($con,$sql)){
		
		$sql1="DELETE FROM my_friends WHERE My_ID='$friend_index' AND Friend_ID='$my_index'";	
		
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