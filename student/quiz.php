<?php 
error_reporting(0);
include_once 'main_head.php';  
include_once 'std_header.php';
include_once 'std_sidebar.php';
$myID = $_SESSION['student_id']?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Quizzes
			<small>Preview</small>
		</h1>

		<ol class="breadcrumb">
            <li><a href="#">Classroom</a></li>
            <li><a href="#">Room</a></li>
            <li><a href="#">Quizzes</a></li>
		</ol>
		<hr>
	</section>

	<section class="content">
		
		<div class="row">
            <?php
            $qid = $_GET['quizID'];

            $sql = mysqli_query($con, "SELECT * from quiz inner join classroom on quiz.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.id inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID WHERE quiz.Quiz_ID = '$qid'");
            $row = mysqli_fetch_assoc($sql);
            $image = $row['Picture'];
            $class= $row['Name']. " " .$row['Strand']. " - " .$row['Section'];
            ?>

                <div class="col-md-12">
                    <div class="cards" style="background-image: url(../assets/image/classroom.jpg);  background-size: cover;
	                background-position: center; background-repeat: no-repeat;color: #333; margin-top: 20px; margin-left: 50px; 
                    margin-right: 50px; padding: .5rem 1rem 1rem 2rem">
                    
                    <h1 style="margin-top: 120px; color:#fff;"><?php echo $row['Subject_Code']. " - " . $row['Description']?></h1>
                    <h4 style="color: #fff;"><?php echo $class?></h4>                    
                    
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="cards" style="background: #fff; margin-top: 10px; margin-left: 50px; padding: .5rem 1rem 1rem 1rem">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="logo" style="background-color: #D9D9D9; padding: 1rem 1rem 1rem 1rem; border-radius: 100%;">
                                    <img src="../assets/image/assignment.png" width="45px">
                                </div>
                            </div>

                            <div class="col-md-10">
                                <div style="margin-left: -20px;">
                                    <?php
                                    $ass_data = mysqli_query($con, "SELECT * from quiz inner join classroom on quiz.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID Where quiz.Quiz_ID = '$qid'");
                                    while ($row1 = mysqli_fetch_assoc($ass_data)) {
                                        $date = date("M d, Y", strtotime($row1['Date']));
                                        $due = date("M d, Y", strtotime($row1['Due_Date']));
                                        $time = date("h:m A", strtotime($row1['Due_Time']));
                                        $duedate = $due." ".$time;
                                        echo '<div style="line-height: 15px; margin-top: 5px">
                                            <p style="font-size: 20px; font-weight: 600;">'.$row1['Title'].'</p>
                                            <p style="color: #6E6E6E;">'.$row1['Salutation'].'. '.$row1['Firstname'].' '.$row1['Lastname']. '</p>
                                            <small style="color: #6E6E6E;">'.$date.'</small>
                                            <p style="float: right; color: #6E6E6E;">Due '.$duedate.'</p><br>
                                            
                                        
                                        </div>  

                                        
                                        
                                        ';
                                    }
                                    
                                    ?>
                                </div>
                            </div>

                        </div>
                        <div style="border: 1px solid #4d5bf9 "></div>
                        <?php
                            $ass_data = mysqli_query($con, "SELECT *, quiz.Code as code, quiz.Status as status from quiz inner join classroom on quiz.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID Where quiz.Quiz_ID = '$qid'");
                            while ($data1 = mysqli_fetch_assoc($ass_data)) {
                            	$deadline = date("F j, Y", strtotime($data1['Due_Date'])). " " .date("h:i A", strtotime($data1['Due_Time']));
                            	$total = $data1['Questions'];
                                $classCode = $data1['code'];
                                $status = $data1['status'];
	                       ?>
	                       <div class="row">
		                       	<div class="col-md-12" style="padding: 10px;">
		                     		<a href="startQuiz.php?qid=<?=$qid?>&n=1&total=<?=$total?>&std_id=<?=$myID?>&code=<?=$classCode?>&status=<?=$status?>" title="Click Here Start The Quiz">
		                     			<img src="../assets/image/quizzes.png" width="150px" style="float: left; margin-right: 10px">
		                     		<div style="line-height: 15px">
		                     			<p><b>Title: </b><?=$data1['Title'] ?></p>
		                     			<p><b>Instruction: </b><?=$data1['Description'] ?></p>
		                     			<p><b>Total Questions: </b><?=$data1['Questions'] ?></p>
		                     			<p><b>Time Limit: </b><?=$data1['Time_Limit']?> minutes</p>
		                     			<p><b>Deadline: </b><?=$deadline ?></p>
		                     		</div>
		                     		</a>

		                     	</div>
	                       </div>
	                     	

                           <?php } ?>
                       
                        <?php
                            $sql1 = mysqli_query($con, "SELECT count(*) From assignment_comments WHERE Post_ID = '$qid' AND Status = 0");
                            $rows = mysqli_fetch_assoc($sql1);
                        ?>
                        <div style="border: 1px solid #4d5bf9;"></div>
                        <div class='commentOption' onClick='javascript:toggle()'> 
                            <p>Class comments - <?=$rows['count(*)']?></p>
                        </div>
                        <div class='post_comment' id='toggleComment' style='display:none;'>
                            <iframe src='../student/quiz_comment.php?quiz_id=<?=$qid?>' id='comment_iframe' frameborder='0' ></iframe>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <?php
                        $query = mysqli_query($con, "SELECT * FROM std_quiz WHERE Quiz_ID = '$qid' AND Student_ID = '$myID'");
                        $row = mysqli_fetch_assoc($query);
                        $file = $row['Files'];
                        $total = mysqli_query($con, "SELECT sum(Points) as points FROM `questions` WHERE Quiz_ID = '$qid'");
                        $sum = mysqli_fetch_assoc($total);
                        $total = $sum['points'];

                        if ($file == "") {
                            echo '
                            <div class="cards" style="background: #fff; margin-top: 10px; margin-right: 50px; padding: .5rem 1rem 1rem 1rem">

                            <div class="title">
                                <p style="font-size: 14px; float: right; margin-top: 5px; color: green;">Assigned</p>
                                <p style="font-size: 20px; font-weight: 600;">Your Work</p>
                            </div>
                                <form action="quiz.php?quizID='.$qid.'" method="POST" enctype="multipart/form-data">
                                    <div class="pass" style="margin-top: 10px;">
                                    <input type="file" name="file" id="file" class="form-group form-control">
                                    <button style="background-color:#4d5bf9; color:#fff; font-size: 14px; font-weight: 500;" type="submit" name="submit" id="submit" class="form-group form-control btn">Submit</button>
                                    </div>
                                </form>
                            </div>
                            ';
                        }else{
                            echo '
                            <div class="cards" style="background: #fff; margin-top: 10px; margin-right: 50px; padding: .5rem 1rem 1rem 1rem">

                                <div class="title">
                                    <p style="font-size: 14px; float: right; margin-top: 5px; color: green;">Score: '.$row['Score'].' out of '.$total.'</p>
                                    <p style="font-size: 20px; font-weight: 600;">Your Work</p>
                                </div>
                                <div style="border: 1px solid #4d5bf9;"></div>
                                <div class="pass" style="margin-top: 10px;">

                                    <div style=" border-radius: 10px; background-color: #d9d9d9; font-size: 14px; padding: .5rem .5rem .5rem .5rem; display: flex; justify-content: center; align-item: center; margin-bottom: 10px; border: 1px solid">
                                    <a style=""href="../assignment/'.$row['Files'].'">'.$row['Files'].'</a>
                                    </div>
                                </div>

                                <button data-toggle="modal" data-target="#unsubmit" style="color:#333; background-color: #ED696B; font-size: 14px; font-weight: 500;" type="submit" class="form-group form-control btn">Unsubmit</button>

                            </div>
                                ';
                        }
                        
                    ?>
                </div>

                <div class="col-md-4">
                    <?php
                        $sql1 = mysqli_query($con, "SELECT count(*) From assignment_comments WHERE Post_ID = '$qid' AND Status = 1 AND Student_ID = '$myID'");
                        $rows = mysqli_fetch_assoc($sql1);
                    ?>
                    <div class="cards" style="background: #fff; margin-top: 10px; margin-right: 50px; padding: .5rem 1rem 1rem 1rem">
                        <div class="">
                            <img src="../assets/image/private.png" width="30px" class="img-circle">
                            <span style="color: #7F7F7F; font-weight: 500;">Private comments</span>
                        </div>

                        <div style="margin-top: 10px;" class='commentOption' onClick='javascript:private()'> 
                            <p style="font-size: 14px; ">Add private comment - <?=$rows['count(*)']?></p>
                        </div>
                        
                        <div id="private" style="display: none;">
                            
                        <iframe src='../student/private_comment.php?quiz_id=<?=$qid?>&type=quiz' id='comment_iframe' width="100%" height="250px" frameborder='0' ></iframe>
                        </div>
                
                    </div>
                </div>
        </div>
	</section>
