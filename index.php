<?php include_once 'database/connection.php';

$get = mysqli_query($con, "SELECT * FROM academic_list Where is_default = '1'");
$row = mysqli_fetch_assoc($get);
$status = $row['Status'];
$sy = $row['School_Year']
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Holy Child Academy of Binalonan</title>
	<link rel="icon" href="assets/image/logo.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
	<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	

</head>
<body>

<section class="header">
	<div class="col-md-12">
		<nav>
				<a href="index.php">
					<img src="assets/image/child.png" width="270px">
				</a>

				<div class="nav-links" id="">
					<ul id="navLinks">
						<li><a href="index.php" class="home">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#message">Contact Us</a></li>
						<li><a href="student/std_login.php">Portal</a></li>
						<li class="enroll"><button type="button" data-toggle="modal" data-target="#enrollment_modal" class="btn btn-primary form-control">Enroll Now</button></li>
						<li></li>
					</ul>
					<img src="assets/image/menu.png" class="menu-icon" onclick="togglemenu()">
				</div>
		</nav>
	</div>
</section>
<section class="content">
		<div class="swiper" id="swiper">
		  <!-- Additional required wrapper -->
		  <div class="swiper-wrapper">
		  	<?php
		  		$get = mysqli_query($con, "SELECT * FROM sys_image Where Status = '1' Order By ID Asc");
		  		while($row = mysqli_fetch_assoc($get)){
		  	?>
		  		<div class="swiper-slide"><img src="image/<?=$row['Image']?>"></div>
	  		<?php }?>
		  </div>
		  <!-- If we need pagination -->
		  <div class="swiper-pagination"></div>

		  <!-- If we need navigation buttons -->
		  <div class="swiper-button-prev"></div>
		  <div class="swiper-button-next"></div>
		</div>

	<div class="title">
		<div class="col-md-3"></div>
		<div class="col-md-6 text-center"><h1>Welcome to Holy Child Academy</h1></div>
		<div class="col-md-3"></div>
	</div>

	<div class="title">
		<div class="col-md-3"></div>
		<div class="col-md-6 text-center">
			<?php  
				$get = mysqli_query($con, "SELECT * from sys_video Where Status = '1'");
				while ($row = mysqli_fetch_assoc($get)) {
				?>
				<video height="240" 
				 source src="video/<?=$row['Video']?>" controls loop="true" autoplay="true" muted>
			</video>
			<?php }?>

			
		</div>
		<div class="col-md-3"></div>
	</div>

	<div class="enrollment_page">
		
		<div class="row">
			<div class="col-md-12 text-center">
				<h1>Online Enrollment is on going</h1>
			</div>

			<div class="col-md-12 text-center">
					<button type="button" data-toggle="modal" data-target="#enrollment_modal" class="new-student">New Student</button>
					<button type="button" onclick="document.location.href='student/std_login.php'" class="old-student">Old Student</button>
			</div>
		</div>
	</div>

	<div class="-page">
		
		<div class="row">
			<div class="col-md-12">
				<h1>
					Mission & Vision
				</h1>
			</div>

		<div class="mission-col">
			<h3>Mission</h3>
			<p>Holy child academy is a catholic school. It is our commitment to fulfill the mission of the church; to proclaim the gospel of Jesus Christ and to continue his work among today's young people. This devine mission is what ultimately inspires and impowers us.</p>
		</div>

		<div class="mission-col">
			<h3>Vision</h3>
			<p>The holy child academy is an institution committed to providing affordable quality education and contributing to the development of a nation that is responsible, disciplined, and well-rounded individuals who work toward the realization of their full potentials in the service of God, Country, and Fellowmen. The school aims to include in the students pride and dignity of being a Filipino, without neglecting to respect the rights, beliefs, and tradition of other people in the world.</p>
		</div>
		</div>
	</div>

	<div class="message_page text-center" id="message">
		<h2>We'd love to hear from you!<br>Our school is ready to answer your questions.</h2>

		<div class="input">
			<form action="" method="GET" id="message-form">
				<input type="text" name="name_query" id="name_query" placeholder="*Name" class="form-control form-group">
				<input type="number" name="contact_query" id="contact_query" placeholder="*Enter Contact Number" class="form-control form-group">
				<input type="email" name="email_query" id="email_query" placeholder="*Enter Email Address" class="form-control form-group">
				<textarea name="message_query" id="message_query" cols="5" rows="2" placeholder="*Message" class="form-control form-group"></textarea>
				<button type="button" id="send" class="btn btn-danger">Send</button>
			</form>
		</div>
	</div>

	<div class="info-page text-center">
		<div class="icons">
			<ul class="info">
				<li><a href="#"><i class="fa fa-map-marker"></i>Oct 16 St. Poblacion, Binalonan, Pangasinan</a>
				<li><a href="#"><i class="fa fa-phone"></i>075 632 3049</a>
				<li><a href="https://www.facebook.com/HCABin"><i class="fa fa-facebook-square"></i>https://www.facebook.com/HCABin</a>
				<li><a href="#"><i class="fa fa-envelope-o"></i>HolyChildAcademyBinalonan@gmail.com</a>
			</ul>
		</div>
	</div>
