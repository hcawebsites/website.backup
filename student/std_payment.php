<?php include_once('main_head.php');?>
<?php include_once ('../database/connection.php');?>
<?php include_once('std_header.php');?>
<?php include_once('std_sidebar.php');?>

<div class="content-wrapper">

	
    <section class="content-header">
    	<h1>
        	Payment
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Payments</a></li>
    	</ol>
	</section>
<hr>
	<section class="content">

			<div class="table-schedule">
				<div class="table-payment">
					<h3>Payments</h3>
				</div>
			<table class="table table-striped" id="search" style="color: #666666; font-size:14px; font-weight: 400;">
			  <thead>
				<tr>
					<th scope="col">Total</th>
					<th scope="col">Balance</th>
					<th scope="col">Due Date</th>
					<th scope="col">Action</th>
				</tr>
			</thead>

			<tbody class="table-hover" id="detailTable">
			<?php
			$myID = $_SESSION['student_id'];
			$query_payment = mysqli_query($con, "SELECT * FROM payments Where Student_ID = '$myID'");
			if (mysqli_num_rows($query_payment) > 0) {
				$row = mysqli_fetch_assoc($query_payment);
				$notif = $row['ID'];
				$balance = $row['Balance'];
				$due1 = date("Y-m-d", strtotime($row['Due_Date']));
				//Due date frame
					date_default_timezone_set('Singapore');
					$due_date = date("Y-m-d", strtotime($row['Due_Date']));
                    $date_time_now = date("Y-m-d");
                    $start_date = new DateTime($due_date); //Time of post
                    $end_date = new DateTime($date_time_now); //Current time
                    $interval = $start_date->diff($end_date); //Difference between dates 
                     if ($interval->d >= 1) {
                        if ($interval->d >= 1) {
                            $due = $interval->d;
                        } else {
                            
                        }
                    }else{
						$due = 'Due Date';
					}

					if ($due <= "10") {
						$main_notif = mysqli_query($con, "SELECT * from main_notification Where Notification_ID = '$notif' AND _status = 'Payment'");
						$std_fees = mysqli_query($con, "SELECT * from student_fees Where Student_ID = '$myID'");
						$notif_history = mysqli_query($con, "SELECT * from notification_history Where Notification_ID = '$notif' AND User_ID = '$myID'");
						if (mysqli_num_rows($main_notif) > 0 && mysqli_num_rows($notif_history) > 0 && mysqli_num_rows($std_fees) > 0) {
							
						}else{
							mysqli_query($con, "INSERT INTO main_notification(Notification_ID, _status, isread)values('$notif' ,'Payment', '0')");
							mysqli_query($con, "INSERT INTO notification_history(Notification_ID, User_ID, Access, _Status, isread)values('$notif' ,'$myID', 'Student', 'Payment', '0')");
							mysqli_query($con, "INSERT INTO student_fees(Student_ID, Total_Fees, Status, Due_Date)values('$myID' ,'$balance', '1', '$due1')");
						}
					}
					//end
				?>
				<tr>
					<td style = "vertical-align: middle;"><?=$row['Total']?></td>
					<td style = "vertical-align: middle;"><?=$row['Balance']?></td>
					<td style = "vertical-align: middle;"><?=date("F j, Y", strtotime($row['Due_Date']))?></td>
					<td style = "vertical-align: middle;" class="text-center">
						<button class="form-control btn btn-success btnPay" id="<?php echo $row['ID']?>"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>&nbspPay</button>	
					</td>
				</tr>

			<?php } ?>
			
			</tbody>




		</table>
</div>

<!--Modal Payment -->

<div class="modal fade" id="payment" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
	  	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title"><i class="fa fa-money"></i>&nbspPayment Information</h4>  
      </div>
      <div class="modal-body">
        <form action="#" class="" method="POST">
			<fieldset id="pay-field">
				<div class="row">
					<div class="col-md-12">
						<input type="hidden" id="std_id" class="form-control" disabled>
						<input type="hidden" id="email" class="form-control" disabled>

						<label for="">Account Name:</label>
						<input type="text" id="aname" class="form-control" required>

						<label for="">Account Email:</label>
						<input type="email" id="email3" class="form-control" required>

						<label for="">Type of Payment:</label>
						<select id="type" class="form-control" required>
							<option value="" disabled>Payment Type</option>
							<option value="Partial Payment">Partial Payment</option>
							<option value="Fully Paid">Fully Paid</option>
						</select>

						<label for="">Balance</label>
               			<input type="number" id="balance" class="form-control" disabled>

						<label for="">Amount</label>
               			<input type="number" id="amount" class="form-control" required>
					</div>
				</div>
			</fieldset>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="next">Next</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--Review Modal-->

