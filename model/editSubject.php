<?php
include_once '../database/connection.php';
extract($_POST);

$id = mysqli_real_escape_string($con, $_POST['id1']);
$code = mysqli_real_escape_string($con, $_POST['code1']);
$title = mysqli_real_escape_string($con, $_POST['title1']);
$level = mysqli_real_escape_string($con, $_POST['level1']);
$dept = mysqli_real_escape_string($con, $_POST['dept1']);

$sql = "UPDATE subjects SET Subject_Code = '$code', Description = '$title', Level = '$level', Department = '$dept' WHERE ID = '$id'";
$result = mysqli_query($con, $sql);

if ($result) {
	echo 'success';
}



 ?>