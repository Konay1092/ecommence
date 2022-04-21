<?php
if(@$_SESSION['admin_id']=="")
{
echo "Page Not Found!!";
}
else
{
    require_once('function/insert_process.php');
    require_once('head.php');
    
    
?>
<body>

<div class="wrapper">

<?php
require_once('sidebar.php');
?>

<div class="main-panel">


<?php
require_once('navbar.php');
?>


<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card" style="padding:15px;">
<div class="card-header">
<h4 class="card-title">Add Brand Info</h4>
</div>
<div class="card-body">
<form method="post">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Brand Name</label>
<input type="text" class="form-control" name="brandname">
</div>
</div>
</div>


<button type="submit" class="btn btn-info btn-fill pull-right" name="btnsave">Save</button>

<div class="clearfix"></div>

</form>
</div>
</div>
</div>

</div>
</div>
</div>


<?php require_once('footer.php'); ?>

</div>
</div>


</body>

<?php require_once('jslink.php'); ?>

</html>

<?php
}
?>