</section>



</body>
<footer></footer>
</html>

<div class="modal fade" id="enrollment_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
       	 	<?php
       	 		if ($status == 1) {
       	 			?>
       	 			<div class="container">
       	 				
       	 					<form action="" id="enrollment_form" method="POST" class="form-enroll" enctype="multipart/form-data">
       	 						<div class="row first form">
       	 							<div class="col-md-12">
       	 								<header>Enrollment Registration</header>
       	 							</div>

       	 							<div class="title col-md-12">
       	 								Personal Details
       	 							</div>

       	 							<div class="col-md-3 input-field">
       	 								<label>Last Name</label>
       	 								<input type="text" name="lastname" id="lastname" placeholder="Last Name" class="form-control form-group" required>
       	 							</div>

       	 							<div class="col-md-3 input-field">
       	 								<label>First Name</label>
       	 								<input type="text" name="firstname" id="firstname" placeholder="First Name" class="form-control form-group" required>
       	 							</div>

       	 							<div class="col-md-3 input-field">
       	 								<label>Middle Name</label>
       	 								<input type="text" name="middlename" id="middlename" placeholder="Middle Name" class="form-control form-group" required>
       	 							</div>

       	 							<div class="col-md-3 input-field">
       	 								<label>Extension Name</label>
       	 								<input type="text" name="suffix" id="suffix" placeholder="If applicable" class="form-control form-group">
       	 							</div>

       	 							<div class="col-md-3 input-field" novalidated>
       	 								<label>Date of Birth</label>
       	 								 <input type="date" name= "birthdate" id="birthdate" class = "form-control" onkeyup="AgeVal(0)" required>
       	 							</div>

       	 							<div class="col-md-3 input-field">
       	 								<label>Age</label>
       	 								<input type="number" name="age" id="age" readonly class="form-control">
       	 							</div>

       	 							<div class="col-md-3 input-field">
       	 								<label>Place of Birth</label>
       	 								<input type="text" name="pob" id="pob" placeholder="Place of birth" class="form-control form-group" required>
       	 							</div>

       	 							<div class="col-md-3 input-field">
       	 								<label>Gender</label>
       	 								<select name="gender" id="gender" class="form-control" required>
       	 									<option value="">Select here</option>
       	 									<option value="Male">Male</option>
       	 									<option value="Female">Female</option>
       	 								</select>
       	 							</div>

       	 							<div class="col-md-6 input-field">
       	 								<label>Nationality</label>
       	 								<input type="text" name="nationality" id="nationality" class="form-control" placeholder="Nationality" required>
       	 							</div>

       	 							<div class="col-md-6 input-field">
       	 								<label for="">Status:</label>
	                       	<select name="status" id="status" class = "form-control" required>
	                        	<option value="">Select Status</option>
	                        	<option value="Single">Single</option>
			                  		<option value="Married">Married</option>
			                  		<option value="In a Relationship">In a Relationship</option>
			                  		<option value="Divorce">Divorce</option>
			                  		<option value="Widowed">Widowed</option>
	                    		</select>	
       	 							</div>

       	 							<div class="col-md-6 input-field">
       	 								<label>Email</label>
       	 								<input type="email" name="email" id="email1" class="form-control" placeholder="Email" required>
       	 							</div>

       	 							<div class="col-md-6 input-field">
       	 								<label>Contact Number</label>
       	 								<input type="number" name="contact" id="contact1" placeholder="Contact Number" class="form-control form-group" required>
       	 							</div>
       	 							<div class="col-md-6"></div>
       	 							<div class="col-md-6 input-field">
       	 								<label>Picture</label><br>
       	 								<img id="output" class="rounded-corncers" style="width:150px; height:150px; margin-bottom: 10px;"/>
                        <input type="file" accept="image/*" name="image" id="image" onchange="loadFile(event)">
       	 							</div>

       	 							<div class="title col-md-12">
       	 								Enrollment Details
       	 							</div>

       	 							<div class="col-md-3 input-field">
       	 								<label>School Year</label>
       	 								<input type="text" name="sy" id="sy" readonly value="<?=$sy?>" class="form-control form-group">
       	 							</div>

       	 							<div class="col-md-3 input-field">
       	 								<label>Semester</label>
       	 									<select name="semester" id="semester" class="form-control" disabled>
                            <option hidden selected>Please Select Here</option>
                            <?php 
                            $get = mysqli_query($con, "SELECT * FROM academic_list Where is_default = '1'");
                                  while($row = mysqli_fetch_assoc($get)){
                                  ?>
                                  <option value="<?=$row['Semester']?>"><?=$row['Semester']?></option> 
                            <?php }?>
	                        </select> 
       	 							</div>

       	 							<div class="col-md-3 input-field">
       	 								<label>Enrollment Type</label>
       	 								<select name="type" id="type" class="form-control" required>
       	 									<option value="">Select here</option>
       	 									<option value="New">New</option>
       	 									<option value="Transferee">Transferee</option>
       	 								</select>
       	 							</div>

       	 							<div class="col-md-3 input-field">
       	 								<label>LRN</label>
       	 								<input type="text" name="lrn" id="lrn" placeholder="If applicable" class="form-control form-group">
       	 							</div>

       	 							<div class="col-md-4 input-field">
       	 								<label>Grade Level to Enroll</label>
	       	 								<select name="grade" id="grade" class="form-control" required>
	                              <option value="">Please Select Here</option>
	                              <?php  
	                                    $get = mysqli_query($con, "SELECT * FROM grade Order By ID ASC");
	                                    while($row = mysqli_fetch_assoc($get)){
	                                    ?>
	                                    <option value="<?=$row['Name']?>"><?=$row['Name']?></option> 
	                              <?php }?>
	                              
	                        </select> 
       	 							</div>

       	 							<div class="col-md-6 input-field">
       	 								<label>Strand</label>
	       	 								<select name="strand" id="strand" class="form-control" disabled>
	                              <option hidden selected>Please Select Here</option>    
	                        </select> 
       	 							</div>

       	 							<div class="col-md-2 input-field">
       	 								<label>Average</label>
	       	 							<input type="number" name="average" id="average" placeholder="Average" class="form-control form-group" required>
       	 							</div>


       	 							<div class="col-md-4 input-field">
       	 								<label>Last School Attended</label>
       	 								<input type="text" name="lsa" id="lsa" placeholder="Last school attended" class="form-control form-group" required>
       	 							</div>

       	 							<div class="col-md-4 input-field">
       	 								<label>Last School Year Attended</label>
       	 								<input type="text" name="lsya" id="lsya" placeholder="Last school year attended" class="form-control form-group" required>
       	 							</div>

       	 							<div class="col-md-4 input-field">
       	 								<label>Last grade completed</label>
       	 								<input type="text" name="lgc" id="lgc" placeholder="Last grade completed" class="form-control form-group" required>
       	 							</div>

											<div class="col-md-4">
												<button type="button" class="nextBtn">
	                        <span class="btnText">Next</span>
	                        <i class="uil uil-navigator"></i>
                    		</button>
											</div>
       	 						</div>

       	 						<div class="row second form">
       	 							<div class="col-md-12">
       	 								<header>Enrollment Registration</header>
       	 							</div>
       	 							<div class="title col-md-12">
       	 								Address Details
       	 							</div>

       	 							<div class="col-md-4 input-field">
       	 								<label>House No.</label>
       	 								<input type="number" name="houseno" id="houseno" placeholder="House No." class="form-control form-group" required>
       	 							</div>

       	 							<div class="col-md-4 input-field">
       	 								<label>Street Name</label>
       	 								<input type="text" name="street" id="street" placeholder="Street Name" class="form-control form-group" required>
       	 							</div>

       	 							<div class="col-md-4 input-field">
       	 								<label>Barangay</label>
       	 								<input type="text" name="barangay" id="barangay" placeholder="Barangay" class="form-control form-group" required>
       	 							</div>

       	 							<div class="col-md-3 input-field">
       	 								<label>Municipality/ City</label>
       	 								<input type="text" name="city" id="city" placeholder="Municipality/ City" class="form-control form-group" required>
       	 							</div>

       	 							<div class="col-md-3 input-field">
       	 								<label>Province</label>
       	 								<input type="text" name="province" id="province" placeholder="Province" class="form-control form-group" required>
       	 							</div>

       	 							<div class="col-md-3 input-field">
       	 								<label>Country</label>
       	 								<input type="text" name="country" id="country" placeholder="Country" class="form-control form-group" required>
       	 							</div>

       	 							<div class="col-md-3 input-field">
       	 								<label>Zip Code</label>
       	 								<input type="number" name="code" id="code" placeholder="Zip Code" class="form-control form-group" required>
       	 							</div>

       	 							<div class="title col-md-12">
       	 								Guardian Details
       	 							</div>
       	 							<div class="col-md-4 input-field">
       	 								<label>Last Name</label>
       	 								<input type="text" name="glname" id="glname" placeholder="Last Name" class="form-control form-group" required>
       	 							</div>

       	 							<div class="col-md-4 input-field">
       	 								<label>First Name</label>
       	 								<input type="text" name="gfname" id="gfname" placeholder="First Name" class="form-control form-group" required>
       	 							</div>

       	 							<div class="col-md-4 input-field">
       	 								<label>Middle Name</label>
       	 								<input type="text" name="gmname" id="gmname" placeholder="Middle Name" class="form-control form-group" required>
       	 							</div>

       	 							<div class="col-md-12 input-field form-group">
       	 								<label>Contact</label>
       	 								<input type="number" name="gcontact" id="gcontact" placeholder="Contact" class="form-control form-group" required>
       	 							</div>
       	 							<br>

       	 							<div class="col-md-12 input-field">
       	 								<input type="checkbox" name="check" id="check" value="" required>
       	 								<span style="font-size:13px; font-weight:300;">I hereby certify that the above information given are true and correct to the best of my knowledge and I allow the Department of Education to use my informations that i provide to create and/or update my learner profile in the Learner Information System. The Information herein shall be treated as confidential in compliance with the Data Privacy Act of 2012.</span>
       	 								<hr>
       	 							</div>

       	 							<div class="col-md-6 input-field">
       	 								<table class="table" style="font-size:13px; font-weight: 400;">
       	 									<thead>
       	 										<tr>
       	 										<td>*Requirements:</td>
       	 									</tr>
       	 									</thead>
       	 									<tr>
       	 										<td><small>PSA Birth Certificate</small></td>
       	 									</tr>
       	 									<tr>
       	 										<td><small>Baptismal | Confirmation Certificate</small></td>
       	 									</tr>
       	 									<tr>
       	 										<td><small>Good Moral</small></td>
       	 									</tr>
       	 									<tr>
       	 										<td><small>Form 138</small></td>
       	 									</tr>
       	 									<tr>
       	 										<td><small>Form 137</small></td>
       	 									</tr>
       	 									<tr>
       	 										<td><small>2pc 2x2 Picture</small></td>
       	 									</tr>
       	 									<tr>
       	 										<td><small>Certificate of Completion</small></td>
       	 									</tr>
       	 								</table>
       	 							</div>

       	 							<div class="col-md-6 input-field">
       	 								<table class="table" style="font-size:13px; font-weight: 400;">
       	 									<thead>
       	 										<tr>
       	 											<td>Assessment of Fees</td>
       	 											<td>Amount</td>
       	 										</tr>
       	 									</thead>
       	 									<tbody id="fees">
       	 										
       	 									</tbody>
       	 								</table>
       	 							</div>

       	 							<div class="col-md-4">
       	 								<div class="backBtn">
                            <i class="uil uil-navigator"></i>
                            <span class="btnText">Back</span>
                        </div>
       	 							</div>

       	 							<div class="col-md-4">
       	 								<button type="submit" id="save" class="sumbit">
                            <span class="btnText">Submit</span>
                            <i class="uil uil-navigator"></i>
                        </button>
       	 							</div>
       	 						</div>
       	 					</form>
       	 			</div>
       	 			<?php
       	 		}else{
       	 			?>
       	 			<div class="modal-body">
       	 				<div class="greetings">
       	 					<h4>Greetings from Holy Child Academy!</h4>
       	 				</div>

       	 				<div class="greetings">
       	 					<p>Enrollment is still closed!</p>
       	 					<p>Please wait for the next announcement.</p>
       	 					<p>Thank you and God bless!</p>
       	 					<hr>
       	 					<p>For any other help, find and like us on Facebook and send us a message.</p>
       	 				</div>
       	 			</div>
       	 			<?php
       	 		}
       		?>
       </div>
  </div>
