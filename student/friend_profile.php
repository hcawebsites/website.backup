<?php
include_once('../database/connection.php');

if(isset($_GET["friend_type"])&&($_GET["friend_type"] == "Student")){

    $index=$_GET['friend_index'];

    $sql = "SELECT * FROM student_tb WHERE Student_ID = '$index'";
    $result = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($result);
    $image = $data['Picture'];

?>
<div class="modal msk-fade" id="modalviewFriend" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog"> 
        <div class="container col-lg-8 ">
            <div class="row">
            <div class="col-md-8">
                <div class="panel">
                    <div class="panel-heading">  
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

                     <h2 class="panel-title">Profile</h2>
                     <hr>
                    </div>

                    <div class="panel-body"><!--panel-body -->
                        <div class="row">
                            <div class="col-md-3"> 
                                <img src="../assets/upload/<?=$image?>" class="img-circle img-responsive"> 
                            </div>

                            <div class="col-md-8">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                           <td>Full Name:</td>
                                            <td id=""><?php echo $data['Firstname']," ", $data['Lastname'];?></td>
                                        </tr>

                                        <tr>
                                           <td>Age:</td>
                                            <td id=""><?php echo $data['Age']?></td>
                                        </tr>

                                        <tr>
                                           <td>Gender:</td>
                                            <td id=""><?php echo $data['Gender']?></td>
                                        </tr>

                                        <tr>
                                           <td>Contact:</td>
                                            <td id=""><?php echo $data['Phone']?></td>
                                        </tr>

                                        <tr>
                                           <td>Email:</td>
                                            <td id=""><?php echo $data['Email']?></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Back</button>
                    </div>

                </div>
            </div>
            </div>
        </div>
    </div>
</div>


<?php }?>

<?php
include_once('../database/connection.php');

if(isset($_GET["friend_type"])&&($_GET["friend_type"] == "Admin")){

    $index=$_GET['friend_index'];

    $sql = "SELECT * FROM admin WHERE Admin_ID = '$index'";
    $result = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($result);
    $image = $data['Picture'];

?>
<div class="modal msk-fade" id="modalviewFriend" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog"> 
        <div class="container col-lg-8 ">
            <div class="row">
            <div class="col-md-8">
                <div class="panel">
                    <div class="panel-heading">  
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

                     <h2 class="panel-title">Profile</h2>
                     <hr>
                    </div>

                    <div class="panel-body"><!--panel-body -->
                        <div class="row">
                            <div class="col-md-3"> 
                                <img src="../assets/upload/<?=$image?>" class="img-circle img-responsive"> 
                            </div>

                            <div class="col-md-8">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                           <td>Full Name:</td>
                                            <td id=""><?php echo $data['Firstname']," ", $data['Lastname'];?></td>
                                        </tr>

                                        <tr>
                                           <td>Age:</td>
                                            <td id=""><?php echo $data['Age']?></td>
                                        </tr>

                                        <tr>
                                           <td>Gender:</td>
                                            <td id=""><?php echo $data['Gender']?></td>
                                        </tr>

                                        <tr>
                                           <td>Contact:</td>
                                            <td id=""><?php echo $data['Contact']?></td>
                                        </tr>

                                        <tr>
                                           <td>Email:</td>
                                            <td id=""><?php echo $data['Email']?></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Back</button>
                    </div>

                </div>
            </div>
            </div>
        </div>
    </div>
</div>


<?php }?>

<?php
include_once('../database/connection.php');

if(isset($_GET["friend_type"])&&($_GET["friend_type"] == "Teacher")){

    $index=$_GET['friend_index'];

    $sql = "SELECT * FROM teacher_tb WHERE Emp_ID = '$index'";
    $result = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($result);
    $image = $data['Picture'];

?>
<div class="modal msk-fade" id="modalviewFriend" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog"> 
        <div class="container col-lg-8 ">
            <div class="row">
            <div class="col-md-8">
                <div class="panel">
                    <div class="panel-heading">  
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

                     <h2 class="panel-title">Profile</h2>
                     <hr>
                    </div>

                    <div class="panel-body"><!--panel-body -->
                        <div class="row">
                            <div class="col-md-3"> 
                                <img src="../assets/upload/<?=$image?>" class="img-circle img-responsive"> 
                            </div>

                            <div class="col-md-8">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                           <td>Full Name:</td>
                                            <td id=""><?php echo $data['Firstname']," ", $data['Lastname'];?></td>
                                        </tr>

                                        <tr>
                                           <td>Age:</td>
                                            <td id=""><?php echo $data['Age']?></td>
                                        </tr>

                                        <tr>
                                           <td>Gender:</td>
                                            <td id=""><?php echo $data['Gender']?></td>
                                        </tr>

                                        <tr>
                                           <td>Contact:</td>
                                            <td id=""><?php echo $data['Contact']?></td>
                                        </tr>

                                        <tr>
                                           <td>Email:</td>
                                            <td id=""><?php echo $data['Email']?></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Back</button>
                    </div>

                </div>
            </div>
            </div>
        </div>
    </div>
</div>


<?php }?>

