<?php include_once '../database/connection.php';
error_reporting(0);
$grade = mysqli_real_escape_string($con, $_POST['grade']);
$section = mysqli_real_escape_string($con, $_POST['section']);
$strand = mysqli_real_escape_string($con, $_POST['strand']);
$count = 1;

$output = "";

$get_dept = mysqli_query($con, "SELECT * FROM grade WHERE ID = '$grade'");
$rowDept = mysqli_fetch_assoc($get_dept);
$dept = $rowDept['Department'];

if ($dept == "SHSDEPT") {
    $getStudent = mysqli_query($con, "SELECT * FROM student inner join student_grade on student.Student_ID = student_grade.Student_ID inner join grade on student_grade.Class_ID = grade.ID WHERE student_grade.Class_ID = '$grade' AND student_grade.Strand = '$strand' AND student.Enrollment_Status = 'Enrolled'");
    if (mysqli_num_rows($getStudent) > 0) {
        while ($row = mysqli_fetch_assoc($getStudent)) {
        $class = $row['Name']. " ". $row['Strand']. " - " .$row['Section'];
        $output .= '
        <tr>
            <td style = "vertical-align: middle;" >'.$count++.'</td>
            <td style = "vertical-align: middle;" >'.$row['Student_ID'].'</td>
            <td style = "vertical-align: middle;">'.$row['Firstname'].' '.$row['Lastname'].'</td>
            <td style = "vertical-align: middle;" >'.$row['Gender'].'</td>
            <td style = "vertical-align: middle;" >'.$row['Phone'].'</td>
            <td style = "vertical-align: middle;">'.$class.'</td>
            <td style = "vertical-align: middle; text-align: center;">

            <button class="form-control btn btn-success data1" id="'.$row['Student_ID'].'"><i class="fa fa-eye"></i></button>
            <button class="form-control btn btn-warning view_grade" id="'.$row['Student_ID'].'">View Grade</button>
        
            </td>
        </tr>
    ';
    }
    }else{
        $output .= '
        <tr>
            <td colspan="5" style = "vertical-align: middle; text-align: center;" >No Record Found</td>
        </tr>
    ';
    }
}else{
    $sql = "SELECT * from student inner join student_grade on student.Student_ID = student_grade.Student_ID inner join grade on student_grade.Class_ID = grade.ID WHERE student_grade.Class_ID = '$grade' AND student.Enrollment_Status = 'Enrolled'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
        $class = $row['Name']. " - " .$row['Section'];
    $output .= '
        <tr>
            <td style = "vertical-align: middle;" >'.$count++.'</td>
            <td style = "vertical-align: middle;" >'.$row['Student_ID'].'</td>
            <td style = "vertical-align: middle;">'.$row['Firstname'].' '.$row['Lastname'].'</td>
            <td style = "vertical-align: middle;" >'.$row['Gender'].'</td>
            <td style = "vertical-align: middle;" >'.$row['Phone'].'</td>
            <td style = "vertical-align: middle;">'.$class.'</td>
            <td style = "vertical-align: middle; text-align: center;">

            <button class="form-control btn btn-success data1" id="'.$row['Student_ID'].'"><i class="fa fa-eye"></i></button>
            <button class="form-control btn btn-warning view_grade" id="'.$row['Student_ID'].'">View Grade</button>
        
            </td>
        </tr>
    ';
    }
    }else{
    $output .= '
        <tr>
            <td colspan="7" style = "vertical-align: middle; text-align: center;" >No Record Found</td>
        </tr>
    ';
    }
}

echo $output;

?>
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
                    $("#sec").val(data.section);
                    $("#str1").val(data.strand);
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