<?php  
include_once 'main_head.php';
include_once 'header.php';
include_once 'sidebar.php';
include_once '../database/connection.php';
$myID = $_SESSION['admin_id'];
$count = 1;
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Staff
			<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">&nbspStaff</a></li>
			<li><a href="#"></a>&nbspList of Staff</li>
		</ol>

		<hr>
	</section>
	<section class="content">
		<div class="table-master">
			<div class="table-title">
				<h3>
					<i class="fa fa-list-alt"></i>&nbsp
					List of Staff
				</h3>
				<div class="search">
					<div class="row form-inline">
						<form action="../reports/staff_reports.php" method="POST">
							<input type="hidden" name="aid" value="<?php echo $myID  ?>">
						<select name="filter" id="filter" class="form-control" required>
							<option value="All">All</option>
							<option value="Cashier">Cashier</option>
							<option value="Librarian">Librarian</option>
							<option value="Nurse">Nurse</option>
							<option value="Councelor">Councelor</option>
						</select>
						<button type="submit" name="print" class="btn btn-danger"><i class="fa fa-print"></i>&nbspPrint</button>
						<button type="submit" name="excel" class="btn btn-success"><i class="fa fa-file-excel-o"></i>&nbspExcel</button>

						</form>
					</div>
				</div>
			</div>

			<table class="table table-bordered table-striped" id="search" style="color: #666666; font-size: 12px; font-weight: 500;">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Gender</th>
						<th>Age</th>
						<th>Email</th>
						<th>Contact</th>
						<th>Access</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="data">
					<?php  
						$get_staff = mysqli_query($con, "SELECT * from staff_tb inner join user on staff_tb.Emp_ID = user.Username Order by staff_tb.ID asc");
						while ($row = mysqli_fetch_assoc($get_staff)) {
						$name = $row['Salutation']. ". ". $row['Firstname']. " " .$row['Lastname'];
					?>
						<tr>
							<td scope="col" style="vertical-align:middle;"><?=$count++?></td>
							<td scope="col" style="vertical-align:middle;"><?=$name?></td>
							<td scope="col" style="vertical-align:middle;"><?=$row["Gender"]?></td>
							<td scope="col" style="vertical-align:middle;"><?=$row['Age']?></td>
							<td scope="col" style="vertical-align:middle;"><?=$row['Email']?></td>
							<td scope="col" style="vertical-align:middle;"><?=$row['Contact']?></td>
							<td scope="col" style="vertical-align:middle;"><?=$row['Access']?></td>
							<td scope="col" style="vertical-align:middle;" class="text-center">
								<button type="button" class="btn btn-primary view_btn" id="<?=$row['Emp_ID']?>"><i class="fa fa-eye"></i></button>
								<button type="button" class="btn btn-danger"><i class="fa fa-archive" aria-hidden="true"></i></button>
							</td>
						</tr>
					<?php }?>
					
				</tbody>
			</table>
		</div>
	</section>
</div>
<!-- Modal View Student -->
<div class="modal fade" id="view-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="close"><i class="fa fa-times"></i></button>
        <h4 class="modal-title">Staff Information</h4>
      </div>
      <form action="" method="POST">
        <div class="modal-body">
          <div class="row">
            <div class ="form-group col-md-6 text-right">
                <img id="output" src="" style="width:150px; height:150px;" />
            </div>

            <div class ="form-group col-md-6">
                <img id="output1" src="" style="width:150px; height:150px;" />
            </div>

            <div class="form-group col-md-6">
                <label for="">Registration Date:</label>
                <input type="text" name="date" id="date" class="form-control" readonly>
            </div>

            <div class="form-group col-md-6">
                <label for="">Staff ID:</label>
                <input type="text" name="id" id="id" class="form-control" readonly>
            </div>

            <div class="form-group col-md-2">
                <label for="">Salutation:</label>
                <input type="text" name="salutation" id="salutation" class="form-control" readonly>
            </div>

            <div class="form-group col-md-3">
                <label for="">Lastname:</label>
                <input type="text" name="lastname" id="lastname" class="form-control" readonly>
            </div>

            <div class="form-group col-md-3">
                <label for="">Firstname:</label>
                <input type="text" name="firstname" id="firstname" class="form-control" readonly>
            </div>

            <div class="form-group col-md-3">
                <label for="">Middlename:</label>
                <input type="text" name="middlename" id="middlename" class="form-control" readonly>
            </div>

            <div class="form-group col-md-1">
                <label for="">Suffix:</label>
                <input type="text" name="suffix" id="suffix" class="form-control" readonly>
            </div>

            <div class="form-group col-md-4">
                <label for="">DOB:</label>
                <input type="text" name="dob" id="dob" class="form-control" readonly >
            </div>

            <div class="form-group col-md-4">
                <label for="">Age:</label>
                <input type="text" name="age" id="age" class="form-control" readonly>
            </div>

            <div class="form-group col-md-4">
                <label for="">Gender:</label>
                <input type="text" name="gender" id="gender" class="form-control" readonly>
            </div>

            <div class="form-group col-md-12">
                <label for="">Address:</label>
                <input type="text" name="address" id="address" class="form-control" readonly>
            </div>
            
            <div class="form-group col-md-6">
                <label for="">Nationality:</label>
                <input type="text" name="nationality" id="nationality" class="form-control" readonly>
            </div>

            <div class="form-group col-md-6">
                <label for="">Contact:</label>
                <input type="text" name="contact" id="contact" class="form-control" readonly>
            </div>

            <div class="form-group col-md-12">
                <label for="">Email:</label>
                <input type="text" name="email" id="email" class="form-control" readonly>
            </div>

            <div class="form-group col-md-12">
                <label for="">Access:</label>
                <input type="text" name="access" id="access" class="form-control" readonly>
            </div>


          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
      
    </div>  
  </div>
</div>
<?php include_once 'footer.php';?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#search').DataTable();

		$('#filter').change(function(){
			start_load()
			var access = $(this).val();
			$.ajax({
				url: "filter-staff.php",
				method: "POST",
				data:{
					access:access
				},
				success:function(data){
					$('#data').html(data);
				},
				complete:function(){
					end_load();
				}
			})
		});

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