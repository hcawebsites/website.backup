<?php include_once ('main_head.php');
      ob_start();
      include_once ('header.php');
      include_once ('sidebar.php');
      ?>

<div class="content-wrapper">
  <title>Account Settings | Change Password</title>
  
    <section class="content-header col-md-12">
      <h1><i class="fa fa-lock" aria-hidden="true">
          Applicant's Account
          <small>Preview</small></i>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Applicant's Account</a></li>
      </ol>
      <hr>
      <div class="title">
        <h4 class="text-center"><i class="fa fa-lock" aria-hidden="true"> Change Password</i></h4>
      </div>
      <hr>
  </section>

   <section class="content">

<?php
$myID = $_SESSION["username"];

include_once('../database/connection.php');

  $sql="SELECT * FROM std_account where Student_ID = '$myID'";
  $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_assoc($result);

?>

    <form method="POST" action="settings_model.php" enctype="multipart/form-data">
      <div class="form-row">
        <div class="form-group">
          <label>Applicant's Fullname:</label>
          <input type="text" name="" class="form-control" readonly value="<?php echo $row['Firstname'], " " , $row['Lastname'];?>"><br><br>

          <label>Username:</label>
          <input type="text" value= "<?php echo $row['Student_ID'];?>" class="form-control" readonly><br>
          <input type="hidden" name="myID" value= "<?php echo $myID;?>" class="form-control" readonly><br>
          <label>Old Password:</label>
          <input type="password" name="oldpass" id = "oldpass" placeholder="Input Old Password" class="form-control" minlength="6" maxlength="20" ><br>

          <label>New Password:</label>
          <input type="password" name="newpass" id = "newpass" placeholder="Input New Password" class="form-control" minlength="6" maxlength="20"><br>

          <label>Confirm Password:</label>
          <input type="password" name="cpass" id = "cpass" placeholder="Confirm Password" class="form-control" minlength="8" maxlength="20">
          <i class = "fa fa-eye" onclick="showHide()"><span> Show Password</p></i><br>

          <input type="submit" name="submit" class="btn btn-success form-control" value="Submit">




        </div>
        
      </div>
      

    </form>
                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger text-center">
                            <p><?php echo $_GET['error']; ?></p>
                            <button type="button" class="close" data-dismiss="alert" style="margin-top: -2%;">&times;</button>
                          </div>
                        <?php endif ?>

                        <?php if(isset($_GET['info'])): ?>
                              <div class="alert alert-success text-center">
                                  <p><?php echo $_GET['info']; ?></p>
                                  <button type="button" class="close" data-dismiss="alert" style="margin-top: -2%;">&times;</button> 
                              </div>
                        <?php endif?>
      
  </section>
      
     
</div>
<?php include_once('footer.php')?>

<script>
function showHide() {
  var x = document.getElementById("oldpass");
  var y = document.getElementById("newpass");
  var z = document.getElementById("cpass");
  x.style.left = "40%";
  if (x.type === "password" && y.type === "password" && z.type === "password") {
    
    x.type = "text";
    y.type = "text";
    z.type = "text";
  } else {

    x.type = "password";
    y.type = "password";
    z.type = "password";
    
  }
}
</script>

 <?php include_once 'footer.php'?>


