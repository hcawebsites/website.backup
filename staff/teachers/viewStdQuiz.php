<?php include_once('main_head.php');?>
<?php

$student_id = $_GET['student_id'];
$qid = $_GET['quiz_id'];
$sql1 = mysqli_query($con, "SELECT * from std_quiz Where Student_ID = '$student_id' AND Quiz_ID = '$qid'");
$row1 = mysqli_fetch_assoc($sql1);


?>

<div class="text-center">
    <a href="../../assignment/<?=$row1['Files']?>" class="btn btn-success form-control" style="width: 200px;">View Assignment</a>
</div>