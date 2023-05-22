<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>

<div class="content-wrapper">
    <section class="content-header">
    	<h1>
        	Room
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Classroom</a></li>
            <li><a href="#">Room</a></li>
    	</ol>  
	</section>
    <hr>
    <section class="content">
        <div class="row">
            <?php
            
            $myID = $_SESSION['emp_id'];
            $sql = mysqli_query($con, "SELECT * FROM teacher_tb WHERE Emp_ID = '$myID'");
            $row2 = mysqli_fetch_assoc($sql);
            $id = $row2['ID'];
            $name = $row2['Salutation']. ". " .$row2['Firstname'] . " " . $row2['Lastname'];
            $picture = $row2['Picture'];

            $ids = $_GET['student_id'];
            $qid = $_GET['quiz_id'];
            $sql1 = mysqli_query($con, "SELECT * FROM std_quiz WHERE Quiz_ID = '$qid' AND Student_ID = '$ids'");
            $row1 = mysqli_fetch_assoc($sql1);
            $code = $row1['Code'];

            $sql = mysqli_query($con, "SELECT * from quiz inner join classroom on quiz.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID where quiz.Code = '$code' AND schedule.Teacher_ID = '$myID'");
            $row = mysqli_fetch_assoc($sql);
            $image = $row['Picture'];
            ?>

                <div class="col-md-12">
                    <div class="cards" style="background-image: url(../../assets/image/classroom.jpg);  background-size: cover;
	                background-position: center; background-repeat: no-repeat;color: #333; margin-top: 20px; margin-left: 50px; 
                    margin-right: 50px; padding: .5rem 1rem 1rem 2rem">  

                    <h1 style="margin-top: 120px; color:#fff;"><?php echo $row['Subject_Code']. " - " . $row['Description']?></h1>
                    <h4 style="color: #fff;"><?php echo $row['Name']. " ".$row['Strand']. " - " . $row['Section']?></h4>                    
                    
                    </div>
                </div>

                <?php
                $alert = "";

                if (isset($_POST['post'])) {
                    $body = mysqli_real_escape_string($con, $_POST['private']);
                    $private = mysqli_query($con, "INSERT INTO assignment_comments (Body, Code, Name, Student_ID, Teacher_ID, Post_ID, Picture, Status) Values ('$body', '$code', '$name', '$ids', '$myID', '$qid', '$picture', '1')");
                    if ($private) {
                        $alert = '<p style="font-size: 14px; color: #7F7F7F;" class="text-center">Comment Posted!</p>';
                    }
                }


                
                
                ?>

                <div class="col-md-12">
                    <div class="cards" style="background: #fff; margin-top: 10px; margin-right: 50px; margin-left: 50px; padding: .5rem 1rem 1rem 1rem">
                        <div class="row">
                            <div class="col-md-8">
                                <iframe src="viewStdQuiz.php?student_id=<?=$ids?>&quiz_id=<?=$qid?>" width="100%" height="100%" frameborder="0"></iframe>
                            </div>

                            <div class="col-md-4" style="border-left: 1px solid #d9d9d9;">
                                <p style="font-size: 22px; font-weight: 600;">Grade</p>
                               
                                <form action="../../staff-model/update_quiz_score.php?student_id=<?=$ids?>&quiz_id=<?=$qid?>" method="POST">
                                    <?php
                                        echo '
                                        <input type="number" name="score" value='.$row1['Score'].' class="form-control" required>                                        <button style="margin-top: 10px" type="submit" name="return" class="form-control btn btn-info">Return</button>
                                        ';
                                    
                                    
                                    
                                    ?>
                                </form>
                                <hr>

                                <p style="font-size: 16px; font-weight: 600;">Private Comment</p>
                                <hr>
                                <?php
                                    $private = mysqli_query($con, "SELECT * from assignment_comments WHERE Post_ID = '$qid' AND Teacher_ID = '$myID' And Student_ID = '$ids' And assignment_comments.Status = '1'");
                                    if (mysqli_num_rows($private) > 0) {
                                        while ($rows = mysqli_fetch_assoc($private)) {
                                            $date = date("M d,  h:m A", strtotime($rows['Date_Post']));
                                            echo '<img style="float: left;" src="../../assets/upload/'.$rows['Picture'].'" width="35px" alt="">
                                           <div style="margin-left: 40px;">
                                            <span>'.$rows['Name'].'</span>
                                            <p style="font-size: 12px; color: #7F7F7F;">'.$date.'</p>
                                           </div>
                                           <p>'.$rows['Body'].'</p>
                                            <hr>
                                            
                                            
                                            ';
                                        }
                                       
                                    }else{
                                        echo '<p>No comment to show!</p>';
                                    }
                                ?>

                                    <form action="std_quiz_answer.php?student_id=<?=$ids?>&quiz_id=<?=$qid?>" method="POST">
                                    <textarea name="private" id="private" class="form-control" rows="2" style="resize: none;"></textarea>
                                    <button style="margin-top: 10px" type="submit" name="post" id="post" class="form-control btn btn-success">Post</button>
                                    <?=$alert?>
                                </form>
                            </div>

                            
                                
                            
                        </div>
                        
                    
                    </div>
                </div>

       
    </section>

</div>

<script>

let list = document.querySelectorAll('button');
        for (let i = 0; i<list.length; i++ ){
            list[i].onclick = function () {
                let j = 0;
                while (j < list.length) {
                    list[j++].className = 'btn form-control';
                }
                list[i].className = 'btn form-control active';
            }
        }
</script>

<?php include_once('../footer.php'); ?>

