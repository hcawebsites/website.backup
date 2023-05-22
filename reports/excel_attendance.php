<?php
include_once('../database/connection.php');
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 

$fileName = "attendance-data_" . date('Y-m-d') . ".xls";

$fields = array('ID', 'Employee ID', 'Salutation', 'Last Name', 'First Name', 'Middle Name', 'Time In', 'Time Out', 'Log Date', 'Status');
$excelData = implode("\t", array_values($fields)) . "\n"; 

$attendance_data = mysqli_query($con, "SELECT *, emp_attendance.Date as date, emp_attendance.Status as status, emp_attendance.ID as id from emp_attendance inner join teacher_tb on emp_attendance.Emp_ID = teacher_tb.Emp_ID");
if (mysqli_num_rows($attendance_data) > 0) {
    while ($row = mysqli_fetch_assoc($attendance_data)) {
        $date = date("F j, Y", strtotime($row['date']));
        $data = array($row['id'], $row['Emp_ID'], $row['Salutation'], $row['Lastname'], $row['Firstname'], $row['Middlename'], $row['Time_In'], $row['Time_Out'], $date, $row['status']);
        array_walk($data, 'filterData'); 
        $excelData .= implode("\t", array_values($data)) . "\n"; 
    }
}
else{ 
    $excelData .= 'No records found...'. "\n"; 
} 

header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 

// Render excel data 
echo $excelData; 

exit;

?>