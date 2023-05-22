<?php
date_default_timezone_set('Singapore');
class POST{

		private $con;
		private $code;
		public $fileDestination;

    public function __construct($con, $id, $code)
		{
			$this->con = $con;
			$this->id = $id;
			$this->code = $code;
		}
    
    public function loadpost(){
        $str = ""; 
		$data_query = mysqli_query($this->con, "SELECT *, posts.ID as id FROM posts inner join classroom on posts.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID WHERE posts.Code='$this->code' And Teacher_ID = '$this->id' ORDER BY posts.id DESC");

        if(mysqli_num_rows($data_query) > 0){
            while ($row = mysqli_fetch_array($data_query)) {
                $id = $row['id'];
                $body = $row['Body'];
                $added_by = $row['Post_By'];
                $date_time = $row['Date_Post'];
                $newdate = date("Y-m-d h:i:s", strtotime($date_time));
                $newdate1 = date("h:i a", strtotime($date_time));
                $image = $row['Picture'];
                $file = $row['Files'];
			    $path = $row['Destination'];

                	//Timeframe
                    date_default_timezone_set('Singapore');
                    $date_time_now = date("Y-m-d h:i:s");
                    $start_date = new DateTime($newdate); //Time of post
                    $end_date = new DateTime($date_time_now); //Current time
                    $interval = $start_date->diff($end_date); //Difference between dates 
                    if ($interval->y >= 1) {
                        if ($interval == 1)
                            $time_message = $interval->y . " year ago"; //1 year ago
                        else
                            $time_message = $interval->y . " years ago"; //1+ year ago
                    } else if ($interval->m >= 1) {
                        if ($interval->d == 0) {
                            $days = " ago";
                        } else if ($interval->d == 1) {
                            $days = $interval->d . " day ago";
                        } else {
                            $days = $interval->d . " days ago";
                        }


                        if ($interval->m == 1) {
                            $time_message = $interval->m . " month" . $days;
                        } else {
                            $time_message = $interval->m . " months" . $days;
                        }
                    } else if ($interval->d >= 1) {
                        if ($interval->d == 1) {
                            $time_message = "Yesterday";
                        } else {
                            $time_message = $interval->d . " days ago";
                        }
                    } else if ($interval->h >= 1) {
                        if ($interval->h == 1) {
                            $time_message = $interval->h . " hour ago";
                        } else {
                            $time_message = $interval->h . " hours ago";
                        }
                    } else if ($interval->i >= 1) {
                        if ($interval->i == 1) {
                            $time_message = $interval->i . " minute ago";
                        } else {
                            $time_message = $interval->i . " minutes ago";
                        }
                    } else {
                        if ($interval->s < 30) {
                            $time_message = "Just now";
                        } else {
                            $time_message = $interval->s . " seconds ago";
                        }
                    }

                    $comments_check = mysqli_query($this->con, "SELECT * FROM comments WHERE Post_ID='$id'");
	                $comments_check_num = mysqli_num_rows($comments_check);
                    ?>
                    <script>
                        function toggle<?php echo $id; ?>() {
                            var element = document.getElementById("toggleComment<?php echo $id; ?>");

                            if (element.style.display == "block")
                                element.style.display = "none";
                            else
                                element.style.display = "block";
                        }
                    </script>
                    <?php
                    
                    if($row['Files'] == 'None'){
                       
                        $str .="
                        <div class='cards' style='background: #fff; margin-top: 10px; margin-left: -50px; margin-right: 50px; padding: .5rem 1rem 1rem 1rem'>
                        
                            <div class='post_profile_pic'>
                                <img src='../../assets/upload/".$image."' width='50'>
                                
                                ".$row['Salutation'].". ".$row['Firstname']." ".$row['Lastname']."
                                <span style='font-size:12px; color:#ACACAC; float: right;''> ".$time_message." </span> 

                                <br><br><p>".$row['Body']."</p>
                                
                            </div>
                            <hr>
                            <div class='commentOption' onClick='javascript:toggle$id()'> 
                            <p>Comments - $comments_check_num</p>
                          </div>
                           <div class='post_comment' id='toggleComment$id' style='display:none;'>
                             <iframe src='../../staff/teachers/comments.php?post_id=$id' id='comment_iframe' frameborder='0' ></iframe>
                     
                             </div>
                            
                            



                            
                            
                            
                        
                        </div>
                    
                    
                    
                    ";
                    }else{
                        $res = str_replace("../upload_files/", "", $path);
                        $downloadFile = "<div id='downloadFile'>
							<a href ='../../upload_files/".$path."' title='Click Here To Download'>$res</a>
						</div>";

                        $str .="
                        <div class='cards' style='background: #fff; margin-top: 10px; margin-left: -50px; margin-right: 50px; padding: .5rem 1rem 1rem 1rem'>
                        
                            <div class='post_profile_pic'>
                                <img src='../../assets/upload/".$image."' width='50'>
                                
                                ".$row['Salutation'].". ".$row['Firstname']." ".$row['Lastname']."
                                <span style='font-size:12px; color:#ACACAC; float: right;''> ".$time_message." </span> 

                                <br><br><p>".$row['Body']."</p>
                                <p style='border: 1px solid black;'>$downloadFile</p>
                                
                            </div>
                            <hr>
                            <div class='commentOption' onClick='javascript:toggle$id()'> 
                            <p>Comments - $comments_check_num</p>
                          </div>
                           <div class='post_comment' id='toggleComment$id' style='display:none;'>
                             <iframe src='../../staff/teachers/comments.php?post_id=$id' id='comment_iframe' frameborder='0' ></iframe>
                     
                             </div>
                            
                            



                            
                            
                            
                        
                        </div>
                    
                    
                    
                    ";
                    }

            }//end of while loop

            echo $str;
        }
       
    }


