<?php include_once '../database/connection.php';

if(isset($_GET['id']))
{
	$id = $_GET['id'];
      $query = "SELECT * FROM request_tb INNER JOIN 
      parents_enrollment_request_tb ON 
      request_tb.Reg_Num = 
      parents_enrollment_request_tb.Reg_Num WHERE request_tb.ID = $id";  
      $result = mysqli_query($con, $query);  
      $row=mysqli_fetch_assoc($result);
      //student data
      $current_year = date("Y");
      $student_id = "$current_year".(sprintf("%'.05d","-$id"));
      $lrn = "100146".(sprintf("%'.06d",rand(1,999999)));  
      $lastname = $row['Lastname'];
      $firstname = $row['Firstname'];
      $middlename = $row['Middlename'];
      $suffix = $row['Suffix'];
      $dob = $row['DOB'];
      $age = $row['Age'];
      $pob = $row['POB'];
      $gender = $row['Gender'];
      $status = $row['Status'];
      $nationality = $row['Nationality'];
      $address = $row['Address'];
      $type = $row['Student_Type'];
      $grade = $row['G_Applying'];
      $strand = $row['Strand'];
      $semester = $row['Semester'];
      $contact = $row['Contact'];
      $email = $row['Email'];
      $picture = $row['Picture'];


      //end//

      

      
      
      $sql = "INSERT INTO student(Student_ID, Lastname, Firstname, Middlename, Suffix, DOB, Age, POB, Gender, Phone, 
                                   Email, Picture, Grade, Strand, Status, Nationality, Address, LRN, Student_Type, 
                                   Enrollment_Status) VALUES ('$student_id', '$lastname', '$firstname', '$middlename', 
                                   '$suffix', '$dob', '$age', '$pob', '$gender', '$contact', '$email', '$picture', 
                                   '$grade', '$strand', '$status', '$nationality', '$address', '$lrn', 'New', 'To Pay')";
      $result = mysqli_query($con, $sql);

      $sql1 = "SELECT sum(Amount) as total_fees From fees";
            $result1 = mysqli_query($con, $sql1);
            $fees = mysqli_fetch_assoc($result1);
            $payment = $fees['total_fees'];

      $sql2 = "INSERT into student_fees (Student_ID, Account_Name, Account_Number, Total_Fees, Status) 
                     VALUES ('$student_id', 'Holy Child Academy', '111100067412', '$payment', 1)";
      $insert_fees = mysqli_query($con, $sql2);

      $sql = "INSERT into student_grade (Student_ID, Level, Strand) VALUES ('$student_id', '$grade', '$strand')";
            $insert_grade = mysqli_query($con, $sql);

            $sql1 = "SELECT sum(Amount) as total_fees From fees";
            $result1 = mysqli_query($con, $sql1);
            $fees = mysqli_fetch_assoc($result1);
            $payment = $fees['total_fees'];
            $reg = "UPDATE pre_register_tb SET Student_ID = '$student_id' Where ID = '$id'";
            mysqli_query($con, $reg);
            $reg1 = "UPDATE request_tb SET AStatus = 2 Where ID = '$id'";
            mysqli_query($con, $reg1);

            if ($insert_grade && $insert_fees && $result) {
                  $info = "Student Enrollment Request Approved!";
                  header("location: ../admin/Enrollment_list.php?info=$info");
                  
            }
            else{
                  $error = "Student Enrollment Request Failed!";
                  header("location: ../admin/Enrollment_list.php?error=$error");

            }
}
?>