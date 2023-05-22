<?php  
include_once 'database/connection.php';
extract($_GET);
$name = mysqli_real_escape_string($con, $_GET['name_query']);
$contact = mysqli_real_escape_string($con, $_GET['contact_query']);
$email = mysqli_real_escape_string($con, $_GET['email_query']);
$message = mysqli_real_escape_string($con, $_GET['message_query']);

$_insert_queries = mysqli_query($con, "INSERT INTO queries (Name, Contact, Email, Message) VALUES ('$name', '$contact', '$email', '$message')");

if ($_insert_queries) {
	echo "Success";
}else{
	echo "Failed";
}

?>