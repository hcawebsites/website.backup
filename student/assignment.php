<?php include_once('main_head.php');?>
<?php include_once('std_header.php'); ?>
<?php include_once('std_sidebar.php'); ?>

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

            $sql = mysqli_query($con, "SELECT * from classroom inner join assignment on classroom.Code = assignment.Code inner join schedule on classroom.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID WHERE assignment.ID = '$ass_id'");
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
                                    $ass_data = mysqli_query($con, "SELECT * from assignment inner join classroom on assignment.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID Where assignment.ID = '$ass_id'");
                                    while ($row1 = mysqli_fetch_assoc($ass_data)) {
                                        $date = date("M d, Y", strtotime($row1['Date_Created']));
                                        $due = date("M d, Y", strtotime($row1['Due']));
                                        $time = date("h:m A", strtotime($row1['Time']));
                                        $duedate = $due." ".$time;
                                        echo '<div style="line-height: 15px; margin-top: 5px">
                                            <p style="float: right; font-size: 16px; font-weight: 500;">'.$row1['Score'].' points</p>
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
                            $ass_data = mysqli_query($con, "SELECT * from assignment inner join classroom on assignment.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID Where assignment.ID = '$ass_id'");
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
                            <iframe src='../student/comment_assignment.php?ass_id=<?=$ass_id?>' id='comment_iframe' frameborder='0' ></iframe>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="cards" style="background: #fff; margin-top: 10px; margin-right: 50px; padding: .5rem 1rem 1rem 1rem">
                                <?php 
                                $myID = $_SESSION['student_id'];
                                $query = mysqli_query($con, "SELECT * from std_assign Where Student_ID = '$myID' And Ass_ID = '$ass_id'");
                                if(mysqli_num_rows($query) > 0){
                                    $row = mysqli_fetch_assoc($query);

                                    if ($row['Score'] == "0") {
                                        echo '
                                        <div class="title">
                                        <p style="font-size: 14px; float: right; margin-top: 5px; color: green;">Submitted</p>
                                        
                                        <p style="font-size: 20px; font-weight: 600;">Your Work</p>
                                        
                                        </div>
                                        <div style="border: 1px solid #4d5bf9;"></div>
                                            <div class="pass" style="margin-top: 10px;">

                                            <div style=" border-radius: 10px; background-color: #d9d9d9; font-size: 18px; padding: .5rem .5rem .5rem .5rem; display: flex; justify-content: center; align-item: center; margin-bottom: 10px; border: 1px solid">
                                            <a style=""href="../assignment/'.$row['Answer'].'">'.$row['Answer'].'</a>
                                            </div>

                                            <button data-toggle="modal" data-target="#unsubmit" style="color:#333; background-color: #ED696B; font-size: 14px; font-weight: 500;" type="submit" class="form-group form-control btn">Unsubmit</button>
                                            </div>
                                        ';
                                    }else{
                                        echo '
                                    <div class="title">
                                    <p style="font-size: 14px; float: right; margin-top: 5px; color: green;">Score: '.$row['Score'].'</p>
                                    
                                    <p style="font-size: 20px; font-weight: 600;">Your Work</p>
                                    
                                    </div>
                                    <div style="border: 1px solid #4d5bf9;"></div>
                                        <div class="pass" style="margin-top: 10px;">

                                        <div style=" border-radius: 10px; background-color: #d9d9d9; font-size: 18px; padding: .5rem .5rem .5rem .5rem; display: flex; justify-content: center; align-item: center; margin-bottom: 10px; border: 1px solid">
                                        <a style=""href="../assignment/'.$row['Answer'].'">'.$row['Answer'].'</a>
                                        </div>
                                        </div>
                                    ';
                                    }
                                    
                                }else{
                                    echo '
                                    <div class="title">
                                    <p style="font-size: 14px; float: right; margin-top: 5px; color: green;">Assigned</p>
                                    
                                    <p style="font-size: 20px; font-weight: 600;">Your Work</p>
                                    
                                    </div>
                                    <div style="border: 1px solid #4d5bf9;"></div>
                                    <form action="assignment.php?ass_id='.$ass_id.'" method="POST" enctype="multipart/form-data">
                                        <div class="pass" style="margin-top: 10px;">
                                        <input type="file" name="file" id="file" class="form-group form-control">
                                        <button style="background-color:#4d5bf9; color:#fff; font-size: 14px; font-weight: 500;" type="submit" name="submit" id="submit" class="form-group form-control btn">Submit</button>
                                        </div>
                                    </form>
                                    ';
                                }
                                ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <?php
                        $sql1 = mysqli_query($con, "SELECT count(*) From assignment_comments WHERE Post_ID = '$ass_id' AND Status = 1 AND Student_ID = '$myID'");
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
                            
                        <iframe src='../student/private_comment.php?ass_id=<?=$ass_id?>&type="assignment"' id='comment_iframe' width="100%" height="250px" frameborder='0' ></iframe>
                        </div>
                
                    </div>
                </div>
        </div>

               
       
    </section>

</div>

<!--Modal Unsubmit-->
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
        <form action="assignment.php?ass_id=<?=$ass_id?>" method="POST">
        <button type="submit" name="unsubmit" class="btn btn-primary">Unsubmit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php include_once('footer.php'); 
//submit assignment
if(isset($_POST['submit'])){

    $ass_id = $_GET['ass_id'];
    $data_code = mysqli_query($con, "SELECT * from assignment Where ID = '$ass_id'");
    $code = mysqli_fetch_assoc($data_code);
    $classCode = $code['Code'];
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

            $sql = mysqli_query($con, "INSERT into std_assign (Code, Ass_ID, Student_ID, Answer) VALUES ('$classCode', '$ass_id', '$myID', '$fileName')");
            if($sql){
               echo '<script>
                    alert("Assignment Submitted!");
                    window.location.href="assignment.php?ass_id='.$ass_id.'"
               </script>';
            }
        } else {
            echo "your file is too big";
        }
    } else {
        echo "Error uploading your file!  ";
    }
} else {
    echo "You can't upload file of this";
}
}

//submit assignment

if(isset($_POST['unsubmit'])){
    $myID = $_SESSION['student_id'];

    $unsubmit = mysqli_query($con, "DELETE from std_assign WHERE student_ID = '$myID' And Ass_ID = '$ass_id'");

    if($unsubmit){
        echo '<script>
        alert("Assignment Unsubmitted!");
        window.location.href="assignment.php?ass_id='.$ass_id.'"
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
