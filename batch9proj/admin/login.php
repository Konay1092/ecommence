<?php
	
	require_once('function/login_process.php');
?>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<link href="login.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<div id="wrapper">

<br>
<br>
<br>
<div class="form_div">
<p class="form_label">LOGIN FORM</p>
<form method="post" action="">
<p><input type="text" name="email" placeholder="Enter Email" required></p>
<p><input type="password" name="pswd" placeholder="**********" required></p>
<p><input type="submit" value="LOGIN" name="btnlogin"></p>
<p>
	If you don't have an account, <a href="index.php?page=register">Register Here!!</a>
</p>
<p>
	<a href="index.php?page=forget">Forget Password!!</a>
</p>
</form>
</div>
<br>
<br>
<br>


</div>
</body>
</html>