<?php
include_once('../database/connection.php');

if(isset($_GET["friend_type"])&&($_GET["friend_type"] == "Librarian")){

    $index=$_GET['friend_index'];

    $sql = "SELECT * FROM emp_tb WHERE Emp_ID = '$index'";
    $result = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($result);
    $image = $data['Picture'];

?>
<div class="modal msk-fade" id="modalviewFriend" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog"> 
        <div class="container col-lg-8 ">
            <div class="row">
            <div class="col-md-8">
                <div class="panel">
                    <div class="panel-heading">  
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

                     <h2 class="panel-title">Profile</h2>
                     <hr>
                    </div>

                    <div class="panel-body"><!--panel-body -->
                        <div class="row">
                            <div class="col-md-3"> 
                                <img src="../assets/upload/<?=$image?>" class="img-circle img-responsive"> 
                            </div>

                            <div class="col-md-8">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                           <td>Full Name:</td>
                                            <td id=""><?php echo $data['Firstname']," ", $data['Lastname'];?></td>
                                        </tr>

                                        <tr>
                                           <td>Age:</td>
                                            <td id=""><?php echo $data['Age']?></td>
                                        </tr>

                                        <tr>
                                           <td>Gender:</td>
                                            <td id=""><?php echo $data['Gender']?></td>
                                        </tr>

                                        <tr>
                                           <td>Contact:</td>
                                            <td id=""><?php echo $data['Contact']?></td>
                                        </tr>

                                        <tr>
                                           <td>Email:</td>
                                            <td id=""><?php echo $data['Email']?></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Back</button>
                    </div>

                </div>
            </div>
            </div>
        </div>
    </div>
</div>


<?php }?>

<?php
include_once('../database/connection.php');

if(isset($_GET["friend_type"])&&($_GET["friend_type"] == "Registrar")){

    $index=$_GET['friend_index'];

    $sql = "SELECT * FROM emp_tb WHERE Emp_ID = '$index'";
    $result = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($result);
    $image = $data['Picture'];

?>
<div class="modal msk-fade" id="modalviewFriend" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog"> 
        <div class="container col-lg-8 ">
            <div class="row">
            <div class="col-md-8">
                <div class="panel">
                    <div class="panel-heading">  
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

                     <h2 class="panel-title">Profile</h2>
                     <hr>
                    </div>

                    <div class="panel-body"><!--panel-body -->
                        <div class="row">
                            <div class="col-md-3"> 
                                <img src="../assets/upload/<?=$image?>" class="img-circle img-responsive"> 
                            </div>

                            <div class="col-md-8">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                           <td>Full Name:</td>
                                            <td id=""><?php echo $data['Firstname']," ", $data['Lastname'];?></td>
                                        </tr>

                                        <tr>
                                           <td>Age:</td>
                                            <td id=""><?php echo $data['Age']?></td>
                                        </tr>

                                        <tr>
                                           <td>Gender:</td>
                                            <td id=""><?php echo $data['Gender']?></td>
                                        </tr>

                                        <tr>
                                           <td>Contact:</td>
                                            <td id=""><?php echo $data['Contact']?></td>
                                        </tr>

                                        <tr>
                                           <td>Email:</td>
                                            <td id=""><?php echo $data['Email']?></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Back</button>
                    </div>

                </div>
            </div>
            </div>
        </div>
    </div>
</div>


<?php }?>

<?php
include_once('../database/connection.php');

if(isset($_GET["friend_type"])&&($_GET["friend_type"] == "Clinic")){

    $index=$_GET['friend_index'];

    $sql = "SELECT * FROM emp_tb WHERE Emp_ID = '$index'";
    $result = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($result);
    $image = $data['Picture'];

?>
<div class="modal msk-fade" id="modalviewFriend" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog"> 
        <div class="container col-lg-8 ">
            <div class="row">
            <div class="col-md-8">
                <div class="panel">
                    <div class="panel-heading">  
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

                     <h2 class="panel-title">Profile</h2>
                     <hr>
                    </div>

                    <div class="panel-body"><!--panel-body -->
                        <div class="row">
                            <div class="col-md-3"> 
                                <img src="../assets/upload/<?=$image?>" class="img-circle img-responsive"> 
                            </div>

                            <div class="col-md-8">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                           <td>Full Name:</td>
                                            <td id=""><?php echo $data['Firstname']," ", $data['Lastname'];?></td>
                                        </tr>

                                        <tr>
                                           <td>Age:</td>
                                            <td id=""><?php echo $data['Age']?></td>
                                        </tr>

                                        <tr>
                                           <td>Gender:</td>
                                            <td id=""><?php echo $data['Gender']?></td>
                                        </tr>

                                        <tr>
                                           <td>Contact:</td>
                                            <td id=""><?php echo $data['Contact']?></td>
                                        </tr>

                                        <tr>
                                           <td>Email:</td>
                                            <td id=""><?php echo $data['Email']?></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Back</button>
                    </div>

                </div>
            </div>
            </div>
        </div>
    </div>
</div>


<?php }?>
