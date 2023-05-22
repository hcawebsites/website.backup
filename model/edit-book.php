<?php  
include_once '../database/connection.php';

extract($_POST);

if ($_POST) {
	$id = mysqli_real_escape_string($con, $_POST['id']);
	$code = mysqli_real_escape_string($con, $_POST['code']);
   	$title = mysqli_real_escape_string($con, $_POST['title']);
   	$subtitle = mysqli_real_escape_string($con, $_POST['subtitle']);
   	$author = mysqli_real_escape_string($con, $_POST['author']);
   	$sub_author = mysqli_real_escape_string($con, $_POST['subAuthor']);
   	$category = mysqli_real_escape_string($con, $_POST['category']);
   	$total = mysqli_real_escape_string($con, $_POST['total']);
   	$callnumber = mysqli_real_escape_string($con, $_POST['callNumber']);

   	mysqli_query($con, "UPDATE books SET ISBN = '$code', Title = '$title', Subtitle = '$subtitle', Author = '$author', Sub_Author = '$sub_author', Category = '$category', Total = '$total', Available = '$total', Call_Number = '$callnumber' Where ID = '$id'");
   	echo "success";
}

?>