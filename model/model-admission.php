<?php
include '../database/connection.php';
$info = array();

	date_default_timezone_set('Asia/Manila');
    $date = date("l jS \of F Y h:i:s A");
	
	if (isset($_POST['submit'])){

		//Student Information data

		$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
		$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
		$middlename = mysqli_real_escape_string($con, $_POST['middlename']);
		$DOB = mysqli_real_escape_string($con, $_POST['birthdate']);
		$age = mysqli_real_escape_string($con, $_POST['age']);
		$POB = mysqli_real_escape_string($con, $_POST['pbirth']);
		$nationality = mysqli_real_escape_string($con, $_POST['nationality']);
		$address = mysqli_real_escape_string($con, $_POST['address']);
		$paddress = mysqli_real_escape_string($con, $_POST['paddress']);
		$scontact = mysqli_real_escape_string($con, $_POST['sphone']);
		$email = mysqli_real_escape_string($con, $_POST['email']);
        $encpass = password_hash("12345678", PASSWORD_BCRYPT);

		//Parents|Guardian Information Data

		$flastname = mysqli_real_escape_string($con, $_POST['flastname']);
		$ffirstname = mysqli_real_escape_string($con, $_POST['ffirstname']);
		$fmiddlename = mysqli_real_escape_string($con, $_POST['fmiddlename']);
		$foccupation = mysqli_real_escape_string($con, $_POST['foccupation']);
		$fphone = mysqli_real_escape_string($con, $_POST['fphone']);

		$mlastname = mysqli_real_escape_string($con, $_POST['mlastname']);
		$mfirstname = mysqli_real_escape_string($con, $_POST['mfirstname']);
		$mmiddlename = mysqli_real_escape_string($con, $_POST['mmiddlename']);
		$moccupation = mysqli_real_escape_string($con, $_POST['moccupation']);
		$mphone = mysqli_real_escape_string($con, $_POST['mphone']);

		$gname = mysqli_real_escape_string($con, $_POST['gname']);
		$gphone = mysqli_real_escape_string($con, $_POST['gphone']);

		$img_name = $_FILES['my_image']['name'];
    	$img_size = $_FILES['my_image']['size'];
    	$tmp_name = $_FILES['my_image']['tmp_name'];
    	$error = $_FILES['my_image']['error'];

    	$reg_year=date("Y");
		$reg_month=date("F");
		$reg_date=date("Y-m-d");

    	$check_email = "SELECT * FROM std_admission WHERE Email = '$email'";
    	$res = mysqli_query($con, $check_email);

    	if(mysqli_num_rows($res) > 0){
        	$errors = "Email that you have entered is already exist!";
       		header("Location: ../student/admissionForm.php?error=$errors");
    	}
    	else if($error === 0){
    		$astatus = "Pending";

    		if ($img_size > 31457280) {
            	$errors = "Sorry, your file is too large.";
            	header("Location: ../student/admissionForm.php?error=$errors");
            
        	}else {
            	$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            	$img_ex_lc = strtolower($img_ex);
            	$allowed_exs = array("jpg", "jpeg", "png");

            	if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = '../assets/upload/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                $std_data = "INSERT INTO std_admission (Lastname, Firstname, Middlename, DOB, Age, POB, Gender, Status, Nationality, Address, PA, SContact, Email, Fathers_LN, Fathers_FN, Fathers_MN, F_Occupation, FContact, Mothers_LN, Mothers_FN, Mothers_MN, M_Occupation, MContact, Guardian, GContact, Picture, AStatus, Reg_Month, Reg_Year, Reg_Date) values ('$lastname', '$firstname', '$middlename', '$DOB', '$age', '$POB', '$gender', '$status', '$nationality', '$address', '$paddress', '$scontact', '$email', '$flastname', '$ffirstname', '$fmiddlename', '$foccupation', '$fphone', '$mlastname', '$mfirstname', '$mmiddlename', '$moccupation', '$mphone', '$gname', '$gphone', '$new_img_name', '$astatus', '$reg_month', '$reg_year', '$reg_date')";

                $checkdata = mysqli_query($con, $std_data);

                if ($checkdata) {

                    $subject = "HCA Student Admission";
                    $message = "Hello $firstname $lastname,\n\n<br>Welcome to Holy Child Academy</b>\n\nThank Your! $lastname for Applying Student Admission in our School!!!\n\nThis e-email serves as a confirmation that your <b>Application Successfully Submitted!!!</b>\n\nWait for the school admin/registrar to verify and approve your Application for the second step of your application.";
                    $sender = "From: hca-mis@portal";

                    if(mail($email, $subject, $message, $sender)){
                    $info = "Application Submitted!";
                    header("Location: ../student/std_admission.php?info=$info");
                    exit();
                }else{
                    $errors = "Failed while sending email verification!";
                    header("Location: ../student/std_admission.php?error=$errors");
                }
                
                }else{
                	$errors = "Error!";
                	header("Location: ../student/std_admission.php?error=$errors");

                }

            	}else {
                $errors = "You can't upload files of this type";
                header("Location: ../student/std_admission.php?error=$errors");
            }

        	}
    	}
    

	}

?>