<?php
	if($_REQUEST['page']=='register' && isset($_POST['btnsignup']))
	{
		$adminname=$_POST['adminname'];
		$email=$_POST['email'];
		$pswd=$_POST['pswd'];
		$cpswd=$_POST['cpswd'];
		$userrole=$_POST['userrole'];

		$selectadmin=mysqli_query($conn,"SELECT * FROM tbl_admin WHERE email='$email'");
		$dtrow=mysqli_num_rows($selectadmin);

		if($dtrow>0)
		{
			echo "<script>alert('Admin Email is already registered!!');
			window.location.href='index.php?page=register';
			</script>";
		}

		else
		{
			$ins=mysqli_query($conn,"Insert into tbl_admin(adminname,email,admin_password,confirm_password,userrole_id) Values('$adminname','$email','$pswd','$cpswd',$userrole)");
			if($ins)
			{
				echo "<script>alert('Successfully Register!');
				window.location.href='index.php';
				</script>";
			}
		}
	}

	// add prodcut //

	if($_REQUEST['page']=='productentry' && isset($_POST['btnsave']))
	{
		$productcode=$_POST['pcode'];
		$productname=$_POST['pname'];
		$brandid=$_POST['brand'];
		$categoryid=$_POST['category'];
		$pdesc=$_POST['pdesc'];
		$pimage=$_FILES['pimage']['name'];
		$qty=$_POST['qty'];
		$price=$_POST['price'];

		$selectpd=mysqli_query($conn,"SELECT * FROM tbl_product WHERE product_code='$productcode'");
		$dtrow1=mysqli_num_rows($selectpd);

		if($dtrow1>0)
		{
			echo "<script>alert('This Product is already Saved!!');
			window.location.href='index.php?page=productentry';
			</script>";
		}

		else
		{

			$inspd=mysqli_query($conn,"Insert into tbl_product(product_code,product_name,brand_id,category_id,p_detail,image,qty,price) Values('$productcode','$productname','$brandid','$categoryid','$pdesc','$pimage','$qty','$price')");
move_uploaded_file($_FILES['pimage']['tmp_name'],'../photo/' . $pimage);

			
			if($inspd)
			{
				echo "<script>alert('Successfully Saved!');
				window.location.href='index.php?page=productlist';
				</script>";
			}
		}
	}
	// end product //

	
?>