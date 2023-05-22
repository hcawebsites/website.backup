<?php include_once '../../database/connection.php';
$grade = mysqli_real_escape_string($con, $_POST['grade']);
$tid = $_GET['teacher_id'];
$output = "";
$count = 1;
$getDept = mysqli_query($con, "SELECT * FROM teacher_tb inner join grade on teacher_tb.Department = grade.Department WHERE Emp_ID = '$tid' AND grade.ID = '$grade'");
$rowDept = mysqli_fetch_assoc($getDept);
$dept = $rowDept['Department'];


if ($dept == "SHSDEPT") {
    $strand = mysqli_real_escape_string($con, $_POST['strand']);
    $getStd = mysqli_query($con, "SELECT * FROM student_grade inner join handle_student on student_grade.Student_ID = handle_student.Student_ID inner join schedule on handle_student.Sched_ID = schedule.ID inner join grade on schedule.Class_ID = grade.ID inner join student on student_grade.Student_ID = student.Student_ID WHERE schedule.Teacher_ID = '$tid' AND schedule.Strand = '$strand' Group by handle_student.Student_ID ORDER by student.Gender DESC");
if (mysqli_num_rows($getStd) > 0) {
    while ($rowStd = mysqli_fetch_assoc($getStd)) {
    $class = $rowStd['Name']. " ". $strand. " - " .$rowStd['Section'];

    $output.= '
    <tr>
        <td style="vertical-align: middle;">'.$count++.'</td>
        <td style="vertical-align: middle;">'.$rowStd['Student_ID'].'</td>
        <td style="vertical-align: middle;">'.$rowStd['Lastname'].', '.$rowStd['Firstname'].'</td>
        <td style="vertical-align: middle;">'.$rowStd['Gender'].'</td>
        <td style="vertical-align: middle;">'.$class.'</td>
        <td style="vertical-align: middle; text-align: center;">
            <button class="btn btn-success view" id="'.$rowStd['Student_ID'].'"><i class="fa fa-eye"></i>&nbspView</button>
            <button class="btn btn-primary"><i class="fa fa-eye"></i>&nbspView Grades</button>
        </td>
    </tr>
    ';
    
}
}else{
    $output.= '
    <tr>
        <td colspan="6" style="vertical-align: middle; text-align: center;">No Record Found!</td>
    </tr>
    ';
}
    
}
else{
$getStd = mysqli_query($con, "SELECT * FROM student_grade inner join handle_student on student_grade.Student_ID = handle_student.Student_ID inner join schedule on handle_student.Sched_ID = schedule.ID inner join grade on schedule.Class_ID = grade.ID inner join student on student_grade.Student_ID = student.Student_ID WHERE schedule.Teacher_ID = '$tid' AND schedule.Class_ID = '$grade' Group by handle_student.Student_ID ORDER by student.Gender DESC");
if (mysqli_num_rows($getStd) > 0) {
    while ($rowStd = mysqli_fetch_assoc($getStd)) {
    $class = $rowStd['Name']. " - " .$rowStd['Section'];

    $output.= '
    <tr>
        <td style="vertical-align: middle;">'.$count++.'</td>
        <td style="vertical-align: middle;">'.$rowStd['Student_ID'].'</td>
        <td style="vertical-align: middle;">'.$rowStd['Lastname'].', '.$rowStd['Firstname'].'</td>
        <td style="vertical-align: middle;">'.$rowStd['Gender'].'</td>
        <td style="vertical-align: middle;">'.$class.'</td>
        <td style="vertical-align: middle; text-align: center;">
            <button class="btn btn-success view" id="'.$rowStd['Student_ID'].'"><i class="fa fa-eye"></i>&nbspView</button>
            <button class="btn btn-primary"><i class="fa fa-eye"></i>&nbspView Grades</button>
        </td>
    </tr>
    ';
    
}
}else{
    $output.= '
    <tr>
        <td colspan="6" style="vertical-align: middle; text-align: center;">No Record Found!</td>
    </tr>
    ';
}
}
echo $output;
?>

<script type="text/javascript">
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
</script>