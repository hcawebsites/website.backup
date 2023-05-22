<?php include_once ('../database/connection.php');


if (isset($_POST['save'])) {
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($con, $_POST['middlename']);
    $suffix = mysqli_real_escape_string($con, $_POST['suffix']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $pob = mysqli_real_escape_string($con, $_POST['birth']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    $nationality = mysqli_real_escape_string($con, $_POST['nationality']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $lrn = mysqli_real_escape_string($con, $_POST['lrn']);
    $grade = mysqli_real_escape_string($con, $_POST['grade']);
    $sla = mysqli_real_escape_string($con, $_POST['SLA']);
    $lsya = mysqli_real_escape_string($con, $_POST['sy']);
    $genAve = mysqli_real_escape_string($con, $_POST['genAve']);
    $strand = mysqli_real_escape_string($con, $_POST['strand']);
    $phone = mysqli_real_escape_string($con, $_POST['sphone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];
    /* END OF STUDENT DATA*/

    /* PARENTS DATA*/

    $flastname = mysqli_real_escape_string($con, $_POST['flastname']);
    $ffirstname = mysqli_real_escape_string($con, $_POST['ffirstname']);
    $fmiddlename = mysqli_real_escape_string($con, $_POST['fmiddlename']);
    $fnum = mysqli_real_escape_string($con, $_POST['fnum']);

    $mlastname = mysqli_real_escape_string($con, $_POST['mlastname']);
    $mfirstname = mysqli_real_escape_string($con, $_POST['mfirstname']);
    $mmiddlename = mysqli_real_escape_string($con, $_POST['mmiddlename']);
    $mnum = mysqli_real_escape_string($con, $_POST['mnum']);

    $glastname = mysqli_real_escape_string($con, $_POST['glastname']);
    $gfirstname = mysqli_real_escape_string($con, $_POST['gfirstname']);
    $gmiddlename = mysqli_real_escape_string($con, $_POST['gmiddlename']);
    $gnum = mysqli_real_escape_string($con, $_POST['gnum']);

    $reg_num = $_SESSION['username'];
    if (!$img_name) {
		$new_student_data = "UPDATE student SET Lastname = '$lastname' , Firstname ='$firstname', Middlename = '$middlename', 
        Suffix = '$suffix', Age = '$age', POB = '$pob', Gender = '$gender', Gender = '$gender', Phone = '$phone',
        Email = '$email', Grade = '$grade', Strand = '$strand', Status = '$status', Nationality = '$nationality',
        Address = '$address', LRN = '$lrn' WHERE student.Reg_Number = '$reg_num' ";

        $new_guardians_data = "UPDATE guardians SET F_Lastname = '$flastname', F_Firstname = '$ffirstname', F_Middlename = '$fmiddlename' , F_Contact = '$fnum' , M_Lastname = '$mlastname' , M_Firstname ='$mfirstname' , M_Middlename = '$mmiddlename' , M_Contact = '$mnum' , G_Lastname = '$glastname' , G_Firstname = '$gfirstname' , G_Middlename = '$gmiddlename' , G_Contact = '$gnum' WHERE guardians.Reg_Number = '$reg_num' ";

		if(mysqli_query($con,$new_student_data) && mysqli_query($con,$new_guardians_data)){
    			 echo "<script>alert('Details Updated...!')</script>";
                 echo "<script>window.location.href</script>";
    		}
	}else{
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png");

        if (in_array($img_ex_lc, $allowed_exs)) {
        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
        $img_upload_path = '../assets/upload/'.$new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);

        $new_student_data = "UPDATE student SET Lastname = '$lastname' , Firstname ='$firstname', Middlename = '$middlename', 
        Suffix = '$suffix', Age = '$age', POB = '$pob', Gender = '$gender', Gender = '$gender', Phone = '$phone',
        Email = '$email', Picture = '$new_img_name', Grade = '$grade', Strand = '$strand', Status = '$status', Nationality = '$nationality',
        Address = '$address', LRN = '$lrn' WHERE student.Reg_Number = '$reg_num' ";

        $new_guardians_data = "UPDATE guardians SET F_Lastname = '$flastname', F_Firstname = '$ffirstname', F_Middlename = '$fmiddlename' , F_Contact = '$fnum' , M_Lastname = '$mlastname' , M_Firstname ='$mfirstname' , M_Middlename = '$mmiddlename' , M_Contact = '$mnum' , G_Lastname = '$glastname' , G_Firstname = '$gfirstname' , G_Middlename = '$gmiddlename' , G_Contact = '$gnum' WHERE guardians.Reg_Number = '$reg_num' ";

        if(mysqli_query($con,$new_student_data) && mysqli_query($con,$new_guardians_data)){
                 echo "<script>alert('Details Updated...!')</script>";
                 echo "<script>window.location.href</script>";
            }


    }
    }
}




?>