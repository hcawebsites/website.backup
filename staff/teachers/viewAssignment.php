<?php include_once('main_head.php');?>
<?php

$student_id = $_GET['student_id'];
$sql1 = mysqli_query($con, "SELECT * from std_assign Where Student_ID = '$student_id'");
$row1 = mysqli_fetch_assoc($sql1);


?>

<div class="text-center">
    <a href="../../assignment/<?=$row1['Answer']?>" class="btn btn-success form-control" style="width: 200px;">View Assignment</a>
</div>