<?php include_once ('../database/connection.php');

	
if (isset($_POST['save'])){

	$rdate = mysqli_real_escape_string($con, $_POST['rdate']);
	$atype = mysqli_real_escape_string($con, $_POST['atype']);
	$id = mysqli_real_escape_string($con, $_POST['id']);
	$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
	$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
	$middlename = mysqli_real_escape_string($con, $_POST['middlename']);
	$bdate = mysqli_real_escape_string($con, $_POST['birthdate']);
	$age = mysqli_real_escape_string($con, $_POST['age']);
	$gender = mysqli_real_escape_string($con, $_POST['gender']);
	$address = mysqli_real_escape_string($con, $_POST['address']);
	$nationality = mysqli_real_escape_string($con, $_POST['nationality']);
	$phone = mysqli_real_escape_string($con, $_POST['phone']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['pass']);
	$cpassword = mysqli_real_escape_string($con, $_POST['cpass']);
	
	$img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];
    	
    	if ($atype == "Teacher") {
		if($error == 0){

    		if ($img_size > 31457280) {
            	echo '<script>alert("Sorry, Your File is to big!")</script>';
				echo '<script>window.location.href="../staff/form.php"</script>';
            
        	}else {
            	$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            	$img_ex_lc = strtolower($img_ex);
            	$allowed_exs = array("jpg", "jpeg", "png");

            	if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = '../assets/upload/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                $teacher_data = "UPDATE teacher_tb SET Lastname='$lastname', Firstname='$firstname', Middlename='$middlename',
				DOB='$bdate', Age='$age', Gender='$gender', Address='$address', Nationality='$nationality', Contact='$phone', 
				Email='$email',Picture='$new_img_name', RDate='$rdate' WHERE Emp_ID = '$id'";

                $checkdata = mysqli_query($con, $teacher_data);
                $encpass = password_hash($password, PASSWORD_BCRYPT);

                $sql = "UPDATE user SET Lastname = '$lastname', Firstname = '$firstname', Middlename = '$middlename', Password = '$encpass', AStatus = '1' WHERE Username ='$id'";	
                $result = mysqli_query($con, $sql);

                if ($result && $checkdata) {
                	echo '<script>alert("Account Inforamtion Save!\nClick Ok to proceed!\n\nThank you and God Blessed!")</script>';
					echo '<script>window.location.href="../staff/login.php"</script>';

                }else{
                    echo '<script>alert("Something went wrong!")</script>';
					echo '<script>window.location.href="sign-in.php"</script>';
                }
                
                }else {
					echo '<script>alert("You cant upload this file type!")</script>';
					echo '<script>window.location.href="../staff/form.php"</script>';

                }

            	}

        	}
    	}

    	if ($atype == "librarian") {

			if($password != $cpassword){
				echo '<script>alert("Password Not Match!")</script>';
				echo '<script>window.location.href="../staff/form.php"</script>';
				
			}
			if($error == 0){
	
				if ($img_size > 31457280) {
					echo '<script>alert("Sorry, Your File is to big!")</script>';
					echo '<script>window.location.href="../staff/form.php"</script>';
				
				}else {
					$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
					$img_ex_lc = strtolower($img_ex);
					$allowed_exs = array("jpg", "jpeg", "png");
	
					if (in_array($img_ex_lc, $allowed_exs)) {
					$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
					$img_upload_path = '../assets/upload/'.$new_img_name;
					move_uploaded_file($tmp_name, $img_upload_path);
	
					$teacher_data = "UPDATE teacher_tb SET Lastname='$lastname', Firstname='$firstname', Middlename='$middlename',
					DOB='$bdate', Age='$age', Gender='$gender', Address='$address', Nationality='$nationality', Contact='$phone', 
					Email='$email',Picture='$new_img_name', RDate='$rdate' WHERE Emp_ID = '$id'";
	
					$checkdata = mysqli_query($con, $teacher_data);
					$encpass = password_hash($password, PASSWORD_BCRYPT);
	
					$sql = "UPDATE user SET Lastname = '$lastname', Firstname = '$firstname', Middlename = '$middlename', Password = '$encpass', AStatus = '1' WHERE Username ='$id'";	
					$result = mysqli_query($con, $sql);
	
					if ($result && $checkdata) {
						echo '<script>alert("Account Inforamtion Save!\nClick Ok to proceed!\n\nThank you and God Blessed!")</script>';
						echo '<script>window.location.href="../staff/login.php"</script>';
	
					}else{
						echo '<script>alert("Something went wrong!")</script>';
						echo '<script>window.location.href="sign-in.php"</script>';
					}
					
					}else {
						echo '<script>alert("You cant upload this file type!")</script>';
						echo '<script>window.location.href="../staff/form.php"</script>';
	
					}
	
					}
	
				}
			}

			if ($atype == "Registrar") {

    	if($password != $cpassword){
			echo '<script>alert("Password Not Match!")</script>';
			echo '<script>window.location.href="../staff/form.php"</script>';
    		
    	}
		if($error == 0){

    		if ($img_size > 31457280) {
            	echo '<script>alert("Sorry, Your File is to big!")</script>';
				echo '<script>window.location.href="../staff/form.php"</script>';
            
        	}else {
            	$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            	$img_ex_lc = strtolower($img_ex);
            	$allowed_exs = array("jpg", "jpeg", "png");

            	if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = '../assets/upload/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                $teacher_data = "UPDATE teacher_tb SET Lastname='$lastname', Firstname='$firstname', Middlename='$middlename',
				DOB='$bdate', Age='$age', Gender='$gender', Address='$address', Nationality='$nationality', Contact='$phone', 
				Email='$email',Picture='$new_img_name', RDate='$rdate' WHERE Emp_ID = '$id'";

                $checkdata = mysqli_query($con, $teacher_data);
                $encpass = password_hash($password, PASSWORD_BCRYPT);

                $sql = "UPDATE user SET Lastname = '$lastname', Firstname = '$firstname', Middlename = '$middlename', Password = '$encpass', AStatus = '1' WHERE Username ='$id'";	
                $result = mysqli_query($con, $sql);

                if ($result && $checkdata) {
                	echo '<script>alert("Account Inforamtion Save!\nClick Ok to proceed!\n\nThank you and God Blessed!")</script>';
					echo '<script>window.location.href="../staff/login.php"</script>';

                }else{
                    echo '<script>alert("Something went wrong!")</script>';
					echo '<script>window.location.href="sign-in.php"</script>';
                }
                
                }else {
					echo '<script>alert("You cant upload this file type!")</script>';
					echo '<script>window.location.href="../staff/form.php"</script>';

                }

            	}

        	}
    	}

		if ($atype == "Clinic") {

			if($password != $cpassword){
				echo '<script>alert("Password Not Match!")</script>';
				echo '<script>window.location.href="../staff/form.php"</script>';
				
			}
			if($error == 0){
	
				if ($img_size > 31457280) {
					echo '<script>alert("Sorry, Your File is to big!")</script>';
					echo '<script>window.location.href="../staff/form.php"</script>';
				
				}else {
					$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
					$img_ex_lc = strtolower($img_ex);
					$allowed_exs = array("jpg", "jpeg", "png");
	
					if (in_array($img_ex_lc, $allowed_exs)) {
					$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
					$img_upload_path = '../assets/upload/'.$new_img_name;
					move_uploaded_file($tmp_name, $img_upload_path);
	
					$teacher_data = "UPDATE teacher_tb SET Lastname='$lastname', Firstname='$firstname', Middlename='$middlename',
					DOB='$bdate', Age='$age', Gender='$gender', Address='$address', Nationality='$nationality', Contact='$phone', 
					Email='$email',Picture='$new_img_name', RDate='$rdate' WHERE Emp_ID = '$id'";
	
					$checkdata = mysqli_query($con, $teacher_data);
					$encpass = password_hash($password, PASSWORD_BCRYPT);
	
					$sql = "UPDATE user SET Lastname = '$lastname', Firstname = '$firstname', Middlename = '$middlename', Password = '$encpass', AStatus = '1' WHERE Username ='$id'";	
					$result = mysqli_query($con, $sql);
	
					if ($result && $checkdata) {
						echo '<script>alert("Account Inforamtion Save!\nClick Ok to proceed!\n\nThank you and God Blessed!")</script>';
						echo '<script>window.location.href="../staff/login.php"</script>';
	
					}else{
						echo '<script>alert("Something went wrong!")</script>';
						echo '<script>window.location.href="sign-in.php"</script>';
					}
					
					}else {
						echo '<script>alert("You cant upload this file type!")</script>';
						echo '<script>window.location.href="../staff/form.php"</script>';
	
					}
	
					}
	
				}
			}






    }



?>