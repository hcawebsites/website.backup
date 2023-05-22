<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); 
$myID = $_SESSION['emp_id'];
?>

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
            $qid = $_GET['quiz_id'];
            $sql = mysqli_query($con, "SELECT * from classroom inner join schedule on classroom.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID Where schedule.Teacher_ID = '$myID'");
            $row = mysqli_fetch_assoc($sql);
            $image = $row['Picture'];
            $class = $row['Name']. " " .$row['Strand']. " - " .$row['Section'];
            ?>

                <div class="col-md-12">
                    <div class="cards" style="background-image: url(../../assets/image/classroom.jpg);  background-size: cover;
	                background-position: center; background-repeat: no-repeat;color: #333; margin-top: 20px; margin-left: 50px; 
                    margin-right: 50px; padding: .5rem 1rem 1rem 2rem">
                    
                    <h1 style="margin-top: 120px; color:#fff;"><?php echo $row['Subject_Code']. " - " . $row['Description']?></h1>
                    <h4 style="color: #fff;"><?php echo $class?></h4>                    
                    
                    </div>
                </div>

                <div class="col-md-12 text-center" style="margin-top: 20px;">
                    <button id="instruction" class="btn btn-warning">Instruction</button>
                    <button id="studentwork" class="btn btn-success">Student Work</button>
                </div>



                <div class="col-md-12" id="instructions" style="display: none;">
                    <div class="cards" style="background: #fff; margin-top: 10px; margin-left: 50px; margin-right: 50px; padding: .5rem 1rem 1rem 1rem">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="logo" style="float:left; margin-top: 15px;">
                                    <img src="../../assets/image/assignment.png" width="45px">
                                </div>
                            </div>

                            <div class="col-md-10">
                                <div style="margin-left: -95px;">
                                    <?php
                                    $ass_data = mysqli_query($con, "SELECT * from quiz inner join classroom on quiz.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID Where Quiz_ID = '$qid'");
                                    while ($row1 = mysqli_fetch_assoc($ass_data)) {
                                        $date = date("M d, Y", strtotime($row1['Date']));
                                        $due = date("M d, Y", strtotime($row1['Due_Date']));
                                        $time = date("h:m A", strtotime($row1['Due_Time']));
                                        $duedate = $due." ".$time;
                                        echo '
                                        <div style="line-height: 15px; margin-top: 5px">
                                        
                                            <p style="font-size: 20px; font-weight: 600;">'.$row1['Title'].'</p>
                                            <p style="color: #6E6E6E;">'.$row1['Salutation'].'. '.$row1['Firstname'].' '.$row1['Lastname']. '</p>
                                            <small style="color: #6E6E6E;">'.$date.'</small>
                                            <p style="float: right; color: #6E6E6E;">Due '.$duedate.'</p>
                                        
                                        </div>
                                        ';
                                    }
                                    
                                    ?>
                                </div>
                            </div>

                        </div>

                        <?php
                            $ass_data = mysqli_query($con, "SELECT *, quiz.Status as status from quiz inner join classroom on quiz.Code = classroom.Code Where Quiz_ID = '$qid'");
                            while ($data1 = mysqli_fetch_assoc($ass_data)) {
                                $status = $data1['status'];
                                $code = $data1['Code'];
                                echo '
                                <h4><b>Instruction:</b> '.$data1['Description'].'</h4>
                                <p><b>Title: </b>'.$data1['Title'].'</p>
                                <p><b>Total Question: </b>'.$data1['Questions'].'</p>
                                <p><b>Time Limit: </b>'.$data1['Time_Limit'].' minutes</p>
                                ';

                                if ($status == 0) {
                                    echo '<button id="'.$qid.'" class="btn btn-success start" style="margin-bottom: 10px;">Start accepting responses</button>';
                                }else{
                                    echo '<button id="'.$qid.'" class="btn btn-danger stop" style="margin-bottom: 10px;">Stop accepting responses</button>';
                                }

                                echo '<a href="viewQuiz.php?quiz_id='.$qid.'&code='.$code.'" class="btn btn-primary" style="margin-left: 10px; margin-bottom: 10px;">View</a>';
                                
                            }
                        ?>

                        <?php
                            $sql1 = mysqli_query($con, "SELECT count(*) From assignment_comments WHERE Post_ID = '$qid' AND Status = 0");
                            $rows = mysqli_fetch_assoc($sql1);
                        ?>
                        <div style="border: 1px solid #4d5bf9;"></div>
                        <div class='commentOption' onClick='javascript:toggle()'> 
                            <p>Class comments - <?=$rows['count(*)']?></p>
                        </div>
                        <div class='post_comment' id='toggleComment' style='display:none;'>
                            <iframe src='../../staff/teachers/comment_assignment.php?quiz_id=<?=$qid?>&type=quiz' id='comment_iframe' frameborder='0' ></iframe>
                        </div>

                    </div>
                </div>



                <div id="studentworks">
                    <div class="col-md-5">
                        <div class="cards" style="background: #fff; margin-top: 10px; margin-left: 50px; padding: .5rem 1rem 1rem 1rem">
                            
                            <label for="" style="font-size: 16px;">List of Student Responses</label><br>
                            
                                <?php
                                $getQuiz = mysqli_query($con, "SELECT * FROM quiz inner join std_quiz on quiz.Code = std_quiz.Code inner join student on std_quiz.Student_ID = student.Student_ID WHERE quiz.Quiz_ID = '$qid'");
                                if(mysqli_num_rows($getQuiz) > 0){
                                    while ($quiz = mysqli_fetch_assoc($getQuiz)) {
                                        $picture = $quiz['Picture'];
                                        $name = $quiz['Firstname']. " " . $quiz['Lastname'];
                                        $total = mysqli_query($con, "SELECT sum(Points) as points FROM `questions` WHERE Quiz_ID = '$qid'");
                                        $sum = mysqli_fetch_assoc($total);
                                        $total = $sum['points'];
                                        ?>
                                
                                        <hr>
                                       <div style="cursor: pointer; background-color: #d9d9d9; border-top: 1px solid #737373;  border-bottom: 1px solid #737373; padding: 1rem 1rem 1rem 1rem;">

                                        
                                       <div class="row">
                                            <div class="col-md-8" style="border-right: 1px solid #737373;">
                                                <input type="checkbox" name="check[]" value="<?=$quiz['Student_ID']?>" id="check" style="margin-right: 10px; cursor: pointer;">
                                                <img src="../../assets/upload/<?=$picture?>" width="30" class="img-circle">
                                                <span><?=$name?></span>
                                            </div>

                                            <div class="col-md-4 score">
                                                <?php 
                                                    if ($quiz['Score'] ==  0) {
                                                       echo '<input type="text" name="score_'.$quiz['Student_ID'].'" require id="score" value="'.$quiz['Score'].'"> - <span style="font-weight: 600">'.$total.'</span>';
                                                    }else{
                                                        echo '<input type="text" name="score_'.$quiz['Student_ID'].'" require id="score" value="'.$quiz['Score'].'"> - <span style="font-weight: 600">'.$total.'</span>';
                                                    }
                                                
                                                ?>
                                            </div>


                                            
                                       </div>
                                       
                                       </div>
                                <?php }
                                }else{
                                    
                                }
                                
                                ?>
                            </form>
                                    
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="cards" style="background: #fff; margin-top: 10px; margin-right: 50px; padding: .5rem 1rem 1rem 1rem">

                        <div class="row">
                            <?php
                                    $asstitle = mysqli_query($con, "SELECT * from quiz Where Quiz_ID = '$qid'");
                                    $rows = mysqli_fetch_assoc($asstitle);
                                    echo '<div class="col-md-12"><p style="font-size: 18px; font-weight: 600;">'.$rows['Title'].'</p></div>';

                                    $getQuiz = mysqli_query($con, "SELECT * FROM std_quiz inner join classroom on std_quiz.Code = classroom.Code
                                    inner join student on std_quiz.Student_ID = student.Student_ID Where Quiz_ID = '$qid'");
                                
                                    if(mysqli_num_rows($getQuiz) > 0){
                                        while ($quiz = mysqli_fetch_assoc($getQuiz)) {
                                            $picture = $quiz['Picture'];
                                            $name = $quiz['Firstname']. " " . $quiz['Lastname'];
                                        ?>
                                
                                
                                        <a href="std_quiz_answer.php?student_id=<?=$quiz['Student_ID']?>&quiz_id=<?=$qid?>" style="cursor: pointer;">
                                            <div class="col-md-4" style="line-height: 30px">
                                                <div class="cards text-center" style="background: #fff; margin-top: 10px; padding: .5rem 1rem 1rem 1rem">
                                                    <img src="../../assets/upload/<?=$picture?>" width="30" class="img-circle">
                                                    <p style="font-size: 13px; font-weight: 500;"><?=$name?></p>

                                                    <div class="answer" style="border: 1px solid #7F7F7F; border-radius: 10px; background-color: #d9d9d9;">
                                                        <p><?=$quiz['Files']?></p>
                                                    </div>
                                                
                                                </div>
                                            </div>
                                        </a>
                                    
                                   
                                
                            <?php }

                            }else{
                                
                            }
                            
                            ?>
                        </div>
     
                    </div>
                            
    </div>       
    </section>

</div>

<?php include_once('../footer.php');?>


<script>

$(document).ready(function(){
    $('.start').click(function() {
        var qid = $(this).attr('id');

        $.ajax({
            url: "../../staff-model/acceptResponses.php",
            method: "POST",
            data:{
                qid:qid
            },
            success:function(data){
                alert(data);
                location.reload();
            }
        })
    })
})

$(document).ready(function(){
    $('.stop').click(function() {
        var qid = $(this).attr('id');

        $.ajax({
            url: "../../staff-model/stopResponses.php",
            method: "POST",
            data:{
                qid:qid
            },
            success:function(data){
                alert(data);
                location.reload();
            }
        })
    })
})

$(document).ready(function(){
    $('.view').click(function() {
        var qid = $(this).attr('id');

        $.ajax({
            url: "viewQuiz.php",
            method: "POST",
            data:{
                qid:qid
            },
            success:function(data){
                alert(data);
            }
        })
    })
})

$(document).ready(function(){
                // Check/Uncheck ALl
    $('#checkAll').change(function(){
        if($(this).is(':checked')){
            $('input[name="check[]"]').prop('checked',true);
        }else{
            $('input[name="check[]"]').each(function(){
            $(this).prop('checked',false);
    }); 
    }
    });
            // Checkbox click
     $('input[name="check[]"]').click(function(){
        var total_checkboxes = $('input[name="check[]"]').length;
        var total_checkboxes_checked = $('input[name="check[]"]:checked').length;
 
        if(total_checkboxes_checked == total_checkboxes){
                $('#checkAll').prop('checked',true);
            }else{
                $('#checkAll').prop('checked',false);
             }
        });
    });



    $(document).ready(function() {

    $("#instruction").click(function() { //show assignment form and hide post form 
        document.getElementById('instructions').style.display = "block";
        document.getElementById('studentworks').style.display = "none";
    });

    $("#studentwork").click(function() {
        document.getElementById('studentworks').style.display = "block";
        document.getElementById('instructions').style.display = "none";
    });
});

function toggle() {
         var element = document.getElementById("toggleComment");

         if (element.style.display == "block")
             element.style.display = "none";
         else
             element.style.display = "block";
     }

     function answer() {
         var element = document.getElementById("toggleAnswer");

         if (element.style.display == "block")
             element.style.display = "none";
         else
             element.style.display = "block";
     }
 </script>
