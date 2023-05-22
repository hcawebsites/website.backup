<?php include_once('main_head.php');?>

<div class="comment-wrapper">

<?php 
		$postBy = $_SESSION['teacher_id'];
        $user = mysqli_query($con, "SELECT * from teacher_tb Where Emp_id = '$postBy'");
        $row1 = mysqli_fetch_assoc($user);
        $name = $row1['Firstname']. " " .$row1['Lastname'];
        $picture = $row1['Picture'];
        $type = $_GET['type'];

        if ($type == "quiz") {
        	if (isset($_GET['quiz_id'])) {
			$quiz_id = $_GET['quiz_id'];
		}
        $classCode = mysqli_query($con, "SELECT Code FROM quiz WHERE Quiz_ID='$quiz_id'");
		    $row = mysqli_fetch_array($classCode);
            $code = $row['Code'];

        
        if (isset($_POST['postComment' . $quiz_id])) {
            
			$post_body = mysqli_escape_string($con,  $_POST['post_body']);
			$insert_post = mysqli_query($con, "INSERT INTO assignment_comments (Body, Code, Name, Post_ID, Picture, Status)VALUES ('$post_body', '$code', '$name', '$quiz_id', '$picture', '0')");
	
			
			echo "<p style='font-size: 14px; text-align: center; margin: 0 0 0.5rem 0;'>Comment Posted! </p>";
		}
		?>

        <form action="comment_assignment.php?quiz_id=<?php echo $quiz_id; ?>&type=<?php echo $type; ?>" id="comment_form" name="postComment<?php echo $quiz_id; ?>" method="POST" autocomplete="off">
        <div class="comment">
            <input class="fomr-control" type="text" name="post_body" placeholder="Add a comment">
            <button type="submit" class="btn" name="postComment<?php echo $quiz_id; ?>"><i class="fa fa-paper-plane" id="send" aria-hidden="true"></i></button>
        </div>    
        

        </form>
		<hr>
		<!-- Load comments -->
		<?php 
		$get_comments = mysqli_query($con, "SELECT * FROM assignment_comments WHERE Post_ID ='$quiz_id' AND Status = '0' ORDER BY assignment_comments.id DESC");
		$count = mysqli_num_rows($get_comments);

		if ($count != 0) {

			while ($comment = mysqli_fetch_array($get_comments)) {
				$id = $comment['ID'];
				$courseCode = $comment['Code'];
				$comment_body = $comment['Body'];
		        $date = date("M d h:i a", strtotime($comment['Date_Post']));
		        
				?>
		<div class="comment_section">
		   
		    
		        <img src="../../assets/upload/<?=$comment['Picture']?>" class="img-circle left" width="55">               
		        <?php echo $comment['Name']?>
		        
		        <div class="bodyCom">
		        <span style="font-size:12px; color:#ACACAC;"><?=$date?></span> 
		        <p style="font-size:14 px;"><?=$comment_body?></p>
		        </div>
		</div>

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
        $classCode = mysqli_query($con, "SELECT Code FROM assignment WHERE ID='$ass_id'");
		    $row = mysqli_fetch_array($classCode);
            $code = $row['Code'];

        
        if (isset($_POST['postComment' . $ass_id])) {
            
			$post_body = mysqli_escape_string($con,  $_POST['post_body']);
			$insert_post = mysqli_query($con, "INSERT INTO assignment_comments (Body, Code, Name, Post_ID, Picture, Status)VALUES ('$post_body', '$code', '$name', '$ass_id', '$picture', '0')");
	
			
			echo "<p style='font-size: 14px; text-align: center; margin: 0 0 0.5rem 0;'>Comment Posted! </p>";
		}
		?>

        <form action="comment_assignment.php?ass_id=<?php echo $ass_id; ?>&type=<?php echo $type; ?>" id="comment_form" name="postComment<?php echo $ass_id; ?>" method="POST" autocomplete="off">
        <div class="comment">
            <input class="fomr-control" type="text" name="post_body" placeholder="Add a comment">
            <button type="submit" class="btn" name="postComment<?php echo $ass_id; ?>"><i class="fa fa-paper-plane" id="send" aria-hidden="true"></i></button>
        </div>    
        

        </form>
<hr>
        <!-- Load comments -->
        <?php 
		$get_comments = mysqli_query($con, "SELECT * FROM assignment_comments WHERE Post_ID ='$ass_id' AND Status = '0' ORDER BY assignment_comments.id DESC");
		$count = mysqli_num_rows($get_comments);

		if ($count != 0) {

			while ($comment = mysqli_fetch_array($get_comments)) {
				$id = $comment['ID'];
				$courseCode = $comment['Code'];
				$comment_body = $comment['Body'];
                $date = date("M d h:i a", strtotime($comment['Date_Post']));
                
				?>
        <div class="comment_section">
           
            
                <img src="../../assets/upload/<?=$comment['Picture']?>" class="img-circle left" width="55">               
                <?php echo $comment['Name']?>
                
                <div class="bodyCom">
                <span style="font-size:12px; color:#ACACAC;"><?=$date?></span> 
                <p style="font-size:14 px;"><?=$comment_body?></p>
                </div>
        </div>

            <hr>
        <?php

	}
} else {
	echo "<h5 style='text-align: center; margin-bottom:4rem;'>No Comments to Show!</h5>";
}

        }
		

?>

</div>