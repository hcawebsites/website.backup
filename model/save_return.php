<?php
include_once '../database/connection.php';
extract($_POST);

if ($_POST) {
	$id = mysqli_real_escape_string($con, $_POST['isbn']);
	$borrowersID = mysqli_real_escape_string($con, $_POST['borrowersID']);
	$return = mysqli_real_escape_string($con, $_POST['return']);

	$get_book_info = mysqli_query($con, "SELECT Available, Borrowed FROM books WHERE ISBN = '$id'");
	$row = mysqli_fetch_assoc($get_book_info);
	$book_available = $row['Available'];
	$book_avaiable_borrow = $row['Borrowed'];

	$update_return_book = mysqli_query($con, "UPDATE borrow_books Set Status = '0', Date_Returned = '$return' WHERE ISBN = '$id' AND Borrowers_ID = '$borrowersID'");
	if ($update_return_book) {
		$get_borrowed_info = mysqli_query($con, "SELECT COUNT(*) FROM borrow_books Where ISBN = '$id' AND Borrowers_ID = '$borrowersID' AND Status = '0'");
		$row_count = mysqli_fetch_assoc($get_borrowed_info);
		$borrowed_count = $row_count['COUNT(*)'];
		$total_available = $book_available + $borrowed_count;
		$total_borrowed = $book_avaiable_borrow - $borrowed_count;
		mysqli_query($con, "UPDATE books SET Available = '$total_available', Borrowed = '$total_borrowed' WHERE ISBN = '$id'");
}
}

?>