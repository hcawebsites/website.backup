<?php
include_once '../database/connection.php';
include_once "../phpqrcode/qrlib.php";
extract($_POST);

if ($_POST) {
	$id = mysqli_real_escape_string($con, $_POST['id']);
	$bookID = mysqli_real_escape_string($con, $_POST['isbn']);
	$title = mysqli_real_escape_string($con, $_POST['title']);
	$auth = mysqli_real_escape_string($con, $_POST['auth']);
	$borrowersID = mysqli_real_escape_string($con, $_POST['borrowersID']);
	$name = mysqli_real_escape_string($con, $_POST['name']);
	$contact = mysqli_real_escape_string($con, $_POST['contact']);

    $get_book_info = mysqli_query($con, "SELECT Available, Borrowed FROM books WHERE ISBN = '$bookID'");
	$row = mysqli_fetch_assoc($get_book_info);
	$available = $row['Available'];
	$borrowed = $row['Borrowed'];

	$book_borrowed = mysqli_query($con, "INSERT INTO borrow_books (ISBN, Title, Author, Borrowers_ID, Fullname, Contact, Status) 
	VALUES ('$bookID', '$title', '$auth', '$borrowersID', '$name', '$contact', '1')");

	if ($book_borrowed) {
		$get_borrowed_info = mysqli_query($con, "SELECT COUNT(*) FROM borrow_books Where ISBN = '$bookID' AND Borrowers_ID = '$borrowersID' AND Status = '1'");
		$row_count = mysqli_fetch_assoc($get_borrowed_info);
		$borrowed_count = $row_count['COUNT(*)'];
		$total_available = $available - $borrowed_count;
		$total_borrowed = $borrowed + $borrowed_count;

		mysqli_query($con, "UPDATE books SET Available = '$total_available', Borrowed = '$total_borrowed' WHERE ISBN = '$bookID'");
	}
}
?>