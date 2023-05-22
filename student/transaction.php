<?php
include_once '../database/connection.php';

if(isset($_POST['payment_id']))  {
    $query = mysqli_query($con, "SELECT *, payments.Student_ID as id FROM payments inner join student on payments.Student_ID = student.Student_ID WHERE payments.ID = ".$_POST['payment_id']."");
    
    while ($row =mysqli_fetch_assoc($query)) {
        $data['std_id'] = $row['id'];
        $data['email'] = $row['Email'];
        $data['bal'] = $row['Balance'];
        
    }
echo json_encode($data);
}   
?>