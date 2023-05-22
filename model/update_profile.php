<?php 
include_once '../database/connection.php';
$info = array();

if (isset($_POST['submit'])) {
	$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
	$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
	$middlename = mysqli_real_escape_string($con, $_POST['middlename']);
	$age = mysqli_real_escape_string($con, $_POST['age']);
	$gender = mysqli_real_escape_string($con, $_POST['gender']);
	$address = mysqli_real_escape_string($con, $_POST['address']);
	$nationality = mysqli_real_escape_string($con, $_POST['nationality']);
	$contact = mysqli_real_escape_string($con, $_POST['contact']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$myID = mysqli_real_escape_string($con, $_POST['myID']);

	$img_name = $_FILES['my_image']['name'];
   	$img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

	if (!$img_name) {
		$new_data1 = "UPDATE admin SET Lastname = '$lastname' , Firstname ='$firstname', Middlename = '$middlename', Age = '$age', Gender = '$gender', Address = '$address', Nationality = '$nationality', Contact = '$contact', Email = '$email' WHERE Admin_ID = '$myID'";

		if(mysqli_query($con,$new_data1)){
			echo "<script>alert('Information Updated Success...!')</script>";
            echo "<script>window.location.href='../admin/admin_profile.php'</script>";
    		}
	}else{

		if ($error === 0) {
			if ($img_size > 31457280) {
            	$errors = "Sorry, your file is too large.";
            	header("Location: ../admin/admin_profile.php?error=$errors");
            
        	}else{
        		$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            	$img_ex_lc = strtolower($img_ex);
            	$allowed_exs = array("jpg", "jpeg", "png");

            	if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = '../assets/upload/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                $new_data2 = "UPDATE admin SET Lastname = '$lastname' , Firstname ='$firstname', Middlename = '$middlename', Age = '$age', Gender = '$gender', Address = '$address', Nationality = '$nationality', Contact = '$contact', Email = '$email', Picture = '$new_img_name' WHERE Admin_ID = '$myID'";
                $checkdata = mysqli_query($con, $new_data2);

                if ($checkdata) {
                	echo "<script>alert('Information Updated Success...!')</script>";
            		echo "<script>window.location.href='../admin/admin_profile.php'</script>";
                }else{

                	$errors = "Profile Update Failed";
                	header("Location: ../admin/admin_profile.php?error=$errors");

                }
            }else {
                $errors = "You can't upload files of this type";
                header("Location: ../admin/admin_profile.php?error=$errors");
            }



        	}
		}
		
		}
	}



?>