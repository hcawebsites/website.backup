<?php
include_once('main_head.php');
include_once('header.php');
include_once('sidebar.php');
include_once('../database/connection.php');
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Curriculum
        </h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">System Maintenance</a></li>
            <li><a href="#">Curriculum</a></li>
        </ol>
        <hr>
    </section>

    <section class="content">
        <div class="table-master">
            <div class="table-title">
                <h3><i class="fa fa-list" aria-hidden="true"><b>&nbspCurriculum</b></i></h3>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addCurriculum"><i class="fa fa-plus"></i>&nbsp Add New Curriculum</button>
            </div>
            <table class="table table-bordered table-striped" id="search">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Curriculum Name</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-hover">
                    <?php
                    $query_curriculum = mysqli_query($con, "SELECT * From curriculum ORDER BY ID DESC");
                    while ($get_curriculum = mysqli_fetch_assoc($query_curriculum)) {
                    $date = date("F j, Y", strtotime($get_curriculum['Date']));
                    $status = $get_curriculum['Status'];
                    ?>
                        <tr>
                            <td><?=$get_curriculum['ID']?></td>
                            <td><?=$get_curriculum['Name']?></td>
                            <td><?php
                                if ($status == "1") {
                                    echo '<p class="text-success">Active</p>';
                                }
                                else{
                                    echo '<p class="text-danger">Deactivate</p>';
                                }
                            ?></td>
                            <td><?=$date?></td>
                            <td></td>
                        </tr>
                   
                    <?php  } ?>
                </tbody>
            </table>

        </div>
    </section>
</div>
<div class="modal fade" id="addCurriculum" tabindex="" role="dialog" aria-hidden="true">
  <div class="modal-dialog" modal-dialog-scrollable role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="close">
        <i class="fa fa-times" aria-hidden="true"></i>
        </button>
        <h4 class="modal-title"><i class="fa fa-plus" aria-hidden="true"></i> Add New Curriculum</h4>
      </div>
        <div class="modal-body">
        <form name="curriculum" id="add_curriculum">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4 form-group">
                <button type="button" name="add" id="add" class="form-control btn btn-info"><i class="fa fa-plus"></i>&nbspAdd More Subjects</button>
            </div>
                <div class="form-group col-md-12">
                    
                    <table class="table table-bordered" id="subject">
                        <tr>
                            <th>Curriculum Name:</th>
                            <td><input type="text" name="curriculum" id="curriculum" class="form-control"></td>
                        </tr>
                        <tr>
                        <th>Subject 1:</th>
                            <td><input type="text" name="subjects[]" placeholder="Enter Subjects" class="form-control subject" /></td>
                        </tr>
                    </table>
                </div>

                <div class="form-group col-md-12">
                    <input type="submit" name="submit" id="submit" value="Save" class="form-control btn-success">
                </div>

            </div>
        </form>
        </div>

      </div>
  </div>
</div>


<script>

$(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#subject').append('<tr id="row'+i+'"><th>Subject : '+i+'</th><td><input type="text" name="subjects[]" placeholder="Enter Subjects" class="form-control subject" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-trash"></i></button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      $('#submit').click(function(){            
           $.ajax({  
                url:"../model/add_curriculum.php",  
                method:"POST",  
                data:$('#add_curriculum').serialize(),  
                success:function(data)  
                {  
                     alert(data);  
                     $('#add_curriculum')[0].reset();  
                }  
           });  
      });  
 });  

    $(document).ready(function () {
    $('#search').DataTable();
    })
</script>