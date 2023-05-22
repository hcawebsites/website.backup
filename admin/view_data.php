<?php include_once ('../database/connection.php'); ?>

<?php  
 if(isset($_POST["applicant_id"]))  
 {   
      $query = "SELECT * FROM student WHERE student.ID = '".$_POST["applicant_id"]."'";  
      $result = mysqli_query($con, $query);  
     
      while($row = mysqli_fetch_array($result))  
      {
        //Applicant Data
        $data['id'] = $row['ID'];
        $data['firstname'] = $row['Firstname'];
        $data['lastname'] = $row['Lastname'];
        $data['middlename'] = $row['Middlename'];
        $data['suffix'] = $row['Suffix'];
        $data['dob'] = $row['DOB'];
        $data['age'] = $row['Age'];
        $data['pob'] = $row['POB'];
        $data['gender'] = $row['Gender'];
        $data['status'] = $row['Status'];
        $data['nationality'] = $row['Nationality'];
        $data['address'] = $row['Address'];
        $data['lrn'] = $row['LRN'];
        $data['studentType'] = $row['Student_Type'];
        $data['grade'] = $row['Grade'];
        $data['strand'] = $row['Strand'];
        $data['lastSchool'] = $row['SLA'];
        $data['ActiveSY'] = $row['SY'];
        $data['ActiveSemester'] = $row['Semester'];
        $data['LastSY'] = $row['LSYA'];
        $data['genAve'] = $row['Gen_Ave'];
        $data['contact'] = $row['Phone'];
        $data['email'] = $row['Email'];
        $data['picture'] = $row['Picture'];
        $date = $row['Application_Date'];
        $newdate = strtotime($date);
        $data['regDate'] = date('F j, Y', $newdate);

        //end

        //Guardian Details
        $data['guardian'] = $row['GFirstname']. " " .$row['GMiddlename']. " " .$row['GLastname'];
        $data['g_num'] = $row['GContact'];

        //end
        echo json_encode($data);
          
      }   
 }  
 ?>