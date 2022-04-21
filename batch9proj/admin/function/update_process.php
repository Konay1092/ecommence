<?php
	if($_REQUEST['page']=='adminedit' && isset($_POST['btnupdate']))
	{
		$edit=$_REQUEST['editid'];
		$adminname=$_POST['adminname'];
		$email=$_POST['email'];
		$userrole=$_POST['userrole'];

		$updateadmin=mysqli_query($conn,"UPDATE tbl_admin SET adminname='$adminname',email='$email',userrole_id='$userrole' WHERE admin_id= '$edit'");
			if($updateadmin)
			{
				echo "<script>alert('Successfully Updated One Record!');
				window.location.href='index.php?page=RGio943%jnh';
				</script>";
			}
	}

	if($_REQUEST['page']=='productedit' && isset($_POST['btnupdate']))
	{
		$edit=$_REQUEST['editid'];
		$productcode=$_POST['pcode'];
		$productname=$_POST['pname'];
		$brandid=$_POST['brand'];
		$categoryid=$_POST['category'];
		$pdesc=$_POST['pdesc'];
		$oimage=$_POST['oldimage'];
		$pimage=$_FILES['pimage']['name'];
		$qty=$_POST['qty'];
		$price=$_POST['price'];

		if($pimage=="")
		{
			$inspd=mysqli_query($conn,"UPDATE tbl_product SET product_code='$productcode',product_name='$productname',brand_id='$brandid',category_id='$categoryid',p_detail='$pdesc',image='$oimage',qty='$qty',price='$price' WHERE product_id='$edit'");
			
		}
		else
		{
			$inspd=mysqli_query($conn,"UPDATE tbl_product SET product_code='$productcode',product_name='$productname',brand_id='$brandid',category_id='$categoryid',p_detail='$pdesc',image='$pimage',qty='$qty',price='$price' WHERE product_id='$edit'");
			move_uploaded_file($_FILES['pimage']['tmp_name'],'../photo/' . $pimage);
		}

		
			if($inspd)
			{
				echo "<script>alert('Successfully Updated!');
				window.location.href='index.php?page=productlist';
				</script>";
			}
		
	}
?>