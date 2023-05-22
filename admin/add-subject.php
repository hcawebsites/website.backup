<?php 
include_once('main_head.php');
include_once('header.php');
include_once('sidebar.php'); 
$myID = $_SESSION['admin_id'];
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Add Subject
			<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">Subjects</a></li>
			<li><a href="#">Add Subject</a></li>
		</ol>
		<hr>
	</section>
	<section class="content">
		<div class="table-master" style="color: #666666; font-size: 14px; font-weight: 500">
			<h4>*Subject Information</h4>
			<hr>
			<form action="" id="sub-form">
				<div class="row">
					<div class="col-md-12">
						<label>Subject Code:</label>
						<input type="text" name="code" id="code" class="form-control"></input>

						<label>Subject:</label>
						<select name="subject" id="subject" class="form-control">
							<option hidden selected>Please Select Here</option>
							<?php
				                $query = "SELECT * FROM curriculum_subjects inner join curriculum on curriculum_subjects.Curriculum_ID = curriculum.ID Where Status = '1' ORDER BY curriculum_subjects.ID ASC";
				                $result = mysqli_query($con, $query);
				                if (mysqli_num_rows($result) > 0) {
				                  while ($row = mysqli_fetch_assoc($result)):
				                    echo '<option value="'.$row['Subjects'].'">'.$row['Subjects'].'</option>';
				                  endwhile;
				                }else{
				                    echo '<option>No Subject Found!</option>';
				                }
			                ?>
						</select>

						<label>Grade:</label>
						<select name="grade" id="grade" class="form-control form-group">
							<option hidden selected>Please Select Here</option>
							<?php
			                $query = "SELECT * FROM grade ORDER BY ID";
			                $result = mysqli_query($con, $query);
			                while ($row = mysqli_fetch_assoc($result)):
			                ?>
			                <option value="<?=$row['Name']?>"><?=$row['Name']?></option>
			                <?php endwhile ?>
						</select>

						<button type="button" id="save" class="form-control btn btn-primary">Save</button>
					</div>
				</div>
			</form>
		</div>
	</section>
</div>
<?php include_once 'footer.php'?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#save').click(function(){
			start_load();
			$.ajax({
				url: "../model/add-subject.php",
				method: "POST",
				data: $('#sub-form').serialize(),
				success:function(data){
					if(data == "success"){
					    const swalWithBootstrapButtons = Swal.mixin({
        				  customClass: {
        				    confirmButton: 'btn btn-success',
        				  },
        				  buttonsStyling: false
        				})
        
        				swalWithBootstrapButtons.fire({
        				  title: 'Subject Successfully Added!',
        				  text: "",
        				  icon: 'success',
        				  showCancelButton: false,
        				  confirmButtonText: 'Close',
        				}).then((result) => {
        				  if (result.isConfirmed) {
        				  	window.location.href = 'subjectList.php';
        				    }
        				})
        				end_load();
					}else{
					    Swal.fire(
        			      data,
        			      '',
        			      'warning'
        		    	)
        		    	end_load();
					}
				}
			})
		})
	})
</script>