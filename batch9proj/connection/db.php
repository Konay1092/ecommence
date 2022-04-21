<?php
	$conn=mysqli_connect('localhost','root','','online_shopdb');
	if(!$conn)
	{
		echo mysqli_error();
	}
?>