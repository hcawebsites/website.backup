<?php include_once '../database/connection.php';
if(isset($_POST['deletedata']))
{
	 $id = $_POST['delete_id'];
     $sql = "DELETE FROM user WHERE ID= '$id'";
     $delete = mysqli_query($con, $sql);
	 
	 if ($delete) {
	 	header('location:../admin/users.php?info=Accout Deleted Successfully!');
	 }else{
	 	header('location:../admin/users.php?error=Accout Deleted Failed!');
	 }
}
?>