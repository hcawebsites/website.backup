<?php
include_once("../database/connection.php");

if (isset($_POST['save'])) {
   $admin_id = mysqli_real_escape_string($con, $_POST['admin_id']);
   $salutation = mysqli_real_escape_string($con, $_POST['salutation']);
   $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
   $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
   $middlename = mysqli_real_escape_string($con, $_POST['middlename']);
   $suffix = mysqli_real_escape_string($con, $_POST['suffix']);
   $age = mysqli_real_escape_string($con, $_POST['age']);
   $gender = mysqli_real_escape_string($con, $_POST['gender']);
   $status = mysqli_real_escape_string($con, $_POST['status']);
   $address = mysqli_real_escape_string($con, $_POST['address']);
   $nationality = mysqli_real_escape_string($con, $_POST['nationality']);
   $contact = mysqli_real_escape_string($con, $_POST['contact']);
   $email = mysqli_real_escape_string($con, $_POST['email']);

   $query_update = mysqli_query($con, "UPDATE admin SET Salutation = '$salutation', Lastname = '$lastname', Firstname = '$firstname', Middlename = '$middlename', 
   Suffix = '$suffix', Age = '$age', Gender = '$gender', Status = '$status', Address = '$address', Nationality = '$nationality', Contact = '$contact', 
   Email = '$email' WHERE Admin_ID = '$admin_id'");

   if ($query_update) {
        echo '<script>
            alert("Administrator Details Updated!")
            window.location.href="../admin/admin.php"
        </script>';
   }
}



?>