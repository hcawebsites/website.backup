<?php include_once ('admin/main_head.php');?>
<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <i class="fa fa-times" aria-hidden="true"></i>
        </button>
    <p><?php echo $_GET['error']; ?></p>
    </div>
<?php endif ?>

<?php if(isset($_GET['info'])): ?>
    <div class="alert alert-success text-center"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <i class="fa fa-times" aria-hidden="true"></i>
        </button>
        <p><?php echo $_GET['info']; ?></p>
    </div>
<?php endif?>