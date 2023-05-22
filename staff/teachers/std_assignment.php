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
            $ass_id = $_GET['ass_id'];

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
                                    $ass_data = mysqli_query($con, "SELECT * from assignment inner join classroom on assignment.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID Where assignment.ID = '$ass_id'");
                                    while ($row1 = mysqli_fetch_assoc($ass_data)) {
                                        $date = date("M d, Y", strtotime($row1['Date_Created']));
                                        $due = date("M d, Y", strtotime($row1['Due']));
                                        $time = date("h:m A", strtotime($row1['Time']));
                                        $duedate = $due." ".$time;
                                        echo '<div style="line-height: 15px; margin-top: 5px">
                                        
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
                            $ass_data = mysqli_query($con, "SELECT * from assignment inner join classroom on assignment.Code = classroom.Code Where assignment.ID = '$ass_id'");
                            while ($data1 = mysqli_fetch_assoc($ass_data)) {
                                if($data1['File'] == "None"){
                                    echo '
                                    <div style="margin-top: 10px;">
                                    <textarea readonly class="form-group form-control" cols="30" rows="10" style="resize: none;" required>'.$data1['Instruction'].'</textarea>
                                    
                                    </div>
                                    ';
                                }else{
                                    echo '
                                    <div style="margin-top: 10px; margin-bottom:20px;">
                                    <h4>'.$data1['Instruction'].'</h4>
                                    
                                        <div style="background-color:#D9D9D9; border-radius: 10px; border: 1px solid;  padding:1rem 1rem 1rem 1rem; cursor:pointer;">
                                        <a style="font-size: 18px;" href="../upload_files/'.$data1['File'].'">'.$data1['File'].'</a>
                                        </div>
                                    
                                    </div>
                                    
                                    ';
                                }
                            }
                        ?>

                       

                        <?php
                            $sql1 = mysqli_query($con, "SELECT count(*) From assignment_comments WHERE Post_ID = '$ass_id' AND Status = 0");
                            $rows = mysqli_fetch_assoc($sql1);
                        ?>
                        <div style="border: 1px solid #4d5bf9;"></div>
                        <div class='commentOption' onClick='javascript:toggle()'> 
                            <p>Class comments - <?=$rows['count(*)']?></p>
                        </div>
                        <div class='post_comment' id='toggleComment' style='display:none;'>
                            <iframe src='../../staff/teachers/comment_assignment.php?ass_id=<?=$ass_id?>&type=assignment' id='comment_iframe' frameborder='0' ></iframe>
                        </div>

                    </div>
                </div>



                <div id="studentworks">
                    <div class="col-md-5">
                        <div class="cards" style="background: #fff; margin-top: 10px; margin-left: 50px; padding: .5rem 1rem 1rem 1rem">
                            

                            <form action="../../staff-model/return_score.php?ass_id=<?=$ass_id?>" method="POST">
                            <button type="submit" name="return" class="btn btn-success form-control">Return Scores</button>
                            <hr>

                            <input type="checkbox" name="all" id="checkAll"  style="cursor: pointer;">&nbsp
                            <label for="" style="font-size: 16px;">All Students</label><br>
                            
                                <?php
                                $getAssign = mysqli_query($con, "SELECT *, assignment.Score as score, std_assign.Score as std_score FROM std_assign inner join classroom on std_assign.Code = classroom.Code
                                inner join student on std_assign.Student_ID = student.Student_ID inner join assignment on std_assign.Ass_ID = assignment. ID Where Ass_ID = '$ass_id'");
                                if(mysqli_num_rows($getAssign) > 0){
                                    while ($assign = mysqli_fetch_assoc($getAssign)) {
                                        $picture = $assign['Picture'];
                                        $name = $assign['Firstname']. " " . $assign['Lastname'];
                                        ?>
                                
                                        <hr>
                                       <div style="cursor: pointer; background-color: #d9d9d9; border-top: 1px solid #737373;  border-bottom: 1px solid #737373; padding: 1rem 1rem 1rem 1rem;">
                                        
                                       <div class="row">
                                            <div class="col-md-8" style="border-right: 1px solid #737373;">
                                                <input type="checkbox" name="check[]" value="<?=$assign['Student_ID']?>" id="check" style="margin-right: 10px; cursor: pointer;">
                                                <img src="../../assets/upload/<?=$picture?>" width="30" class="img-circle">
                                                <span><?=$name?></span>
                                            </div>

                                            <div class="col-md-4 score">
                                                <?php 
                                                    if ($assign['std_score'] ==  0) {
                                                       echo '<input type="text" name="score_'.$assign['Student_ID'].'" require id="score" > - <span style="font-weight: 600">'.$assign['score'].'</span>';
                                                    }else{
                                                        echo '<input type="text" name="score_'.$assign['Student_ID'].'" require id="score" value="'.$assign['std_score'].'" disabled> - <span style="font-weight: 600">'.$assign['score'].'</span>';
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
                                    $asstitle = mysqli_query($con, "SELECT * from assignment Where ID = '$ass_id'");
                                    $rows = mysqli_fetch_assoc($asstitle);
                                    echo '<div class="col-md-12"><p style="font-size: 18px; font-weight: 600;">'.$rows['Title'].'</p></div>';

                                    $getAssign = mysqli_query($con, "SELECT * FROM std_assign inner join classroom on std_assign.Code = classroom.Code inner join student on std_assign.Student_ID = student.Student_ID Where Ass_ID = '$ass_id'");
                                
                                    if(mysqli_num_rows($getAssign) > 0){
                                        echo '<div class="col-md-12"><p style="font-size: 16px; font-weight: 500;">Students Submitted - 0</p></div>';
                                        while ($assign = mysqli_fetch_assoc($getAssign)) {
                                            $picture = $assign['Picture'];
                                            $name = $assign['Firstname']. " " . $assign['Lastname'];
                                        ?>
                                
                                
                                        <a href="std_answer.php?student_id=<?=$assign['Student_ID']?>" style="cursor: pointer;">
                                            <div class="col-md-4" style="line-height: 30px">
                                                <div class="cards text-center" style="background: #fff; margin-top: 10px; padding: .5rem 1rem 1rem 1rem">
                                                    <img src="../../assets/upload/<?=$picture?>" width="30" class="img-circle">
                                                    <p style="font-size: 13px; font-weight: 500;"><?=$name?></p>

                                                    <div class="answer" style="border: 1px solid #7F7F7F; border-radius: 10px; background-color: #d9d9d9;">
                                                        <p><?=$assign['Answer']?></p>
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
