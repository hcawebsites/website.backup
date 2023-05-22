<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('../database/connection.php');

 $count = 1;
 $myID = $_SESSION['admin_id'];
 ?>

<div class="content-wrapper">
    <section class="content-header">
    	<h1>
        	Master List
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-file"></i>Home</a></li>
            <li><a href="#">Master List</a></li>
            <li><a href="#">Senior High Department</a></li>
    	</ol>
	</section>
    <hr>

    <section class="content">
        <div class="table-master">
			<div class="table-title">
                <h3><i class="fa fa-graduation-cap" aria-hidden="true"><b> Senior High Department</b></i></h3>

                <div class="btn-master">
                    <form class="form-inline" action="../reports/student_reports.php" method="post" id="filter">
                        <div class="row">
                            <input type="hidden" name="admin_id" value="<?php echo $myID  ?>">

                            <?php
                            $sql = "SELECT * FROM grade Where Department = 'SHSDEPT'";
                            $result = mysqli_query($con, $sql);
                            ?>
                                <select name="grade" id="grade" required onclick="edt(this)" class="form-control">
                                    <option value="">Select Grade</option>
                                    <?php
                                    while ($grade = mysqli_fetch_assoc($result)):
                                    ?>
                                    <option value="<?php echo $grade['ID'];?>"><?php echo $grade['Name'];?></option>

                                    <?php endwhile?>
                                </select>

                                <select name="section" id="section" required class="form-control" onclick="edt1(this)" disabled>
                                    <option value="">Select Section</option>
                                </select>

                                <select name="strand" id="strand" required class="form-control" onclick="edt1(this)" disabled>
                                    <option value="">Select Strand</option>
                                </select>

                                <button type="submit" name="print" class="btn btn-danger form-control" id="print" disabled><i class="fa fa-print" aria-hidden="true"> Print</i></button>
                                <button type="submit" name="excel" class="btn btn-success form-control" id="excel" disabled><i class="fa fa-file-excel-o" aria-hidden="true"> Excel</i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="form-population">
                    <form class="form-inline" id="filter" action="#" method="POST">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" id="male" placeholder="Number of Male" class="form-control" readonly>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <input type="text" id="female" placeholder="Number of Female" class="form-control" readonly>
                            </div>

                            <div class="form-group col-md-4">
                                <input type="text" id="population" placeholder="Total Population" class="form-control" readonly>
                            </div>
                        </div>

                    </form>
           </div>

           <table class="table table-bordered" id="search" style="color: #5c5c5c; font-size: 13px; font-weight: 400">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Student ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Class</th>
                    <th scope="col">Action</th>
                  </tr>
              </thead>

              <tbody id="data">
                  <?php 
                  $sql = "SELECT * from student inner join student_grade on student.Student_ID = student_grade.Student_ID inner join grade on student_grade.Class_ID = grade.ID WHERE grade.Department = 'SHSDEPT' AND student.Enrollment_Status = 'Enrolled'";
                  $result = mysqli_query($con, $sql);

                  while ($row = mysqli_fetch_assoc($result)):
                    $class = $row['Grade']. " " .$row['Strand'] . " - " .$row['Section'];
                   
                  ?>
                  <tr>
                      <td style = "vertical-align: middle;"><?php echo $count++; ?></td>
                      <td style = "vertical-align: middle;"><?php echo $row['Student_ID']; ?></td>
                      <td style = "vertical-align: middle;"><?php echo $row['Firstname'], " ", $row['Lastname']; ?></td>
                      <td style = "vertical-align: middle;"><?php echo $row['Gender']; ?></td>
                      <td style = "vertical-align: middle;"><?php echo $row['Phone']; ?></td>
                      <td style = "vertical-align: middle;"><?php echo $class; ?></td>
                      <td style = "vertical-align: middle; text-align: center;">

                      <button class="form-control btn btn-success data1" id="<?php echo $row['Student_ID'] ?>"><i class="fa fa-eye"></i></button>
                      <button class="form-control btn btn-warning view_grade" id="<?php echo $row['Student_ID']; ?>">View Grade</button>
                  
                      </td>
                  </tr>
                  <?php endwhile?>

              </tbody>
          </table>
        </div>
    </section>
</div>


<?php include_once 'footer.php';?>
<script>
$(document).ready(function () {

$('#search').DataTable();

});//End
//select dynamically section
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
});//end

$(document).ready(function(){
    $('#grade').change(function(){
        var grade = $(this).val();
        $.ajax({
            url:"filter-section.php",
            method: "POST",
            data:{grade:grade},
            success:function(data) {
                $("#section").html(data);
            }
        });
    });
});

function sem(type){
var selectedValue = type.options[type.selectedIndex].value;
var grade = document.getElementById("grade");
grade.disabled = selectedValue == "" ? true : false;

}

function edt(type){
var selectedValue = type.options[type.selectedIndex].value;
var strand = document.getElementById("strand");
var section = document.getElementById("section");
strand.disabled = selectedValue == "" ? true : false;
section.disabled = selectedValue == "" ? true : false;

}

function edt1(type){
var selectedValue = type.options[type.selectedIndex].value;
var print = document.getElementById("print");
var excel = document.getElementById("excel");
print.disabled = selectedValue == "" ? true : false;
excel.disabled = selectedValue == "" ? true : false;

}

$(document).ready(function(){  
	$('#strand').click(function(e){
		e.preventDefault();

		$.ajax({
	   	url: 'section-per-grade.php',
	   	data: $('#filter').serialize(),
	   	method: 'POST',
	   	error: function(data) {
		 	alert("some Error");
	   	},
	   	success: function(data) {
            $("#data").html(data);
	   }

	 
	});

	});
});