</div>

<script>
var loadFile = function(img) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};

	const swiper = new Swiper('.swiper', {
	effect: 'coverflow',
  loop: true,
  autoplay:{
  	delay: 10000,
  	disableOnInteraction:false,
  },
  slidesPerView: 'auto',
  coverfloweffect:{
  	rotate: 50,
  	stretch: 0,
  	depth: 100,
  	modifier: 1,
  	slideShadow: true
  },

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
    clickable: true
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

});

$(document).ready(function(){
	$('#send').click(function(){
		var name = $('#name_query').val();
		var contact = $('#contact_query').val();
		var email = $('#email_query').val();
		var message = $('#message_query').val();

		if (name == "" || contact == "" || email == "" || message == "") {
			Swal.fire(
		      'All Fields Required!',
		      '',
		      'info'
	    	)
		}else{
			$.ajax({
				url: "send_queries.php",
				method: "GET",
				data: $('#message-form').serialize(),
				success:function(data){
					if (data == success) {
						Swal.fire(
				      'Message successfully Send!',
				      '',
				      'success'
			    	)	
					}
				}
			})

		}
	})

  $('#grade').change(function(){
        var gid = $(this).val();

        if (gid == "Grade 11" || gid == "Grade 12") {
        	document.getElementById('strand').disabled = false;
        	document.getElementById('semester').disabled = false;
        }else{
        	document.getElementById('strand').disabled = true;
        	document.getElementById('semester').disabled = true;
        }

        $.ajax({
        	url: "filter-strand.php",
        	method: "GET",
        	data:{
        		gid:gid
        	},
        	success:function(data){
        		$('#strand').html(data);
        	}
        });

        $.ajax({
        	url: "filter_payment.php",
        	method: "GET",
        	data:{
        		gid:gid
        	},
        	success:function(data){
        		$('#fees').html(data);
        	}
        })

        
  })

  $('#enrollment_form').on('submit', function(e){
  	e.preventDefault();
  	start_load();

	  	var formData = new FormData(this);
	    var files = $('#image')[0].files;
	    formData.append('image', files[0]);
   
    	$.ajax({
      url: 'save_application.php',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success:function(data){
        const swalWithBootstrapButtons = Swal.mixin({
			  customClass: {
			    confirmButton: 'btn btn-success',
			  },
			  buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
			  title: 'Data Successfully Saved!',
			  text: "",
			  icon: 'success',
			  showCancelButton: false,
			  confirmButtonText: 'Close',
			}).then((result) => {
			  if (result.isConfirmed) {
			  	location.reload();
			    }
			})
			end_load();
      }
    });

  })

})

