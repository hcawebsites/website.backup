<?php include_once '../database/connection.php';
if(isset($_POST['deletedata']))
{
	 $id = $_POST['delete_id'];
     $sql = "DELETE FROM denied_tb WHERE ID= '$id'";
     $delete = mysqli_query($con, $sql);
	 
	 if ($delete) {
	 	echo "<script>alert('Deleted Successfully!')</script>";
		echo "<script>window.location.href='../admin/std-denied.php'</script>";
	 }else{
	 	echo "<script>alert('Something went wrong!')</script>";
		echo "<script>window.location.href='../admin/std-denied.php'</script>";
	 }
}
?>