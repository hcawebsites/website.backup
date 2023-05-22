<?php  
include_once '../database/connection.php';

extract($_POST);

if ($_POST) {
    $code = mysqli_real_escape_string($con, $_POST['code']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $grade = mysqli_real_escape_string($con, $_POST['grade']);
    $query_dept = mysqli_query($con, "SELECT * from grade Where Name = '$grade'");
    $get_dept = mysqli_fetch_assoc($query_dept);
    $dept = $get_dept['Department'];

    $chk = mysqli_query($con, "SELECT * from subjects WHERE Description = '$subject' AND Level = '$grade'");
    if (mysqli_num_rows($chk) > 0) {
        echo "Subject Alread Exist In Our Database!";
    }else{
        mysqli_query($con, "INSERT INTO subjects (Subject_Code, Description, Level, Department)
         VALUES ('$code', '$subject', '$grade', '$dept')");
        echo "success";
    }
}

?>