const form = document.querySelector(".form-enroll"),
        nextBtn = form.querySelector(".nextBtn"),
        backBtn = form.querySelector(".backBtn"),
        allInput = form.querySelectorAll(".first input");


nextBtn.addEventListener("click", ()=> {

    var lastname = $('#lastname').val();
    var firstname = $('#firstname').val();
    var middlename = $('#middlename').val();
    var pob = $('#pob').val();
    var nationality = $('#nationality').val();
    var status = $('#status').val();

    var gender = $('#gender').val();
    var email = $('#email1').val();
    var contact = $('#contact1').val();
    var type = $('#type').val();

    var grade = $('#grade').val();
    var lsa = $('#lsa').val();
    var lsya = $('#lsya').val();
    var lgc = $('#lgc').val();

    if (lastname=="" || firstname=="" || middlename=="" || pob=="" || gender=="" || contact=="" || email=="" || type=="" || grade=="" || lsa == "" || lsya =="" || lgc =="") {
       Swal.fire(
		      'All Fields Required!',
		      '',
		      'warning'
	    	)

    }else{

        form.classList.add('secActive');
    }
        
})

backBtn.addEventListener("click", () => form.classList.remove('secActive'));


//Start of age//

function formatDate(date){
    var date = new Date(date),
        month = '' + (date.getMonth() + 1),
        day = '' + date.getDate(),
        year = date.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');

}

