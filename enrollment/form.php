<?php include ('main_head.php');
      include ('header.php');
      include ('sidebar.php');
      ob_start();
      include_once ('../database/connection.php');
      include_once ('save_application.php');
      $reg_date=date("F j, Y");
      $sql = "SELECT * FROM academic_list WHERE Status = 1";
      $result = mysqli_query($con, $sql);

      $myID = $_SESSION['username'];
      $sql1 = "SELECT * FROM std_account WHERE username = '$myID'";
      $result1 = mysqli_query($con, $sql1);
      $row1 = mysqli_fetch_assoc($result1);
      
      ?>

<div class="content-wrapper">
  <title>Home</title>
  
    <section class="content-header col-md-12">
      <h1><i class="fa fa-book" aria-hidden="true">
          My Registration
          <small>Preview</small></i>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
      <hr>
            
      <div class="title">
            
        <h4 class="text-center">Registration Form</h4>
      </div>
      <hr>
            <div class="form-group col-md-12">
                  <?php if (isset($_GET['error'])): ?>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <div class="text-danger text-center">
                            <h6><?php echo $_GET['error']; ?></h6>
                          </div>
                  <?php endif ?>
            </div>
  </section>
 
  <!-- ENROLLMENT FORM -->
  <section class = "content">
            <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                  <div class = "col-md-4">
                        <label for="">Date of Registration:</label>
                        <input type="data" value = "<?php echo $reg_date; ?>" class = "form-control" readonly>
                  </div>

                  <div class = "col-md-4">
                        <label>Active School Year:</label>
                        <input type="text" value = "<?php while ($row = mysqli_fetch_assoc($result)) { echo $row['School_Year']; }?>" class = "form-control" readonly placeholder = "No Active School Year">
                  </div>

                  <div class = "col-md-4">
                  <?php
                  $result = mysqli_query($con, $sql);
                  ?>
                        <label>Active Semester:<small>[For SHS Only]</small></label>
                        <input type="text" value = "<?php while ($row = mysqli_fetch_assoc($result)) { echo $row['Semester']; }?>" class = "form-control" readonly placeholder = "No Active School Year">
                  </div>
            </div>
            <hr>
            <hr>

            <div class = row>
                  <div class="form-group col-md-3">
                        <label for="">Last Name:</label>
                        <input type="text" name= "lastname" value = "<?php echo $row1['Lastname'];?>" class = "form-control" required>
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">First Name:</label>
                        <input type="text" name = "firstname" value = "<?php echo $row1['Firstname'];?>" class = "form-control" required>
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">Middle Name:</label>
                        <input type="text" name = "middlename" value = "<?php echo $row1['Middlename'];?>" class = "form-control" required>
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">Suffix:</label>
                        <input type="text" name = "suffix" placeholder = "If Applicable" class = "form-control">
                  </div>

                  <div class="form-group col-md-4">
                        <label for="">Date of Birth:</label>
                        <input type="date" name= "birthdate" id="birthdate" class = "form-control" onkeyup="AgeVal(0)" >
                  </div>

                  <div class="form-group col-md-4">
                        <label for="">Age:</label>
                        <input type="number" name="age" id="age" readonly class="form-control">
                  </div>

                  <div class="form-group col-md-4">
                        <label for="">Place of Birth:</label>
                        <input type="text" name="birth" id="birth"  class="form-control" required>
                  </div>

                  <div class="form-group col-md-4">                    
                        <label for="">Gender:</label>
                       	<select name="gender" id="gender" class = "form-control" >
                        	<option selected disabled> Select Gender</option>
                        	<option value="Male">Male</option>
                        	<option value="Female">Female</option>
                    	</select>                      		
           		</div>

           		<div class="form-group col-md-4">                   
                    	<label for="">Status:</label>
                       	<select name="status" id="status" class = "form-control" >
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
                       	<input type= "text" name= "nationality" id="nationality" class = "form-control"  required>
           		</div>

          		<div class="form-group col-md-4">                  
                    	<label for="">Address:</label>
                       	<input type= "text" name= "address" id="address" class = "form-control" required>                    		
           		</div>

       		<div class="form-group col-md-4">  
                    	<label for="">Permanent Address:</label>
                       	<input type= "text" name= "paddress" id="paddress" class = "form-control" required>
                       		
           		</div>

                       <div class="form-group col-md-4">  
                    	<label for="">LRN:</label>
                       	<input type= "text" name= "lrn" id="lrn" class = "form-control" placeholder="If Applicable" >
                       		
           		</div>

                  <div class="form-group col-md-4">
                    	<label for="">Student Type:</label>
                    	<select name="type" id="type" class = "form-control" onclick="edt(this)" >
                        	<option selected disabled>Student Type</option>
                        	<option value="New">New</option>
                        	<option value="Transferee">Transferee</option>
                    	</select>
           		</div>

                  <div class="form-group col-md-4">
                    <label for="">Grade Applying:</label>
                        <select name="grade" id="grade" class="form-control" onchange="populate(this.id,'strand')" onclick="edt(this)" >
                              <option hidden selected>Please Select Here</option>
                              <?php  
                                    $get = mysqli_query($con, "SELECT * FROM grade Order By ID ASC");
                                    while($row = mysqli_fetch_assoc($get)){
                                    ?>

                                    <option value="<?=$row['Name']?>"><?=$row['Name']?></option> 
                              <?php }?>

                              
                        </select>    
                  </div>

                  <div class="form-group col-md-4">                   
                    	<label for="">Strand:<small>[For SHS Only]</small></label>
                       		<select name="strand" id="strand" class="form-control" disabled="" >
                       			<option hidden selected>Please select here</option>

                    		</select>
                  </div>

                  <div class="form-group col-md-4">                  
                    	<label for="">School Last Attended:</label>
                       		<input type= "text" name= "SLA" id="SLA" class = "form-control" placeholder="If Applicable" disabled>
                       		
           		</div>

           		<div class="form-group col-md-4">
                    	<label for="">Last School Year Attended:</label>
                       		<input type= "text" name= "sy" id="sy" class = "form-control" placeholder="If Applicable" disabled>                     		
           		</div>

           		<div class="form-group col-md-4">                 
                    	<label for="">General Average:</label>
                       		<input type= "text" name= "genAve" id="genAve" class = "form-control" placeholder="If Applicable" disabled>               		
           		</div>

                  <div class="form-group col-md-6">
                    	<label for="">Contact Number:</label>
                       		<input type= "number" name= "sphone" id="sphone" value = "<?php echo $row1['Contact'];?>" class = "form-control" required>	
           		</div>

           		<div class="form-group col-md-6">
                    	<label for="">Email:</label>
                       		<input type= "email" name= "email" id="email" value = "<?php echo $row1['Email'];?>" class = "form-control" required>	
           		</div>

            </div>
            <hr>
            <div class="title">
                  <h4 class="text-center">Parents/ Guardian Information</h4>
            </div>
            <hr>

            <div class="row">
                  <div class="form-group col-md-3">
                        <label for="">Last Name:</label>
                        <input type="text" name="flastname" id="flastname" class="form-control" placeholder="Father Last Name" required>
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">First Name:</label>
                        <input type="text" name="ffirstname" id="ffirstname" class="form-control" placeholder="Father First Name" required>
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">Middle Name:</label>
                        <input type="text" name="fmiddlename" id="fmiddlename" class="form-control" placeholder="Father Middle Name" required>
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">Contact:</label>
                        <input type="number" name="fnum" id="fnum" class="form-control" placeholder="Contact" required>
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">Last Name:</label>
                        <input type="text" name="mlastname" id="mlastname" class="form-control" placeholder="Mother Last Name" required>
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">First Name:</label>
                        <input type="text" name="mfirstname" id="mfirstname" class="form-control" placeholder="Mother First Name" required>
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">Middle Name:</label>
                        <input type="text" name="mmiddlename" id="mmiddlename" class="form-control" placeholder="Mother Middle Name" required>
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">Contact:</label>
                        <input type="number" name="mnum" id="mnum" class="form-control" placeholder="Contact" required>
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">Last Name:</label>
                        <input type="text" name="glastname" id="glastname" class="form-control" placeholder="Guardian Last Name" required>
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">First Name:</label>
                        <input type="text" name="gfirstname" id="gfirstname" class="form-control" placeholder="Guardian First Name" required>
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">Middle Name:</label>
                        <input type="text" name="gmiddlename" id="gmiddlename" class="form-control" placeholder="Guardian Middle Name" required>
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">Contact:</label>
                        <input type="number" name="gnum" id="gnum" class="form-control" placeholder="Contact" required>
                  </div>


                  
            </div>

            <hr>

            <div class="row">

                  <div class="form-group col-md-6">
                        <h4>Requirements:</h4>
                        <hr>
                        <ul style="list-style-type:square">
                              <li>Photocopy OF:</li>
                        </ul>

                        <ul class="list">
                              <b><li>PSA Birth Certificate</li></b>
                              <b><li>Baptismal/ Confirmation Certificate</li></b>
                              <b><li>Good Moral</li></b>
                              <b><li>SF 9(Form 138</li></b>
                              <b><li>SF 10(Form 137)</li></b>
                              <b><li>2pc 2x2 picture</li></b>
                              <b><li>Certificate of Completion</li></b>
                        </ul>
                  </div>

                  <div class="form-group col-md-6">
                        <h4>Assessment of Fees:</h4>
                        <hr>
                        <table class="table table-striped">
                		<thead>
                              <tr>
                                    <th>Type</th>
                                    <th>Amount</th>
                              </tr>
                        </thead>
                        <tbody>
                              <tr>
                                    <td>Tuition Fee:</td>
                                    <td>P8,000.00</td>
                              </tr>

                              <tr>
                                    <td>Miscellaneous Fee:</td>
                                    <td>P3,000.00</td>
                              </tr>

                              <tr>
                                    <td>Registration Fee:</td>
                                    <td>P150.00</td>
                              </tr>

                              <tr>
                                    <td>Others Fee:</td>
                                    <td>P2,000.00</td>
                              </tr>

                              <tr>
                                    <td>Total:</td>
                                    <td>P13,150.00</td>
                              </tr>

                        </tbody>
                			
                        </table>
                  </div>

            </div><hr><hr>

           <div class="row">
            <div class="form-group col-md-12 text-center">
                  <input type="checkbox" name="checkbox" id="checkbox" value="verify" required>
                  <label for="">I hereby certify that the above information given are true and correct to the best of my knowledge 
                  and I allow the Department of Education to use my informations that i provide to create and/or update my learner profile
                  in the Learner Information System. The Information herein shall be treated as confidential in compliance with the Data
                  Privacy Act of 2012.</label>
            </div>

            <div class="form-group col-md-12 text-center">
                  <input type="checkbox" name="checkbox" id="checkbox" value=">I hereby certify that the above information given are true and correct to the best of my knowledge 
                  and I allow the Department of Education to use my informations that i provide to create and/or update my learner profile
                  in the Learner Information System. The Information herein shall be treated as confidential in compliance with the Data
                  Privacy Act of 2012." required><br>
                  <label for="">I have read the <a href="#">TERMS & CONDITIONS</a></label>
            </div>

            <div class="form-group col-md-12">
                  
                  <input type="submit" name = "submit" id="submit" value="Submit" class="form-control btn-success">
                  
            </div>

           </div>

            </form>
            

  </section>
  <!-- END ON ENROLLMENT FORM-->


  </div>
  
<script>
    var loadFile = function(img) {
      var image = document.getElementById('output');
      image.src = URL.createObjectURL(event.target.files[0]);
};

var loadFile = function(img) {
      var image = document.getElementById('output');
      image.src = URL.createObjectURL(event.target.files[0]);
};

$(document).ready(function(){
      $('#grade').change(function(){
            var grade = $(this).val();

            $.ajax({
                  url: "filter-strand.php",
                  method: "POST",
                  data:{
                        grade:grade
                  },
                  success:function(data){
                        $('#strand').html(data);
                  }
            })
      })
})

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

      //Strand Script//
      function populate(s1,s2) {
            var s1 = document.getElementById(s1);

                  if(s1.value == "Grade 11" || s1.value == "Grade 12"){
                  document.getElementById("strand").disabled = false;

                  }
                  else{
                  document.getElementById("strand").disabled = true;
                  }
        }

      //End of Strand Script//

function edt(type){

var selectedValue = type.options[type.selectedIndex].value;
var SLA = document.getElementById("SLA");
var sy = document.getElementById("sy");
var genAve = document.getElementById("genAve");

SLA.disabled = selectedValue == "Kinder" ? true : false;
sy.disabled = selectedValue ==  "Kinder" ? true : false;
genAve.disabled = selectedValue ==  "Kinder" ? true : false;

if (!SLA.disabled && !sy.disabled & !genAve.disabled) {
      SLA.value = ""
      sy.value = ""
      genAve.value = ""

}else{
      SLA.value = "Not Applicable"
      sy.value = "Not Applicable"
      genAve.value = "Not Applicable"
}

}



</script>

 
