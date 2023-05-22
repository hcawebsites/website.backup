<?php include_once '../database/connection.php';
error_reporting(0);
$grade = mysqli_real_escape_string($con, $_POST['grade']);
$section = mysqli_real_escape_string($con, $_POST['section']);
$strand = mysqli_real_escape_string($con, $_POST['strand']);

$get_dept = mysqli_query($con, "SELECT * FROM grade WHERE ID = '$grade' AND Section = '$section'");
$rowDept = mysqli_fetch_assoc($get_dept);
$dept = $rowDept['Department'];

if ($dept == "SHSDEPT") {

     $getMale = mysqli_query($con, "SELECT count(Gender) as male FROM student inner join student_grade on student.Student_ID = student_grade.Student_ID inner join grade on student_grade.Class_ID = grade.ID Where grade.ID = '$grade' AND grade.Section='$section' AND student.Gender = 'Male' And student_grade.Strand ='$strand'");

    $getFemale = mysqli_query($con, "SELECT count(Gender) as female FROM student inner join student_grade on student.Student_ID = student_grade.Student_ID inner join grade on student_grade.Class_ID = grade.ID Where grade.ID = '$grade' AND grade.Section='$section' AND student.Gender = 'Female' And student_grade.Strand ='$strand'");

    $getPopulation = mysqli_query($con, "SELECT count(*) as total FROM student inner join student_grade on student.Student_ID = student_grade.Student_ID inner join grade on student_grade.Class_ID = grade.ID Where grade.ID = '$grade' AND grade.Section='$section' And student_grade.Strand ='$strand'");

    $rowMale = mysqli_fetch_assoc($getMale);
    $rowFemale = mysqli_fetch_assoc($getFemale);
    $rowPopulation = mysqli_fetch_assoc($getPopulation);

    $data['male'] = "Total Male: ". $rowMale['male'];
    $data['female'] = "Total Female: ". $rowFemale['female'];
    $data['total'] = "Total Population: ". $rowPopulation['total'];
    
}else{
    $getMale = mysqli_query($con, "SELECT count(Gender) as male FROM student inner join student_grade on student.Student_ID = student_grade.Student_ID inner join grade on student_grade.Class_ID = grade.ID Where grade.ID = '$grade' AND grade.Section='$section' AND student.Gender = 'Male'");

    $getFemale = mysqli_query($con, "SELECT count(Gender) as female FROM student inner join student_grade on student.Student_ID = student_grade.Student_ID inner join grade on student_grade.Class_ID = grade.ID Where grade.ID = '$grade' AND grade.Section='$section' AND student.Gender = 'Female'");

    $getPopulation = mysqli_query($con, "SELECT count(*) as total FROM student inner join student_grade on student.Student_ID = student_grade.Student_ID inner join grade on student_grade.Class_ID = grade.ID Where grade.ID = '$grade' AND grade.Section='$section'");

    $rowMale = mysqli_fetch_assoc($getMale);
    $rowFemale = mysqli_fetch_assoc($getFemale);
    $rowPopulation = mysqli_fetch_assoc($getPopulation);

    $data['male'] = "Total Male: ". $rowMale['male'];
    $data['female'] = "Total Female: ". $rowFemale['female'];
    $data['total'] = "Total Population: ". $rowPopulation['total'];
}

    

    echo json_encode($data);
    
?>