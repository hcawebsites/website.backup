<?php
session_start();
include_once ('../database/connection.php');
$sql = "SELECT * FROM academic_list WHERE Status = 1";
$result = mysqli_query($con, $sql);
      
$reg_num = $_SESSION['username'];

$sql1 = "SELECT * FROM student INNER JOIN guardians ON student.Reg_Number = guardians.Reg_Number WHERE student.Reg_Number = '$reg_num'";
?>


<div class="row">
                  <div class = "col-md-4">
                        <label for="">Date of Registration:</label>
                        <input type="data" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['Application_Date'];?>" class = "form-control" readonly>
                  </div>

                  <div class = "col-md-4">
                        <label>Active School Year:</label>
                        <input type="text" value = "<?php  while ($row = mysqli_fetch_assoc($result)) { echo $row['School_Year']; }?>" class = "form-control" readonly placeholder = "No Active School Year">
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
                        <input type="text"  name = "lastname" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['Lastname'];?>" class = "form-control">
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">First Name:</label>
                        <input type="text"  name = "firstname" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['Firstname'];?>" class = "form-control">
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">Middle Name:</label>
                        <input type="text"  name = "middlename" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['Middlename'];?>" class = "form-control">
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">Suffix:</label>
                        <input type="text"  name = "suffix" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['Suffix'];?>" placeholder = "If Applicable" class = "form-control">
                  </div>

                  <div class="form-group col-md-4">
                        <label for="">Date of Birth:</label>
                        <input type="date" readonly name= "birthdate" id="birthdate" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['DOB'];?>" class = "form-control">
                  </div>

                  <div class="form-group col-md-4">
                        <label for="">Age:</label>
                        <input type="number" name="age" id="age" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['Age'];?>"  class="form-control">
                  </div>

                  <div class="form-group col-md-4">
                        <label for="">Place of Birth:</label>
                        <input type="text" name="birth" id="birth" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['POB'];?>" class="form-control" >
                  </div>

                  <div class="form-group col-md-4">                    
                        <label for="">Gender:</label>
                       	<input type="text" name="gender" id="gender" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['Gender'];?>" class="form-control" >              		
           		</div>

           		<div class="form-group col-md-4">                   
                    	<label for="">Status:</label>
                       	<input type="text" name="status" id="status" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['Status'];?>" class="form-control" >   	
           		</div>

           		<div class="form-group col-md-4">                  
                    	<label for="">Nationality:</label>
                       	<input type= "text" name= "nationality" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['Nationality'];?>" id="nationality" class = "form-control"  >
           		</div>

          		<div class="form-group col-md-4">                  
                    	<label for="">Address:</label>
                       	<input type= "text"  name= "address" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['Address'];?>" id="address" class = "form-control" >                    		
           		</div>

       		<div class="form-group col-md-4">  
                    	<label for="">Permanent Address:</label>
                       	<input type= "text"  name= "paddress" id="paddress" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['Address'];?>" class = "form-control" >
                       		
           		</div>

                       <div class="form-group col-md-4">  
                    	<label for="">LRN:</label>
                       	<input type= "text"  name= "lrn" id="lrn" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['LRN'];?>" class = "form-control" placeholder="If Applicable" >
                       		
           		</div>

                  <div class="form-group col-md-4">
                    	<label for="">Student Type:</label>
                    	<input type= "text"  name= "stype" id="stype" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['Student_Type'];?>" class = "form-control">
           		</div>

                  <div class="form-group col-md-4">
                    <label for="">Grade Applying:</label>
                        <input type= "text" name= "grade" id="grade" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['Grade'];?>" class = "form-control">
                  </div>
                  

                  <div class="form-group col-md-4">                   
                    	<label for="">Strand:<small>[For SHS Only]</small></label>
                       		<input type= "text" name="strand" id="strand" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['Strand'];?>" class = "form-control" placeholder="Not Applicable">
                  </div>

                  <div class="form-group col-md-4">                  
                    	<label for="">School Last Attended:</label>
                       		<input type= "text"  name= "SLA" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['SLA'];?>" id="SLA" class = "form-control" placeholder="Not Applicable">
                       		
           		</div>

           		<div class="form-group col-md-4">
                    	<label for="">Last School Year Attended:</label>
                       		<input type= "text" name= "sy"  value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['LSYA'];?>" id="sy" class = "form-control" placeholder="Not Applicable" >                     		
           		</div>

           		<div class="form-group col-md-4">                 
                    	<label for="">General Average:</label>
                       		<input type= "text" name= "genAve" readonly id="genAve" class = "form-control" placeholder="Not Applicable" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['Gen_Ave'];?>" >               		
           		</div>

                  <div class="form-group col-md-4">
                    	<label for="">Contact Number:</label>
                       		<input type= "number" name= "sphone"  id="sphone" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['Phone'];?>" class = "form-control">	
           		</div>

           		<div class="form-group col-md-4">
                    	<label for="">Email:</label>
                       		<input type= "email" name= "email"  id="email" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['Email'];?>" class = "form-control">	
           		</div>

                  <div class="form-group col-md-4"> 
                        <?php 
                        $result1 = mysqli_query($con, $sql1);
                        while ($row = mysqli_fetch_assoc($result1)) {
                              $image = $row['Picture'];
                        }


                        ?>                   
                        <img id="output" src="" class="rounded-corncers" style="width:150px; height:150px;" />
                        <input type="file" accept="image/*" name="my_image" id="file" onchange="loadFile(event)" style="margin-top:7px;"  />
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
                        <input type="text" name="flastname"  id="flastname"  class="form-control" placeholder="Father Last Name" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['F_Lastname'];?>">
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">First Name:</label>
                        <input type="text" name="ffirstname"  id="ffirstname" class="form-control" placeholder="Father First Name" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['F_Firstname'];?>">
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">Middle Name:</label>
                        <input type="text" name="fmiddlename"  id="fmiddlename" class="form-control" placeholder="Father Middle Name" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['F_Middlename'];?>">
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">Contact:</label>
                        <input type="number" name="fnum" id="fnum" class="form-control" placeholder="Contact"value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['F_Contact'];?>">
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">Last Name:</label>
                        <input type="text" name="mlastname"  id="mlastname" class="form-control" placeholder="Mother Last Name" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['M_Lastname'];?>">
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">First Name:</label>
                        <input type="text" name="mfirstname"  id="mfirstname" class="form-control" placeholder="Mother First Name" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['M_Firstname'];?>">
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">Middle Name:</label>
                        <input type="text" name="mmiddlename"  id="mmiddlename" class="form-control" placeholder="Mother Middle Name" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['M_Middlename'];?>">
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">Contact:</label>
                        <input type="number" name="mnum"  id="mnum" class="form-control" placeholder="Contact"value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['M_Contact'];?>">
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">Last Name:</label>
                        <input type="text" name="glastname"  id="glastname" class="form-control" placeholder="Guardian Last Name" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['G_Lastname'];?>">
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">First Name:</label>
                        <input type="text" name="gfirstname"  id="gfirstname" class="form-control" placeholder="Guardian First Name" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['G_Firstname'];?>">
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">Middle Name:</label>
                        <input type="text" name="gmiddlename"  id="gmiddlename" class="form-control" placeholder="Guardian Middle Name" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['G_Middlename'];?>">
                  </div>

                  <div class="form-group col-md-3">
                        <label for="">Contact:</label>
                        <input type="number" name="gnum"  id="gnum" class="form-control" placeholder="Contact" value = "<?php $result1 = mysqli_query($con, $sql1);  while ($row = mysqli_fetch_assoc($result1)) echo $row['G_Contact'];?>">
                  </div>

                  <div class="form-group col-md-12">
                    <input type="submit" name="save" id="save" value="Save" class="form-control btn-success">
                  </div>


                  
            </div>

<script>
    var loadFile = function(img) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};


</script>