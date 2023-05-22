<?php include_once '../database/connection.php';

if(isset($_POST['btnDelete']))
{
	 $id = $_POST['deleteID'];
     $sql = "DELETE FROM guidance WHERE ID= '$id'";
     $delete = mysqli_query($con, $sql);
	 
	 if ($delete) {
	 	echo '<script>
         alert("Student Record Deleted Successfully!");
         window.location.href = "../staff/councelor/guidance.php";
         </script>';
	 }
}
?>