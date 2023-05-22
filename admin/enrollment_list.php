<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); 
$count = 1;
$myID = $_SESSION['admin_id'];
?>



<div class="content-wrapper">
  <title>Enrollment Request</title>
	
    <section class="content-header">
    	<h1>
        	Enrollment Request
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Enrollment Request</a></li>
    	</ol>
	</section>
	<hr>

<section class="content">
	<div class="start-enrollment">
		<div class="row">
				<?php 
					$sql = "SELECT * FROM academic_list WHERE is_default = '1'";
					$result = mysqli_query($con, $sql);	
				?>
				<div class="col-md-6 text text-center">
						<label for="">Active School Year:</label>
					<input type="text" value="<?php while ($row = mysqli_fetch_assoc($result)) {
										if ($row['Status'] == 1) {
												echo $row['School_Year'];
										}else{
												echo "No Active School Year";
										}
									}?>" 
									class="text-center form-control"
									placeholder = "No Active Semester" readonly>
										
				</div>
					<?php 
						$sql = "SELECT * FROM academic_list WHERE is_default = '1'";
						$result = mysqli_query($con, $sql);
					?>
					<div class="col-md-6 text text-center">
						<label for="">Active Semester:</label>
							<input type="text" value="<?php while ($row = mysqli_fetch_assoc($result)) {
										if ($row['Status'] == 1) {
												echo $row['Semester'];
										}else{
											echo "No Active School Year";
										}
							}?>" 
									class="text-center form-control"
									placeholder = "No Active Semester" readonly>
										
					</div>

					<div class="col-md-6 start">
						<input type="button" value="Start Enrollment" class="btn btn-success form-control" data-target = "#modalStart" data-toggle="modal">
						<i class="fa fa-plus plus" aria-hidden="true"></i>
					</div>

					<div class="col-md-6 stop">
						<input type="button" name="stop" id="stop" value="Stop Enrollment" class="btn btn-danger form-control" data-target = "#modalStop" data-toggle="modal">
						<i class="fa fa-exclamation-triangle warning" aria-hidden="true"></i>
					</div>		
		</div>
	</div><hr>

		<div class="table-enrollment">
			<div class="table-title">
				<h3><i class="fa fa-book" aria-hidden="true"><b> Enrollment Request</b></i></h3>
				<div class="btn-enrollment">
				<form class="form-inline" action="../reports/enrollment_reports.php" method="POST">
					<div class="row">
						<input type="hidden" name="aid" value="<?php echo $myID?>">
						<a href="to_pay.php" class="btn btn-info"><i class="fa fa-money" aria-hidden="true">&nbspTo Pay</i></a>
						<button type="submit" name="print" class="btn btn-danger form-control"><i class="fa fa-print" aria-hidden="true">&nbspPrint</i></button>
						<button type="submit" name="excel" class="btn btn-success form-control"><i class="fa fa-file-excel-o" aria-hidden="true"> Excel</i></button>

					</div>
				</div>
				</form>
			</div>
			<table class="table table-striped" id="enrollment_table" style="color: #666666; font-size:13px; font-weight: 500;">
      			<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Name</th>
						<th scope="col">Age</th>
						<th scope="col">Gender</th>
						<th scope="col">Status</th>
						<th scope="col">Application Date</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<?php
					$request = "SELECT * FROM student Where Enrollment_Status = 'Pending'";
					$result = mysqli_query($con, $request);
				?>
				<tbody class="table-hover" id="detailTable">
					<?php
					while ($row = mysqli_fetch_assoc($result)) {
						$date = $row['Application_Date'];
						$newdate = strtotime($date);
					?>

					<tr class="table-active">
						<td style = "vertical-align: middle;"><?php echo $count++;?></td>
						<td style = "vertical-align: middle;"><?php echo $row['Firstname'], " ", $row['Lastname'];?></td>
						<td style = "vertical-align: middle;"><?php echo $row['Age'];?></td>
						<td style = "vertical-align: middle;"><?php echo $row['Gender'];?></td>
						<td style = "vertical-align: middle;" class="text-center"><?php 

						if ($row['Enrollment_Status'] == "Pending") {
							echo "<p class='btn-info'>Pending</p>";
						}

						?></td>
						<td style = "vertical-align: middle;"><?php echo date('F j, Y', $newdate);?></td>
						<td style = "vertical-align: middle;" class="text-center">
							<button name="view" id="<?php echo $row['ID'];?>" class="btn btn-success applicant_data">
							<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbspApprove</button>

						  <button class="btn-danger form-control delete" id="<?php echo $row['ID']?>"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i>&nbspUnqualified</button>
						</td>
					</tr>



				<?php }?>
				</tbody>




			</table>
		</div>
