<?php
	$pgname=@$_REQUEST['page'];

	switch($pgname)
	{
		case 'register':
		$mainpage='register.php';
		break;

		case 'forget':
		$mainpage='forgetpass.php';
		break;

		case 'home':
		$mainpage='home.php';
		break;

		case 'logout':
		$mainpage='logout.php';
		break;

		case 'RGio943%jnh';
		$mainpage='adminlist.php';
		break;

		case 'adminedit';
		$mainpage='adminedit.php';
		break;

		case 'brandlist';
		$mainpage='brandlist.php';
		break;

		case 'brandentry';
		$mainpage='brandentry.php';
		break;

		case 'categorylist';
		$mainpage='categorylist.php';
		break;

		case 'productlist';
		$mainpage='productlist.php';
		break;

		case 'productentry';
		$mainpage='productentry.php';
		break;

		case 'productedit';
		$mainpage='productedit.php';
		break;

		case 'orderlist';
		$mainpage='orderlist.php';
		break;

		case 'orderlistdetail';
		$mainpage='orderlistdetail.php';
		break;

		default:
		$mainpage='login.php';
	}

	
?>