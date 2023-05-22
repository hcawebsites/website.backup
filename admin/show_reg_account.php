<?php
include_once('../database/connection.php');

$reg_id = $_GET['reg_id'];

$sql = mysqli_query($con, "SELECT * from user where ID = '$reg_id'");
$row = mysqli_fetch_assoc($sql);
$name = $row['Firstname']. " " .$row['Lastname'];

			
?>


<div class="modal fade" id="modalviewEvent5" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"><i class="fa fa-bell"></i>&nbspNotifications</h3>
      <div class="modal-body">
        <div class="row">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Email</th>
                <th>Access</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
              <tbody>
                <tr>
                <td><?=$row['Username']?></td>
                <td><?=$name?></td>
                <td><?=$row['Email']?></td>
                <td><?=$row['Access']?></td>
                <td><?php
                if ($row['AStatus'] == "0") {
                  echo '<a href="#" class="btn btn-danger">Disabled</a>';
                }else{
                  echo '<a href="#" class="btn btn-success">Enabled</a>';
                }
                
                ?></td>
                <td><?php               
                  echo '<a href="users.php" class="btn btn-info">View</a>';               
                ?></td>
                </tr>
                
              </tbody>
          </table>
        </div>
      </div>
      
    </div>
  </div>
</div>