function getAge(dateString){
    var birth = new Date().getTime();
    if (typeof dateString === 'undefined' || dateString === null || (String(dateString) === 'NaN')){
        
        birth = new Date().getTime();
    }
    birth = new Date(dateString).getTime();
    var now = new Date().getTime();
   
    var n = (now - birth)/1000;
     if (n > 31562417){ 
      var year_n = Math.floor(n/31556926);
        if (typeof year_n === 'undefined' || year_n === null || (String(year_n) === 'NaN')){
            return year_n = '';
        }else{
            return year_n + '' + (year_n > 1 ? '' : '') + '';
        }
    }else{
        
    }
}

function AgeVal(pid){
    var birthd = formatDate(document.getElementById("birthdate").value);
    var count = document.getElementById("birthdate").value.length;
    if (count=='10'){
        var age = getAge(birthd);
        var str = age;
        var res = str.substring(0, 1);
        if (res =='-' || res =='0'){
            document.getElementById("birthdate").value = "";
            document.getElementById("age").value = "";
            $('#birthdate').focus();
            return false;
        }else{
            document.getElementById("age").value = age;
        }
    }else{
        document.getElementById("age").value = "";
        return false;
    }
}

      // End Of Age Script //

window.start_load = function(){
      $('body').prepend('<div id="preloader2"></div>')
    }
    window.end_load = function(){
      $('#preloader2').fadeOut('fast', function() {
          $(this).remove();
        })
    }

</script>

<style type="text/css">



</style>
