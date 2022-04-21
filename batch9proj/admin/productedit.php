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
        $selectadmin=mysqli_query($conn,"SELECT * FROM tbl_product,tbl_brand,tbl_category WHERE tbl_product.brand_id=tbl_brand.brand_id AND tbl_product.category_id=tbl_category.category_id AND product_id='$edid'");
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
<form method="post" enctype="multipart/form-data">

<div class="row">
<div class="col-md-12">
<div class="form-group">
    <p><img src="../photo/<?php echo $radmin['image']; ?>" width="200" height="200"></p>
    <input type="hidden" name="oldimage" value="<?php echo $radmin['image']; ?>">
<label>Choose Iamge:</label>
<input type="file" class="form-control" name="pimage">
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Product Code</label>
<input type="text" class="form-control" value="<?php echo $radmin['product_code']; ?>" name="pcode">
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Product Name</label>
<input type="text" class="form-control" value="<?php echo $radmin['product_name']; ?>" name="pname">
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Brand</label>
<select class="form-control" name="brand">


    <option value="<?php echo $radmin['brand_id']; ?>"><?php echo $radmin['brand']; ?></option>

    <?php
            $selectu=mysqli_query($conn,"SELECT * FROM tbl_brand");
            while($rowuser=mysqli_fetch_assoc($selectu))
            {
        ?>
            <option value="<?php echo $rowuser['brand_id']; ?>"><?php echo $rowuser['brand']; ?></option>
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
<label>Category</label>
<select class="form-control" name="category">


    <option value="<?php echo $radmin['category_id']; ?>"><?php echo $radmin['category']; ?></option>

    <?php
            $selectc=mysqli_query($conn,"SELECT * FROM tbl_category");
            while($rowc=mysqli_fetch_assoc($selectc))
            {
        ?>
            <option value="<?php echo $rowc['category_id']; ?>"><?php echo $rowc['category']; ?></option>
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
<textarea class="form-control" name="pdesc"><?php echo $radmin['p_detail']; ?></textarea>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Quantity</label>
<input type="text" class="form-control" value="<?php echo $radmin['qty']; ?>" name="qty">
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Price</label>
<input type="text" class="form-control" value="<?php echo $radmin['price']; ?>" name="price">
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
