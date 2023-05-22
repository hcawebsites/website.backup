<?php include_once('main_head.php');?>
<?php include_once('std_header.php'); ?>
<?php include_once('std_sidebar.php'); ?>
<?php include_once('../database/connection.php');?>


<div class="content-wrapper">
	
    <section class="content-header">
    	<h1>
        	Returned Books
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Library</a></li>
            <li><a href="#">Returned Book</a></li>
    	</ol>
	</section>
	<hr>
    <section class="content">

    	<div class="table">
            <div class="table-title">
                <h3><i class="fa fa-book" aria-hidden="true">&nbspReturned Books</i></h3>
            </div>

            
        <table class="table table-striped" id="search">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">ISBN</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Date Borrowed</th>
                            <th scope="col">Date Returned</th>
                        </tr>
                    </thead>
                    <?php
                    	$myID = $_SESSION['username'];
                        $sql = "SELECT * FROM borrow_books Where Borrowers_ID = '$myID' AND Status = '0'";
                        $result = mysqli_query($con, $sql);
                    ?>
                    <tbody class="table-hover" id="detailTable">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)):
                        $date = $row['Date_Borrow'];
                        $newdate = date('M d Y', strtotime($date));

                        $date1 = $row['Date_Returned'];
                        $newdate1 = date('M d Y', strtotime($date1));
                    ?>
                    <tr class="table-active" style="text-align: center;">
                    <td style = "vertical-align: middle;"><?=$row['ID']?></td>
                    <td style = "vertical-align: middle;"><?=$row['ISBN']?></td>
                    <td style = "vertical-align: middle;"><?=$row['Title']?></td>

                    <td style = "vertical-align:middle;"><?=$row['Author']?></td>

                    <td style = "vertical-align: middle;"><?=$newdate?></td>
                    <td style = "vertical-align: middle;"><?=$newdate1?></td>
                
                    </tr>



                    </tbody>



                    <?php endwhile?>
                </table>


        </div>
    
    </section>
</div>

<?php include_once 'footer.php';?>

<script type="text/javascript">
	  $(document).ready(function () {

    $('#search').DataTable();

});
</script>