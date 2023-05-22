<?php include_once '../database/connection.php'?>
<?php

if (isset($_POST['save'])) {
    $code = mysqli_real_escape_string($con, $_POST['code']);
    $des = mysqli_real_escape_string($con, $_POST['description']);
    $grade = mysqli_real_escape_string($con, $_POST['grade']);

    $check_strand = mysqli_query($con, "SELECT * from strands Where Strands = '$code' AND Description = '$des' AND Grade = '$grade'");

    if (mysqli_num_rows($check_strand) > 0) {
        echo '<script>alert("Strand Already Exists!")</script>';
        echo '<script>window.alert.href="../admin/strand.php"</script>';

    }else{
        $sql = "INSERT INTO strands (Strands, Description, Grade) VALUES ('$code', '$des', '$grade')";
        $strand = mysqli_query($con, $sql);

        if ($strand) {
            $sql1 = "INSERT INTO section (Grade, Strand) VALUES ('$grade', '$code')";
            $section = mysqli_query($con, $sql1);

            if ($section) {
            echo '<script>alert("Strand Saved Successful!")</script>';
            echo '<script>window.alert.href="../admin/strand.php"</script>';
            }else{
                echo '<script>alert("Something Went Wrong!")</script>';
                echo '<script>window.alert.href="../admin/strand.php"</script>';
            }
        }else{
            echo '<script>alert("Something Went Wrong!")</script>';
            echo '<script>window.alert.href="../admin/strand.php"</script>';
        }
    }    

    

}
?>