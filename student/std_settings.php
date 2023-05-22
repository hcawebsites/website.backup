<?php include_once('../assets/templates/main_head.php'); ?>
<?php include_once('../std-model/std-change-password.php'); ?>
<?php ob_start();?>
<?php include_once('std_header.php'); ?>
<?php include_once('std_sidebar.php'); ?>


<div class="content-wrapper">
  <title>Account Settings | Change Password</title>
  
    <section class="content-header col-md-12">
      <h1><i class="fa fa-lock" aria-hidden="true">
          Student's Account
          <small>Preview</small></i>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Student's Account</a></li>
      </ol>
      <hr>
      <div class="title">
        <h4 class="text-center"><i class="fa fa-lock" aria-hidden="true"> Change Password</i></h4>
      </div>
      <hr>
  </section>

   <section class="content">

<?php
$student_id=$_SESSION["student_id"];

include_once('../database/connection.php');

  $sql="SELECT * FROM student inner join std_account on student.Student_ID = std_account.Student_ID 
  where student.Student_ID='$student_id'";
  $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_assoc($result);
  $image=$row['Picture'];

?>

    <form method="POST" action="" enctype="multipart/form-data">
      <div class="form-row">
        <div class="form-group">
          <label>Student's Fullname:</label>
          <input type="text" name="" class="form-control" readonly value="<?php echo $row['Firstname'], " " , $row['Lastname'];?>"><br><br>

          <label>Username:</label>
          <input type="text" value="<?php echo $row['Username']; ?>" class="form-control" readonly><br>

          <label>Old Password:</label>
          <input type="password" name="oldpass" placeholder="Input Old Password" class="form-control" minlength="6" maxlength="20" ><br>

          <label>New Password:</label>
          <input type="password" name="newpass" placeholder="Input New Password" class="form-control" minlength="6" maxlength="20" required><br>

          <label>Confirm Password:</label>
          <input type="password" name="cpass" placeholder="Confirm Password" class="form-control" minlength="8" maxlength="20" required><br>

          <input type="submit" name="submit" class="btn btn-success form-control" value="Submit">




        </div>
        
      </div>
      

    </form>

                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger text-center">
                            <p><?php echo $_GET['error']; ?></p><button type="button" class="close" data-dismiss="alert" style="margin-top: -3.4%;">&times;</button>
                          </div>
                        <?php endif ?>

                        <?php if(isset($_GET['info'])): ?>
                              <div class="alert alert-success text-center">
                                  <p><?php echo $_GET['info']; ?></p><button type="button" class="close" data-dismiss="alert" style="margin-top: -3.4%;">&times;</button> 
                              </div>
                        <?php endif?>
      
  </section>
      
     
</div>

 <?php include_once 'footer.php'?>

  <div class="row" id="fProfile">

