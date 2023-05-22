<?php
include_once('../../database/connection.php');

if (isset($_POST)) {
   $output = "" ;
   $teacher_id = $_POST['teacher_id'];
   $output .= '<option value="" disabled selected>Select Section</option>';
   $sql = mysqli_query($con, "SELECT * from schedule Where Teacher_ID = '$teacher_id' GROUP BY Grade");
   while ($row = mysqli_fetch_assoc($sql)) {
      $output .='
      <option value="'.$row['Grade'].'">'.$row['Grade'].'</option>
      ';
    
   }
   echo $output;
}
?>