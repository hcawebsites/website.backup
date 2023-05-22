<?php include_once '../database/connection.php'?>
<?php

if (isset($_POST['student_id'])) {
    $payment = "SELECT * FROM payments INNER JOIN student on payments.Student_ID = student.Student_ID
	INNER JOIN student_fees on student.Student_ID = student_fees.Student_ID WHERE student.Student_ID = '".$_POST["student_id"]."'";
	$result = mysqli_query($con, $payment);

    while ($row = mysqli_fetch_array($result)) {
        $date = $row['Date'];
        $newdate = strtotime($date);
        $data['date'] = date('M d Y h:m:s', $newdate);
        $data['or'] = $row['OR_Number'];
        $data['aname'] = $row['Account_Name'];
        $data['anum'] = $row['Account_Number'];
        $data['fees'] = $row['Total_Fees'];
        $data['type'] = $row['Payment_Type'];
        $data['amount'] = $row['Paid_Amount'];
        $data['balance'] = $row['Balance'];
        $data['Adate'] = $row['Date_Approve'];
        $data['student_id'] = $row['Student_ID'];
        $data['fname'] = $row['Firstname'];
        $data['lname'] = $row['Lastname'];
        $data['grade'] = $row['Grade'];
        $data['strand'] = $row['Strand'];
        
        echo json_encode($data);
        

    }
}

?>