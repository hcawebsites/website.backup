<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('../database/connection.php');?>

<div class="content-wrapper">
    <section class="content-header">
    	<h1>
        	Retrieve Messages
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-file"></i>Home</a></li>
            <li><a href="#">Message</a></li>
            <li><a href="#">Retrieve Message</a></li>
    	</ol>
	</section>
    <hr>

    <section class="content">
        <div class="table-master">
			<div class="table-title">
                <h3><i class="fa fa-check" aria-hidden="true"><b> Retrieve Message</b></i></h3>

                <div class="btn-master">
                    <form class="form-inline" action="#" method="post" id="filter">
                        <div class="row">
                            <select name="conversation_id" id="conversation_id" onclick="edt1(this)" class="form-control">
                                <option value="" disabled selected>Select Converastion ID</option>
                                <?php 
                                    $query = mysqli_query($con, "SELECT * From online_chat Group by Conversation_ID Order by ID DESC");
                                    if (mysqli_num_rows($query) > 0) {
                                       while ($row = mysqli_fetch_assoc($query)) {
                                        echo '<option value="'.$row['Conversation_ID'].'">'.$row['Conversation_ID'].'</option>';
                                       }
                                    }else{
                                        echo '<option value="">No Record Found!</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
			<hr>
			<div class="panel-body" id="conversation-panel-body">
				<table class="table">
					<tbody id="retrieve_message">
						<tr>
							<td class="text-center" style="font-size: 20px; font-weight: 600px;">Retrieved Messages</td>
						</tr>
					</tbody>
				</table>
			</div>
        </div>
    </section>
</div>

<script>
$(document).ready(function(){  
	$('#conversation_id').click(function(e){
		e.preventDefault();

		$.ajax({
       
	   	url: '../model/retrieve_message.php',
	   	data: $('#filter').serialize(),
	   	method: 'POST',
	   	error: function(data) {
		 	alert("some Error");
	   	},
	   	success: function(data) {
            $("#retrieve_message").html(data);
	   }

	 
	});

	});
});

function edt1(type){
    var selectedValue = type.options[type.selectedIndex].value;
    var print = document.getElementById("print");
    var excel = document.getElementById("excel");
    print.disabled = selectedValue == "" ? true : false;
    excel.disabled = selectedValue == "" ? true : false;

}
</script>


<?php include_once 'footer.php';?>
<style>
    .panel{
        padding: 1rem 1rem 1rem 1rem;
    }

    
    
    #conversation-panel-body{
	height:200px!important;
	overflow:auto !important;
}


.msg-p2{
	
	max-width:352px !important;
	word-break: break-all;
	float:left;
	text-align:left;
	font-size:12px;  
	font-weight:600;
	
	background-color:#dbdada;
	color:black;
	border-radius:15px;
	padding:7px;
	font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
	
}

body{
	overflow-y:scroll;
	
}

.msk-fade {  
      
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s

}


#conversation-panel-body{
	height:350px!important;
	overflow:auto !important;
}

.logo1{
	float: left;
	width: 60px;
	height: 60px;
	margin-right: 10px;
	border-radius: 50%;
	text-align: center;
	background-color:#fff;
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}
</style>