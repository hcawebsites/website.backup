<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('../database/connection.php')?>


<div class="content-wrapper">

	<section class="content-header">
		<h1>
			Evaluation Questionnaire
			<small>Preview</small>
		</h1>

		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#"></i>Evaluation</a></li>
			<li><a href="#"></i>Questionnaire</a></li>
		</ol>
		<hr>
	</section>

	<section class="content">
		<hr>
		<div class="row">
			<div class="col-md-4">
				<div class="table-master">
					<div class="table-title">
						<h3>Criteria Form</h3>
					</div>
					<form action="../model/addCriteria.php" method="POST">
						<label>Criteria:</label>
						<input type="text" name="criteria" id="criteria" class="form-control" required><br>
						<div class="text-right">
							<button type="submit" name="saveCriteria" class="btn btn-md btn-primary">Save</button>
							<button class="btn btn-md btn-secondary">Cancel</button>
						</div>
					</form>
				</div>
			</div>

			<div class="col-md-8">
				<div class="table-master">
					<div class="table-title">
						<h3>Criteria List</h3>
						<div class="search">
							<button class="btn btn-info save">Save Order</button>
						</div>
					</div>

					<form action="" id="form">

						<ul class="list-group" id="sort" style="margin-top: 10px;">
							<?php
								$criteria = array();
								$getCriteria = mysqli_query($con, "SELECT * FROM criteria order by abs(Order_BY) asc");
								while($row= mysqli_fetch_assoc($getCriteria)){
									$criteria[$row['ID']] = $row;
									?>
									<li class="list-group-item">
									<span class="btn-group" style="float:right;">
									  <span type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									   <i class="fa fa-ellipsis-v"></i>
									  </span>
									  <div class="dropdown-menu">
									     <a class="dropdown-item edit_criteria" data-id="<?php echo $row['ID'] ?>">Edit</a>
					                      <div class="dropdown-divider"></div>
					                     <a class="dropdown-item delete_criteria" data-id="<?php echo $row['ID'] ?>">Delete  </a>
									  </div>
									</span>

									<i class="fa fa-bars"></i> <?php echo ucwords($row['Criteria']) ?>
									<input type="hidden" name="criteria_id[]" value="<?php echo $row['ID'] ?>">
									</li>

								<?php } ?>
							
						</ul>
					</form>
				</div>
			</div>
		</div>
	</section>
	<div class="notifications"></div>
</div>
 <script
  src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
  integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0="
  crossorigin="anonymous"></script>
<script src="../js/app.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#sort').sortable();

		$('.save').click(function(e){
			e.preventDefault();
			$.ajax({
				url:'save_order_criteria.php',
				method:'POST',
				data:$('#form').serialize(),
				success:function(data){
					alert("Criteria List updated!")
				    location.reload();
				    finish();
				}
			})
		})
	})
</script>
<?php include_once 'footer.php'; ?>