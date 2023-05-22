<?php include '../model/model-admission.php'?>
<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<title>HCA Portal | Student Admission</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet"  href="../assets/style/std-admission.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="content">
	<div class="navbar">
	<img src="../assets/image/logo.png" class="logo">
	<h1><span>Holy Child Academy</span></h1>
	<nav>
		<ul id="menuList">
			<li><a href="#">EVENTS</a></li>
			<li><a href="#">ABOUT US</a></li>
			<li><a href="#">ADMISSION</a></li>
			<li><a href="../index.php">LOG IN</a></li>

		</ul>
	</nav>
	
	
	</div>
<div class="color"></div>


<div class="main">
  
  <div class="box-form">
  	<h2>Student Admission Form</h3>
		<hr class="line1">
 			<?php
              date_default_timezone_set('Asia/Manila');
              $date = date("l jS \of F Y h:i:s A");
             ?>
    <form action="" method="POST" enctype="multipart/form-data">
    	<div class="form-row">

    		<div class="form-group col-md-6" style="margin-top: 10px; margin-bottom: 5px;">
       			 <h3>Student Information</h3>
        	</div>

        	<div class="form-group col-md-6" style="margin-bottom: -100px; margin-top: -5px;">
        		            <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger text-center"><button type="button" class="close" data-dismiss="alert">&times;</button>
                            <p><?php echo $_GET['error']; ?></p>
                          </div>
                        <?php endif ?>

                        <?php if(isset($_GET['info'])): ?><button type="button" class="close" data-dismiss="alert">&times;</button>
                              <div class="alert alert-success text-center">
                                  <p><?php echo $_GET['info']; ?></p>
                              </div>
                        <?php endif?>
       			 
        	</div>

       	</div>
         	<hr>
            	<div class="form-row">
                
                	<div class="form-group col-md-12">
                    
                    	<label for="">Date Of Registration:</label>
                       		<input type= "text" name= "date" id="date" class = "form-control" readonly value="<?php echo ($date)?>">
           		 	</div>

					<div class="form-group col-md-4">
                    
                    	<label for="">Last Name:</label>
                       		<input type= "text" name= "lastname" id="lastname" class = "form-control" >

           		 	</div>

           		 	<div class="form-group col-md-4">
                    
                    	<label for="">First Name:</label>
                       		<input type= "text" name= "firstname" id="firstname" class = "form-control" >
                       		
           		 	</div>

           		 	<div class="form-group col-md-4">
                    
                    	<label for="">Middle Name:</label>
                       		<input type= "text" name= "middlename" id="middlename" class = "form-control" >
                       		
           		 	</div>

           		 	<div class="form-group col-md-4">
                    
                    	<label for="">Date of Birth:</label>
                       		<input type= "date" name= "birthdate" id="birthdate" class = "form-control" onkeyup="AgeVal(0)">

           		 	</div>

           		 	<div class="form-group col-md-4">
                    
                    	<label for="">Age:</label>
                       		<input type= "number" name= "age" id="age" class = "form-control" readonly>
                       		
           		 	</div>

           		 	<div class="form-group col-md-4">
                    
                    	<label for="">Place of Birth:</label>
                       		<input type= "text" name= "pbirth" id="pbirth" class = "form-control" >
                       		
           		 	</div>

           		 	<div class="form-group col-md-4">
                    
                    	<label for="">Gender:</label>
                       		<select name="gender" id="gender" class = "form-control">
                        		<option selected disabled> Select Gender</option>
                        		<option value="Male">Male</option>
                        		<option value="Male">Female</option>
                    		</select>
                       		
           		 	</div>

           		 	<div class="form-group col-md-4">
                    
                    	<label for="">Status:</label>
                       		<select name="status" id="status" class = "form-control">
                        		<option selected disabled>Select Status</option>
                        		<option value="Single">Single</option>
                        		<option value="Married">Married</option>
                        		<option value="In a Relationship">In a Relationship</option>
                        		<option value="Divorce">Divorce</option>
                        		<option value="Widowed">Widowed</option>
                    		</select>
                       		
           		 	</div>

           		 	<div class="form-group col-md-4">
                    
                    	<label for="">Nationality:</label>
                       		<input type= "text" name= "nationality" id="nationality" class = "form-control" >
                       		
           		 	</div>

           		 	<div class="form-group col-md-6">
                    
                    	<label for="">Address:</label>
                       		<input type= "text" name= "address" id="address" class = "form-control" >
                       		
           		 	</div>

           		 	<div class="form-group col-md-6">
                    
                    	<label for="">Permanent Address:</label>
                       		<input type= "text" name= "paddress" id="paddress" class = "form-control" >
                       		
           		 	</div>

           		 	<div class="form-group col-md-6">
                    
                    	<label for="">Contact Number:</label>
                       		<input type= "number" name= "sphone" id="sphone" class = "form-control" >
                       		
           		 	</div>

           		 	<div class="form-group col-md-6">
                    
                    	<label for="">Email:</label>
                       		<input type= "email" name= "email" id="email" class = "form-control" >
                       		
           		 	</div>

           		</div>

           			<hr>
           		 <h3>Parents/ Guardian Information</h2>
         			<hr class="line1">
            	<div class="form-row" id="pinformation">

            		<div class="form-group col-md-4">
                    
                    	<label for="">Father's Last Name:</label>
                       		<input type= "text" name= "flastname" id="name" class = "form-control" >
                       		
           		 	</div>

            		<div class="form-group col-md-4">
                    
                    	<label for="">Father's First Name:</label>
                       		<input type= "text" name= "ffirstname" id="ffirstname" class = "form-control" >
                       		
           		 	</div>

           		 	<div class="form-group col-md-4">
                    
                    	<label for="">Father's Middle Name:</label>
                       		<input type= "text" name= "fmiddlename" id="fmiddlename" class = "form-control" >
                       		
           		 	</div>

           		 	<div class="form-group col-md-6">
                    
                    	<label for="">Father's Occupation:</label>
                       		<input type= "text" name= "foccupation" id="foccupation" class = "form-control" >
                       		
           		 	</div>

           		 	<div class="form-group col-md-6">
                    
                    	<label for="">Father's Contact:</label>
                       		<input type= "number" name= "fphone" id="fphone" class = "form-control" maxlength="11" >
                       		
           		 	</div>

           		 		<div class="form-group col-md-4">
                    
                    	<label for="">Mother's Last Name:</label>
                       		<input type= "text" name= "mlastname" id="mlname" class = "form-control" >
                       		
           		 	</div>

            		<div class="form-group col-md-4">
                    
                    	<label for="">Mother's First Name:</label>
                       		<input type= "text" name= "mfirstname" id="mfirstname" class = "form-control" >
                       		
           		 	</div>

           		 	<div class="form-group col-md-4">
                    
                    	<label for="">Mother's Middle Name:</label>
                       		<input type= "text" name= "mmiddlename" id="mmiddlename" class = "form-control" >
                       		
           		 	</div>

           		 	<div class="form-group col-md-6">
                    
                    	<label for="">Mother's Occupation:</label>
                       		<input type= "text" name= "moccupation" id="moccupation" class = "form-control" >
                       		
           		 	</div>

           		 	<div class="form-group col-md-6">
                    
                    	<label for="">Mother's Contact:</label>
                       		<input type= "number" name= "mphone" id="mphone" class = "form-control" maxlength="11" >
                       		
           		 	</div>

           		 		<div class="form-group col-md-6">
                    
                    	<label for="">Guardian's Name:</label>
                       		<input type= "text" name= "gname" id="gname" class = "form-control" >
                       		
           		 	</div>

           		 	<div class="form-group col-md-6">
                    
                    	<label for="">Guardian's Contact:</label>
                       		<input type= "number" name= "gphone" id="gphone" class = "form-control" maxlength="11" >
                       		
           		 	</div>

           		 	 <div class="form-group col-md-6">
                    
                            <input type= "checkbox" name= "checkbox" id="checkbox" ><label for="" style=""> I HEREBY CERTIFY that the information provided in this form is complete, true and correct to the best of my knowledge.</label>
                            
                 </div>

                 <div class="form-group col-md-4">
                    <label for="">Photo</label>
                    <div id="">
                        <img id="output" class="rounded-corncers" style="width:150px; height:150px;" />
                        <input type="file" accept="image/*" name="my_image" id="file" onchange="loadFile(event)" style="margin-top:7px;"  />
                    </div>
                 </div>

           		 <div class="form-group col-md-6">
                    <a href="student/std_login.php" class="btn btn-danger">Go Back</a>
                 </div>

                 <div class="form-group col-md-6">
                    <input type="submit" name="submit" id="submit"class="btn btn-success" value="Submit">
                 </div>



            	</div>

    </form>
  </div> 
  </div> 
  </div>

