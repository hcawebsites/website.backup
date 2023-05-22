<?php include_once '../database/connection.php';
if(isset($_POST['deletedata']))
{
	 $id = $_POST['delete_id'];
     $sql = "DELETE FROM student_fees WHERE Student_ID= '$id'";
     $delete = mysqli_query($con, $sql);
	 
	 if ($delete) {
	 	echo "<script>alert('Pay List Successfully Deleted!')</script>";
	 	echo "<script>window.location.href='../admin/std-approve-request.php'</script>";
	 }else{
	 	echo "<script>alert('Something went wrong!')</script>";
	 	echo "<script>window.location.href='../admin/std-approve-request.php'</script>";
	 }
}
?>