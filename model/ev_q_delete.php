<?php
include_once '../database/connection.php';  

extract($_POST);
if ($_POST) {
	$id = mysqli_real_escape_string($con, $_POST['qid']);

	mysqli_query($con, "DELETE FROM ev_questionnaire WHERE ID = '$id'");
}

?>