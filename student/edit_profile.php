<?php 
session_start();
include_once '../database/connection.php';?>
<?php 
$student_id = $_SESSION['student_id'];
$sql="SELECT * FROM student inner join student_grade on student.Student_ID = student_grade.Student_ID Where student.Student_ID= '$student_id'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);

$date = strtotime($row['DOB']);

?>

<div class="row">
	<div class="col-md-4 text-center"
	style="padding: 50px 20px; background:; border-top-left-radius: 25px;">

	<img id="output" src="../std_picture/<?=$row['Picture']?>" class="img-thumbnail" alt="Cinque Terre" 
	style="width: 60%"><span>
    <input type="file" accept="image/*" name="my_image" id="file" onchange="loadFile(event)" style="margin-top:7px;"  />
    <h4><?php echo $row['Firstname'] ," ", $row['Lastname'];?></h4>
    
	<p style="margin-top:-10px;"><?php echo $row['Student_ID'];?></p></span>

	
	</div>

	<div class="col-md-8"
	style="padding: 20px; background:#D0D0D0; border-bottom-right-radius: 25px; 
	border-top-right-radius: 25px; ">
	<div class="col-md-12" style="color: red;">
		<h4>Student Information:</h4>
		<hr>
	</div>
	
	<div class="form-group col-md-4">
		<label for="">Last Name:</label>
		<input type="text" name="lastname" id="lastname" class="form-control" 
		value="<?php echo $row['Lastname'];?>" >
	</div>

	<div class="form-group col-md-4">
		<label for="">First Name:</label>
		<input type="text" name="firstname" id="firstname" class="form-control" 
		value="<?php echo $row['Firstname'];?>" >
	</div>

	<div class="form-group col-md-4">
		<label for="">Middle Name:</label>
		<input type="text" name="middlename" id="middlename" class="form-control" 
		value="<?php echo $row['Middlename'];?>" >
	</div>

	<div class="form-group col-md-4">
		<label for="">Date of Birth:</label>
		<input type="text" name="dob" id="dob" class="form-control" 
		value="<?php echo date('M d Y', $date);?>" readonly>
	</div>

	<div class="form-group col-md-4">
		<label for="">Age:</label>
		<input type="text" name="age" id="age" class="form-control" 
		value="<?php echo $row['Age'];?>" >
	</div>

	<div class="form-group col-md-4">
		<label for="">Gender</label>
		<input type="text" name="gender" id="gender" class="form-control" 
		value="<?php echo $row['Gender'];?>" >
	</div>

	<div class="form-group col-md-6">
		<label for="">Contact:</label>
		<input type="text" name="contact" id="contact" class="form-control" 
		value="<?php echo $row['Phone'];?>" >
	</div>

	<div class="form-group col-md-6">
		<label for="">Address:</label>
		<input type="text" name="address" id="address" class="form-control" 
		value="<?php echo $row['Address'];?>" >
	</div>

	<div class="form-group col-md-12">
		<label for="">Email:</label>
		<input type="email" name="email" id="email" class="form-control" 
		value="<?php echo $row['Email'];?>" >
	</div>

	<div class="form-group col-md-12">
		<label for="">Guardian Name:</label>
		<input type="text" name="gname" id="gname" class="form-control" 
		value="<?php echo $row['GLastname'], " ", $row['GFirstname'], " ", $row['GMiddlename'];?>">
	</div>

	<div class="form-group col-md-12">
		<label for="">Guardian Contact:</label>
		<input type="text" name="gcontact" id="gcontact" class="form-control" 
		value="<?php echo $row['GContact'];?>" >
	</div>

	<div class="form-group col-md-12">
		<button type="button" id="save" class="btn btn-success form-control">Update</button>
	</div>


	</div>

</div>


<script>
    var loadFile = function(img) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);

	$(document).ready(function(){
		alert("sds")
	})
};

</script>