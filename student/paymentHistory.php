<?php include_once('main_head.php');?>
<?php include_once('std_header.php'); ?>
<?php include_once('std_sidebar.php'); ?>
<?php include_once('../database/connection.php');
$myID = $_SESSION['student_id'];
$count = 1;
?>

<div class="content-wrapper">
	
    <section class="content-header">
    	<h1>
        	Payment History
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Payment History</a></li>
    	</ol>
	</section>
<hr>
    <section class="content">

    <div class="table-schedule">
        <div class="table-payment">
            <h3><i class="fa fa-money">&nbspPayment History</i></h3>
            <div class="search">
              <form class="form-inline" action="" id="filter-payment">
                <div class="row">
                    <input type="hidden" name="myID" value="<?php echo $myID;?>" class="form-control">
                    <input type="date" name="date1" id="date1" class="form-control">
        
                    <input type="date" name="date2" id="date2" class="form-control">
                </div>
              </form>
            </div>
        </div>
    <table class="table table-striped" id="search" style="color: #666666; font-weight: 500;
    font-size: 12px;">
      			<thead>
					<tr>
            <th scope="col">#</th>
						<th scope="col">OR No.</th>
						<th scope="col">Payment Type</th>
						<th scope="col">Paid Amount</th>
						<th scope="col">Balance</th>
                        <th scope="col">Date</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody class="table-hover" id="data">
          <?php  
            $get = mysqli_query($con, "SELECT * from payment_history WHERE Student_ID = '$myID' Order by ID asc");
            while ($fetch = mysqli_fetch_assoc($get)) {
              $date = $fetch['Date'];
              $newdate = date("M d Y", strtotime($date));
             ?>
             <tr class="table-active"> 
              <td style="vertical-align: middle;"><?php echo $count++  ?></td>
              <td style = "vertical-align: middle;"><?php echo $fetch['OR_Number']?></td>
              <td style = "vertical-align: middle;"><?php echo $fetch['Payment_Type']?></td>
              <td style = "vertical-align: middle;"><?php echo $fetch['Paid_Amount']?></td>
              <td style = "vertical-align: middle;"><?php echo $fetch['Balance']?></td>
              <td style = "vertical-align: middle;"><?php echo $newdate?></td>
              <td style = "vertical-align: middle;">
              <button name="view" id="<?php echo $fetch['OR_Number'];?>" class="btn btn-success payment">
              <i class="fa fa-eye" aria-hidden="true"></i></button>

              <a href="../reports/print_invoice.php?or_num=<?=$fetch['OR_Number'];?>" name="view" class="btn btn-danger">
              <i class="fa fa-print" aria-hidden="true"></i></button> 
              </td>

            </tr>
          <?php }?>

          
          
				</tbody>




			</table>
    </div>

    </section>
</div>

<div class="modal fade" id="as" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><ion-icon name="close-circle-outline"></ion-icon></span>
        </button>
        <h4 class="modal-title"><i class="fa fa-money">&nbspPayment Details</i></h4>

      </div>
      <div class="modal-body">
            <form action="" method="post">
              <div class="row">

                <div class ="form-group text-center col-md-12">
                  <img id="output" class="form-group img-rounded"  style="width:150px; height:150px;" />
                </div>

                <div class="col-md-12">
                  <label for="">OR Number:</label>
                  <input type="text" id="or" class="form-control" readonly>
                </div>

                <div class="col-md-6">
                  <label for="">Account Name:</label>
                  <input type="text" id="aname" class="form-control" readonly>
                </div>

                <div class="col-md-6">
                  <label for="">Account Number:</label>
                  <input type="text" id="anum" class="form-control" readonly>
                </div>

                <div class="col-md-6">
                  <label for="">Date:</label>
                  <input type="text" id="date" class="form-control" readonly>
                </div>

                <div class="col-md-6">
                  <label for="">Payment Type:</label>
                  <input type="text" id="type" class="form-control" readonly>
                </div>

                <div class="col-md-4">
                  <label for="">Total:</label>
                  <input type="text" id="total" class="form-control" readonly>
                </div>

                <div class="col-md-4">
                  <label for="">Paid Amount:</label>
                  <input type="text" id="paid" class="form-control" readonly>
                </div>

                <div class="col-md-4">
                  <label for="">Balance:</label>
                  <input type="text" id="balance" class="form-control" readonly>
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

<?php include_once 'footer.php'; ?>
<script>

  $(document).ready(function () {

    $('#search').DataTable();

});

$(document).ready(function(){  
    $('.payment').click(function(){  
         var ornumber = $(this).attr("id")
         $.ajax({  
              url:"view_payment_history.php",  
              method:"POST",  
              data:{
                ornumber:ornumber 
      },
              success:function(data){
              data = $.parseJSON(data);
              $('.form-group img').attr("src", "../payment_qrcode/" + (data.image));
              $('#or').val(data.or);
              $('#aname').val(data.aname);
              $('#anum').val(data.aemail);
              $('#date').val(data.date);
              $('#type').val(data.type);
              $('#total').val(data.total);
              $('#paid').val(data.paid);
              $('#balance').val(data.bal);
              $('#as').modal("show");  
              }  
         });  
    });

    $('#date2').change(function(){
        $.ajax({
          url: "filter_payment.php",
          method: "POST",
          data: $('#filter-payment').serialize(),
          success:function(data){
            $('#data').html(data);
          }
        })
    })  
 });  

</script>
