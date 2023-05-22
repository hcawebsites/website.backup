<?php include_once('main_head.php');?>
<?php ob_start();?>
<?php include_once('std_header.php'); ?>
<?php include_once('../std-model/std-update-profile.php'); ?>
<?php include_once('std_sidebar.php'); ?>

<?php

$sql="SELECT * FROM student inner join student_grade on student.Student_ID = student_grade.Student_ID inner join grade on student_grade.Class_ID = grade.ID Where student.Student_ID= '$student_id'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$class = $row['Name']. " " .$row['Strand']. " - " .$row['Section'];
$date = strtotime($row['DOB']);
?>

<div class="content-wrapper">
	
    <section class="content-header">
    	<h1>
        	My Profile
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Profile</a></li>
    	</ol>
	</section>

	<hr><hr>

	<section class="content">
      
      	<div class="col-md-12" style="margin-top: 10px; margin-left:3px;">
			
			<form action="" method="POST" enctype="multipart/form-data" id="my_profile">
				<div class="row">
					<div class="col-md-4 text-center"
					style="padding: 50px 20px; background:; border-top-left-radius: 25px;">

					<img src="../assets/upload/<?=$image?>" class="img-thumbnail" alt="Cinque Terre" 
					style="width: 60%"><span><h4><?php echo $firstname ," ", $lastname;?><br><small><?=$class?></small></h4><br><br></span>
					
					<img src="../student_qrcode/<?=$row['QR_Code']?>" class="img-thumbnail" alt="Cinque Terre" 
					style="width: 60%"><span>
					<p style="margin-top:5px;"><?php echo $row['Student_ID'];?></p></span><br>

					
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
						value="<?php echo $lastname;?>" readonly>
					</div>

					<div class="form-group col-md-4">
						<label for="">First Name:</label>
						<input type="text" name="firstname" id="firstname" class="form-control" 
						value="<?php echo $firstname;?>" readonly>
					</div>

					<div class="form-group col-md-4">
						<label for="">Middle Name:</label>
						<input type="text" name="middlename" id="middlename" class="form-control" 
						value="<?php echo $row['Middlename'];?>" readonly>
					</div>

					<div class="form-group col-md-4">
						<label for="">Date of Birth:</label>
						<input type="text" name="dob" id="dob" class="form-control" 
						value="<?php echo date('M d Y', $date);?>" readonly>
					</div>

					<div class="form-group col-md-4">
						<label for="">Age:</label>
						<input type="text" name="age" id="age" class="form-control" 
						value="<?php echo $row['Age'];?>" readonly>
					</div>

					<div class="form-group col-md-4">
						<label for="">Gender</label>
						<input type="text" name="gender" id="gender" class="form-control" 
						value="<?php echo $row['Gender'];?>" readonly>
					</div>

					<div class="form-group col-md-6">
						<label for="">Contact:</label>
						<input type="text" name="contact" id="contact" class="form-control" 
						value="<?php echo $row['Phone'];?>" readonly>
					</div>

					<div class="form-group col-md-6">
						<label for="">Address:</label>
						<input type="text" name="address" id="address" class="form-control" 
						value="<?php echo $row['Address'];?>" readonly>
					</div>

					<div class="form-group col-md-12">
						<label for="">Email:</label>
						<input type="email" name="email" id="email" class="form-control" 
						value="<?php echo $row['Email'];?>" readonly>
					</div>

					<div class="form-group col-md-12">
						<label for="">Guardian Name:</label>
						<input type="text" name="gname" id="gname" class="form-control" 
						value="<?php echo $row['GLastname'], " ", $row['GFirstname'], " ", $row['GMiddlename'];?>">
					</div>

					<div class="form-group col-md-12">
						<label for="">Guardian Contact:</label>
						<input type="text" name="gcontact" id="gcontact" class="form-control" 
						value="<?php echo $row['GContact'];?>" readonly>
					</div>

					<div class="form-group col-md-12 text-right" 
					style="font-size:40px; cursor: pointer;">
						<a href="#" onclick="editProfile('<?php echo $student_id; ?>')"><i class="fa fa-edit"></i></a>
					</div>


					</div>
					


				</div>


			</form>

      	</div>

  </section>

</div> 
<?php include_once 'footer.php'?>

<!-- JAVASCRIPT EDIT PROFILE-->
<script>

function editProfile(student_id){

var xhttp = new XMLHttpRequest(); 
  xhttp.onreadystatechange = function() {   
	  
	  document.getElementById('my_profile').innerHTML = this.responseText;//
		  $("#panel_footer").hide();
			$("#note1").hide();
		  
			
	}
	xhttp.open("GET", "edit_profile.php" , true);                       
	xhttp.send();
			  
  };

  var loadFile = function(img) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};
</script>

  <div class="row" id="fProfile"> 
	