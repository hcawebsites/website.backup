<?php
include_once('main_head.php');
include_once('header.php');
include_once('sidebar.php');
include_once('../database/connection.php');
$myID = $_SESSION['admin_id'];
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Administrator
            <small>Preview</small>
        </h1>
        
        <ol class="breadcrumb">
           <li><a href="#"><i class="fa fa-dashboard"></i>&nbspHome</a></li>
           <li><a href="#"><i class="fa fa-user"></i>&nbspStaff</a></li>
           <li><a href="#"><i class="fa fa-lock"></i>Administrator</a></li>
        </ol>
        <hr>
    </section>

    <section class="content">
        <div class="table-master">
            <div class="table-title">
                <h3><i class="fa fa-lock"></i>&nbspList of Administrators</h3>
                <div class="search">
                    <div class="row">
                        <form action="../reports/admin_reports.php" class="form-inline" method="POST">
                            <button type="submit" name="excel" class="btn btn-success"><i class="fa fa-file-excel-o"></i>&nbspExcel</button>
                            <button type="submit" name="print" class="btn btn-danger"><i class="fa fa-print"></i>&nbspPrint</button>
                        </form>
                    </div>
                </div>
            </div>

            <table class="table table-striped table-bordered" id="search">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>QR Code</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $query_admin = mysqli_query($con, "SELECT * from admin WHERE Archived = '0' order by ID ASC");
                        while ($get_admin = mysqli_fetch_assoc($query_admin)) {
                            $name = $get_admin['Salutation']. ". " .$get_admin['Firstname']. " " .$get_admin['Lastname'];
                            ?>
                            <tr>
                                <td style="vertical-align:middle"><?=$get_admin['ID']?></td>
                                <td style="vertical-align:middle; text-align: center;"><img src="../A-QRCODE/<?=$get_admin['QR_Code']?>" width="50px"></td>
                                <td style="vertical-align:middle"><?=$name?></td>
                                <td style="vertical-align:middle"><?=$get_admin['Email']?></td>
                                <td style="vertical-align:middle"><?=$get_admin['Contact']?></td>
                                <td style="vertical-align:middle; text-align: center;">
                                    <button class="btn btn-success view" id="<?=$get_admin['Admin_ID']?>"><i class="fa fa-eye"></i></button>
                                    <button class="btn btn-primary edit" id="<?=$get_admin['Admin_ID']?>"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger archived" id="<?=$get_admin['Admin_ID']?>"><i class="fa fa-archive" aria-hidden="true"></i></button>
                                </td>
                                
                            </tr>
                       <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<div class="modal fade" id="viewAdmin" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h3 class="modal-title"><i class="fa fa-lock"></i>&nbspAdministrator Information</h3>
      </div>
      <div class="modal-body">
       <form action="#">
            <div class="row">
                <div class="col-md-12 form-group text-center">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <img id="output" class="img-rounded" src="" style="width:150px; height:150px;" />
                    </div>

                    <div class="col-md-3">
                        <img id="qrcode" class="img-rounded" src="" style="width:150px; height:150px;" />
                    </div>
                    <div class="col-md-3"></div>
                </div>

                <div class="col-md-2">
                    <label for="">Salutation:</label>
                    <input type="text" id="salutation" class="form-control" readonly>
                </div>

                <div class="col-md-3">
                    <label for="">Lastname:</label>
                    <input type="text" id="lastname" class="form-control" readonly>
                </div>

                <div class="col-md-3">
                    <label for="">Firstname:</label>
                    <input type="text" id="firstname" class="form-control" readonly>
                </div>

                <div class="col-md-3">
                    <label for="">Middlname:</label>
                    <input type="text" id="middlename" class="form-control" readonly>
                </div>

                <div class="col-md-1">
                    <label for="">Suffix:</label>
                    <input type="text" id="suffix" class="form-control" readonly>
                </div>

                <div class="form-group col-md-3">
                    <label for="">DOB:</label>
                    <input type="text" id="dob" class="form-control" readonly >
                </div>

                <div class="form-group col-md-3">
                    <label for="">Age:</label>
                    <input type="text" id="age" class="form-control" readonly>
                </div>

                <div class="form-group col-md-3">
                    <label for="">Gender:</label>
                    <input type="text" id="gender" class="form-control" readonly>
                </div>

                <div class="form-group col-md-3">
                    <label for="">Status:</label>
                    <input type="text" id="status" class="form-control" readonly>
                </div>

                <div class="form-group col-md-12">
                    <label for="">Address:</label>
                    <input type="text" id="address" class="form-control" readonly>
                </div>
                
                <div class="form-group col-md-6">
                    <label for="">Nationality:</label>
                    <input type="text" name="nationality" id="nationality" class="form-control" readonly>
                </div>

                <div class="form-group col-md-6">
                    <label for="">Contact:</label>
                    <input type="text" id="contact" class="form-control" readonly>
                </div>

                <div class="form-group col-md-6">
                    <label for="">Registered Date:</label>
                    <input type="text" id="rdate" class="form-control" readonly>
                </div>

                <div class="form-group col-md-6">
                    <label for="">Email:</label>
                    <input type="text" id="email" class="form-control" readonly>
                </div>
                
            </div>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editAdmin" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h3 class="modal-title"><i class="fa fa-lock"></i>&nbspAdministrator Information</h3>
      </div>
      <div class="modal-body">
       <form action="../model/edit_admin.php" method="POST">
            <div class="row">
                <div class="col-md-12 form-group text-center">
                    <input type="hidden" name="admin_id" id="admin_id" class="form-control" readonly>
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <img id="output1" class="img-rounded" src="" style="width:150px; height:150px;" />
                    </div>

                    <div class="col-md-3">
                        <img id="qrcode1" class="img-rounded" src="" style="width:150px; height:150px;" />
                    </div>
                    <div class="col-md-3"></div>
                </div>

                <div class="col-md-2">
                    <label for="">Salutation:</label>
                    <input type="text" name="salutation" id="salutation1" class="form-control">
                </div>

                <div class="col-md-3">
                    <label for="">Lastname:</label>
                    <input type="text" name="lastname" id="lastname1" class="form-control">
                </div>

                <div class="col-md-3">
                    <label for="">Firstname:</label>
                    <input type="text" name="firstname" id="firstname1" class="form-control">
                </div>

                <div class="col-md-3">
                    <label for="">Middlname:</label>
                    <input type="text" name="middlename" id="middlename1" class="form-control">
                </div>

                <div class="col-md-1">
                    <label for="">Suffix:</label>
                    <input type="text" name="suffix" id="suffix1" class="form-control">
                </div>

                <div class="form-group col-md-3">
                    <label for="">DOB:</label>
                    <input type="text" name="dob" id="dob1" class="form-control" readonly>
                </div>

                <div class="form-group col-md-3">
                    <label for="">Age:</label>
                    <input type="text" name="age" id="age1" class="form-control">
                </div>

                <div class="form-group col-md-3">
                    <label for="">Gender:</label>
                    <input type="text" name="gender" id="gender1" class="form-control">
                </div>

                <div class="form-group col-md-3">
                    <label for="">Status:</label>
                    <input type="text" name="status" id="status1" class="form-control">
                </div>

                <div class="form-group col-md-12">
                    <label for="">Address:</label>
                    <input type="text" name="address" id="address1" class="form-control">
                </div>
                
                <div class="form-group col-md-6">
                    <label for="">Nationality:</label>
                    <input type="text" name="nationality" name="nationality" id="nationality1" class="form-control">
                </div>

                <div class="form-group col-md-6">
                    <label for="">Contact:</label>
                    <input type="text" name="contact" id="contact1" class="form-control">
                </div>

                <div class="form-group col-md-6">
                    <label for="">Registered Date:</label>
                    <input type="text" id="rdate1" class="form-control" readonly>
                </div>

                <div class="form-group col-md-6">
                    <label for="">Email:</label>
                    <input type="text" name="email" id="email1" class="form-control">
                </div>
                
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="save" class="btn btn-success">Save Changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="archivedModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title" style="font-weight: 500; color: red;"><i class="fa fa-archive"></i>&nbspArchived Admin User?</h4>
        
      </div>
      <div class="modal-body">
      <form action="../model/archived_admin.php" method="POST">
            <div class="row">
                <div class="col-md-12 form-group text-center">
                    <input type="hidden" name="admin_id" id="admin_id1" class="form-control" readonly>
                    <img id="output2" class="img-rounded" src="" style="width:150px; height:150px;" />
                </div>

                <div class="col-md-12">
                    <label for="">Salutation:</label>
                    <input type="text" name="salutation" id="salutation2" class="form-control" readonly>
                </div>

                <div class="col-md-12">
                    <label for="">Lastname:</label>
                    <input type="text" name="lastname" id="lastname2" class="form-control" readonly>
                </div>

                <div class="col-md-12">
                    <label for="">Firstname:</label>
                    <input type="text" name="firstname" id="firstname2" class="form-control" readonly>
                </div>

                <div class="col-md-12">
                    <label for="">Middlname:</label>
                    <input type="text" name="middlename" id="middlename2" class="form-control" readonly>
                </div>

                <div class="col-md-12">
                    <label for="">Suffix:</label>
                    <input type="text" name="suffix" id="suffix1" class="form-control" readonly>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="archived" class="btn btn-danger">Yes, Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>
  </div>
</div>
<?php include_once('footer.php');?>

<script>
    $(document).ready(function(){
        $('#search').DataTable()
    })

    $(document).ready(function(){
        $('.view').click(function() {
           var admin_id = $(this).attr("id");
           
           $.ajax({
                url: "view_admin.php",
                method: "POST",
                data:{
                    admin_id:admin_id
                },
                success:function(data){
                    data = $.parseJSON(data);
                    $('#output').attr("src", "../assets/upload/" + (data.picture));
                    $('#qrcode').attr("src", "../A-QRCODE/" + (data.qrcode));
                    $('#salutation').val(data.salutation);
                    $('#lastname').val(data.lastname);
                    $('#firstname').val(data.firstname);
                    $('#middlename').val(data.middlename);
                    $('#suffix').val(data.suffix);
                    $('#dob').val(data.dob);
                    $('#age').val(data.age);
                    $('#gender').val(data.gender);
                    $('#status').val(data.status);
                    $('#address').val(data.address);
                    $('#nationality').val(data.nationality);
                    $('#contact').val(data.contact);
                    $('#rdate').val(data.rdate);
                    $('#email').val(data.email);
                    $('#viewAdmin').modal('show');
                }
           })
        })
    })

    $(document).ready(function(){
        $('.edit').click(function() {
           var admin_id = $(this).attr("id");
           
           $.ajax({
                url: "view_admin.php",
                method: "POST",
                data:{
                    admin_id:admin_id
                },
                success:function(data){
                    data = $.parseJSON(data);
                    $('#output1').attr("src", "../assets/upload/" + (data.picture));
                    $('#qrcode1').attr("src", "../A-QRCODE/" + (data.qrcode));
                    $('#admin_id').val(data.admin_id);
                    $('#salutation1').val(data.salutation);
                    $('#lastname1').val(data.lastname);
                    $('#firstname1').val(data.firstname);
                    $('#middlename1').val(data.middlename);
                    $('#suffix1').val(data.suffix);
                    $('#dob1').val(data.dob);
                    $('#age1').val(data.age);
                    $('#gender1').val(data.gender);
                    $('#status1').val(data.status);
                    $('#address1').val(data.address);
                    $('#nationality1').val(data.nationality);
                    $('#contact1').val(data.contact);
                    $('#rdate1').val(data.rdate);
                    $('#email1').val(data.email);
                    $('#editAdmin').modal('show');
                }
           })
        })
    })

    $(document).ready(function(){
        $('.archived').click(function() {
            var admin_id = $(this).attr('id');
            $.ajax({
                url: "view_admin.php",
                method: "POST",
                data:{
                    admin_id:admin_id
                },
                success:function(data){
                    data = $.parseJSON(data);
                    $('#admin_id1').val(data.admin_id);
                    $('#output2').attr("src", "../assets/upload/" + (data.picture));
                    $('#salutation2').val(data.salutation);
                    $('#lastname2').val(data.lastname);
                    $('#firstname2').val(data.firstname);
                    $('#middlename2').val(data.middlename);
                    $('#suffix2').val(data.suffix);
                    $('#archivedModal').modal('show');
                }
           })
        })
    })
</script>