<?php 
include_once 'database/connection.php';
include_once 'model/faculty.php';

?>
<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<title>HCA Portal | Faculty Form</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet"  href="css/admin/form.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="content">
	<div class="navbar">
	<img src="assets/image/logo.png" class="logo">
	<h3><span>Holy Child Academy</span></h1>
	<nav>
		<ul id="menuList">
			<li><a href="logout.php">LOG IN</a></li>

		</ul>
	</nav>
	</div>
	<div class="color"></div>

	<div class="main-content">
		<div class="box-form">
			<?php
			$date = date("M d, Y");
			?>

			<form action="" method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-8">
					<h2>Faculty Registration Form</h2>
					
				</div>

				<div class="col-md-3" id="clock"></div>
				<div class="col-md-12"><hr></div>
				<div class="form-group col-md-6">
					
                    <label for="">Date Of Registration:</label>
                       	<input type= "text" name = "rdate" class = "form-control" readonly value="<?php echo $date?>">
           		 </div>

           		 <div class="form-group col-md-6">
					
                    <label for="">Account Type</label>
                       <select name="access" id="access" class="form-control">
						<option value="" disabled selected>Select Access Type</option>
						<option value="Admin">Administrator</option>
						<option value="Teacher">Teacher</option>
						<option value="Librarian">Librarian</option>
						<option value="Nurse">Nurse</option>
						<option value="Cashier">Cashier</option>
						<option value="Guidance">Guidance</option>

					   </select>
           		 </div>

				<div class="form-group col-md-3">
					
                    <label for="">Salutation:</label>
                       	<input type= "text" name= "salutation" id="salutation" class = "form-control" >
           		 </div>

           		 <div class="form-group col-md-3">
					
                    <label for="">Last Name:</label>
                       	<input type= "text" name= "lastname" id="lastname" class = "form-control" >
           		 </div>

           		 <div class="form-group col-md-3">
					
                    <label for="">First Name:</label>
                       	<input type= "text" name= "firstname" id="firstname" class = "form-control" >
           		 </div>

           		 <div class="form-group col-md-3">
					
                    <label for="">Middle Name:</label>
                       	<input type= "text" name= "middlename" id="middlename" class = "form-control" >
           		 </div>

           		 <div class="form-group col-md-4">
					
                    <label for="">Date of Birth:</label>
                       	<input type= "date" name= "birthdate" id="birthdate" class = "form-control" onkeyup="AgeVal(0)" >
           		 </div>

           		 <div class="form-group col-md-4">
					
                    <label for="">Age:</label>
                       	<input type= "number" name= "age" id="age" class = "form-control" readonly>
           		 </div>

           		 <div class="form-group col-md-4">
					
                    <label for="">Gender:</label>
                       	<select name="gender" id="gender" class = "form-control">
                        		<option selected disabled> Select Gender</option>
                        		<option value="Male">Male</option>
                        		<option value="Female">Female</option>
                    	</select>
           		 </div>

           		 <div class="form-group col-md-6">
					
                    <label for="">Address:</label>
                       	<input type= "text" name= "address" id="address" class = "form-control" >
           		 </div>

           		 <div class="form-group col-md-6">
					
                    <label for="">Nationality:</label>
                       	<input type= "text" name= "nationality" id="nationality" class = "form-control" >
           		 </div>

           		 <div class="form-group col-md-6">
					
                    <label for="">Contact:</label>
                       	<input type= "number" name= "phone" id="phone" class = "form-control">
           		 </div>

           		 <div class="form-group col-md-6">
					
                    <label for="">Email:</label>
                       	<input type= "email" name= "email" id="email" class = "form-control" >
           		 </div>

           		 <div class="form-group col-md-6 text-center">
                    
                       		<input type= "checkbox" name= "checkbox" id="checkbox"><label for="" style=""> I HEREBY CERTIFY that the information provided in this form is complete, true and correct to the best of my knowledge.</label>
                       		
           		 </div>

           		 <div class="form-group col-md-4">
           		 	<label for="">Photo</label>
           		 	<div id="">
                        <img id="output" class="rounded-corncers" style="width:150px; height:150px;" />
                        <input type="file" accept="image/*" name="my_image" id="file" onchange="loadFile(event)" style="margin-top:7px;"  />
                    </div>
           		 </div>
           		 <div class="form-group col-md-6">
           		 	<a href="index.php" class="btn btn-danger">Go Back</a>
           		 </div>

           		 <div class="form-group col-md-6">
           		 	<input type="submit" name="save" id="save"class="btn btn-success" value="Save">
           		 </div>
           		


				
			</div>
			</form>
			</div>

			
		</div>
		

	</div>

</div>

	
</body>


<script>

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

	var loadFile = function(img) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};

function Time() {

 var date = new Date();

 var hour = date.getHours();

 var minute = date.getMinutes();

 var second = date.getSeconds();

 var period = "";

 if (hour >= 12) {
 period = "PM";
 } else {
 period = "AM";
 }

 if (hour == 0) {
 hour = 12;
 } else {
 if (hour > 12) {
 hour = hour - 12;
 }
 }

 hour = update(hour);
 minute = update(minute);
 second = update(second);

 document.getElementById("clock").innerText = hour + " : " + minute + " : " + second + " " + period;

 setTimeout(Time, 1000);
}

function update(t) {
 if (t < 10) {
 return "0" + t;
 }
 else {
 return t;
 }
}
Time();
</script>
</html>