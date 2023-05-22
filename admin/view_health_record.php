  <?php include_once ('../database/connection.php'); ?>

<?php  
 if(isset($_POST))  
 {   
  $id = mysqli_real_escape_string($con, $_POST['id']);

  $get = mysqli_query($con, "SELECT * from health_record inner join student on health_record.Student_ID = student.Student_ID inner join student_grade on student.Student_ID = student_grade.Student_ID inner join grade on student_grade.Class_ID = grade.ID WHERE health_record.Student_ID = '$id'");
  while ($row = mysqli_fetch_assoc($get)) {
    $name = $row['Firstname']. " ". $row['Middlename']. " " .$row['Lastname'];
    $class = $row['Name']. " " .$row['Strand']. " - " .$row['Section'];
    $array = explode(',', $row['Medical_History']);
    $count = count($array);
    $array1 = explode(',', $row['Family_History']);
    $count1 = count($array1);

    $data['std_id'] = $row['Student_ID'];
    $data['name'] = $name;
    $data['firstname'] = $row['Firstname'];
    $data['email'] = $row['Email'];
    $data['class'] = $class;
    $data['illness'] = $row['Illness'];
    $data['medicine'] = $row['Medication_Taken'];
    $data['m_history'] = $array;
    $data['operation'] = $row['Operations'];
    $data['f_history'] = $array1;
    $data['height'] = $row['Height'];
    $data['weight'] = $row['Weight'];
    $data['bmi'] = $row['BMI'];
    $data['classification'] = $row['Classification'];
    $data['smoking'] = $row['Smoking'];
    $data['drinking'] = $row['Drinking'];
    $data['count'] = $count;
    $data['count1'] = $count1;
  }

  echo json_encode($data);
 
 }  
 ?>