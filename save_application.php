<?php  
include_once 'database/connection.php';
error_reporting(0);

 //Personal Details
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($con, $_POST['middlename']);
    $suffix = mysqli_real_escape_string($con, $_POST['suffix']);
    $dob = mysqli_real_escape_string($con, $_POST['birthdate']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $pob = mysqli_real_escape_string($con, $_POST['pob']);        
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $nationality = mysqli_real_escape_string($con, $_POST['nationality']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $reference = uniqid();

    $img_name = $_FILES['image']['name'];
    $img_size = $_FILES['image']['size'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $error = $_FILES['image']['error'];

    //Enrollment Details
    $sy = mysqli_real_escape_string($con, $_POST['sy']);
    $semester = mysqli_real_escape_string($con, $_POST['semester']);
    $type = mysqli_real_escape_string($con, $_POST['type']);
    $lrn = mysqli_real_escape_string($con, $_POST['lrn']);
    $grade = mysqli_real_escape_string($con, $_POST['grade']);
    $strand = mysqli_real_escape_string($con, $_POST['strand']);
    $average = mysqli_real_escape_string($con, $_POST['average']);
    $lsa = mysqli_real_escape_string($con, $_POST['lsa']);
    $lsya = mysqli_real_escape_string($con, $_POST['lsya']);
    $lgc = mysqli_real_escape_string($con, $_POST['lgc']);

    //Address Details
    $houseno = mysqli_real_escape_string($con, $_POST['houseno']);
    $street = mysqli_real_escape_string($con, $_POST['street']);
    $barangay = mysqli_real_escape_string($con, $_POST['barangay']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $province = mysqli_real_escape_string($con, $_POST['province']);
    $country = mysqli_real_escape_string($con, $_POST['country']);
    $code = mysqli_real_escape_string($con, $_POST['code']);
    
    $address = $houseno. ' '. $street. ' ' .$barangay. ' '. $city. ' '. $province. ' ' .$country. ' '. $code;

    //Guardian Details
    $glastname = mysqli_real_escape_string($con, $_POST['glname']);
    $gfirstname = mysqli_real_escape_string($con, $_POST['gfname']);
    $gmiddlename = mysqli_real_escape_string($con, $_POST['gmname']);
    $gcontact = mysqli_real_escape_string($con, $_POST['gcontact']);

    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);
    $allowed_exs = array("jpg", "jpeg", "png");

    if (in_array($img_ex_lc, $allowed_exs)) {
        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
        $img_upload_path = 'assets/upload/'.$new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);

        $check = mysqli_query($con, "SELECT * FROM student Where Email = '$email' AND Firstname = '$firstname' AND Lastname = '$lastname'");


        if (mysqli_num_rows($check) > 0) {
            echo "Enrollment Application Already Sent";
        }else{
             $insert = mysqli_query($con, "INSERT INTO student (Lastname, Firstname, Middlename, Suffix, DOB, Age, POB,  Gender, Phone, Email, Picture, Grade, Strand, Status, Nationality, Address, LRN, Student_Type, SLA, LSYA, LGC, Gen_Ave, Semester, SY, Enrollment_Status, GLastname, GFirstname, GMiddlename, GContact, Reference) VALUES ('$lastname', '$firstname', '$middlename', '$suffix', '$dob', '$age', '$pob','$gender', '$contact', '$email', '$new_img_name', '$grade', '$strand', '$status', '$nationality', '$address', '$lrn', '$type', '$lsa', '$lsya', '$lgc', '$average', '$semester', '$sy', 'Pending', '$glastname', '$gfirstname', '$gmiddlename', '$gcontact', '$reference')");
             if($insert){
                  $subject = "Enrollment Application Confirmation";
                    $htmlContent = '
                       <html> 
                            <body style="margin: 0; padding: 0; font-weight: 300; list-style-type: none; background-color: #d9d9d9;"> 
                                <div style="padding: 2rem 2rem 2rem 2rem; text-align: center;">
                                    <img src="https://portalhcamis.000webhostapp.com/assets/image/holy_logo.jpg" width="100px" height="100px" style="border-radius: 100%;">
                                    <p style="color: #5c5c5c; font-size: 20px; font-weight: 400;">Hi, '.$firstname.'</p>
                                    <p style="color: #333; font-size: 16px; font-weight: 300;">This e-mail serves as a confirmation that <b>Your Enrollment Form Was Successfully Submitted!</p>
                                    <p style="color: #333; font-size: 16px; font-weight: 300;">Please wait for the approval of your Enrollment Form by the <b>ADMINISTRATOR</b> we will send you an email to confirm if your Enrollment Form has been approved.</p>
                                    <p style="color: #333; font-size: 16px; font-weight: 300;">Thank you and God Blessed!</p>
                                </div>
                            </body> 
                        </html>
                    ';
                    $headers = "MIME-Version: 1.0" . "\r\n"; 
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    
                    if(mail($email, $subject, $htmlContent, $headers)){
                        echo 'success';
                    }
             }
          
        }
                     
}
    
    

?>