</section>
	

</div>
<?php include_once ('footer.php'); ?>

<script>
  $(document).ready(function () {

    $('#enrollment_table').DataTable();

});
</script>
</div>


<!-- Modal Start Enrollment -->

<div class="modal fade" id="modalStart" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md" role="content"> 
    <div class="modal-content">
      <div class="modal-header">
	  	<button type="button" class="close" data-dismiss="modal" aria-label="close">
          	<span aria-hidden="true">&times;</span></button>
		<h2>Start Enrollment</h2>
        
      </div>

      <form action="../model/start_enrollment.php" method="POST">
        <div class="modal-body">
          <h3 class="text-center">You are Starting an Enrollement</h3>
		  <p class="text-center">Please select a school year</p>
		  <hr>

		  <label for="">Semester:</label>
            <select name="semester" id="semester" class = "form-control">
                <option selected disabled> Select Semester</option>
                <option value="1st Semester">1st Semester</option>
                <option value="2nd Semester">2nd Semester</option>
            </select><br>

			<label for="">School Year:</label>
            <select name="sy" id="sy" class = "form-control">
                <option selected disabled> Select School Year</option>
                <option value="2022-2023">2022-2023</option>
                <option value="2023-2024">2023-2024</option>
				<option value="2024-2025">2024-2025</option>
				<option value="2026-2027">2026-2027</option>
				<option value="2028-2029">2028-2029</option>
				<option value="2030-2031">2030-2031</option>
				<option value="2032-2033">2032-2033</option>
            </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">NO, Cancel</button>

          <button type="submit" name="start" id="start" class="btn btn-success start">Yes, Start</button>

        </div>
      </form>
    </div>
  </div>
</div>

<!-- END -->

<!-- Modal Stop Enrollment -->
<div class="modal fade" id="modalStop" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md" role="content"> 
    <div class="modal-content">
      <div class="modal-header">
	  	<button type="button" class="close" data-dismiss="modal" aria-label="close">
          	<span aria-hidden="true">&times;</span></button>
		<h2>Stop Enrollment</h2>
        
      </div>

      <form action="../model/start_enrollment.php" method="POST">
        <div class="modal-body">
          <h4 class="text-left">Are You Sure You Want To Stop Enrollment?</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">NO, Cancel</button>

          <button type="submit" name="stop" id="start" class="btn btn-danger start">Yes, Stop</button>

        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal View Details -->
