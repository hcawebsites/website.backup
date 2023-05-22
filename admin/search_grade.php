<?php  
include_once '../database/connection.php';

	if ($_POST) {
		$val = mysqli_real_escape_string($con, $_POST['val']);
		$std_id = $_GET['std_id'];
		$output = "";
		$sy = mysqli_query($con, "SELECT * from academic_list Where is_default = 1");
		$row_sy = mysqli_fetch_assoc($sy);
		$semester = $row_sy['Semester'];
		$ay = $row_sy['School_Year'];
		$count = 1;

		$get = mysqli_query($con, "SELECT Department from grade inner join student_grade on grade.ID = student_grade.Class_ID Where student_grade.Student_ID = '$std_id'");
		$row = mysqli_fetch_assoc($get);
		$dept = $row['Department'];

		if ($dept == "SHSDEPT") {
			$get_grade = mysqli_query($con, "SELECT * FROM shs_grade inner join subjects on shs_grade.Subject = subjects.Subject_Code Where Student_ID = '$std_id' And Semester = '$semester' and AY = '$ay' AND Subject = '$val'");
			if (mysqli_num_rows($get_grade) > 0) {
				while ($row_grade = mysqli_fetch_assoc($get_grade)) {
				$output .=
				"
					<tr>
						<td style='vertical-align: middle'>".$count++."</td>
						<td style='vertical-align: middle'>".$row_grade['Subject']."</td>
						<td style='vertical-align: middle'>".$row_grade['Description']."</td>
						<td style='vertical-align: middle'>".$row_grade['Prelim']."</td>
						<td style='vertical-align: middle'>".$row_grade['Midterm']."</td>
						<td style='vertical-align: middle'>".$row_grade['Final']."</td>
						<td style='vertical-align: middle'>".$row_grade['Overall']."</td>
						<td style='vertical-align: middle'>".$row_grade['Semester']."</td>
						<td style='vertical-align: middle'>".$row_grade['AY']."</td>
						<td style='vertical-align: middle' class='text-center'>
						<button type='button' class='btn btn-warning edit' id=".$row_grade['Student_ID']." data-id=".$row_grade['Subject']."><i class='fa fa-pencil-square-o'></i></button>

						<button type='button' class='btn btn-danger deleteBtn' id=".$row_grade['Student_ID']."><i class='fa fa-trash'></i></button>
						</td>
					</tr>
				";
			}
			}else{
				$output .= "
					<tr>
						<td colspan = '10' class='text-center'>No Record Found</td>
					</tr>
				";
			}
		}else{

			$get_grade = mysqli_query($con, "SELECT * FROM std_grade inner join subjects on std_grade.Subject = subjects.Subject_Code Where Student_ID = '$std_id' and SY = '$ay' AND Subject = '$val'");
			if (mysqli_num_rows($get_grade) > 0) {
				while ($row_grade = mysqli_fetch_assoc($get_grade)) {
				$output .=
				"
					<tr>
						<td style='vertical-align: middle'>".$count++."</td>
						<td style='vertical-align: middle'>".$row_grade['Subject']."</td>
						<td style='vertical-align: middle'>".$row_grade['Description']."</td>
						<td style='vertical-align: middle'>".$row_grade['First']."</td>
						<td style='vertical-align: middle'>".$row_grade['Second']."</td>
						<td style='vertical-align: middle'>".$row_grade['Third']."</td>
						<td style='vertical-align: middle'>".$row_grade['Fourth']."</td>
						<td style='vertical-align: middle'>".$row_grade['Final']."</td>
						<td style='vertical-align: middle'>".$row_grade['SY']."</td>
						<td style='vertical-align: middle' class='text-center'>
						<button type='button' class='btn btn-warning edit' id=".$row_grade['Student_ID']." data-id=".$row_grade['Subject']."><i class='fa fa-pencil-square-o'></i></button>

						<button type='button' class='btn btn-danger deleteBtn' id=".$row_grade['Student_ID']."><i class='fa fa-trash'></i></button>
						</td>
					</tr>
				";
			}
			}else{
				$output .= "
					<tr>
						<td colspan = '10' class='text-center'>No Record Found</td>
					</tr>
				";
			}

		}

		echo $output;
	}
?>

<script>
	$(document).ready(function(){
		$('.edit').click(function(){
			var std_id = $(this).attr('id');
			var subject = $(this).attr('data-id');
			$.ajax({
				url: "edit_grade.php?code="+subject,
				method: "POST",
				data:{
					std_id:std_id,
				},
				success:function(data){
					data = JSON.parse(data);
					$('#name1').val(data.name);
					$('#std_id1').val(std_id);
					$('#prelim').val(data.prelim);
					$('#midterm').val(data.midterm);
					$('#final').val(data.final);
					$('#code').val(data.subject);
					$('#title').val(data.description);
					$('#overall').val(data.overall);

					$('#name').val(data.name);
					$('#first').val(data.first);
					$('#second').val(data.second);
					$('#third').val(data.third);
					$('#fourth').val(data.fourth);
					$('#final').val(data.final);
					$('#edit_modal').modal('show');
				}
			})
		});
	})
</script>