<?php
include_once ('../database/connection.php');
use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST['save'])) {
	$code = mysqli_real_escape_string($con, $_POST['code']);
	$title = mysqli_real_escape_string($con, $_POST['title']);
	$author = mysqli_real_escape_string($con, $_POST['name']);
	$category = mysqli_real_escape_string($con, $_POST['category']);
	$studentID = mysqli_real_escape_string($con, $_POST['studentID']);
	$name = mysqli_real_escape_string($con, $_POST['fullname']);
	$contact = mysqli_real_escape_string($con, $_POST['contact']);

	$sql = "INSERT INTO borrow_books (ISBN, Title, Author, Category, Borrowers_ID, Fullname, Contact, Status) VALUES ('$code', '$title', '$author', '$category', '$studentID', '$name', '$contact', '1')";
	$result = mysqli_query($con, $sql);

	if ($result) {
		echo '<script>
			  alert("Request to Borrow Book Send Success!");
			  window.location.href="../student/request_borrow_book.php";

		</script>';
	}
}



?>