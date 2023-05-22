<?php include_once('main_head.php');?>


<?php 
		$postBy = $_SESSION['student_id'];
        $user = mysqli_query($con, "SELECT * from student Where Student_ID = '$postBy'");
        $row1 = mysqli_fetch_assoc($user);
        $name = $row1['Firstname']. " " .$row1['Lastname'];
        $picture = $row1['Picture'];
        $type = $_GET['type'];

        if ($type == "quiz") {
        	if (isset($_GET['quiz_id'])) {
			$quiz_id = $_GET['quiz_id'];
			}
	        $classCode = mysqli_query($con, "SELECT *, quiz.Code  FROM quiz inner join classroom on quiz.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID WHERE Quiz_ID ='$quiz_id'");
			    $row = mysqli_fetch_array($classCode);
	            $code = $row['Code'];
	            $reciever = $row['Teacher_ID'];

	        
	        if (isset($_POST['postComment' . $quiz_id])) {
	            
				$post_body = mysqli_escape_string($con,  $_POST['post_body']);
				$insert_post = mysqli_query($con, "INSERT INTO assignment_comments (Body, Code, Name, Student_ID, Teacher_ID, Post_ID, Picture, Status)VALUES ('$post_body','$code', '$name', '$postBy', '$reciever', '$quiz_id', '$picture', '1')");
		
				
				echo "<p style='font-size: 14px; text-align: center; margin: 0 0 0.5rem 0;'>Comment Posted! </p>";
			}
			?>

	        <form action="private_comment.php?quiz_id=<?php echo $quiz_id; ?>&type=<?php echo $type; ?>" id="" name="postComment<?php echo $quiz_id; ?>" method="POST" autocomplete="off">
	        <button style="font-size: 19px; margin-right: 5px; color: #4d5bf9; float: right;" type="submit" class="btn" name="postComment<?php echo $quiz_id; ?>"><i class="fa fa-paper-plane" id="send" aria-hidden="true"></i></button> 
	        <input style="width: 75%;" class="form-control" type="text" name="post_body" placeholder="Add a comment">
	            
	        

	        </form>
	<hr>
	        <!-- Load comments -->
	        <?php 
			$get_comments = mysqli_query($con, "SELECT * FROM assignment_comments WHERE Post_ID ='$quiz_id' AND assignment_comments.Status ='1' And assignment_comments.Student_ID = '$postBy' ORDER BY assignment_comments.id DESC");
			$count = mysqli_num_rows($get_comments);

			if ($count != 0) {

				while ($comment = mysqli_fetch_array($get_comments)) {
					$id = $comment['ID'];
					$courseCode = $comment['Code'];
					$comment_body = $comment['Body'];
	                $date = date("M d h:i a", strtotime($comment['Date_Post']));

	                
	                    echo '<div class="comment_section">
	           
	            
	                    <img src="../assets/upload/'.$comment['Picture'].'" class="img-circle left" width="55">               
	                    '.$comment['Name'].'
	                    
	                    <div class="bodyCom">
	                    <span style="font-size:12px; color:#ACACAC;"><?=$date?></span> 
	                    <p  style="font-size: 12px; color: #7F7F7F;">'.$date.'</p>
	                    <p style="font-size:14 px;">'.$comment_body.'</p>
	                   
	                    </div>
	                    </div>';
					?>

	            <hr>
	        <?php

		}
	} else {
		echo "<h5 style='text-align: center; margin-bottom:4rem;'>No Comments to Show!</h5>";
	}
        }else{

        	if (isset($_GET['ass_id'])) {
			$ass_id = $_GET['ass_id'];
			}
	        $classCode = mysqli_query($con, "SELECT * FROM assignment inner join classroom on assignment.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID WHERE assignment.ID ='$ass_id'");
			    $row = mysqli_fetch_array($classCode);
	            $code = $row['Code'];
	            $reciever = $row['Teacher_ID'];

	        
	        if (isset($_POST['postComment' . $ass_id])) {
	            
				$post_body = mysqli_escape_string($con,  $_POST['post_body']);
				$insert_post = mysqli_query($con, "INSERT INTO assignment_comments (Body, Code, Name, Student_ID, Teacher_ID, Post_ID, Picture, Status)VALUES ('$post_body','$code', '$name', '$postBy', '$reciever', '$ass_id', '$picture', '1')");
		
				
				echo "<p style='font-size: 14px; text-align: center; margin: 0 0 0.5rem 0;'>Comment Posted! </p>";
			}
			?>

	        <form action="private_comment.php?ass_id=<?php echo $ass_id; ?>&type=<?php echo $type; ?>" id="" name="postComment<?php echo $ass_id; ?>" method="POST" autocomplete="off">
	        <button style="font-size: 19px; margin-right: 5px; color: #4d5bf9; float: right;" type="submit" class="btn" name="postComment<?php echo $ass_id; ?>"><i class="fa fa-paper-plane" id="send" aria-hidden="true"></i></button> 
	        <input style="width: 75%;" class="form-control" type="text" name="post_body" placeholder="Add a comment">
	            
	        

	        </form>
	<hr>
	        <!-- Load comments -->
	        <?php 
			$get_comments = mysqli_query($con, "SELECT * FROM assignment_comments WHERE Post_ID ='$ass_id' AND assignment_comments.Status ='1' And assignment_comments.Student_ID = '$postBy' ORDER BY assignment_comments.id DESC");
			$count = mysqli_num_rows($get_comments);

			if ($count != 0) {

				while ($comment = mysqli_fetch_array($get_comments)) {
					$id = $comment['ID'];
					$courseCode = $comment['Code'];
					$comment_body = $comment['Body'];
	                $date = date("M d h:i a", strtotime($comment['Date_Post']));

	                
	                    echo '<div class="comment_section">
	           
	            
	                    <img src="../assets/upload/'.$comment['Picture'].'" class="img-circle left" width="55">               
	                    '.$comment['Name'].'
	                    
	                    <div class="bodyCom">
	                    <span style="font-size:12px; color:#ACACAC;"><?=$date?></span> 
	                    <p  style="font-size: 12px; color: #7F7F7F;">'.$date.'</p>
	                    <p style="font-size:14 px;">'.$comment_body.'</p>
	                   
	                    </div>
	                    </div>';
					?>

	            <hr>
	        <?php

		}
	} else {
		echo "<h5 style='text-align: center; margin-bottom:4rem;'>No Comments to Show!</h5>";
	}

        }
		

?>


