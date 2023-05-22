<?php
include_once '../database/connection.php';

if(isset($_POST["ornumber"]))  {
    $sql = "SELECT *, payment_history.QR_Code as qrcode FROM payment_history inner join student on payment_history.Student_ID = payment_history.Student_ID Where payment_history.OR_Number = '".$_POST["ornumber"]."'";
    $result = mysqli_query($con, $sql);
    
    while ($row =mysqli_fetch_assoc($result)) {
        $date = date("M d, Y", strtotime($row['Date']));
        $total = $row['Balance'] + $row['Paid_Amount'];
        $data['or'] = $row['OR_Number'];
        $data['aname'] = $row['Account_Name'];
        $data['aemail'] = $row['Account_Email'];
        $data['date'] = $date;
        $data['type'] = $row['Payment_Type'];
        $data['paid'] = $row['Paid_Amount'];
        $data['total'] = $total;
        $data['bal'] = $row['Balance'];
        $data['image'] = $row['qrcode'];
       
        
        
    }

echo json_encode($data);
}   
?>