<?php include_once '../model/student-section.php';?>
<div class="modal fade" id="modalview" tabindex="-1" aria-hidden="true" >
  <div class="modal-dialog modal-lg"> 
    <div class="modal-content">
      <div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal" aria-label="close">
          <span aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span></button>
		<h4>Review Information</h4>
        
      </div>

      <form action="" method="POST" id="review_form">
        <div class="modal-body" id="details">
          <div class = "row">

		  <div class ="form-group text-center col-md-12">
				<img id="output" class="img-rounded" src="" style="width:150px; height:150px;" />
		  </div>
			
		  <div class ="form-group col-md-6">
				<label for="">Active School Year:</label>
				<input type="text" id="activeSY" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-6">
				<label for="">Active Semester:</label>
				<input type="text" id="activeSemester" readonly class = "form-control">
			</div>

			<input type="hidden" id="id" name="id" readonly class = "form-control">

			<div class ="form-group col-md-3">
				<label for="">Date of Registration:</label>
				<input type="text" id="date" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-3">
				<label for="">Student Type:</label>
				<input type="text" id="studentType" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-6">
				<label for="">Address:</label>
				<input type="text" id="address" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-6">
				<label for="">Student ID:</label>
				<input type="text" id="id" placeholder= "Not Available" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-3">
				<label for="">School Last Attended:</label>
				<input type="text" id="lsa" placeholder ="Not Applicable" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-3">
				<label for="">Last S.Y Attended:</label>
				<input type="text" id="lsy" placeholder ="Not Applicable" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-6">
				<label for="">Grade Level:</label>
				<input type="text" name="grade" id="grade" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-3">
				<label for="">LRN:</label>
				<input type="text" id="lrn" placeholder ="Not Applicable" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-3">
				<label for="">General Average:</label>
				<input type="text" id="genAve" placeholder ="Not Applicable" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-6">
				<label for="">Strands:<small> For SHS Only</small></label>
				<input type="text" name="strand" id="strand" placeholder ="Not Applicable" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-6">
				<label for="">Lastname:</label>
				<input type="text" name="lastname" id="lastname"  readonly class = "form-control">
			</div>

			<div class ="form-group col-md-6">
				<label for="">Firstname:</label>
				<input type="text" name="firstname" id="firstname"  readonly class = "form-control">
			</div>

			<div class ="form-group col-md-6">
				<label for="">Middlename:</label>
				<input type="text" id="middlename" name="middlename"  readonly class = "form-control">
			</div>

			<div class ="form-group col-md-6">
				<label for="">Suffix:</label>
				<input type="text" id="suffix" placeholder="Not Available" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-6">
				<label for="">Guardian's Name:</label>
				<input type="text" id="gname" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-3">
				<label for="">Date of Birth:</label>
				<input type="date" id="dob" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-3">
				<label for="">Age:</label>
				<input type="text" id="age" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-6">
				<label for="">Guardian's Contact:</label>
				<input type="text" id="gcontact" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-4">
				<label for="">Place of Birth:</label>
				<input type="text" id="pob" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-4">
				<label for="">Gender:</label>
				<input type="text" id="gender" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-4">
				<label for="">Status:</label>
				<input type="text" id="status" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-4">
				<label for="">Nationality:</label>
				<input type="text" id="nationality" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-4">
				<label for="">Contact:</label>
				<input type="text" id="contact" readonly class = "form-control">
			</div>

			<div class ="form-group col-md-4">
				<label for="">Email:</label>
				<input type="email" name ="email" id="email" readonly class = "form-control">
			</div>

			





		  </div>
		  <p class="text-center">By clicking "Approve" the data of the registered is candidate for enrollment until paid.</p>
        </div>
        <div class="modal-footer">
			<button type="submit" name="approve" id="" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Approve</button>
      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Close</button>
        </div>

		
      </form>
    </div>
  </div>
</div>

<!--Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="close"><i class="fa fa-times"></i></button>
        <h3 class="modal-title">Manage Enrollment</h3>
      </div>

      <form action="" id="delete-form">
        <div class="modal-body">
          <input type="hidden" name="id" id="eid">
          <h4>Are you sure you want to delete this enrollment request?</h4>
         
          <textarea name="reason" placeholder="Enter reason here..." class="form-control"></textarea>

        </div>

      </form>
        <div class="modal-footer">
        	<button type="button" class="btn btn-secondary" data-dismiss="modal">NO, Cancel</button>

          <button type="button" id="delete_btn" class="btn btn-danger">Yes, Delete</button>
        </div>
        
      
    </div>  
  </div>
</div>

