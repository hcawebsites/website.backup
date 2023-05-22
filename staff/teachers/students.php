<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('../../database/connection.php'); 
$count = 1;
$myID = $_SESSION['emp_id'];
?>


<div class="content-wrapper">	
    <section class="content-header">
    	<h1>
        	Students
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Students</a></li>
            <li><a href="#">My Students</a></li>
    	</ol>
      <hr>
	</section>
    <section class="content">
        <div class="table-master">
            <div class="table-title">
                <h3><i class="fa fa-graduation-cap">&nbspHandled Student</i></h3>

                <form action="../../reports/student_reports.php" id="filter" method="POST" class="form-inline">
                    <input type="hidden" name="myID" value="<?php echo $myID ?>">
                    <select name="grade" id="grade" onclick="edt(this)" class="form-control" required>
                        <option value="" disabled selected>Select Grade</option>
                        <?php
                        $sql = mysqli_query($con, "SELECT *, grade.ID as id FROM grade inner join teacher_tb on grade.Department = teacher_tb.Department WHERE teacher_tb.Emp_ID = '$myID'");
                            while ($row = mysqli_fetch_assoc($sql)) {
                        ?>
                            <option value="<?=$row['id']?>"><?=$row['Name']?></option>
                        <?php }?>
                    </select>
                        
                    <?php
                    
                    $sql = mysqli_query($con, "SELECT * FROM grade inner join teacher_tb on grade.Department = teacher_tb.Department WHERE teacher_tb.Emp_ID = '$myID'");
                    $row2 = mysqli_fetch_assoc($sql);

                    if ($row2['Department'] == "JHSDEPT" || $row2['Department'] == "ELDEPT") {

                        echo '<select id="section1" class="form-control" required>
                        <option value="" hidden selected>Please select here</option></select>';
                    }else{

                        echo 
                        '<input name="section" id="section" readonly class="form-control">

                        <select name="strand" id="strand" disabled class="form-control" required>
                        <option value="" hidden selected>Please select here</option></select>
                        ';


                    }
                    
                    ?>

                    <button type="submit" name="excel" id="excel" class="form-control btn btn-success"><i class="fa fa-file-excel-o">&nbspExcel</i></button>
                    <button type="submit" name="print" id="prine" class="form-control btn btn-danger"><i class="fa fa-print">&nbspPrint</i></button>
                        
                    

                </form>
            </div>
            <hr>
            <table class="table table-bordered table-striped" id="search" style="color: #666666; font-size: 13px; font-weight: 500;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Student ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Class</th>
                        <th scope="col">Action</th>

                        
                    </tr>
                </thead>
                    <tbody class="table-hover" id="data">
                        <?php

                        $sql1 = mysqli_query($con, "SELECT * FROM student_grade inner join handle_student on student_grade.Student_ID = handle_student.Student_ID inner join schedule on handle_student.Sched_ID = schedule.ID inner join grade on schedule.Class_ID = grade.ID inner join student on student_grade.Student_ID = student.Student_ID WHERE schedule.Teacher_ID = '$myID' Group by handle_student.Student_ID ORDER by student.Gender DESC");

                        while ($row1 = mysqli_fetch_assoc($sql1)) {
                        $class = $row1['Name']. " ". $row1['Strand'].    " - " .$row1['Section'];                                   
                        ?>
                        
                            <tr>
                                <td style="vertical-align: middle;"><?=$count++?></td>
                                <td style="vertical-align: middle;"><?=$row1['Student_ID']?></td>
                                <td style="vertical-align: middle;"><?=$row1['Lastname']. ", " .$row1['Firstname']?></td>
                                <td style="vertical-align: middle;"><?=$row1['Gender']?></td>
                                <td style="vertical-align: middle;"><?=$class?></td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <button class="btn btn-success view" id="<?=$row1['Student_ID']?>"><i class="fa fa-eye"></i>&nbspView</button>
                                    <button class="btn btn-primary"><i class="fa fa-eye"></i>&nbspView Grades</button>
                                </td>
                            </tr>
                        
                        <?php }?>
                    </tbody>
                
            </table>
        </div>
    </section>
</div>
<?php include_once '../footer.php';?>
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
            <div class="form-group col-md-6">
                <label for="">Enrolled Date:</label>
                <input type="text" name="date" id="date" class="form-control" readonly>
            </div>

            <div class="form-group col-md-6">
                <label for="">Learners Reference Number:</label>
                <input type="text" name="lrn" id="lrn" class="form-control" readonly>
            </div>

            <div class="form-group col-md-6">
                <label for="">ID Number:</label>
                <input type="text" name="id" id="id" class="form-control" readonly>
            </div>

            <div class="form-group col-md-3">
                <label for="">Grade:</label>
                <input type="text" name="grade" id="level" class="form-control" readonly>
            </div>

            <div class="form-group col-md-3">
                <label for="">Section:</label>
                <input type="text" name="secton" id="sec" class="form-control" readonly>
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

            <div class="form-group col-md-6">
                <label for="">Contact:</label>
                <input type="text" name="contact" id="contact" class="form-control" readonly>
            </div>

            <div class="form-group col-md-6">
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
        $('.view').click(function(){
            var std_id = $(this).attr('id');
            $.ajax({
                url: "viewStudent.php",
                method: "POST",
                data:{
                    std_id:std_id
                },
                success:function(data){
                    
                    data = $.parseJSON(data);
                    $("#date").val(data.EDate);
                    $("#lrn").val(data.lrn);
                    $("#id").val(data.id);
                    $("#level").val(data.grade);
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
            })
        })
    })

    $(document).ready(function(){  
        $('#strand').change(function(e){
            e.preventDefault();

            $.ajax({
        
            url: 'section-per-grade.php?teacher_id=<?=$myID?>',
            data: $('#filter').serialize(),
            method: 'POST',
            success: function(data) {
                $("#data").html(data);
        }

        
        });

        });
    });

    $(document).ready(function(){  
        $('#section1').change(function(e){
            e.preventDefault();

            $.ajax({
        
            url: 'section-per-grade.php?teacher_id=<?=$myID?>',
            data: $('#filter').serialize(),
            method: 'POST',
            success: function(data) {
                $("#data").html(data);
        }

        
        });

        });
    });


    
        $(document).ready(function () {
            $('#search').DataTable();
        });

        function edt(type){

            var selectedValue = type.options[type.selectedIndex].value;
            var strand = document.getElementById("strand");
            var section = document.getElementById("section1");
            strand.disabled = selectedValue == "" ? true : false;
            section.disabled = selectedValue == "" ? true : false;
            

        }

    $(document).ready(function(){
        $('#grade').change(function(){
            var grade = $(this).val();
            $.ajax({
                url:"filter-section.php",
                method: "POST",
                data:{grade:grade},
                success:function(data) {
                    $("#section1").html(data);
                }
            });
        });
    })

    $(document).ready(function(){
        $('#grade').change(function(){
            var gid = $(this).val();
            $.ajax({
                url:"filter-strand.php",
                method: "POST",
                data:{gid:gid},
                success:function(data) {
                   $('#strand').html(data);
                }
            });

            $.ajax({
                url:"getSection.php",
                method: "POST",
                data:{gid:gid},
                success:function(data) {
                  data = $.parseJSON(data);
                  $('#section').val(data.section);
                }
            });
        });


    })
    </script>