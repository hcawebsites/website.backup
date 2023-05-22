<?php  
include_once '../database/connection.php';
extract($_POST);
$data = "";
foreach($criteria_id as $first => $second){
	$update[] = mysqli_query($con, "UPDATE criteria Set Order_BY = '$first' WHERE ID = '$second'");
}
if(isset($update) && count($update)){
			return 1;
}
?>