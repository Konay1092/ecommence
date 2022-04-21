<?php
	if(isset($_POST['btnlogin']))
	{
		$email=$_POST['email'];
		$pswd=$_POST['pswd'];
		$rqrul=$_SESSION['shop_return_url'];


		$select=mysqli_query($conn,"SELECT * FROM tbl_customer WHERE email='$email' AND cust_password='$pswd'");
		$dtrow=mysqli_num_rows($select);
		$dtrecord=mysqli_fetch_assoc($select);
		

		if($dtrow>0)
		{
			if (@$dtrecord['status']==0)
			{
				echo "<script>alert('Your Account Has Expired!!');
				window.location.href='index.php?page=login';
				</script>";

			}
			else
			{
				$_SESSION['customer_id']=$dtrecord['customer_id'];
			$_SESSION['customer_name']=$dtrecord['customer_name'];
			// $_SESSION['status']=$dtrecord['status'];

			if($rqrul!="")
			{
				echo "<script>
			window.location.href='$rqrul';</script>";
			}
			else
			{
				echo "<script>
			window.location.href='index.php?page=home';
			</script>";
			}
			}
			
			
		} 
		else
		{
			echo "<script>alert('Email Or Password does not Match!');
			window.location.href='index.php?page=login';
			</script>";
		}
	}
?>