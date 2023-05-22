<?php  
include_once '../database/connection.php';
include_once "../phpqrcode/qrlib.php"; 
extract($_POST);
if ($_POST) {
	$code = mysqli_real_escape_string($con, $_POST['code']);
	$title = mysqli_real_escape_string($con, $_POST['title']);
	$subtitle = mysqli_real_escape_string($con, $_POST['subtitle']);
	$author = mysqli_real_escape_string($con, $_POST['name']);
	$sub_author = mysqli_real_escape_string($con, $_POST['subAuthor']);
	$category = mysqli_real_escape_string($con, $_POST['category']);
	$total = mysqli_real_escape_string($con, $_POST['total']);
	$date = mysqli_real_escape_string($con, $_POST['publish']);
	$callnumber = mysqli_real_escape_string($con, $_POST['callNumber']);

	$location = "../qrcodeBooks/".$code.".png";
    $qrimage = $code.".png";

    $query_add = mysqli_query($con, "INSERT INTO books (ISBN, Title, Subtitle, Author, Sub_Author, Category, Date_Publish, Total, Available, Call_Number, Status, QR_Code) VALUES ('$code', '$title', '$subtitle', '$author', '$sub_author', '$category', '$date', '$total', '$total', '$callnumber', '0', '$qrimage')");

    if ($query_add) {
    	QRcode::png($code, $location , 150, 150);
    }
}


?>