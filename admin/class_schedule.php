<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('../database/connection.php');
$myID = $_SESSION['admin_id']; 
?>

<div class="content-wrapper">
	
    <section class="content-header">
    	<h1>
        	Class Schedule
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Subjects</a></li>
            <li><a href="#">Class Schedule</a></li>
    	</ol>
	</section>
	<hr>

 	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="table-master">
					<div class="table-title">
						<h3><i class="fa fa-clock-o" aria-hidden="true"><b>&nbspAssign Schedule</b></i></h3>
					</div>
					<form method="post" id="assignSchedule">
						<div class="row">
							<div class="col-md-12 form-group">
								<label for="">Select Day:</label>
								<select name="day[]" id="days" multiple multiselect-search="true" multiselect-select-all="true" class="form-control" >
								<?php
								$day = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
								$acday = array("M", "T", "W", "TH", "F");
								for ($i=0; $i < 5; $i++) { 
								?>

								<option value="<?=$acday[$i]?>"><?=$day[$i]?></option>
								
								<?php } ?>

								</select>

								<label for="">Select Time:</label>
								<select name="time" id="time" class="form-control" required>
									<option value="" disabled selected>Select Time</option>
								<?php
								$query_time = mysqli_query($con, "SELECT * FROM time Where days = 'mtwthf'");
								while ($row = mysqli_fetch_assoc($query_time)) {
								?>
								<option value="<?=$row['time_id']?>"><?=date("h:i A", strtotime($row['time_start'])). " - " .date("h:i A", strtotime($row['time_end']))?></option>
								
								<?php } ?>

								</select>
							</div>

							<div class="col-md-6">
								<label for="">Grade:</label>
								<select name="grade" id="grade" class="form-control" onclick="edt(this)"  disabled required>
								<option value="" disabled selected>Select Grade</option>
									
								</select>
							</div>

							<div class="col-md-6">
								<label for="">Section:</label>
								<input type="text" name="section" id="section" class="form-control" readonly>
							</div>

							<div class="col-md-6">
								<label for="">Strand:</label>
								<select name="str" id="strand" class="form-control"  disabled required>
									<option hidden selected>Please select here</option>
								</select>
							</div>

							<div class="col-md-6">
								<label for="">Semester:</label>
								<select name="semester" id="semester" class="form-control"  disabled required>
									<option hidden selected>Please select here</option>
									<?php  
										$_get = mysqli_query($con, "SELECT * FROM academic_list WHERE is_default = '1'");
										while ($_row = mysqli_fetch_assoc($_get)) {
											?>
											<option value="<?php echo $_row['Semester'] ?>"><?php echo $_row['Semester'] ?></option>
											<?php  
										}
									?>
								</select>
							</div>

							<div class="col-md-6">
								<label for="">Subject:</label>
								<select name="subject" id="subject" class="form-control"  disabled required>
									<option hidden selected>Please select here</option>
								</select>
							</div>

							<div class="col-md-6">
								<label for="">Class Type:</label>
								<select name="option" id="option" onclick="edt2(this)" class="form-control" disabled required>
									<option value="" disabled selected>Select Type</option>
									<option value="F2F">Face to Face</option>
									<option value="Online">Online</option>
								</select>
							</div>

							<div class="col-md-12"><hr></div>

							<div class="col-md-6">
								<button type="submit" name="save" class="form-control btn btn-success">Save</button>
							</div>

							<div class="form-group col-md-6">
								<button class="form-control btn btn-danger uncheck" type="reset">Refresh</button>
							</div>
						</div><!--row end -->
						
					
				</div>

			</div><!--col end-->

			<div class="col-md-6">
				<div class="table-master">
					<div class="table-title">
						<h3><i class="fa fa-clock-o" aria-hidden="true"><b>&nbspTeacher Information</b></i></h3>
						<div class="" id="alert" style="color: #333; border-radius: 10px; font-weight: 500; display: none; margin-right: 5px; margin-top: 5px; margin-bottom: 5px; padding: 1rem 1rem 1rem 1rem; background-color: #68FF7C;" role="alert">
							Record Found!
						</div>
					</div>
					<hr>
					<div class="form1">
						<div class="row">
							<div class="col-md-12 text-center" id="image" style="display: none;">
								<img src="" id="output" alt="" width="100px">
							</div>
							<div class="col-md-12">
								<label for="">Select Teacher:</label>
								<select name="teacher" id="teacher" class="form-control">
									<option value="">Select Teacher</option>
									<?php
									$get_teacher = mysqli_query($con, "SELECT * From teacher_tb order by ID ASC");
									while ($row = mysqli_fetch_assoc($get_teacher)) {
										?>
									
										<option value="<?=$row['Emp_ID']?>"><?=$row['Salutation']. ". " .$row['Firstname']. " " .$row['Lastname']?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-6">
								<label for="">Department:</label>
								<input type="text" name="dept" id="dept" class="form-control" readonly>
							</div>

							<div class="col-md-6">
								<label for="">Contact:</label>
								<input type="text" id="contact" class="form-control" readonly>
							</div>

							<div class="col-md-12">
								<label for="">Email:</label>
								<input type="text" id="email" class="form-control" readonly>
							</div>
							
							<div class="col-md-12"><hr></div>
							<div class="col-md-12 form-group">
							<div class="result" id="form"></div>	
							</div>
						</div><!--end row-->
					</div>
				</div>




				</form>
			</div><!--col end-->


		</div>
	</section>
</div>

<script>
function edt2(type){

var selectedValue = type.options[type.selectedIndex].value;
var room1 = document.getElementById("room1");
var room2 = document.getElementById("room2");

if (selectedValue == "F2F") {
    room1.disabled = false;
	room2.disabled = true;
}else{
	room2.disabled = false;
	room1.disabled = true;
}
}

function edt(type){

var selectedValue = type.options[type.selectedIndex].value;
var strand = document.getElementById("strand");
var semester = document.getElementById("semester");
var subject = document.getElementById("subject");
var option = document.getElementById("option");
subject.disabled = selectedValue == "" ? true : false;
option.disabled = selectedValue == "" ? true : false;

if (selectedValue == 11 || selectedValue == 12) {
	strand.disabled = false;
	semester.disabled = false;
}else{
	strand.disabled = true;
	semester.disabled = true;
}



}
var timer1=0;
var myVar;
var intervalID;
var intervalID1;

$(document).ready(function(){
	$('#teacher').change(function(){
		var teacher_id = $(this).val();

		$.ajax({
			url: "view-teacher.php",
			method: "POST",
			data:{
				teacher_id: teacher_id
			},
			success:function(data){
				data = $.parseJSON(data);
				$('#dept').val(data.dept);
				$('#contact').val(data.contact);
				$('#email').val(data.email);
				$('#output').attr("src", "../assets/upload/" + (data.image));
				var grade = document.getElementById('grade');
				var img = document.getElementById('image');
				grade.disabled = false;
				img.style.display = "block";
				var dept = document.getElementById('dept').value;
				$.ajax({
				url:"filter-grade.php",
				method: "POST",
				data:{dept:dept},
				success:function(data) {
				$("#grade").html(data);
					
				}
				});
			}
		})
	})
})


$(document).ready(function(){
    $('#grade').change(function(){
        var grade = $(this).val();
        $.ajax({
            url:"getSection.php",
            method: "POST",
            data:{grade:grade},
            success:function(data) {
            	data = $.parseJSON(data);
            	$('#section').val(data.section);               
            }
        });
    });
});

$(document).ready(function(){
    $('#grade').change(function(){
        var grade = $(this).val();
        $.ajax({
            url:"filter-strand.php",
            method: "POST",
            data:{grade:grade},
            success:function(data) {
              $("#strand").html(data);
                
            }
        });
    });
});

$(document).ready(function(){
    $('#grade').change(function(){
        var grade = $(this).val();
        $.ajax({
            url:"filter-subject.php",
            method: "POST",
            data:{grade:grade},
            success:function(data) {
              $("#subject").html(data);
                
            }
        });
    });
});


$(".uncheck").click(function () {
	location.reload();
});

$(document).on('submit', '#assignSchedule', function()
		 {  
		  $.post('../model/schedule.php', $(this).serialize(), function(data)
		  {
		   $(".result").html(data);  
		   $("#form1")[0].reset();
		   $('input:checkbox').removeAttr('checked');
		  // $("#check").reset();

		  });
		  
		  return false;
		  
		
		})
</script>