</body>

<script type="text/javascript">
    var loadFile = function(img) {
    var image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);
};
	
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

        function populate(s1,s2) {
        	var s1 = document.getElementById(s1);
			var s2 = document.getElementById(s2);
			s2.innerHTML = "";

			if(s1.value == "Grade 11" || s1.value == "Grade 12"){
				var optionStrand = ["Select Strand:","GAS","ABM","HUMSS","TVL"];

				var strStrand = "";
				strStrand = strStrand + "<option disabled selected value="+ optionStrand[0]+">"+optionStrand[0]+"</option>";
         				document.getElementById("strand").innerHTML = strStrand;
         				document.getElementById("strand").disabled = false;


	 for(i=1;i<optionStrand.length;i++)
                {
                    strStrand =strStrand +"<option value="+optionStrand[i]+">"+optionStrand[i]+"</option>";
                }
                document.getElementById("strand").innerHTML = strStrand;
			}
			else{
				var optionStrand = ["Not Applicable"];

				var strStrand = "";
					strStrand = strStrand + "<option disabled selected value="+ optionStrand[0]+">"+optionStrand[0]+"</option>";
         				document.getElementById("strand").innerHTML = strStrand;
         				document.getElementById("strand").disabled = true;
			}
        }

        function edt(type){

        	var selectedValue = type.options[type.selectedIndex].value;
        	var SLA = document.getElementById("SLA");
        	var sy = document.getElementById("sy");
        	var genAve = document.getElementById("genAve");

        	SLA.disabled = selectedValue == 2 ? false : true;
        	sy.disabled = selectedValue == 2 ? false : true;
        	genAve.disabled = selectedValue == 2 ? false : true;

        	if (!SLA.disabled && !sy.disabled & !genAve.disabled) {
        		SLA.value = ""
    
        	}else{
        		SLA.value = "Not Applicable"
        		sy.value = "Not Applicable"
        		genAve.value = "Not Applicable"
        	}

        }
      
</script>
</html>