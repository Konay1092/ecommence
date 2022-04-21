<?php
if(@$_SESSION['admin_id']=="")
{
echo "Page Not Found!!";
}
else
{
    require_once('function/update_process.php');
    require_once('head.php');
    
    if(@$_REQUEST['action']=='edit' && @$_REQUEST['editid']!="")
    {
        $edid=$_REQUEST['editid'];
        $selectadmin=mysqli_query($conn,"SELECT * FROM tbl_admin,user_role WHERE tbl_admin.userrole_id=user_role.userrole_id AND admin_id='$edid'");
        $radmin=mysqli_fetch_assoc($selectadmin);
    }
    
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
<h4 class="card-title">Edit Admin Info</h4>
</div>
<div class="card-body">
<form method="post">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Name</label>
<input type="text" class="form-control" value="<?php echo $radmin['adminname']; ?>" name="adminname">
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Email</label>
<input type="text" class="form-control" value="<?php echo $radmin['email']; ?>" name="email">
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>User Role</label>
<select class="form-control" name="userrole">


    <option value="<?php echo $radmin['userrole_id']; ?>"><?php echo $radmin['user_role']; ?></option>

    <?php
            $selectu=mysqli_query($conn,"SELECT * FROM user_role");
            while($rowuser=mysqli_fetch_assoc($selectu))
            {
        ?>
            <option value="<?php echo $rowuser['userrole_id']; ?>"><?php echo $rowuser['user_role']; ?></option>
        <?php
            }
        ?>
    
</select>
</div>
</div>
</div>

<button type="submit" class="btn btn-info btn-fill pull-right" name="btnupdate">Update</button>

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
