<?php
	require_once('head.php');

	if(@$_REQUEST['did']!="" && @$_REQUEST['action']=='delete')
	{
		$delete_id=$_REQUEST['did'];
		$d=mysqli_query($conn,"DELETE FROM tbl_product WHERE product_id = '$delete_id'");
		if($d)
		{
			echo "<script>alert('Successfully Deleted One Record!!');
			window.location.href='index.php?page=productlist'</script>";
		}
	}
?>
<!-- bootstrap table -->
	
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--------------------->
<body>

<div class="wrapper">

<?php
    require_once('sidebar.php');
?>

<div class="main-panel">


<?php
    require_once('navbar.php');
?>

	<script type="text/javascript">
		function deleteconfirm(productid)
		{
			var c=confirm("Are you sure you want to delete?");

			if(c)
			{
				window.location.href="index.php?page=productlist&action=delete&did=" + productid;
			}
		}
	</script>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			
				<h3>Product List
					<a style="float: right;margin-bottom: 12px;" class="btn btn-primary" href="index.php?page=productentry">Add</a>
				</h3>
			
			<div class="col-sm-12">
				
				<table border="1" class="table">
					<tr>
						<th>Image</th>
						<th>Product Code</th>
						<th>Product Name</th>
						<th>Brand</th>
						<th>Category</th>
						<th>qty</th>
						<th>price</th>
						<?php
						if($_SESSION['userrole']=='1')
						{
						?>
						<th>Action</th>
						<?php
						}
						?>
					</tr>

					<?php
					$saprod=mysqli_query($conn,"SELECT * FROM tbl_product,tbl_brand,tbl_category WHERE tbl_product.brand_id=tbl_brand.brand_id AND tbl_product.category_id=tbl_category.category_id Order By tbl_product.reg_date DESC");
					while($dtrecord=mysqli_fetch_assoc($saprod))
						{
					?>

						<tr>
							<td align="center">
								<img src="../photo/<?php echo $dtrecord['image']; ?>" width="100" height="100">
							</td>
							<td><?php echo $dtrecord['product_code']; ?></td>
							<td><?php echo $dtrecord['product_name']; ?></td>
							<td><?php echo $dtrecord['brand']; ?></td>
							<td><?php echo $dtrecord['category']; ?></td>
							<td><?php echo $dtrecord['qty']; ?></td>
							<td><?php echo $dtrecord['price']; ?></td>

							<?php
							if($_SESSION['userrole']=='1')
							{
							?>
							<td>
								<a href="index.php?page=productedit&action=edit&editid=<?php echo $dtrecord['product_id']; ?>">Edit
								</a> 
								| 
								<a style="cursor:pointer;" onclick="deleteconfirm(<?php echo $dtrecord['product_id']; ?>)">Delete
								</a>
							</td>
							<?php
								}
							?>
						</tr>
					<?php
						}
					?>

				</table>
  				
			</div>
		</div>
	</div>
</div>

</body>
</html>