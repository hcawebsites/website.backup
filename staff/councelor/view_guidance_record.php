<?php include_once ('../../database/connection.php'); ?>

<?php  
 if(isset($_POST["id"]))  
 {   
      $query = "SELECT * FROM guidance WHERE ID = '".$_POST["id"]."'";  
      $result = mysqli_query($con, $query);  
     
      while($row = mysqli_fetch_array($result))  
      {
        //Applicant Data
        $data['id'] = $row['ID'];
        $data['student_id'] = $row['Student_ID'];
        $data['name'] = $row['Name'];
        $data['violation'] = $row['Violation'];
        $data['offense'] = $row['Offense'];
        $data['punishment'] = $row['Punishment'];

        echo json_encode($data);
      }   

 
 }  
 ?>