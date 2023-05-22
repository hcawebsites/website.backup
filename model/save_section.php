<?php include_once '../database/connection.php';
if (isset($_POST['save'])) {
    $grade = mysqli_real_escape_string($con, $_POST['grade']);
    $dept = mysqli_real_escape_string($con, $_POST['dept']);
    $section = mysqli_real_escape_string($con, $_POST['section']);

    $checkData = mysqli_query($con, "SELECT * FROM grade WHERE Name = '$grade' AND Section = '$section'");
    if (mysqli_num_rows($checkData) > 0) {
        echo "
        <script>
            alert('Grade and Section already Added!');
            window.location.href = '../admin/grade.php';
        </script>
        ";
    }else{
        $insertData = mysqli_query($con, "INSERT INTO grade (Name, Section, Department)VALUES('$grade', '$section', '$dept')");
        if ($insertData) {
            echo "
                <script>
                    alert('Grade and Section added in database!');
                    window.location.href = '../admin/grade.php';
                </script>
            ";
        }
    }

}




?>