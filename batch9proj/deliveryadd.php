<?php
  //require_once('connection/db.php');
  //require_once('controller/cart_function.php');

  $uid = (!empty($_SESSION['customer_id']) ? $_SESSION['customer_id'] : "");
$uname = (!empty($_SESSION['cust_name']) ? $_SESSION['cust_name'] : "");

$sid = session_id();
$_SESSION['shop_return_url'] = urlencode($_SERVER['REQUEST_URI']);

$cid = (!empty($_GET['cid']) ? $_GET['cid'] : "");
 $icid = (!empty($_GET['icid']) ? $_GET['icid'] : "");

$msg = (!empty($_GET['ms']) ? $_GET['ms'] : "");

$url=$_SESSION['shop_return_url']=$_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

   <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <link rel="stylesheet" type="text/css" href="footer.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script type="text/javascript">
    function gotocheckout()
    {
      var custname = document.getElementById('customername').value;
      var email = document.getElementById('email').value;
      var phone = document.getElementById('phone').value;
      var address = document.getElementById('address').value;
      var pm = document.getElementById('pm').value;
      
      
      if (pm = 1)
      {
        
        window.location.href = "index.php?page=checkoutconfirm&custname="+custname + "&email=" + email + "&phone=" + phone + "&address=" + address + "&pm=" + pm;
       
      }
      
      if(pm = 2)
      {
        var ccname = document.getElementById('cc-name').value;
        var ccnumber = document.getElementById('cc-number').value;
        var ccexpire = document.getElementById('cc-expiration').value;
        var cccvv = document.getElementById('cc-cvv').value;

      }

      
    }
  </script>

</head>

<style type="text/css">
  .hide {
  display: none;
}
</style>
<body>

	  

  <!--Main layout-->
  <main class="mt-2 pt-4">
    <div class="container wow fadeIn">

      <!-- Heading -->
      <h2 class="my-5 h2 text-center">Checkout form</h2>

      <?php
$cartContent = getCartContent();
  $numProduct = count($cartContent);
  if ($numProduct > 0 ) {
?>

      <!--Grid row-->
      <div class="row">

        <h3 class="animated wow slideInLeft" data-wow-delay=".5s">Your shopping cart contains: <span><?php echo $numProduct; if($numProduct > 1) { ?> Products <?php }else {?> Product <?php } ?></span></h3>

        <!--Grid column-->
        <div class="col-md-8 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card content-->
<form class="card-body" action="index.php?page=confirmdelivery" method="post">

              <!--Grid row-->
              <div class="row">

                <!--Grid column-->
                <div class="col-md-6 mb-2">

                 

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-6 mb-2">


                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->
              <?php
              $sql="SELECT * FROM tbl_customer WHERE customer_id ='$uid'" ;
          $result = $conn->query($sql)or die($conn->error);
          $row = $result->fetch_assoc();
          

              ?>
              <!--Username-->
              <div class="md-form input-group pl-0 mb-5">
                <div class="input-group-prepend">
                 
                </div>
                <input type="text" class="form-control py-0" placeholder="Username" aria-describedby="basic-addon1" value="<?php echo $_SESSION['scus_name']=$row['customer_name']; ?>" id="customername">
              </div>

              <!--email-->
              <div class="md-form mb-5">
                <input type="text" id="email" class="form-control" placeholder="youremail@example.com" value="<?php echo $_SESSION['semail']=$row['email']; ?>" id="email">
                <label for="email" class="">Email (optional)</label>
              </div>

              <!--address-->
              <div class="md-form mb-5">
                <input type="text" id="phone" class="form-control" placeholder="09....">
                <label for="phone" class="">Shipping Phone</label>
              </div>

              <!--address-2-->
              <div class="md-form mb-5">
                <input type="text" id="address" class="form-control" placeholder="No...">
                <label for="address" class="">Shipping Address</label>
              </div>

             

              <hr>

              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="same-address" value="1" id="shipadd">
                <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
              </div>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="save-info" value="1" id="savenext">
                <label class="custom-control-label" for="save-info">Save this information for next time</label>
              </div>

              <hr>
              <script type="text/javascript">
                function show1(){
  document.getElementById('div1').style.display ='none';
}
function show2(){
  document.getElementById('div1').style.display = 'block';
}
              </script>

              <div class="d-block my-3">
                <div class="custom-control custom-radio">


<input type="radio" id="pm" name="pm" value="1" onclick="show1();" />
Cash On Delivery
<input type="radio" id="pm" name="pm" value="2" onclick="show2();" />
Credit
<input type="radio" id="pm" name="pm" value="3" onclick="show2();" />
Visa
<div id="div1" class="hide">
  <hr>
 <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="cc-name">Name on card</label>
                  <input type="text" class="form-control" id="cc-name" placeholder="" required>
                  <small class="text-muted">Full name as displayed on card</small>
                  <div class="invalid-feedback">
                    Name on card is required
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="cc-number">Credit card number</label>
                  <input type="text" class="form-control" id="cc-number" placeholder="" required>
                  <div class="invalid-feedback">
                    Credit card number is required
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 mb-3">
                  <label for="cc-expiration">Expiration</label>
                  <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                  <div class="invalid-feedback">
                    Expiration date required
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="cc-expiration">CVV</label>
                  <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                  <div class="invalid-feedback">
                    Security code required
                  </div>
                </div>
              </div>
</div>

<p></p>

  
                </div>
               
              </div>
             
              <hr class="mb-4">
             <!--  <button class="btn btn-primary btn-lg btn-block" type="submit" name="btncheckout">Continue to checkout</button> -->
              <a class="btn btn-primary btn-lg btn-block" onclick="gotocheckout()">Continue to checkout</a>
            </form>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-4 mb-4">

          <!-- Heading -->
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill"><?php echo $numProduct;?></span>
          </h4>

          <!-- Cart -->
          <ul class="list-group mb-3 z-depth-1">
             <?php
            $subTotal=0;
            for($i=0;$i<$numProduct;$i++)
            {
              extract($cartContent[$i]);
              //$subTotal+=$cunit*$ctqty;

          ?>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0"><?php echo $product_name;?></h6>
                <small class="text-muted"><?php echo $p_detail; ?></small>
              </div>
              <span class="text-muted"><?php echo $cart_price;?> <b>MMK</b></span>

            </li>
            <?php
              }
            ?>
            <?php
          $sql="SELECT SUM(alltotal) FROM tbl_cart WHERE cart_session_id ='$sid'" ;
          $result = $conn->query($sql)or die($conn->error);
          while ($row = $result->fetch_assoc())
          {
            $mmktotal=$row['SUM(alltotal)'];
            $mmktotall=number_format($row['SUM(alltotal)']);
            $_SESSION['alltotal']=$mmktotal;
          }
          ?>
            <li class="list-group-item d-flex justify-content-between lh-condensed"><p>Total :</p>
              <span class="text-muted"><?php echo $mmktotall;?> <b>MMK</b></span>
            </li>
          </ul>
          <!-- Cart -->

          <!-- Promo code -->
          <form class="card p-2" action="">
            <div class="input-group">
             
              <div class="input-group-append">
                <!-- <button class="btn btn-secondary btn-md waves-effect m-0" type="button">Go To Cart</button> -->
                <a href="index.php?page=cart" class="btn btn-secondary btn-md waves-effect m-0">Go To Cart</a>
                </div>
            </div>
          </form>
          <!-- Promo code -->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->
      <?php
        }
      ?>

    </div>
  </main>
  <!--Main layout-->

</body>
</html>