<?php
include_once '../database/connection.php';

if (isset($_POST['saveCriteria'])) {
	$criteria = mysqli_real_escape_string($con, $_POST['criteria']);
	$lastOrder= mysqli_query($con, "SELECT * FROM criteria order by abs(Order_BY) desc limit 1");
		$lastOrder = $lastOrder->num_rows > 0 ? $lastOrder->fetch_array()['Order_BY'] + 1 : 0;

	$insertCriteria = mysqli_query($con, "INSERT INTO criteria (Criteria, Order_BY)VALUES('$criteria', '$lastOrder')");

	if ($insertCriteria) {
		echo "
		<script>
		alert('Criteria Saved!');
		window.location.href = '../admin/ev_criteria.php'
		</script>
		";
	}
}

?>