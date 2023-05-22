<?php  include_once '../../database/connection.php';?>
<?php

if (isset($_POST['std_id'])) {
    $query = "SELECT * FROM student_grade inner join student on student_grade.Student_ID = student.Student_ID inner join grade on student_grade.Class_ID = grade.ID WHERE student.Student_ID = '".$_POST["std_id"]."'";  
      $result = mysqli_query($con, $query); 

      while ($row = mysqli_fetch_assoc($result)) {
        $date = $row['Enrolled_Date'];
        $newdate = strtotime($date);
        $date1 = $row['DOB'];
        $dob = strtotime($date1);
        $data['EDate'] = date("F j, Y", $newdate);
        $data['lrn'] = $row['LRN'];
        $data['id'] = $row['Student_ID'];
        $data['grade'] = $row['Name'];
        $data['section'] = $row['Section'];
        $data['strand'] = $row['Strand'];
        $data['lastname'] = $row['Lastname'];
        $data['firstname'] = $row['Firstname'];
        $data['middlename'] = $row['Middlename'];
        $data['suffix'] = $row['Suffix'];
        $data['gender'] = $row['Gender'];
        $data['age'] = $row['Age'];
        $data['dob'] = date("M d Y", $dob);
        $data['address'] = $row['Address'];
        $data['contact'] = $row['Phone'];
        $data['email'] = $row['Email'];
        $data['glastname'] = $row['GLastname'];
        $data['gfirstname'] = $row['GFirstname'];
        $data['gmiddlename'] = $row['GMiddlename'];
        $data['gcontact'] = $row['GContact'];
      }
      echo json_encode($data);
}

?>