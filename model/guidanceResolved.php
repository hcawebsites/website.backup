<?php 
include_once '../database/connection.php';

$id = mysqli_real_escape_string($con, $_POST['id']);
$date = date("Y-m-d");
$sql = "UPDATE guidance SET Status = '0', Date_Resolved = '$date' Where ID = '$id'";
$result = mysqli_query($con, $sql);

if ($result) {
    echo 'success';
}

?>