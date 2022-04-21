<?php

	if(isset($_POST['btnlogin']))
	{
		$email=$_POST['email'];
		$pswd=$_POST['pswd'];

		$select=mysqli_query($conn,"SELECT * FROM tbl_admin WHERE email='$email' AND admin_password='$pswd'");
		$dtrow=mysqli_num_rows($select);
		$dtrecord=mysqli_fetch_assoc($select);

		if($dtrow>0)
		{
			$_SESSION['admin_id']=$dtrecord['admin_id'];
			$_SESSION['admin_name']=$dtrecord['adminname'];
			$_SESSION['userrole']=$dtrecord['userrole_id'];

			echo "<script>
			window.location.href='index.php?page=home';
			</script>";

			// $npswd=rand(2,100);
			// $mailbody= "<p>Dear .....</p>";
			// $mailbody.= "Your new password is " . $npswd;

			// mail($email,"New Password",$mailbody,'aimt.institute@gmail.com');

		}

		else
		{
			echo "<script>alert('Email Or Password Does Not Match');
			window.location.href='index.php';
			</script>";
		}
	}
?>