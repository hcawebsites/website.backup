<?php include_once '../database/connection.php';
$grade = mysqli_real_escape_string($con, $_POST['std-grade']);
if ($grade == "Grade 1") {
    echo "sdsd";
}

?>