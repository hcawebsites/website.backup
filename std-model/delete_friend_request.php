<?php session_start();?>
<?php include_once ('../database/connection.php');

if (isset($_GET['id'])) {

	$my_id = $_SESSION['student_id'];
	$friend_id = $_GET['id'];
	$msg=0;

	$sql="DELETE FROM my_friends WHERE My_ID='$my_id' AND Friend_ID='$friend_id'";

	if(mysqli_query($con,$sql)){
		
		$sql1="DELETE FROM my_friends WHERE My_ID='$friend_id' AND Friend_ID='$my_id'";	
		
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