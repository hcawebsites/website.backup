<?php  include_once '../database/connection.php';?>
<?php

if (isset($_POST['teacher_id'])) {
    $query = "SELECT * FROM teacher_tb WHERE Emp_ID = '".$_POST["teacher_id"]."'";  
    $result = mysqli_query($con, $query); 

      while ($row = mysqli_fetch_assoc($result)) {
      $dob = $row['DOB'];
      $newdob = date("M d Y", strtotime($dob));

      $data['id'] = $row['Emp_ID'];
      $data['salutation'] = $row['Salutation'];
      $data['lastname'] = $row['Lastname'];
      $data['firstname'] = $row['Firstname'];
      $data['middlename'] = $row['Middlename'];
      $data['suffix'] = $row['Suffix'];
      $data['dob'] = $newdob;
      $data['age'] = $row['Age'];
      $data['gender'] = $row['Gender'];
      $data['address'] = $row['Address'];
      $data['nationality'] = $row['Nationality'];
      $data['contact'] = $row['Contact'];
      $data['email'] = $row['Email'];
      $data['dept'] = $row['Department'];
      $data['rdate'] = $row['Date'];
      $data['image'] = $row['Picture'];
      $data['qrcode'] = $row['QR_Code'];


      echo json_encode($data);
      }
      
}

?>