    public function viewAssignment(){

        $str = "";
        $data_ass = mysqli_query($this->con, "SELECT *, assignment.ID as ID from assignment inner join classroom on assignment.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID Where assignment.Code = '$this->code'");
        if(mysqli_num_rows($data_ass) > 0){

            while($row = mysqli_fetch_assoc($data_ass)){
                $id = $row['ID'];

                $str .= "<div class='cards' style='background: #fff; margin-top: 10px; margin-left: -50px; margin-right: 50px; padding: .5rem 1rem 1rem 1rem'>
                <a href='../../staff/teachers/std_assignment.php?ass_id=".$id."' style='display: flex; cursor:pointer;'>
                <i class='fa fa-file-text' aria-hidden='true' style='font-size: 20px; border-radius: 100%; color: white; background-color: #4d5bf9; padding: 1rem 1rem 1rem 1rem'></i>
                <span style='margin-left: 10px; margin-top: 9px; font-size: 16px; font-weight: 500;'>".$row['Firstname']. " ".$row['Lastname']." posted new assignment: ".$row['Title']."</span>
                </a>
                
                </div>";
            }//end of while loop
            
            echo $str;

        }else{
           
        }

    }

        public function viewQuiz(){

        $str = "";
        $data_ass = mysqli_query($this->con, "SELECT *, quiz.Quiz_ID as id FROM quiz inner join classroom on quiz.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID  Where quiz.Code = '$this->code'");
        if(mysqli_num_rows($data_ass) > 0){

            while($row = mysqli_fetch_assoc($data_ass)){
                $id = $row['id'];

                $str .= "<div class='cards' style='background: #fff; margin-top: 10px; margin-left: -50px; margin-right: 50px; padding: .5rem 1rem 1rem 1rem'>
                <a href='../../staff/teachers/std_quiz.php?quiz_id=".$id."' style='display: flex; cursor:pointer;'>
                <i class='fa fa-file-text' aria-hidden='true' style='font-size: 20px; border-radius: 100%; color: white; background-color: #4d5bf9; padding: 1rem 1rem 1rem 1rem'></i>
                <span style='margin-left: 10px; margin-top: 9px; font-size: 16px; font-weight: 500;'>".$row['Firstname']. " ".$row['Lastname']." posted new assignment: ".$row['Title']."</span>
                </a>
                
                </div>";
            }//end of while loop
            
            echo $str;

        }else{
           
        }

    }


