<?php include_once('main_head.php');
?>

<div class="assigment-wrapper">
    <form action="assignment.php?class_code=<?=$_GET['class_code']?>" method="Post" enctype="multipart/form-data">
            <label for="">Title:</label>
            <textarea name="title" placeholder="Title" id="title" class="form-group form-control" cols="30" rows="2" style="resize: none;"></textarea>
            
            <label for="">Instructions:</label>
            <textarea name="instruction" id="instruction" placeholder="Instructions[Optional]" class="form-group form-control" cols="30" rows="4" style="resize: none;" ></textarea>

            <input type="file" name="file" id="file" class="form-group form-control">
            <label for="">Due Date:</label>
            <input type="date" name="duedate" id="duedate" class="form-control form-group" >

            <label for="">Time:</label>
            <input type="time" name="time" id="time" class="form-control form-group" >

            <label for="">Points:</label>
            <input type="number" name="points" id="points" class="form-control form-group" >

            <button type="submit" name="assign" id="assign" class="form-control btn btn-success">Assign</button>
    </form>

    <?php

    if (isset($_POST['assign'])) {
        $id = $_SESSION['emp_id'];
        $data = mysqli_query($con, "SELECT * from teacher_tb Where Emp_ID = '$id'");
        $row = mysqli_fetch_assoc($data);
        $tname = $row['Salutation']. ", " . $row['Firstname']. " " .$row['Lastname'];
        $title = mysqli_real_escape_string($con, $_POST['title']);
        $instruction = mysqli_real_escape_string($con, $_POST['instruction']);
        $duedate = mysqli_real_escape_string($con, $_POST['duedate']);
        $time = mysqli_real_escape_string($con, $_POST['time']);
        $points = mysqli_real_escape_string($con, $_POST['points']);
        $code = $_GET['class_code'];

        $class = mysqli_query($con, "SELECT * from classroom WHERE Code = '$code'");
        $rows = mysqli_fetch_assoc($class);
        $classname = $rows['Classname'];

        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileError = $_FILES['file']['error'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
       
        $allowed  = array('jpg', 'jpeg', 'png', 'pdf', 'docx', 'doc', 'xlsx', 'pptx', 'ppt');


        

                if(!$fileName){
                    $sql1 = mysqli_query($con, "INSERT into assignment (Title, Instruction, File, Due, Score, Time, Code) VALUES ('$title', '$instruction', 'None', '$duedate', '$points', '$time', '$code')");
                    if($sql1){
                        $sql = mysqli_query($con, "SELECT * from joinclass Where Code = '$code'");
                        while ($row = mysqli_fetch_assoc($sql)) {
                            $std_id = array($row['Student_ID']);
                            foreach ($std_id as $stud_id) {
                                $std_data = mysqli_query($con, "SELECT Email, Firstname From student Where Student_ID = '$stud_id'");
                                $row1 = mysqli_fetch_array($std_data);
                                $email = $row1['Email'];
                                $firstname = $row1['Firstname'];

                                $subject = "".$title."";
                                $htmlContent = '
                                   <html> 
                                        <body style="margin: 0; padding: 0; font-weight: 300; list-style-type: none; background-color: #d9d9d9;"> 
                                            <div style="padding: 5rem 5rem 5rem 5rem;">
                                                <img src="" width="30px" height="30px">
                                                <p style="color: #5c5c5c; font-size: 20px; font-weight: 400;">Hi, "'.$firstname.'"</p>
                                                <p style="color: #333; font-size: 16px; font-weight: 300;">'.$tname.' posted a new assignment '.$title.' in '.$classname.'</p>
                                                <p style="color: #333; font-size: 16px; font-weight: 300;">"'.$title.'"</p>
                                            </div>
                                        </body> 
                                    </html>
                                ';
                                $headers = "MIME-Version: 1.0" . "\r\n"; 
                                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                                mail($email, $subject, $htmlContent,  $headers);
                                echo "Assignment Posted!";

                        }//endwhile
                    }//end if
                        
                    }
                    
                }   
                else{
                    if (in_array($fileActualExt, $allowed)) {
                        if ($fileError === 0) {
                            if ($fileSize < 1000000000000) {
                                $fileDestination = '../../upload_files/' . $fileName;
                                move_uploaded_file($fileTmpName, $fileDestination); //file uploaded okay

                                $sql1 = mysqli_query($con, "INSERT into assignment (Title, Instruction, File, Due, Score, Time, Code) VALUES ('$title', '$instruction', '$fileName', '$duedate', '$points', '$time', '$code')");
                                if($sql1){

                                    $sql = mysqli_query($con, "SELECT * from joinclass Where Code = '$code'");
                                    while ($row = mysqli_fetch_assoc($sql)) {
                                    $std_id = array($row['Student_ID']);
                                        foreach ($std_id as $stud_id) {
                                            $std_data = mysqli_query($con, "SELECT Email, Firstname From student Where Student_ID = '$stud_id'");
                                            $row1 = mysqli_fetch_array($std_data);
                                            $email = $row1['Email'];
                                            $firstname = $row1['Firstname'];

                                            $subject = "".$title."";
                                            $htmlContent = '
                                               <html> 
                                                    <body style="margin: 0; padding: 0; font-weight: 300; list-style-type: none; background-color: #d9d9d9;"> 
                                                        <div style="padding: 5rem 5rem 5rem 5rem;">
                                                            <img src="" width="30px" height="30px">
                                                            <p style="color: #5c5c5c; font-size: 20px; font-weight: 400;">Hi, "'.$firstname.'"</p>
                                                            <p style="color: #333; font-size: 16px; font-weight: 300;">'.$tname.' posted a new assignment '.$title.' in '.$classname.'</p>
                                                            <p style="color: #333; font-size: 16px; font-weight: 300;">"'.$title.'"</p>
                                                        </div>
                                                    </body> 
                                                </html>
                                            ';
                                            $headers = "MIME-Version: 1.0" . "\r\n"; 
                                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                                            mail($email, $subject, $htmlContent,  $headers);
                                                echo "Assignment Posted!";
                                        }
                                        
                                        
                                    }
                                    
                                    
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


            }

    ?>
</div>