<?php include_once '../database/connection.php';
$student_id = mysqli_real_escape_string($con, $_POST['student_id']);
$strand = mysqli_real_escape_string($con, $_POST['strand']);
$grade = mysqli_real_escape_string($con, $_POST['grade']);
echo $grade;
if ($grade == "Grade 1") {
    echo "grade;";
}else{
    
}
?>