<!---Assign Student Section-->
<div class="modal fade" id="assign" tabindex="-1" aria-hidden="true" >
  <div class="modal-dialog modal-md"> 
    <div class="modal-content">
      <div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal" aria-label="close">
          <span aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span></button>
		    <h4>Assign Section</h4>
            <hr>
                <form action="" method="POST" id = "section">
                    <div class="row">
                            <input type="hidden" name = "reg_num" id="reg_num1" readonly class="form-control">
														<input type="hidden" name = "email" id="email1" readonly class="form-control">

                        <div class="form-group col-md-4">
                            <label for="">Firstname:</label>
                            <input type="text" name = "firstname" id="firstname1" readonly class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="">Middlename:</label>
                            <input type="text" name = "middlename" id="middlename1" readonly class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="">Lastname:</label>
                            <input type="text" name = "lastname" id="lastname1" readonly class="form-control">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="">Grade:</label>
                            <input type="text" id="grade1" readonly class="form-control">
                            <input type="hidden" name = "grade" id="gid" readonly class="form-control">

                        </div>

												<div class="form-group col-md-12">
                            <label for="" id="strand1">Strand:</label>
                            <input type="text" name = "strand" id="strand2" readonly class="form-control">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="" id="label">Section:</label>
                            <input type="text" name = "section" id="section1" readonly class="form-control">

							</select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" id="save"><i class="fa fa-floppy-o" aria-hidden="true"> Save</i></button>
                        <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"> Close</i></button>
                    </div>
					
                    
                </form>
        </div>
    </div>
</div>
<!-- END -->



<script>
	/*Reject JavaScript*/

	$(document).ready(function () {
      $('#delete_btn').click(function(){
      	start_load();
      	$.ajax({
      		url: "../model/delete_enrollment_request.php",
      		method: "POST",
      		data: $('#delete-form').serialize(),
      		success:function(data){
      			alert("Enrollment Deleted!");
      		},
      		complete:function(){
      			location.reload();
      			end_load();
      		}
      	})
      })

      $('.delete').click(function(){
      	var id = $(this).attr('id');
      	$('#eid').val(id);
      	$('#rejectModal').modal('show');
      })


    });//end


	/*Review Details JavaScript*/
 	$(document).ready(function(){  
      $('.applicant_data').click(function(){  
           var applicant_id = $(this).attr("id")
           $.ajax({  
                url:"view_data.php",  
                method:"POST",  
                data:{
					applicant_id:applicant_id 
				},
        success:function(data){
					data = $.parseJSON(data);
           $('#activeSY').val(data.ActiveSY);
					 $('#activeSemester').val(data.ActiveSemester);
					 $('#id').val(data.id);
					 $('#date').val(data.regDate);    
					 $('#studentType').val(data.studentType);
					 $('#address').val(data.address);
					 $('#lsa').val(data.lastSchool);
					 $('#lsy').val(data.LastSY);
					 $('#grade').val(data.grade);
					 $('#lrn').val(data.lrn);
					 $('#genAve').val(data.genAve);
					 $('#strand').val(data.strand);
					 $('#gname').val(data.guardian);
					 $('#gcontact').val(data.g_num);
					 $('#lastname').val(data.lastname);
					 $('#firstname').val(data.firstname);
					 $('#middlename').val(data.middlename);
					 $('#suffix').val(data.suffix);
					 $('#dob').val(data.dob);
					 $('#age').val(data.age);
					 $('#pob').val(data.pob);
					 $('#gender').val(data.gender);
					 $('#status').val(data.status);
					 $('#nationality').val(data.nationality);
					 $('#contact').val(data.contact);
					 $('#email').val(data.email);
					 $('.form-group img').attr("src", "../assets/upload/" + (data.picture));
                     $('#modalview').modal("show");  
        }  
   });  
    });  
 });  

 //Approve Javascript//

 $(document).ready(function(){  
	$('#save').click(function(e){
		e.preventDefault();
    start_load();
		$.ajax({
       
	   	url: '../model/enroll_student.php',
	   	data: $('#section').serialize(),
	   	method: 'POST',
	   	error: function(data) {
		 
		 	alert("some Error");
	   	},
	   	success: function(data) {
		 		const swalWithBootstrapButtons = Swal.mixin({
				  customClass: {
				    confirmButton: 'btn btn-success',
				  },
				  buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
				  title: 'Data Saved Successfully',
				  text: "",
				  icon: 'success',
				  showCancelButton: false,
				  confirmButtonText: 'Close',
				}).then((result) => {
				  if (result.isConfirmed) {
				  	window.location.href = 'enrollment_list.php';
				    }
				})

	   },
	  	complete:function(){
	  		end_load();
	  	}

	 
	});

	});

 })


 
 </script>


