<?php
include_once ('../database/connection.php');

$myID = $_SESSION['emp_id'];
            $sql = mysqli_query($con, "SELECT * FROM teacher_tb WHERE Emp_ID = '$myID'");
            $row2 = mysqli_fetch_assoc($sql);
            $id = $row2['ID'];
            $name = $row2['Salutation']. ". " .$row2['Firstname'] . " " . $row2['Lastname'];
            $picture = $row2['Picture'];

            $ids = $_GET['student_id'];
            $sql1 = mysqli_query($con, "SELECT *, assignment.ID as ass_id from std_assign inner join assignment on std_assign.Ass_ID = assignment.ID Where Student_ID = '$ids'");
            $row1 = mysqli_fetch_assoc($sql1);
            $code = $row1['Code'];
            $ass_id = $row1['ass_id'];
if (isset($_POST['post'])) {
    $body = mysqli_real_escape_string($con, $_POST['private']);
    $private = mysqli_query($con, "INSERT INTO assignment_comments (Body, Code, Name, Student_ID, Teacher_ID, Post_ID, Picture, Status) Values ('$body', '$code', '$name', '$ids', '$id', '$ass_id', '$picture', '1')");
    if ($private) {
        
    }
}



?>