</div>

<div class="modal fade" id="unsubmit" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Unsubmit?</h4>
        
      </div>
      <div class="modal-body">
        <p>Unsubmit to add or change attachments. Don't forget to resubmit once you're done.</p>
      </div>
      <div class="modal-footer">
        <form action="quiz.php?quizID=<?=$qid?>" method="POST">
        <button type="submit" name="unsubmit" class="btn btn-primary">Unsubmit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once 'footer.php';
if (isset($_POST['submit'])) {
    $qid = $_GET['quizID'];
    $myID = $_SESSION['student_id'];

    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileError = $_FILES['file']['error'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
   
   $allowed  = array('jpg', 'jpeg', 'png', 'pdf', 'docx', 'doc', 'xlsx', 'pptx', 'ppt');

      if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
        if ($fileSize < 1000000000000) {
            $fileNameNew = uniqid(" ", true) . "." . $fileActualExt;
            $fileDestination = '../assignment/' . $fileName;
            move_uploaded_file($fileTmpName, $fileDestination); //file uploaded okay

            $sql = mysqli_query($con, "UPDATE std_quiz SET Files = '$fileName' WHERE Quiz_ID = '$qid' AND Student_ID = '$myID'");
            if($sql){
               echo '<script>
                    alert("Quiz Submitted!");
                    window.location.href="quiz.php?quizID='.$qid.'"
               </script>';
            }
        } else {
            echo "your file is too big";
        }
    } else {
        echo "Error uploading your file!  ";
    }
}else{
}

}

if (isset($_POST['unsubmit'])) {
    $qid = $_GET['quizID'];
    $myID = $_SESSION['student_id'];
    $sql = mysqli_query($con, "UPDATE std_quiz SET Files = '' WHERE Quiz_ID = '$qid' AND Student_ID = '$myID'");
            if($sql){
               echo '<script>
                    alert("Quiz Unsubmitted!");
                    window.location.href="quiz.php?quizID='.$qid.'"
               </script>';
            }
}


?>

<script>
     function toggle() {
         var element = document.getElementById("toggleComment");

         if (element.style.display == "block")
             element.style.display = "none";
         else
             element.style.display = "block";
     }

     function private() {
         var element = document.getElementById("private");

         if (element.style.display == "block")
             element.style.display = "none";
         else
             element.style.display = "block";
     }
 </script>