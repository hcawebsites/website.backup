<?php include_once ('../database/connection.php'); 
  extract($_POST);
  if (isset($_POST)) {
    $count = 1;
    $myID = mysqli_real_escape_string($con, $_POST['myID']);
    $date1 = date("Y-m-d", strtotime($_POST['date1']));
    $date2 = date("Y-m-d", strtotime($_POST['date2']));
    $query = "SELECT * FROM payment_history WHERE Date BETWEEN '$date1' AND '$date2' AND Student_ID = '$myID' Order by ID Asc";
    $res = mysqli_query($con, $query);

      if (mysqli_num_rows($res) > 0) {
        while ($fetch = mysqli_fetch_assoc($res)) {
        $date = $fetch['Date'];
        $newdate = date("M d Y", strtotime($date));
      ?>

      <tr class="table-active" style="text-align: center;">
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

      <?php
      }
      }else{
        ?>
        <tr>
          <td colspan="7" class="text-center">No Record Found!</td>
        </tr>
        
        <?php
      }
    }
?>

<script>
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
 });  
</script>