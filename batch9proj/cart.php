<?php
//require_once('connection/db.php');
//require_once('header.php');
//require_once('function/cart_function.php');


$cust_id = (!empty($_SESSION['customer_id']) ? $_SESSION['customer_id'] : "");
$cust_name = (!empty($_SESSION['customer_name']) ? $_SESSION['customer_name'] : "");
	//$cust_sts = (!empty($_SESSION['status']) ? $_SESSION['status'] : "");


$sid = session_id();



// $msg = (!empty($_GET['ms']) ? $_GET['ms'] : "");
// $shoppingReturnUrl = isset($_SESSION['shop_return_url']) ? $_SESSION['shop_return_url'] : '../index.php';

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : 'view';

$url=$_SESSION['shop_return_url'];

// add portion
if(@$_REQUEST['action']=='checkout')
{
	
			print "<script language=\"JavaScript\">window.location.href='index.php?page=deliveryadd';</script>";


	
}

if(isset($_REQUEST['btncal']))
{
	updateCart($conn);
}

switch ($action)
{
	case 'add' :
	addToCart($conn);
	break;
	case 'update' :
	//echo $_SESSION['itmid']."++++++++";
	updateCart();
	break;
	case 'delete':
	deleteFromCart($cartid = 0, $conn);
	break;
	case 'view' :
}



 ?>
<!DOCTYPE html>
<html>
<head>
<title> Shoping Cart Design Using Bootstrap 4.0 </title>
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="custom.css">
<style type="text/css">
	.Product-img img{
width: 100%;
}
.main-section{
font-family: 'Roboto Condensed', sans-serif;
margin-top:100px;
}
</style>
</head>
<!-- //breadcrumbs -->
<!-- checkout -->

<?php

 // $typequan = $_REQUEST['typequan'];
 // $stqu = $_REQUEST['stqu'];
 // $itname = $_REQUEST['itname'];

 $typequan = (!empty($_REQUEST['typequan']) ? $_REQUEST['typequan'] : "");
 $stqu = (!empty($_REQUEST['stqu']) ? $_REQUEST['stqu'] : "");
 $itname = (!empty($_REQUEST['itname']) ? $_REQUEST['itname'] : "");

$cartContent = getCartContent();
  $numProduct = count($cartContent);
  if ($numProduct > 0 ) {
?>


	<div class="container main-section">
  <form action="index.php?page=cart&action=update" method="post" name="frmCart" id="frmCart" onSubmit="return true">
		<div class="container">

      <div class="grid_5 grid_5 animated wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="500ms">
        <?php if($typequan == ''){ } else { ?>
        <div class="alert alert-danger" style="font-size: 20px;">
        <strong>Oh snap!</strong> We have currently ( <?php echo $stqu; ?> ) qty in <?php echo $itname; ?> in stock. You type quantity is ( <?php echo $typequan; ?> ) qty.
        </div>
        <?php } ?>
      </div>

			<div class="row">
<div class="col-lg-12 pb-2">
<h4>Shoping Cart Design Using Bootstrap 4.0</h4>
</div>


				<div class="col-lg-12 pl-3 pt-3">
<table class="table table-hover border bg-white">
					<thead>
							<tr>
							<th>Product</th>
							<th>Price</th>
							<th style="width:10%;">Quantity</th>
							<th>Subtotal</th>
							<th>Action</th>
							</tr>
					</thead>

          <?php
          	// $subTotal=0;
          	for($i=0;$i<$numProduct;$i++)
          	{
          		extract($cartContent[$i]);
          		//$subTotal+=$cunit*$ctqty;

          ?>

          <tbody>
<tr>
<td>
<div class="row">
<div class="col-lg-2 Product-img">
<img src="photo/<?php echo $image; ?>" alt="..." class="img-responsive"/>
</div>
<div class="col-lg-10">
<h4 class="nomargin"><?php echo $product_name;?></h4>
<p><?php echo $p_detail; ?></p>
</div>
</div>
</td>
<td> <?php echo $cart_price; ?> </td>
<td data-th="Quantity">
<input type="number" class="form-control text-center" value="<?php echo $cart_qty; ?>" name="txtQty[]" id="txtQty[]">
</td>
<td><?php echo $alltotal; ?></td>
<td class="actions" data-th="" style="width:10%;">

<button class="btn btn-info btn-sm" name="btncals"><i class="fa fa-refresh"></i></button>

		<input name="hidCartId[]" type="hidden" value="<?php echo $cart_id; ?>" />
    <input name="hidProductId[]" type="hidden" value="<?php echo $product_id; ?>" />
              
              <a href="index.php?page=cart&action=delete&cid=<?php echo $cart_id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>

<!--<button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>-->
</td>
</tr>

</tbody>

<?php 
		}
 ?>

<tfoot>
<tr>
<td><a href="index.php?pg=productlist.php" class="btn btn-warning text-white"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
<td colspan="2" class="hidden-xs"></td>
 <?php
          $sql="SELECT SUM(alltotal) As GrandTotal FROM tbl_cart WHERE cart_session_id ='$sid'" ;
          $result = $conn->query($sql)or die($conn->error);
          $rowgrand=$result->fetch_assoc();
          $mmkgrandtotal=number_format($rowgrand['GrandTotal']);
          // while ($row = $result->fetch_assoc())
          // {
          //   //$mmktotal=$row['SUM(alltotal)'];
          //   $mmktotall=number_format($row['SUM(alltotal)']);
          //   //$_SESSION['alltotal']=$mmktotal;
          // }
          ?>
<td class="hidden-xs text-center" style="width:10%;"><strong>Total : <?php echo $mmkgrandtotal; ?></strong></td>
<td>
	<a href="index.php?page=cart&action=checkout" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a>
	
<!--<button class="btn btn-success btn-block">Checkout<i class="fa fa-angle-right" name="btncheckout"></i></button>-->

</td>
</tr>
</tfoot>
</table>


					
				</table>
			</div>
        </form>

			</div>

  		<!-- <form method="post">
        <div class="col-md-6 mail-grid-left animated wow slideInLeft" data-wow-delay=".5s">
  		 	<input type="submit" name="btnbuy" value="Buy Now">&nbsp;
          <a href="index.php?page=product"><input type="button" name="" value="<  Continue Shopping" class="btn btn-primary"></a>
        </div>
  		 </form>-->



			<!--	<div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
					<a href="index.php?page=product"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue Shopping</a>
				</div>&nbsp;-->


				<div class="clearfix"> </div>
			</div>
		</div>

	</div>
<!-- //checkout -->

<?php } ?>
<!-- footer -->

