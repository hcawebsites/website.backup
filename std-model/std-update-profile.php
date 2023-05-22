<?php include_once ('../database/connection.php');?>
<?php 

if (isset($_POST['submit'])) {
    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($con, $_POST['middlename']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $contact = mysqli_real_escape_string($con, $_POST['gname']);
    $contact = mysqli_real_escape_string($con, $_POST['gcontact']);

    if (!$img_name) {
        $new_data = "UPDATE student SET Lastname = '$lastname', Firstname = '$firstname', Middlename = '$middlename',
        Age = '$age', Gender = '$gender', Phone = '$contact', Address = '$address', Email = '$email'
        Where Student_ID = '$student_id'";

        if(mysqli_query($con, $new_data)){
            echo "<script>alert('Information Updated Success...!')</script>";
            echo "<script>window.location.href='../student/std_profile.php'</script>";
       }
    }else{
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png");

        if (in_array($img_ex_lc, $allowed_exs)) {
        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
        $img_upload_path = '../assets/upload/'.$new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);
    
        $new_data = "UPDATE student SET Lastname = '$lastname', Firstname = '$firstname', Middlename = '$middlename',
        Age = '$age', Gender = '$gender', Phone = '$contact', Address = '$address', Email = '$email', 
        Picture = '$new_img_name' Where Student_ID = '$student_id'";

        if(mysqli_query($con, $new_data)){
            echo "<script>alert('Information Updated Success...!')</script>";
            echo "<script>window.location.href='../student/std_profile.php'</script>";
       }
    
    
    }else{
        echo "<script>alert('You can't upload this file type...!')</script>";
        echo "<script>window.location.href='../student/std_profile.php'</script>";
    }
    }

}
?>