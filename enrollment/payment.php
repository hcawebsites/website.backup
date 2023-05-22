<?php  
include_once 'main_head.php';
include_once 'header.php';
include_once 'sidebar.php';
include_once '../database/connection.php';
$myID = $_SESSION['student_id'];
$count = 1;
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Payment
      <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
      <li><a href="#">Payment</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="table-master">
      <div class="table-title">
        <h3>
          <i class="fa fa-money"></i>
          Payment
        </h3>
      </div>
      <table class="table table-bordered table-striped" id="search" style="color: #666666; font-size:13px;">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Total Fees</th>
            <th scope="col">Status</th>
            <th scope="col">Date Created</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php  
             $get = mysqli_query($con, "SELECT * from student_fees Where Student_ID = '$myID'");
             while ($row = mysqli_fetch_assoc($get)) {
              $date = date('F j, Y', strtotime($row['Date_Created']));
              ?>
              <tr>
                <td style="vertical-align: middle;"><?php echo $count++?></td>
                <td style="vertical-align: middle;"><?php echo $row['Total_Fees']?></td>
                <td style = "vertical-align: middle;" class="text-center">
                  <?php 
                    if ($row['Status'] == "1") {
                      echo "<p class='btn-danger'>To Pay</p>";
                    }if ($row['Status'] == "2") {
                      echo "<p class='btn-success'>paid</p>";
                    }
                  ?>
                </td>
                <td style="vertical-align: middle;"><?php echo $date?></td>
                <td style = "vertical-align: middle;">
                  <Button class="btn btn-success col-md-12" data-toggle="modal" data-target="#payment">Pay</button>
                </td>
            </tr>
          <?php }?>

          
        </tbody>
      </table>
    </div>
  </section>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="close">
        <i class="fa fa-times" aria-hidden="true"></i>
        </button>
        <h4 class="modal-title"><i class="fa fa-money" aria-hidden="true"></i> Payment Information</h4>
      </div>

      <form action="#" class="transaction_form" method="POST">
    
        <div class="modal-body">
        <fieldset id="information">
          <div class="row">
            <input type="hidden" name="student_id" id="student_id" value="<?php echo $myID?>">
            <div class="col-md-12">
              <label>Account Name:</label>
              <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="col-md-12">
              <label>Email:</label>
              <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="form-group col-md-12">
                <label for="">Type of Payment:</label>
                    <select name="type" id="type" class="form-control" required>
                        <option hidden selected>Please Select Here</option>
                        <option value="Partial Payment">Partial Payment</option>
                        <option value="Fully Paid">Fully Paid</option>
                    </select>
            </div>

            <div class="form-group col-md-12">
              <label for="">Amount</label>
               <input type="number" name="amount" id="amount" class="form-control" required>
            </div>
          </div>
        </fieldset>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

          <button type="button" class="btn btn-success" id="next">Next</button>

        </div>

      
    </div>  
  </div>
</div>

<div class="modal fade" id="review" tabindex="" role="dialog" aria-hidden="true">
  <div class="modal-dialog" modal-dialog-scrollable role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="close">
        <i class="fa fa-times" aria-hidden="true"></i>
        </button>
        <h4 class="modal-title"><i class="fa fa-money" aria-hidden="true"></i> Review Payment</h4>
      </div>
      <div class="modal-body">

      <fieldset id="pay-field">
        
        <table class="table table-bordered table-striped">
       
          <div class="row">
              <tbody>
                <tr>
                  <td>Account Name:</td>
                  <td id="r_name"></td>
                </tr>
                
                <tr>
                  <td>Account Email:</td>
                  <td id="r_email"></td>
                </tr>

                <tr>
                  <td>Type of Payment:</td>
                  <td id="r_type"></td>
                </tr>
                <tr>
                  <td>Amount:</td>
                  <td id="r_amount"></td>
                </tr>
              </tbody>
          </div>
        </table>
        </fieldset>
        <div class="form-group text-center">
                <span id="paypal-button" ></span>
          </div>
      
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-success" data-toggle="modal" data-dismiss="modal" data-target="#payment">Back</button>
        <button type="button" class="btn btn-danger"data-dismiss="modal">Cancel</button>
      
      </div>
        </form>
      </div>
  </div>
</div>
<?php include_once 'footer.php';  ?>
<!-- End of Modal-->
<script type="text/javascript">
  var timer1 = 0;
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
    Swal.fire(
      'Payment Error!',
      '',
      'error'
    )
  }
 
}, '#paypal-button');

  $(document).ready(function(){
    $('#search').DataTable();

    $('#next').click(function(){
        var check = new Promise((resolve,reject)=>{
            $('fieldset#information').find('input,select').each(function(){
                if($(this).val() == ''){
                   
                }
            })
            resolve()
        })
        check.then(function(){
          var name = document.getElementById('name').value;
          var email = document.getElementById('email').value;
          var type = document.getElementById('type').value;
          var amount = document.getElementById('amount').value;
          document.getElementById('r_name').innerHTML = name;
          document.getElementById('r_email').innerHTML = email;
          document.getElementById('r_type').innerHTML = type;
          document.getElementById('r_amount').innerHTML = amount;

          $('#review').modal('show')
          $('#payment').modal('hide')
        })

    })

    $('.transaction_form').submit(function(e){
      e.preventDefault();
      start_load();
      var _this = $(this)
      $.ajax({
       
        url: 'send_payment.php',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        success: function(data) {
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
			  	window.location.href='logout.php'
			    }
			})
			end_load();
        
        }

      });
  });

  })
</script>