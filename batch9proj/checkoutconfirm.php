<?php
 
 require_once('function/insert_process.php');
// require_once('controller/send_confirmemail.php');



$uid = (!empty($_SESSION['customer_id']) ? $_SESSION['customer_id'] : "");
$uname = (!empty($_SESSION['customername']) ? $_SESSION['customername'] : "");


$sid = session_id();
$_SESSION['shop_return_url'] = urlencode($_SERVER['REQUEST_URI']);

$cid = (!empty($_GET['cid']) ? $_GET['cid'] : "");
 $icid = (!empty($_GET['icid']) ? $_GET['icid'] : "");

// $msg = (!empty($_GET['ms']) ? $_GET['ms'] : "");
// $shoppingReturnUrl = isset($_SESSION['shop_return_url']) ? $_SESSION['shop_return_url'] : '../index.php';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : 'view';

$url=$_SESSION['shop_return_url'];


 $customername = $_REQUEST['custname'];
 $email = $_REQUEST['email'];
 $phone = $_REQUEST['phone'];
 $address = $_REQUEST['address'];
 $pm = $_REQUEST['pm'];
 



 ?>
<!-- breadcrumbs -->


<!-- <input type="hidden" name="payment" value="<?php echo $payment; ?>"> -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="footer.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<!--<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>-->
				<li class="active">Confirm Checkout!!</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- checkout -->

<div class="jumbotron text-center">
  <h1 class="display-3">Thank You!</h1>
  <p class="lead"><strong>Please check your email</strong> for further instructions on how to complete your account setup.</p>
  <hr>
  <p>
    Having trouble? <a href="">Contact us</a>
  </p>
  <p class="lead">
    <a class="btn btn-primary btn-sm" href="index.php" role="button">Continue to homepage</a>
  </p>
</div>

<?php
$cartContent = getCartContent();
  $numProduct = count($cartContent);
  if ($numProduct > 0 ) {
?>
	<div class="checkout">
  <form method="post" >
		<div class="container">
			<h3 class="animated wow slideInLeft" data-wow-delay=".5s">Your shopping cart contains: <span><?php echo $numProduct; if($numProduct > 1) { ?> Products <?php }else {?> Product <?php } ?></span></h3>
			<div class="checkout-right animated wow slideInUp" data-wow-delay=".5s">

        <input type="hidden" name="customername" value="<?php echo $customername; ?>">
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <input type="hidden" name="phone" value="<?php echo $phone; ?>">
        <input type="hidden" name="address" value="<?php echo $address; ?>">
        <input type="hidden" name="pm" value="<?php echo $pm; ?>">
        
				<table class="table">
					<thead>
						<tr>
							<th>Product Name</th>
							<th>Product</th>
							<!-- <th>Quality</th>
							<th>Add</th>-->
							<th>Item Price</th>
							<th>Total Price</th>
							<!-- <th>Remove</th> -->
						</tr>
					</thead>

          
           
          <?php
          	$subTotal=0;
          	for($i=0;$i<$numProduct;$i++)
          	{
          		extract($cartContent[$i]);
          		//$subTotal+=$cunit*$ctqty;

          ?>


					<tr class="rem1">
						<td class="invert"><?php echo $product_name;?></td>
						<td><a href="single.html"><img src="photo/<?php echo $image; ?>" alt=" " width="100px" height="90px" /></a></td>



						<td class="invert"><?php echo $cart_price; ?></td>
						<td class="invert"><?php  echo $alltotal; ?></td>

					</tr>
					<?php } ?>


								<!--quantity-->
									<script>
									$('.value-plus').on('click', function(){
										var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
										divUpd.text(newVal);
									});

									$('.value-minus').on('click', function(){
										var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
										if(newVal>=1) divUpd.text(newVal);
									});
									</script>
								<!--quantity-->
				</table>
        </form>

			</div>
			<div class="checkout-left">
				<div class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">
					<h4>Continue to basket</h4>

          <?php
          

          ?>

          <?php
          $sql="SELECT SUM(alltotal) FROM tbl_cart WHERE cart_session_id ='$sid'" ;
          $result = $conn->query($sql)or die($conn->error);
          while ($row = $result->fetch_assoc())
          {
            
            $mmktotal=$row['SUM(alltotal)'];
            $mmktotall=number_format($row['SUM(alltotal)']);

          }
          ?>
					<ul>
					
						<li>Total Order Amount<i>-</i> <span><?php


                echo  $mmktotal=$mmktotal;


             // }
             ?></span></li>
            
            

					</ul>
          <input type="hidden" name="mtotal" value="<?php echo $mmktotal;?>">
				</div>

        <div class="col-md-6 mail-grid-left animated wow slideInLeft" data-wow-delay=".5s">


            <input type="submit" class="btn btn-primary w-3" value="Order Confirm" name="confirmorder">&nbsp;

            <input type="submit" value="Cancel" name="deleteorder">

        </div>


        </form>
			</div>
		</div>


<!-- //checkout -->

<?php } ?>



  </div>
</html>