$(document).ready(function(){  
	$('#strand').change(function(e){
		e.preventDefault();

		$.ajax({
       
	   	url: 'counts-students-section.php',
	   	data: $('#filter').serialize(),
	   	method: 'POST',
	   	error: function(data) {
		 	alert("some Error");
	   	},
	   	success: function(data) {
            data = $.parseJSON(data);
            $("#male").val(data.male);
            $("#female").val(data.female);
            $("#population").val(data.total);
           
	   }

	 
	});

	});
});





</script>
<!-- Modal View Student -->
<div class="modal fade" id="viewStudent" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="close"><i class="fa fa-times"></i></button>
        <h4 class="modal-title">Student Information</h4>
      </div>
      <form action="" method="POST">
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-md-4">
                <label for="">Enrolled Date:</label>
                <input type="text" name="date" id="date" class="form-control" readonly>
            </div>

            <div class="form-group col-md-4">
                <label for="">LRN:</label>
                <input type="text" name="lrn" id="lrn" class="form-control" readonly>
            </div>

            <div class="form-group col-md-4">
                <label for="">ID Number:</label>
                <input type="text" name="id" id="id" class="form-control" readonly>
            </div>

            <div class="form-group col-md-4">
                <label for="">Grade:</label>
                <input type="text" name="grade" id="level" class="form-control" readonly>
            </div>

            <div class="form-group col-md-4">
                <label for="">Strand:</label>
                <input type="text" name="strands" id="str1" class="form-control" readonly>
            </div>

            <div class="form-group col-md-4">
                <label for="">Section:</label>
                <input type="text" name="strands" id="sec" class="form-control" readonly>
            </div>

            <div class="form-group col-md-4">
                <label for="">Last Name:</label>
                <input type="text" name="lastname" id="lastname" class="form-control" readonly>
            </div>

            <div class="form-group col-md-3">
                <label for="">First Name:</label>
                <input type="text" name="firstname" id="firstname" class="form-control" readonly>
            </div>

            <div class="form-group col-md-3">
                <label for="">Middle Name:</label>
                <input type="text" name="middlename" id="middlename" class="form-control" readonly>
            </div>

            <div class="form-group col-md-2">
                <label for="">Suffix:</label>
                <input type="text" name="suffix" id="suffix" class="form-control" readonly>
            </div>

            <div class="form-group col-md-5">
                <label for="">Gender:</label>
                <input type="text" name="gender" id="gender" class="form-control" readonly>
            </div>

            <div class="form-group col-md-2">
                <label for="">Age:</label>
                <input type="text" name="age" id="age" class="form-control" readonly>
            </div>
            
            <div class="form-group col-md-5">
                <label for="">Date of Birth:</label>
                <input type="text" name="dob" id="dob" class="form-control" readonly>
            </div>

            <div class="form-group col-md-12">
                <label for="">Address:</label>
                <input type="text" name="address" id="address" class="form-control" readonly>
            </div>

            <div class="form-group col-md-4">
                <label for="">Contact:</label>
                <input type="text" name="contact" id="contact" class="form-control" readonly>
            </div>

            <div class="form-group col-md-8">
                <label for="">Email:</label>
                <input type="text" name="email" id="email" class="form-control" readonly>
            </div>

            <div class="form-group col-md-4">
                <label for="">G Lastname:</label>
                <input type="text" name="glastname" id="glastname" class="form-control" readonly>
            </div>

            <div class="form-group col-md-4">
                <label for="">G Firstname:</label>
                <input type="text" name="gfirstname" id="gfirstname" class="form-control" readonly>
            </div>

            <div class="form-group col-md-4">
                <label for="">G Middlename:</label>
                <input type="text" name="gmiddlename" id="gmiddlename" class="form-control" readonly>
            </div>

            <div class="form-group col-md-12">
                <label for="">G Contact:</label>
                <input type="text" name="gcontact" id="gcontact" class="form-control" readonly>
            </div>


          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
      
    </div>  
  </div>
</div>
<script>
    $(document).ready(function(){  
      $('.data1').click(function(){  
           var student_id = $(this).attr("id")
           $.ajax({  
                url:"view-student.php",  
                method:"POST",  
                data:{
					student_id:student_id 
				},
                error: function(data) {
		 	    alert("some Error");
	   	        },
	   	        success: function(data) {
                    data = $.parseJSON(data);
                    $("#date").val(data.EDate);
                    $("#lrn").val(data.lrn);
                    $("#id").val(data.id);
                    $("#level").val(data.grade);
                    $("#str1").val(data.strand);
                    $("#sec").val(data.section);
                    $("#lastname").val(data.lastname);
                    $("#firstname").val(data.firstname);
                    $("#middlename").val(data.middlename);
                    $("#suffix").val(data.suffix);
                    $("#gender").val(data.gender);
                    $("#age").val(data.age);
                    $("#dob").val(data.dob);
                    $("#address").val(data.address);
                    $("#contact").val(data.contact);
                    $("#email").val(data.email);

                    $("#glastname").val(data.glastname);
                    $("#gfirstname").val(data.gfirstname);
                    $("#gmiddlename").val(data.gmiddlename);
                    $("#gcontact").val(data.gcontact);

                    $("#viewStudent").modal("show");
	            }
           });  
      });

      $('.view_grade').click(function(){
        var std_id = $(this).attr('id');
        window.location.href="student_grade.php?std_id="+std_id;
      })
 })
</script>