<?php 
if (isset($_POST['next'])) {
    $grade = $_POST['grade'];
    $department = $_POST['department']; 

    if ($department == "ELDEPT" || $department == "JHSDEPT") {
        echo '<script type="text/javascript">
			$(document).ready(function(){
                $("#inputGrade").val("'.$grade.'")
                $("#department1").val("'.$department.'")
				$("#section1").modal("show");
                
			});
		</script>';
    }else{
        $sql1 = "INSERT into grade (Name, Department) VALUES ('$grade', '$department')";
        $grade1 = mysqli_query($con, $sql1);
        if ($grade1) {
            echo "<script>alert('Grade Successfully Saved!')</script>";
            echo "<script>window.location.heref='../admin/grade.php'</script>";

        }else{
            echo "<script>alert('Something Went Wrong!')</script>";
            echo "<script>window.location.heref='../admin/grade.php'</script>";
        }
    }
}




?>



