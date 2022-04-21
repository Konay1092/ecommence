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
			
				<h3>Brand List
					<a style="float: right;margin-bottom: 12px;" class="btn btn-primary" href="index.php?page=brandentry">Add</a>
				</h3>

			
			<div class="col-sm-12">
				
				<table border="1" class="table">
					<tr>
						<th>Admin No</th>
						<th>Admin Name</th>
						<th>Email</th>
						<th>User Role</th>
						<th>Registration Date</th>
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
					$sadmin=mysqli_query($conn,"SELECT * FROM tbl_admin,user_role WHERE tbl_admin.userrole_id=user_role.userrole_id Order By admin_id");
					while($dtrecord=mysqli_fetch_assoc($sadmin))
						{
					?>

						<tr>
							<td><?php echo $dtrecord['admin_id']; ?></td>
							<td><?php echo $dtrecord['adminname']; ?></td>
							<td><?php echo $dtrecord['email']; ?></td>
							<td><?php echo $dtrecord['user_role']; ?></td>
							<td><?php echo $dtrecord['reg_date']; ?></td>

							<?php
							if($_SESSION['userrole']=='1')
							{
							?>
							<td>
								<a href="index.php?page=adminedit&action=edit&editid=<?php echo $dtrecord['admin_id']; ?>">Edit
								</a> 
								| 
								<a style="cursor:pointer;" onclick="deleteconfirm(<?php echo $dtrecord['admin_id']; ?>)">Delete
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