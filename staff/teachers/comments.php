<?php include_once('main_head.php');?>

<div class="comment-wrapper">

<?php 
		$postBy = $_SESSION['emp_id'];
		if (isset($_GET['post_id'])) {
			$post_id = $_GET['post_id'];
		}
        $user = mysqli_query($con, "SELECT * FROM teacher_tb Where Emp_ID = '$postBy'");
        $row1 = mysqli_fetch_assoc($user);
        $name = $row1['Salutation']. ". " .$row1['Firstname']. " " .$row1['Lastname'];
        $picture = $row1['Picture'];

        
        if (isset($_POST['postComment' . $post_id])) {
            
			$post_body = mysqli_escape_string($con,  $_POST['post_body']);
			$insert_post = mysqli_query($con, "INSERT INTO comments (Body, Posted_Name, Image, Post_ID)VALUES ('$post_body', '$name', '$picture', '$post_id')");
	
			
			echo "<p style='font-size: 14px; text-align: center; margin: 0 0 0.5rem 0;'>Comment Posted! </p>";
		}
		?>

        <form action="comments.php?post_id=<?php echo $post_id; ?>" id="comment_form" name="postComment<?php echo $post_id; ?>" method="POST" autocomplete="off">
        <div class="comment">
            <input class="form-control" type="text" name="post_body" placeholder="Add a comment">
            <button type="submit" class="btn" name="postComment<?php echo $post_id; ?>"><i class="fa fa-paper-plane" id="send" aria-hidden="true"></i></button>
        </div>    
        

        </form>
<hr>
        <!-- Load comments -->
        <?php 
		$get_comments = mysqli_query($con, "SELECT * FROM comments WHERE Post_ID ='$post_id' ORDER BY comments.id DESC");
		$count = mysqli_num_rows($get_comments);

		if ($count != 0) {

			while ($comment = mysqli_fetch_array($get_comments)) {
				$id = $comment['ID'];
				$courseCode = $comment['Code'];
				$comment_body = $comment['Body'];
                $date = date("M d h:i a", strtotime($comment['Date_Post']));
                $image = $comment['Image'];
                
				?>
        <div class="comment_section">
           
        
            
                <img src="../../assets/upload/<?=$image?>" class="img-circle left" width="55">               
                <?php echo $comment['Posted_Name']?>
                
                <div class="bodyCom">
                <span style="font-size:12px; color:#ACACAC;"><?=$date?></span> 
                <p style="font-size:14 px;"><?=$comment['Body']?></p>
               
                </div>
        </div>

            <hr>
        <?php

	}
} else {
	echo "<h5 style='text-align: center; margin-bottom:4rem;'>No Comments to Show!</h5>";
}

?>

</div>