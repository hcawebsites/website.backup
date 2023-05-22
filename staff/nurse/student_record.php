<?php  
include_once 'main_head.php';
include_once 'header.php';
include_once 'sidebar.php';
$myID = $_SESSION['staff_id'];
$count = 1;
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Student Medicine
			<small>Preview</small>
		</h1>

		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">Medicine</a></li>
			<li><a href="#">Student Medicine Lists</a></li>
		</ol>
		<hr>
	</section>
	<section class="content">
		<div class="table-master">
			<div class="table-title">
				<h3>
					<i class="fa fa-list-alt"></i>
					Student Medicines
				</h3>
			</div>

			<table class="table table-striped table-bordered" id="search" style="color: #666666; font-size: 12px; font-weight: 500;">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Student ID</th>
						<th scope="col">Name</th>
						<th scope="col">Illness</th>
						<th scope="col">Medicine</th>
						<th scope="col">Total Medicine</th>
						<th scope="col">Date Created</th>
					</tr>
				</thead>
				<tbody>
					<?php  
						$get = mysqli_query($con, "SELECT *, clinic_record.Total from clinic_record inner join medicine on clinic_record. Medicine = medicine.ID inner join student on clinic_record.Student_ID = student.Student_ID Order By Lastname ASC");
						while ($row = mysqli_fetch_assoc($get)) {
							$date_created = date('F j, Y', strtotime($row['Date_Created']));
							$name = $row['Firstname']. " " .$row['Lastname'];
							

							?>
							<tr>
								<td style="vertical-align: middle;"><?=$count++?></td>
								<td style="vertical-align: middle;"><?=$row['Student_ID']?></td>
								<td style="vertical-align: middle;"><?=$name?></td>
								<td style="vertical-align: middle;"><?=$row['Illness']?></td>
								<td style="vertical-align: middle;"><?=$row['Name']?></td>
								<td style="vertical-align: middle;"><?=$row['Total']?></td>
								<td style="vertical-align: middle;"><?=$date_created?></td>
								

							</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	</section>
</div>
<?php include_once '../footer.php';  ?>
<script>
	$(document).ready(function(){
		$('#search').DataTable();

	})
</script>