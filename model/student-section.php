<?php
include_once '../database/connection.php';
if (isset($_POST['approve'])) {
    $id = $_POST['id'];
    $grade = $_POST['grade'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $middlename = $_POST['middlename'];
    $email = $_POST['email'];
    $strand = $_POST['strand'];

     $getGrade = mysqli_query($con, "SELECT *, grade.ID as id FROM grade inner join student on grade.Name = student.Grade WHERE student.ID = '$id'");
        while ($row = mysqli_fetch_array($getGrade)) {
        $dept = $row['Department'];

       if ($dept == "SHSDEPT") {
            echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#reg_num1").val("'.$id.'")
                    $("#email1").val("'.$email.'")
                    $("#firstname1").val("'.$firstname.'")
                    $("#lastname1").val("'.$lastname.'")
                    $("#middlename1").val("'.$middlename.'")
                    $("#gid").val("'.$row['id'].'")
                    $("#grade1").val("'.$grade.'")
                    $("#strand2").val("'.$strand.'");
                    $("#section1").val("'.$row['Section'].'");
                    $("#assign").modal("show");
                });
            </script>';
        }else{
            echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#reg_num1").val("'.$id.'")
                    $("#email1").val("'.$email.'")
                    $("#firstname1").val("'.$firstname.'")
                    $("#lastname1").val("'.$lastname.'")
                    $("#middlename1").val("'.$middlename.'")
                    $("#gid").val("'.$row['id'].'")
                    $("#grade1").val("'.$grade.'")
                    $("#strand2").hide();
                    $("#strand1").hide();
                    $("#section1").val("'.$row['Section'].'");
                    $("#assign").modal("show");
                });
            </script>';
            
        }
}
   
}


?>