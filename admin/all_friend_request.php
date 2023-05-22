<?php session_start(); ?>
<?php include_once ('../database/connection.php'); ?>
<div class="modal msk-fade" id="modalviewAllFriendRequest" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog"><!--modal-dialog -->  
		<div class="container"><!--modal-content --> 
      		<div class="row">
            	<div class="col-md-9">
                    <div class="panel"><!--panel --> 
                        <div class="panel-heading bg-primary">
                            <button type="button" class="close" onclick="countEquel0()" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h4 class="panel-title">All Friend Request</h4>
                        </div>
                        <div class="panel-body"><!--panel-body -->
                            <div class="row">
                                <div class=" col-md-12"> 
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody id="tBody">
                                            <?php
                $my_id = $_SESSION['admin_id'];
                $my_type = $_SESSION['access'];
                $sql = "SELECT * FROM my_friends WHERE My_ID = '$my_id' and Status = 'Pending' ORDER BY Friend_Type DESC";

                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                $friend_type=$row['Friend_Type'];
                $friend_index=$row['Friend_ID'];
                $status=$row['Status'];

                if ($friend_type == "Student") {
                    $sql1 = "SELECT * FROM student WHERE Student_ID = '$friend_index'";
                    $res = mysqli_query($con, $sql1);
                    $row = mysqli_fetch_assoc($res);
                    $image = $row['Picture'];
                    $id = $row['Student_ID'];
                    # code...
                }

                if ($friend_type == "Admin") {
                    $sql1 = "SELECT * FROM admin Where Admin_ID = '$friend_index'";
                    $res = mysqli_query($con, $sql1);
                    $row = mysqli_fetch_assoc($res);
                    $id = $row['Admin_ID'];
                    
                }

                if ($friend_type == "Teacher") {
                    $sql1 = "SELECT * FROM teacher_tb Where Emp_ID = '$friend_index'";
                    $res = mysqli_query($con, $sql1);
                    $row = mysqli_fetch_assoc($res);
                    $id = $row['Emp_ID'];
                    # code...
                }

                if ($friend_type == "Librarian") {
                    $sql1 = "SELECT * FROM emp_tb Where Emp_ID = '$friend_index'";
                    $res = mysqli_query($con, $sql1);
                    $row = mysqli_fetch_assoc($res);
                    $id = $row['Emp_ID'];
                    # code...
                }

                if ($friend_type == "Registrar") {
                    $sql1 = "SELECT * FROM emp_tb Where Emp_ID = '$friend_index'";
                    $res = mysqli_query($con, $sql1);
                    $row = mysqli_fetch_assoc($res);
                    $id = $row['Emp_ID'];
                    # code...
                }

                if ($friend_type == "Clinic") {
                    $sql1 = "SELECT * FROM emp_tb Where Emp_ID = '$friend_index'";
                    $res = mysqli_query($con, $sql1);
                    $row = mysqli_fetch_assoc($res);
                    $id = $row['Emp_ID'];
                    # code...
                }

                ?>

                <tr class="text-center">
                    <td><?php echo $id?></td>
                    <td><a href="#"onClick="friendProfile('<?php echo $friend_type; ?>','<?php echo $friend_index; ?>')"><?php echo $row['Firstname']," ", $row['Lastname']?></a></td>
                    <td><?php echo $friend_type ?></td>

                    <td ><?php echo $status; ?></td>   

                    <td>
                        <button data-dismiss="modal" onclick="confirmFriend('<?php echo $my_id; ?>','<?php echo $my_type; ?>','<?php echo $friend_index; ?>')" class="btn btn-success btn-xs" ><i class="fa fa-user-plus" aria-hidden="true"> Confirm</i></button>

                        <button data-dismiss="modal" data-toggle="modal" onclick="deleteFriend()" class="btn btn-danger btn-xs" ><i class="fa fa-user" aria-hidden="true"> Delete</i></button>


                    </td>

                    
                </tr>

            <?php } }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteFriendRequest" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="content"> 
    <div class="modal-content">
      <div class="modal-header text-center">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
      <h3 style="color: red">Delete Friend Request Confirmation</h3>
      </div>

      <form method="POST">
        <div class="modal-body">
          <h5><strong style="color:red;">Are you sure?</strong>  Do you want to Delete this Friend Request.</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">NO, Cancel</button>

          <button type="submit" onclick = "deletefriend('<?php echo $my_id; ?>','<?php echo $my_type; ?>','<?php echo $friend_index; ?>')" class="btn btn-danger">Yes, Delete</button>

        </div>
      </form>
    </div>
  </div>
</div>

