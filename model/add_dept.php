<?php include_once '../database/connection.php'?>
<?php

if (isset($_POST['save'])) {
    $code = mysqli_real_escape_string($con, $_POST['code']);
    $des = mysqli_real_escape_string($con, $_POST['description']);

    $check_dept = mysqli_query($con, "SELECT * from department Where Dept_Code = '$code' OR Department = '$des'");

    if (mysqli_num_rows($check_dept) > 0) {
        echo '<script>alert("Department Already Exists!")</script>';
        echo '<script>window.alert.href="../admin/department.php"</script>';

    }else{
        $sql = "INSERT INTO department (Dept_Code, Department) VALUES ('$code', '$des')";
        $dept = mysqli_query($con, $sql);
        if ($dept) {
            echo '<script>window.alert.href="../admin/department.php"</script>';
        }
            
    }    

    

}
?>