    public function classAssign(){
        $str = "";
        $data_ass = mysqli_query($this->con, "SELECT *, assignment.ID as ID from assignment inner join classroom on assignment.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID  Where assignment.Code = '$this->code' And Teacher_ID = '$this->id'");
        if(mysqli_num_rows($data_ass) > 0){
           
            while($row = mysqli_fetch_assoc($data_ass)){
                $id = $row['ID'];

                $str .= "<div class='cards' style='background: #fff; margin-top: 10px; margin-left: -50px; margin-right: 50px; padding: .5rem 1rem 1rem 1rem'>
                <a href='../student/assignment.php?ass_id=".$id. "' style='display: flex; cursor:pointer;'>
                <i class='fa fa-file-text' aria-hidden='true' style='font-size: 20px; border-radius: 100%; color: white; background-color: #4d5bf9; padding: 1rem 1rem 1rem 1rem'></i>
                <span style='margin-left: 10px; margin-top: 9px; font-size: 16px; font-weight: 500;'>".$row['Salutation']. ". ".$row['Lastname']." posted new assignment: ".$row['Title']."</span>
                </a>
                
                </div>";
            }//end of while loop
            
            echo $str;
        }

        
    }

    public function classQuiz(){
        $str = "";
        $data_ass = mysqli_query($this->con, "SELECT * from quiz inner join classroom on quiz.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID  Where quiz.Code = '$this->code'");
        if(mysqli_num_rows($data_ass) > 0){
           
            while($row = mysqli_fetch_assoc($data_ass)){
                $id = $row['Quiz_ID'];
                $time = $row['Time_Limit'];
                $total = $row['Questions'];

                $str .= "<div class='cards' style='background: #fff; margin-top: 10px; margin-left: -50px; margin-right: 50px; padding: .5rem 1rem 1rem 1rem'>
                <a href='../student/quiz.php?quizID=".$id."' style='display: flex; cursor:pointer;'>
                <i class='fa fa-file-text' aria-hidden='true' style='font-size: 20px; border-radius: 100%; color: white; background-color: #4d5bf9; padding: 1rem 1rem 1rem 1rem'></i>
                <span style='margin-left: 10px; margin-top: 9px; font-size: 16px; font-weight: 500;'>".$row['Salutation']. ". ".$row['Lastname']." posted new assignment: ".$row['Title']."</span>
                </a>
                
                </div>";
            }//end of while loop
            
            echo $str;
        }

        
    }

