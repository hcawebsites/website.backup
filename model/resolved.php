<?php include_once '../database/connection.php';
if (isset($_GET['id'])) {

	$id = $_GET['id'];
    $today = date("Y-d-m"); 
	$sql = "UPDATE `counseling` SET `Status` = '2', Date_Resolved = '$today' WHERE ID = '$id'";
    $result = mysqli_query($con, $sql);

	if ($result) {
		echo '<script>
                alert("Student Counseling Done!");
                window.location.href = "../admin/counseling.php";
            </script>';
		
	}

	
	
}



?>