<div class="modal fade" id="reviewInfo" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
	  	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title"><i class="fa fa-money"></i>&nbspReview Information</h4>  
      </div>
      <div class="modal-body">
        <form action="#" class="transaction_form" method="POST">
			<fieldset id="information">
				<div class="row">
					<div class="col-md-12">
						<input type="hidden" name="std_id" id="std_id1" class="form-control" readonly>
						<input type="hidden" name="email" id="email1" class="form-control" readonly>

						<label for="">Account Name:</label>
						<input type="text" name="aname" id="aname1" class="form-control" readonly>

						<label for="">Account Email:</label>
						<input type="email" name="email" id="email2" class="form-control" readonly>

						<label for="">Type of Payment:</label>
						<input type="text" name="type" id="type1" class="form-control" readonly>

						<label for="">Balance:</label>
						<input type="hidden" name="balance" id="bal1" class="form-control" readonly>

						<label for="">Amount</label>
               			<input type="number" name="amount" id="amount1" class="form-control" readonly>
					</div>
				</div>
			</fieldset>
		
      </div>
      <div class="modal-footer">
	  	<div style="margin-right: 10px" id="paypal-button"></div>
      </div>
	  </form>
    </div>
  </div>
</div>

</section>


</div>

<script>
  $(document).ready(function () {

    $('#search').DataTable();

});

paypal.Button.render({
    env: 'sandbox', // change for production if app is live,
 
        //app's client id's
	  client: {
        // for test only
        sandbox:    'AdDNu0ZwC3bqzdjiiQlmQ4BRJsOarwyMVD_L4YQPrQm4ASuBg4bV5ZoH-uveg8K_l9JLCmipuiKt4fxn',
        // for live only
        //production: 'AaBHKJFEej4V6yaArjzSx9cuf-UYesQYKqynQVCdBlKuZKawDDzFyuQdidPOBSGEhWaNQnnvfzuFB9SM'
    },
 
    commit: true, // Show a 'Pay Now' button
 
    style: {
      layout:  'vertical',
      color:   'blue',
      shape:   'rect',
      label:   'paypal'
    },
 
    payment: function(data, actions) {
        return actions.payment.create({
            payment: {
                transactions: [
                    {
                    	//total purchase
                        amount: { 
                        	total: $('fieldset#information').find('[name="amount"]').val(), 
                        	currency: 'PHP' 
                        }
                    }
                ]
            }
        });
    },
 
    onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function(payment) {

          $('.transaction_form').submit();
          
          
        });
    },
    onError: (err) => {
    console.error('error from the onError callback', err);
    alert("Payment Error.")
  }
 
}, '#paypal-button');

$(document).ready(function(){  
      $('.btnPay').click(function(){  
           var payment_id = $(this).attr("id")
           $.ajax({  
                url:"transaction.php",  
                method:"POST",  
                data:{
					payment_id:payment_id 
				},
                success:function(data){
				data = $.parseJSON(data);
				$('#std_id').val(data.std_id);
				$('#email').val(data.email);
				$('#balance').val(data.bal);
                $('#payment').modal("show");  
                }  
           });  
      });  
 }); 

 $(document).ready(function(){  
      $('#next').click(function(){  
		var check = new Promise((resolve,reject)=>{
            $('fieldset#pay-field').find('input,select').each(function(){
                if($(this).val() == ''){
                    alert("All fields are required.","warning")
                    reject();
                }
            })
            resolve()
        })
			check.then(function(){
				  var f = document.getElementById("email").value;
				  var e = document.getElementById("std_id").value;
          		  var a = document.getElementById("aname").value;
				  var b = document.getElementById("email3").value;
				  var c = document.getElementById("type").value;
				  var d = document.getElementById("amount").value;
				  var g = document.getElementById("balance").value;

				  document.getElementById("email1").value = f;
				  document.getElementById("std_id1").value = e;
				  document.getElementById("aname1").value = a;
				  document.getElementById("email2").value = b;
				  document.getElementById("type1").value = c;
				  document.getElementById("amount1").value = d;
				  document.getElementById("bal1").value = g;
          		$('#reviewInfo').modal('show');
          		$('#payment').modal('hide');
        })
           
      });  
 	});

	 $('.transaction_form').submit(function(e){
      e.preventDefault();
      start_load();
      var _this = $(this)
      $.ajax({
       
        url: '../std-model/payment.php',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        success: function(data) {
         if(data == 'success'){
             const swalWithBootstrapButtons = Swal.mixin({
			  customClass: {
			    confirmButton: 'btn btn-success',
			  },
			  buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
			  title: 'Payment Completed!',
			  text: "",
			  icon: 'success',
			  showCancelButton: false,
			  confirmButtonText: 'Close',
			}).then((result) => {
			  if (result.isConfirmed) {
			  	location.reload();
			    }
			})
			end_load();
         }
        }

      });
      
});
</script>