<?php 
include_once('main_head.php');
include_once('header.php');
include_once('sidebar.php');
include_once('../database/connection.php');
$myID = $_SESSION['admin_id'];
$teacher_id = isset($_GET['tid']) ? $_GET['tid'] : '' ; 
$get = mysqli_query($con, "SELECT concat(School_Year, ' ' , Semester) as ay FROM academic_list WHERE is_default = 1");
$row = mysqli_fetch_assoc($get);
$ay = $row['ay'];
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Evaluation Reports
			<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i></a>&nbspDashboard</li>
			<li><a href="#"></a>Evaluation</li>
			<li><a href="#"></a>Evaluation Reports</li>
		</ol>
		<hr>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-4">
				<div class="table-master">
					<div class="table-title">
						<h3>
							<i class="fa fa-book"></i>&nbsp
							Subjects
						</h3>
					</div>
					<hr>
					<div class="list-group" id="class-list">
					
					</div>

				</div>
			</div>
			<div class="col-md-8">
				
				
				<div class="table-master">
					<div class="table-title">
						<h3><i class="fa fa-flag"></i>&nbspEvaluation Reports</h3>
						<div class="search">
							<div class="row form-inline">
								<select name="teacher" id="teacher" class="form-control">
									<option hidden selected>Please select here</option>
									<?php
									$f_arr = array();
									$fname = array();
										$selectTeacher = mysqli_query($con, "SELECT *, concat(Salutation, '. ', Lastname, ' ' , Firstname) as name FROM teacher_tb order by ID asc");
										while ($rowTeacher = mysqli_fetch_assoc($selectTeacher)) {
											$f_arr[$rowTeacher['Emp_ID']]= $rowTeacher;
											$fname[$rowTeacher['Emp_ID']]= ucwords($rowTeacher['name']);
									?>
										<option value="<?=$rowTeacher['Emp_ID'] ?>" <?php echo isset($teacher) && $teacher == $rowTeacher['Emp_ID'] ? "selected" : "" ?>><?php echo ucwords($rowTeacher['name']) ?></option>
									<?php }?>
									
								</select>

								<button type="button" class="btn btn-danger" id="print"><i class="fa fa-print"></i>&nbspPrint</button>
							</div>
						</div>
					</div>
					<div class="callout callout-info" id="printable">
					<div class="row">
						<div class="info" style="line-height: 30px;">
							<div class="col-md-6">
								<label>Teacher:&nbsp</label><span id="name"></span>
							</div>

							<div class="col-md-6">
								<label>Academic Year:&nbsp</label><span id="ay"><?php echo $ay  ?></span>
							</div>

							<div class="col-md-6">
								<label>Class:&nbsp</label><span id="class"></span>
							</div>

							<div class="col-md-6">
								<label>Total Student Evaluated:&nbsp<span id="total"></span></label>
							</div>

							<div class="col-md-12">
								<label>Subject:&nbsp</label><span id="subject"></span>
							</div>
						</div>
					</div>

					<fieldset style="border: 1px solid black; padding:10px; margin-bottom: 10px;" class="border border-info p-2 w-100">
					   <legend class="w-auto">Rating Legend</legend>
					   <p style="font-size: 14px; font-weight: 600; color: red;">5 = Strongly Agree, 4 = Agree, 3 = Neutral, 2 = Disagree, 1 = Strongly Disagree</p>
					</fieldset>

					<?php
						$o_array = array();
						$getCriteria = mysqli_query($con, "SELECT * FROM criteria Order by abs(Order_BY) asc");
						while ($rowCriteria = mysqli_fetch_assoc($getCriteria)) {
							$cid = $rowCriteria['ID'];
					?>

					<table class="table table-bordered" style="word-break: break-all; table-layout: fixed;">
						<thead>
							<tr style="background-color: #d9d9d9;">
								<th colspan="6" style="text-align: left;"><b><?php echo $rowCriteria['Criteria'] ?></b></th>
								<th class="text-center">1</th>
								<th class="text-center">2</th>
								<th class="text-center">3</th>
								<th class="text-center">4</th>
								<th class="text-center">5</th>
							</tr>
						</thead>
						<tbody class="tr-sortable">
									<?php
										$getQuestions = mysqli_query($con, "SELECT * FROM ev_questionnaire WHERE Criteria_ID = '$cid' ORDER BY abs(Order_By) asc");
										while ($rowQuestion = mysqli_fetch_assoc($getQuestions)) {
											$o_array[$rowQuestion['ID']] = $rowQuestion;
										?>
										<tr>
											<td colspan="6">
												<?php echo $rowQuestion['Question'] ?>
											</td>

											<?php for($c=1;$c<6;$c++): ?>
											<td class="text-center">
												<div style="">
							                        <span class="rate_<?php echo $c.'_'.$rowQuestion['ID'] ?> rates">-</span>
						                      </div>
											</td>
											<?php endfor; ?>
										</tr>
									<?php } ?>
									
								</tbody>
					</table>

					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php include_once 'footer.php';?>
<noscript>
	<style>
		table{
			width:100%;
			border-collapse: collapse;
		}
		table.wborder tr,table.wborder td,table.wborder th{
			border:1px solid gray;
			padding: 3px
		}
		table.wborder thead tr{
			background: #6c757d linear-gradient(180deg,#828a91,#6c757d) repeat-x!important;
    		color: #fff;
		}
		.text-center{
			text-align:center;
		} 
		.text-right{
			text-align:right;
		} 
		.text-left{
			text-align:left;
		} 
	</style>
</noscript>
<script type="text/javascript">
var timer1 = 0;
var intervalID;
$(document).ready(function(){
	$('#teacher').change(function(){
			window.history.pushState({}, null, 'ev_reports.php?tid='+$(this).val());
			load()
	})
	function load(){
		var fname = <?php echo json_encode($fname) ?>;
		$('#name').text(fname[$('#teacher').val()])
		var teacher_id = $('#teacher').val();
		start_load()

		$.ajax({
			url: "getClass.php",
			method: "POST",
			data:{
				teacher_id:teacher_id
			},
			success:function(data){
						data = JSON.parse(data)
						if(Object.keys(data).length <= 0 ){
							$('#class-list').html('<a href="javascript:void(0)"  type="button" class="list-group-item list-group-item-action disabled">No data to be display.</a>')
							$('#subject').text('');
							$('#class').text('');
						}else{
							$('#class-list').html('')
							Object.keys(data).map(value=>{
							$('#class-list').append('<a href="javascript:void(0)"  data-json=\''+JSON.stringify(data[value])+'\' data-id="'+data[value].Evaluation_ID+'" class="list-group-item list-group-item-action show-result">'+data[value].Name+' '+data[value].Strand+ ' - ' + data[value].Section +' <br> '+data[value].Description+'</a>')
							})
						}
			},
			complete:function(){
				end_load();
				data_rep();
				if('<?php echo isset($_GET['Class_ID']) ?>' == 1){
					$('.show-result[data-id="<?php echo isset($_GET['Class_ID']) ? $_GET['Class_ID'] : '' ?>"]').trigger('click')
				}else{
					$('.show-result').first().trigger('click')
				}
			}
		})
	}

	function data_rep(){
		$('.show-result').click(function(){
			var rep_data = [], hash;
			var data = $(this).attr('data-json');
			data = JSON.parse(data);

			var _href = location.href.slice(window.location.href.indexOf('?') + 1).split('&');
			for(var i = 0; i < _href.length; i++)
				{
					hash = _href[i].split('=');
					rep_data[hash[0]] = hash[1];
				}
			window.history.pushState({}, null, 'ev_reports.php?tid='+rep_data.tid+'&classID='+data.Class_ID+'&strand='+data.Strand+'&subject='+data.Code);
			load_report(rep_data.tid, data.Class_ID, data.Strand, data.Code);
			$('#subject').text(data.Code + ' | ' + data.Description);
			$('#class').text(data.Name + ' ' + data.Strand + ' - ' + data.Section);
			$('.show-result.active').removeClass('active');
			$(this).addClass('active');

		})
	}

	function load_report($teacher_id, $classID, $strand, $subject){
		start_load()
		$.ajax({
			url: "get_ev_report.php",
			method: "POST",
			data: {
				teacher_id:$teacher_id,
				class_id:$classID,
				strand:$strand,
				subject:$subject

			},
			error:function(error) {
				alert('Error occured!');
				end_load();
			},
			success:function(data){
				data = JSON.parse(data);
				if(Object.keys(data).length <= 0){
					$('.rates').text('');
					$('#total').text('0');
					$('.rates').text('-');
				}else{
					$('#total').text(data.tse);
					$('.rates').text('-');
					var data = data.data
						Object.keys(data).map(q=>{
							Object.keys(data[q]).map(r=>{
								$('.rate_'+r+'_'+q).text(data[q][r]+'%');
							})
						})
				}
			},
			complete:function(){
				end_load();
			}
		})
	}

	$('#print').click(function(){
		start_load()
		var ns =$('noscript').clone()
		var content = $('#printable').html()
		ns.append(content)
		var nw = window.open("Report","_blank","width=900,height=700")
		nw.document.write(ns.html())
		nw.document.close()
		nw.print()
		setTimeout(function(){
			nw.close()
			end_load()
		},1000)
	})


})
</script>