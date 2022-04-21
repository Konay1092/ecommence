<?php
	require_once('head.php');

	if(@$_REQUEST['did']!="" && @$_REQUEST['action']=='delete')
	{
		$delete_id=$_REQUEST['did'];
		$d=mysqli_query($conn,"DELETE FROM tbl_admin WHERE admin_id = '$delete_id'");
		if($d)
		{
			echo "<script>alert('Successfully Deleted One Record!!');
			window.location.href='index.php?page=RGio943%jnh'</script>";
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
		function deleteconfirm(adminid)
		{
			$c=confirm("Are you sure you want to delete?");

			if($c)
			{
				window.location.href="index.php?page=RGio943%jnh&action=delete&did=" + adminid;
			}
		}
	</script>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			
				<h3>Order List</h3>
			
			<div class="col-sm-12">
				
				<table id="myTable" class="table table-striped table-bordered table-responsive table-hover" >  
        <thead>  
          <tr>  
            <th>Order Date</th>
            <th>Customer Name</th>
            <th>All Total Amount</th>
            <th>Total Item</th>
            <th>Action</th>
          </tr>  
        </thead>  
        <tbody> 
        <?php
          $selectorder=mysqli_query($conn,"SELECT o.order_id,o.order_date,c.customer_name,o.alltotal_amount,o.totalqty FROM tbl_order AS o, tbl_customer AS c WHERE o.customer_id = c.customer_id ORDER BY order_date DESC");
          while($roworder=mysqli_fetch_assoc($selectorder))
          {
        ?> 
          <tr>  
            <td><?php echo $roworder['order_date']; ?></td>  
            <td><?php echo $roworder['customer_name']; ?></td> 
            <td><?php echo $roworder['alltotal_amount']; ?></td>  
            <td><?php echo $roworder['totalqty']; ?></td>
            <td>
<a href="index.php?page=orderlistdetail&or_id=<?php echo $roworder['order_id']; ?>" title="View">View</a>
            </td>  
          </tr>
          <?php
          }
          ?>  
           
        </tbody>  
      </table>
  				
			</div>
		</div>
	</div>
</div>

</body>
</html>