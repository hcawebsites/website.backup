<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('../database/connection.php');?>

<div class="content-wrapper">
    <section class="content-header">
    	<h1>
        	Staff Users
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-file"></i>Home</a></li>
            <li><a href="#">Users</a></li>
            <li><a href="#">Staff Users</a></li>
    	</ol>
	</section>
    <hr>
    <section class="content">
        <div class="table-master">
			<div class="table-title">
                <h3><i class="fa fa-users" aria-hidden="true"><b>&nbspStaff User</b></i></h3>

                <div class="search">
                  <div class="row form-inline">
                        
                            <button class="btn btn-info form-control" data-toggle="modal" data-target="#add_new_user"><i class="fa fa-user-plus" aria-hidden="true">&nbspAdd New User</i></button>

                            <a href="" class="btn btn-success form-control" name="excel" class="btn btn-success form-control">
                            <i class="fa fa-file-excel-o" aria-hidden="true">&nbspExcel</i></a>

                            <button class="btn btn-danger form-control" name="print">
                            <i class="fa fa-print" aria-hidden="true">&nbspPrint</i></button>
                    </div>
                </div>
            </div>

            <table class="table table-bordered" id="search">
                  <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Account Name</th>
                        <th scope="col">Access</th>
                        <th scope="col">Status</th>
                        <th scope="col">Registration Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>

                <tbody id="data" class="text-center">
                    <?php 
                    $sql = "SELECT * FROM user";
                    $result = mysqli_query($con, $sql);

                    while ($row = mysqli_fetch_assoc($result)):
                        $date = $row['RDate'];
                        $newdate = date("M d Y", strtotime($date));
                        
                    ?>
                    <tr>
                    <td style = "vertical-align: middle;"><?php echo $row['ID'];?></td>
                    <td style = "vertical-align: middle;"><?php echo $row['Username'];?></td>
                    <td style = "vertical-align: middle;"><?php echo $row['Lastname'],", ", $row['Firstname'], " ", $row['Middlename'] ;?></td>
                    <td style = "vertical-align: middle;"><?php echo $row['Access'];?></td>
                    <td style = "vertical-align: middle;">
                        <?php
                            if ($row['AStatus'] == '1') {
                                echo '<a href="../model/deactivate.php?id='.$row['Username'].'" class="btn btn-success">Activate</a>';
                            }else{
                                echo '<a href="../model/activate.php?id='.$row['Username'].'"class="btn btn-warning">Deactivate</a>';
                            }
                        ?>
                    </td>
                    <td style = "vertical-align: middle;"><?php echo $newdate;?></td>
                    <td style = "vertical-align: middle;">

               		<button class ="fa fa-trash btn btn-danger deletebtn"></button>
                            
                  <button class ="fa fa-eye btn btn-success"></button>
                  </td>
                    </tr>
                    <?php endwhile?>

                </tbody>
            </table>
        </div>
    </section>
    
</div>


<!--Add New User-->
<div class="modal fade" id="add_new_user" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h2 class="modal-title">Sign Up</h2>
        <p>It's quick and easy.</p>
      </div>
      <div class="modal-body">
        <form action="../model/add_user.php" method="Post">
          <div class="row">
          <div class="col-md-12">
              <label for="">Access:</label>
              <select name="access" id="access" class="form-control" required>
                <option value="" disabled selected>Select Access</option>
                <option value="Teacher">Administrator</option>
                <option value="Teacher">Teacher</option>
                <option value="Librarian">Librarian</option>
                <option value="Nurse">Nurse</option>
                <option value="Counsilor">Counsilor</option>
                <option value="Cashier">Cashier</option>
              </select>
            </div>

            <div class="col-md-12">
              <label for="">Lastname:</label>
              <input type="text" name="lastname" id="lastname" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label for="">Firstname:</label>
              <input type="text" name="firstname" id="firstname" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label for="">Middlname:</label>
              <input type="text" name="middlename" id="middlename" class="form-control" required>
            </div>

            <div class="col-md-12">
              <label for="">Email:</label>
              <input type="email" name="email" id="email" class="form-control" required>
            </div>

            
          </div>
       
      </div>
      <div class="modal-footer">
        <button type="submit" name="signup" id="signup" class="btn btn-success">Sign Up</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--Delete Modal-->

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Delete Confirmation</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form action="../model/user_delete.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="delete_id" id="delete_id">
          <h4>Do you want to delete this user?</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">NO, Cancel</button>

          <button type="submit" name="deletedata" class="btn btn-danger">Yes, Delete</button>

        </div>
      </form>
      
    </div>  
  </div>
</div>

<?php include_once 'footer.php';?>

<script>
    $(document).ready(function () {
        $('#search').DataTable();
})

$(document).ready(function () {
    $('.deletebtn').on('click', function() {
      
      $('#deleteModal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#delete_id').val(data[0]);
    });
  });


</script>