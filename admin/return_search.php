<?php  
include_once '../database/connection.php';

if ($_POST) {
	$name = mysqli_real_escape_String($con, $_POST['value']);
	$output = "";
	$get = mysqli_query($con, "SELECT * FROM borrow_books WHERE Fullname = '$name' AND Status = '0'");
	if (mysqli_num_rows($get) > 0) {
		while ($row = mysqli_fetch_assoc($get)) {
			$date = date("M. d, Y", strtotime($row['Date_Borrow']));
			$output .= 
			"
			<tr style='color: #666666; font-size: 13px;'>
				<td>".$row['Title']."</td>
				<td>".$row['Fullname']."</td>
				<td>".$date."</td>
			</tr>

			";
		}
	}else{
		$output .=
		"
			<tr style='color: #666666; font-size: 13px;'>
				<td colspan='3' class='text-center'>No record found</td>
			</tr>
		";
	}
	echo $output;
}



?>