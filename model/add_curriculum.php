<?php  
include_once('../database/connection.php');
$curriculum_name = mysqli_real_escape_string($con, $_POST['curriculum']);
$number = count($_POST["subjects"]);  
 if($number > 0)  
 {  
    $curriculum_name = mysqli_query($con, "INSERT INTO curriculum (Name, Status) VALUES('$curriculum_name', '1')");  
    $last_id = mysqli_insert_id($con);
    
      for($i=0; $i<$number; $i++)  
      {  
           if(trim($_POST["subjects"][$i] != ''))  
           {  
                if ($curriculum_name) {
                    mysqli_query($con, "INSERT INTO curriculum_subjects (Curriculum_ID, Subjects) VALUES('$last_id', '".mysqli_real_escape_string($con, $_POST["subjects"][$i])."')");
                }
                
           }  
      }  
      echo "Curriculum Added";  
 }  
 else  
 {  
      echo "Please Enter Curriculum";  
 }  
 ?> 