    public function classStudent(){
        $str = ""; 
		$data_query = mysqli_query($this->con, "SELECT *, posts.ID as id FROM posts inner join classroom on posts.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID WHERE posts.Code='$this->code' AND schedule.Teacher_ID = '$this->id'   ORDER BY posts.id DESC");

        if(mysqli_num_rows($data_query) > 0){
            while ($row = mysqli_fetch_array($data_query)) {
                $id = $row['id'];
                $body = $row['Body'];
                $added_by = $row['Post_By'];
                $date_time = $row['Date_Post'];
                $newdate = date("Y-m-d h:i:s", strtotime($date_time));
                $newdate1 = date("h:i a", strtotime($date_time));
                $image = $row['Picture'];
                $file = $row['Files'];
			    $path = $row['Destination'];

                	//Timeframe
                    date_default_timezone_set('Singapore');
                    $date_time_now = date("Y-m-d h:i:s");
                    $start_date = new DateTime($newdate); //Time of post
                    $end_date = new DateTime($date_time_now); //Current time
                    $interval = $start_date->diff($end_date); //Difference between dates 
                    if ($interval->y >= 1) {
                        if ($interval == 1)
                            $time_message = $interval->y . " year ago"; //1 year ago
                        else
                            $time_message = $interval->y . " years ago"; //1+ year ago
                    } else if ($interval->m >= 1) {
                        if ($interval->d == 0) {
                            $days = " ago";
                        } else if ($interval->d == 1) {
                            $days = $interval->d . " day ago";
                        } else {
                            $days = $interval->d . " days ago";
                        }


                        if ($interval->m == 1) {
                            $time_message = $interval->m . " month" . $days;
                        } else {
                            $time_message = $interval->m . " months" . $days;
                        }
                    } else if ($interval->d >= 1) {
                        if ($interval->d == 1) {
                            $time_message = "Yesterday";
                        } else {
                            $time_message = $interval->d . " days ago";
                        }
                    } else if ($interval->h >= 1) {
                        if ($interval->h == 1) {
                            $time_message = $interval->h . " hour ago";
                        } else {
                            $time_message = $interval->h . " hours ago";
                        }
                    } else if ($interval->i >= 1) {
                        if ($interval->i == 1) {
                            $time_message = $interval->i . " minute ago";
                        } else {
                            $time_message = $interval->i . " minutes ago";
                        }
                    } else {
                        if ($interval->s < 30) {
                            $time_message = "Just now";
                        } else {
                            $time_message = $interval->s . " seconds ago";
                        }
                    }

                    $comments_check = mysqli_query($this->con, "SELECT * FROM comments WHERE Post_ID='$id'");
	                $comments_check_num = mysqli_num_rows($comments_check);
                    if($row['Files'] == 'None'){
                        $str .="
                        <div class='col-md-4'></div>
                        <div class='cards' style='background: #fff; margin-top: 10px; margin-left: -50px; margin-right: 50px; padding: .5rem 1rem 1rem 1rem'>
                        
                            <div class='post_profile_pic'>
                                <img src='../assets/upload/".$image."' width='50'>
                                
                                ".$row['Salutation'].". ".$row['Firstname']." ".$row['Lastname']."
                                <span style='font-size:12px; color:#ACACAC; float: right;''> ".$time_message." </span> 

                                <br><br><p>".$row['Body']."</p>
                                
                            </div>
                            <hr>
                            <div class='commentOption' onClick='javascript:toggle$id()'> 
                                <p>Comments - $comments_check_num</p>
                            </div>
                            <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                <iframe src='../student/comments.php?post_id=$id' id='comment_iframe' frameborder='0' ></iframe>
                            </div>
                            
                            



                            
                            
                            
                        
                        </div>
                    
                    
                    
                    ";
                    }else{
                        $res = str_replace("../upload_files/", "", $path);
                        $downloadFile = "<div id='downloadFile'>
							<a href ='../upload_files/".$path."' title='Click Here To Download'>$res</a>
						</div>";

                        $str .="
                        <div class='cards' style='background: #fff; margin-top: 10px; margin-left: -50px; margin-right: 50px; padding: .5rem 1rem 1rem 1rem'>
                        
                            <div class='post_profile_pic'>
                                <img src='../assets/upload/".$image."' width='50'>
                                
                                ".$row['Salutation'].". ".$row['Firstname']." ".$row['Lastname']."
                                <span style='font-size:12px; color:#ACACAC; float: right;''> ".$time_message." </span> 

                                <br><br><p>".$row['Body']."</p>
                                <p style='border: 1px solid black;'>$downloadFile</p>
                                
                            </div>
                            <hr>
                            <div class='commentOption' onClick='javascript:toggle$id()'> 
                            <p>Comments - $comments_check_num</p>
                          </div>
                           <div class='post_comment' id='toggleComment$id' style='display:none;'>
                             <iframe src='../student/comments.php?post_id=$id' id='comment_iframe' frameborder='0' ></iframe>
                     
                             </div>
                            
                            



                            
                            
                            
                        
                        </div>
                    
                    
                    
                    ";
                    }

?>
 <script>
     function toggle<?php echo $id; ?>() {
         var element = document.getElementById("toggleComment<?php echo $id; ?>");

         if (element.style.display == "block")
             element.style.display = "none";
         else
             element.style.display = "block";
     }
 </script>
 <?php

            }//end of while loop

            echo $str;
        }
       
    }
}





?>

<script>
$(document).ready(function(){  
	$('#send').click(function(e){
		e.preventDefault();

		$.ajax({
       
	   	url: '../std-model/comment.php',
	   	data: $('#comments').serialize(),
	   	method: 'POST',
	   	error: function(data) {
		 
		 	alert("some Error");
	   	},
	   	success: function(data) {
		 
		 alert("success");
		 location.reload();
	   }

	 
	});

	});

 })
 </script>