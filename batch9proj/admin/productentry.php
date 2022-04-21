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
<h4 class="card-title">Add Product Info</h4>
</div>
<div class="card-body">
<form method="post" enctype="multipart/form-data">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Product Code</label>
<input type="text" class="form-control" name="pcode">
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Product Name</label>
<input type="text" class="form-control" name="pname">
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Brand Name</label>
<select class="form-control" name="brand">
    <option value="">Please Select Brand Name</option>
        <?php
            $selectu=mysqli_query($conn,"SELECT * FROM tbl_brand");
            while($rowuser=mysqli_fetch_assoc($selectu))
            {
        ?>
            <option value="<?php echo $rowuser['brand_id']; ?>">
                <?php echo $rowuser['brand']; ?>
                    
                </option>
        <?php
            }
        ?>
</select>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Category Name</label>
<select class="form-control" name="category">
    <option value="">Please Select Category Name</option>
        <?php
            $selectc=mysqli_query($conn,"SELECT * FROM tbl_category");
            while($rowcat=mysqli_fetch_assoc($selectc))
            {
        ?>
            <option value="<?php echo $rowcat['category_id']; ?>">
                <?php echo $rowcat['category']; ?>
                    
                </option>
        <?php
            }
        ?>
</select>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Description</label>
<textarea class="form-control" name="pdesc"></textarea>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Choose Iamge:</label>
<input type="file" class="form-control" name="pimage">
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Quantity</label>
<input type="number" class="form-control" name="qty">
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Price</label>
<input type="number" class="form-control" name="price">
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
