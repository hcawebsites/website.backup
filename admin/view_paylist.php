<?php
include_once '../database/connection.php';

$sql = "SELECT * FROM student inner join student_fees on student.Student_ID = student_fees.Student_ID Where student.Student_ID = '".$_POST["paylist_id"]."'";
$result = mysqli_query($con, $sql);

while ($row =mysqli_fetch_assoc($result)) {
    $date_created = date("M d, Y", strtotime($row['Date_Created']));
	$due_date = date("M d, Y", strtotime($row['Due_Date']));
    $data['student_ID'] = $row['Student_ID'];
    $data['firstname'] = $row['Firstname'];
    $data['lastname'] = $row['Lastname'];
    $data['contact'] = $row['Phone'];
    $data['status'] = $row['Enrollment_Status'];
    $data['amount'] = $row['Total_Fees'];
    $data['date'] = $date_created;
    $data['due'] = $due_date;
}

    
    echo json_encode($data);

?>