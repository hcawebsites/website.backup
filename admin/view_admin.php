<?php
include_once('../database/connection.php');

if (isset($_POST)) {
   $admin_id = $_POST['admin_id'];
   
   $query_admin = mysqli_query($con, "SELECT * FROM admin where Admin_ID = '$admin_id'");
   while ($row = mysqli_fetch_assoc($query_admin)) {
    $date = date("F j, Y", strtotime($row['DOB']));
    $rdate = date("F j, Y", strtotime($row['RDate']));
    $data['admin_id'] = $row['Admin_ID'];
    $data['salutation'] = $row['Salutation'];
    $data['lastname'] = $row['Lastname'];
    $data['firstname'] = $row['Firstname'];
    $data['middlename'] = $row['Middlename'];
    $data['suffix'] = $row['Suffix'];
    $data['dob'] = $date;
    $data['age'] = $row['Age'];
    $data['gender'] = $row['Gender'];
    $data['status'] = $row['Status'];
    $data['address'] = $row['Address'];
    $data['nationality'] = $row['Nationality'];
    $data['contact'] = $row['Contact'];
    $data['email'] = $row['Email'];
    $data['picture'] = $row['Picture'];
    $data['qrcode'] = $row['QR_Code'];
    $data['rdate'] = $rdate;
    
    
   }
   echo json_encode($data);
}

?>