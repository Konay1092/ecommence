<?php
	require_once('function/insert_process.php');
?>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<link href="login.css" type="text/css" rel="stylesheet"/>
<style type="text/css">
	.form_div input[type="button"]
	{
		width:230px;
		height:40px;
		border:none;
		border-radius:2px;
		font-size:17px;
		background-color:#7F8C8D;
		border-bottom:3px solid #616A6B;
		color:white;
		font-weight:bold;
	}
</style>

	<script type="text/javascript">
		function validateform(form)
		{
			var adminname=form.adminname.value;
			var email=form.email.value;
			var password=form.pswd.value;
			var cpassword=form.cpswd.value;
			var userrole=form.userrole.value;

			if(adminname == "")
			{
				alert("Please Enter Name");
				form.adminname.focus();
				return false;
			}
			if(email == "")
			{
				alert("Please Enter Email");
				form.email.focus();
				return false;
			}
			if(!(email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)))
       		{
		            alert("Please Enter Valid Email");
		            form.email.focus();
		            return false;
		     }
		     if(password == "")
			{
				alert("Please Enter Password");
				form.pswd.focus();
				return false;
			}
			if(cpassword == "")
			{
				alert("Please Enter Confirm Password");
				form.cpswd.focus();
				return false;
			}
			if(password != cpassword)
			{
				alert("Password are not same!");
				form.cpswd.focus();
				return false;
			}
			if(userrole == "")
			{
				alert("Please choose user role");
				form.userrole.focus();
				return false;
			}
			return true;
		}
	</script>
</head>
<body>
<div id="wrapper">
<br>
<br>
<br>
<div class="form_div">
<p class="form_label">SIGNUP FORM</p>
<form method="post" action="">
<p><input type="text" placeholder="Enter Name" name="adminname"></p>
<p><input type="text" placeholder="Enter Email" name="email"></p>
<p><input type="password" placeholder="Enter Password(eg.***)" name="pswd"></p>
<p><input type="password" placeholder="Enter Confirm Password" name="cpswd"></p>
<p>
	<select name="userrole" style="width:230px;height:40px;border-radius:2px;font-size:17px;padding-left:5px;border:none;">
		<option value="">Please Select User Role</option>
		<?php
			$selectu=mysqli_query($conn,"SELECT * FROM user_role");
			while($rowuser=mysqli_fetch_assoc($selectu))
			{
		?>
			<option value="<?php echo $rowuser['userrole_id']; ?>">
				<?php echo $rowuser['user_role']; ?>
					
				</option>
		<?php
			}
		?>
	</select>
</p>
<p><input type="submit" value="SIGNUP" name="btnsignup" onclick="return validateform(this.form)"></p>
<p><a href="index.php">Login</a></p>
</form>
</div>

</div>
</body>
</html>