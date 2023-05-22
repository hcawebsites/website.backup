<?php  
include_once '../database/connection.php';

if($_POST){
	$access = mysqli_real_escape_string($con, $_POST['access']);
	$output = "";
	$count = 1;

	if ($access == "All") {
		$get_staff = mysqli_query($con, "SELECT * from staff_tb inner join user on staff_tb.Emp_ID = user.Username Order by staff_tb.ID asc");

		while ($row = mysqli_fetch_assoc($get_staff)) {
		$name = $row['Salutation']. ". ". $row['Firstname']. " " .$row['Lastname'];

		$output .=' 
			<tr>
				<td scope="col">'.$count++.'</td>
				<td scope="col">'.$name.'</td>
				<td scope="col">'.$row['Gender'].'</td>
				<td scope="col">'.$row['Age'].'</td>
				<td scope="col">'.$row['Email'].'</td>
				<td scope="col">'.$row['Contact'].'</td>
				<td scope="col">'.$row['Access'].'</td>
				<td scope="col">
					<button type="button" class="btn btn-primary view_btn" id='.$row['Emp_ID'].'><i class="fa fa-eye"></i></button>
					<button type="button" class="btn btn-danger"><i class="fa fa-archive" aria-hidden="true"></i></button>
				</td>
			</tr>
		';
		}
	}else{
		$get_staff = mysqli_query($con, "SELECT * from staff_tb inner join user on staff_tb.Emp_ID = user.Username Where Access = '$access' Order by staff_tb.ID asc");

		while ($row = mysqli_fetch_assoc($get_staff)) {
		$name = $row['Salutation']. ". ". $row['Firstname']. " " .$row['Lastname'];

		$output .=' 
			<tr>
				<td scope="col">'.$count++.'</td>
				<td scope="col">'.$name.'</td>
				<td scope="col">'.$row['Gender'].'</td>
				<td scope="col">'.$row['Age'].'</td>
				<td scope="col">'.$row['Email'].'</td>
				<td scope="col">'.$row['Contact'].'</td>
				<td scope="col">'.$row['Access'].'</td>
				<td scope="col">
					<button type="button" class="btn btn-primary view_btn" id='.$row['Emp_ID'].'><i class="fa fa-eye"></i></button>
					<button type="button" class="btn btn-danger"><i class="fa fa-archive" aria-hidden="true"></i></button>
				</td>
			</tr>
		';
		}
	}

	echo $output;
}
?>

<script type="text/javascript">
	$(document).ready(function(){
		$('.view_btn').click(function(){
			var id = $(this).attr('id');
			$.ajax({
				url: "view-staff.php",
				method: "POST",
				data:{
					id:id
				},
				success:function(data){
					data = JSON.parse(data);
					$('#output').attr("src", "../assets/upload/" + (data.picture));
					$('#output1').attr("src", "../S-QRCODE/" + (data.qrcode));
                    $('#date').val(data.date);
                    $('#id').val(data.staff_id);
                    $('#salutation').val(data.salutation);
                    $('#lastname').val(data.lastname);
                    $('#firstname').val(data.firstname);
                    $('#middlename').val(data.middlename);
                    $('#suffix').val(data.suffix);
                    $('#dob').val(data.dob);
                    $('#age').val(data.age);
                    $('#gender').val(data.gender);
                    $('#address').val(data.address);
                    $('#nationality').val(data.nationality);
                    $('#contact').val(data.contact);
                    $('#email').val(data.email);
                    $('#access').val(data.access);
                    $("#view-modal").modal("show");
				}
			})
		})
	})
</script>