<?php  
include_once 'database/connection.php';

if ($_GET) {
	$grade = $_GET['gid'];
	$get = mysqli_query($con, "SELECT ID FROM grade WHERE Name = '$grade'");
	$row = mysqli_fetch_assoc($get);
	$gid = $row['ID'];
	$output = "";

	$get_fee = mysqli_query($con, "SELECT * from fees Where Grade_ID = '$gid'");
	while ($row = mysqli_fetch_assoc($get_fee)) {
		$output .=
		"
			<tr>
				<td>".$row['Description']."</td>
				<td>".$row['Amount']."</td>
			</tr>
		";
	}
	$get_amount = mysqli_query($con, "SELECT sum(Amount) as total from fees Where Grade_ID = '$gid'");
	$row_amount = mysqli_fetch_assoc($get_amount);
	$output .=
		"
			<tr>
				<td>Total</td>
				<td>".$row_amount['total']."</td>
			</tr>
		";
	echo $output;
}

?>