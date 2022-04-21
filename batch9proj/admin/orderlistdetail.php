<?php
    require_once('function/cart_function.php');
    require_once('function/order_invoice.php');
	require_once('head.php');

	if(@$_REQUEST['did']!="" && @$_REQUEST['action']=='delete')
	{
		$delete_id=$_REQUEST['did'];
		$d=mysqli_query($conn,"DELETE FROM tbl_admin WHERE admin_id = '$delete_id'");
		if($d)
		{
			echo "<script>alert('Successfully Deleted One Record!!');
			window.location.href='index.php?page=RGio943%jnh'</script>";
		}
	}
?>
<!-- bootstrap table -->
	
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--------------------->
<body>

<div class="wrapper">

<?php
    require_once('sidebar.php');
?>

<div class="main-panel">


<?php
    require_once('navbar.php');
?>

	<script type="text/javascript">
		function deleteconfirm(adminid)
		{
			$c=confirm("Are you sure you want to delete?");

			if($c)
			{
				window.location.href="index.php?page=RGio943%jnh&action=delete&did=" + adminid;
			}
		}
	</script>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			
			<div class="col-sm-12">
				
				<!-- start Order List Detail -->
   <form method="post">
    <div class="content-wrapper">
        <section class="content-header">
            <h3>
              Order Invoice Send
              <!--<small>advanced tables</small>-->
            </h3>
        </section>
        <?php
        $or_id = (string) $_GET['or_id'];
        //$d = date('Y-m-d');
        $t = time();

        $stmt = $conn->stmt_init();

      $stmt->prepare("SELECT c.customer_name,o.customer_id,o.order_id, o.order_date, o.delivered_date1, o.order_email, o.remark, o.totalqty, o.alltotal_amount, o.payment_id, o.order_status, p.payment_type, s.shipping_address, s.shipping_phone FROM tbl_order AS o, tbl_payment AS p, tbl_shipping AS s, tbl_customer AS c WHERE o.order_id=? AND o.order_id = s.order_id AND o.customer_id = c.customer_id");

        $stmt->bind_param("i", $or_id);
        $stmt->execute() or die($stmt->error);
        $stmt->bind_result($customer_name, $customer_id, $order_id, $order_date, $delivered_date1, $order_email, $remark, $totalitem, $alltotal_amount, $payment_id, $order_status, $payment_type, $shipping_address, $shipping_phone);

        $i = 1;
        $stmt->fetch();
      //  {
        ?>
        <section class="">
          <div class="row">
            <div class="">
                <div class="col-sm-12">
                    <input type="hidden" name="cusname" value="<?php echo $customer_name; ?>">
                    <input type="hidden" name="custid" value="<?php echo $customer_id; ?>">
                    <div class="form-group">
                        <label>Order No</label>

                        <input type="text" name="orderno" class="form-control" required="required" value="<?php echo $order_id; ?>">

                    </div>
                    <div class="form-group">
                        <label>Order Date</label>

                        <input type="text" name="orderdate" class="form-control" required="required" value="<?php echo $order_date; ?>">

                      </div>

                      <div class="form-group">
                        <label>Customer Email</label>

                        <input type="text" name="custoemail" class="form-control" required="required" value="<?php echo $order_email; ?>">

                      </div>

                      <div class="form-group">
                        <label>Confirm Date</label>

                        <input type="text" name="incoivedate" class="form-control" value="<?php echo $delivered_date1; ?>" Disabled>

                      </div>

                      <div class="form-group">
                        <label>Remark</label>

                       <textarea class="form-control" name="remark"><?php echo $remark;?></textarea>

                      </div>

                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                   <label>Shipping Address</label>

                   <input type="text" name="shipaddress" class="form-control" value="<?php echo $shipping_address; ?>">

                 </div>

                 
                 <div class="form-group">
                   <label>Phone No</label>

                   <input type="text" name="shippnno" class="form-control" value="<?php echo $shipping_phone; ?>">

                 </div>
                </div>

            </div>
           </div>
       </section>
       
       <section class="content" >
          <div class="row">
             <div class="col-sm-12">
                <div class="box">
                    <div class="box-body">
                        <table  class="table">
                <thead>
                  <tr>
                    <th>Total Item</th>
                    <th>All Total</th>
                    <th>Payment Type</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $totalitem; ?></td>
                   <!-- <td><?php //echo $weight_fee; ?><input type="hidden" name="shipfee" value="<?php //echo $weight_fee; ?>"></td>-->
                    <td><?php echo $alltotal_amount; ?><input type="hidden" name="totalamo" value="<?php echo $alltotal_amount; ?>"></td>
                    <td><?php echo $payment_type; ?></td>

                    <td><?php
                    if($order_status==1)
                    {
                    echo "<font color=\"red\">Delivered!!</font>";
                    }
                    else
                    {
                    echo "<font color=\"#06F\">Confirm</font>";
                     }
                     ?>

                    </td>

                  </tr>
                </tbody>
                 <tfoot>
                  <tr>
                    <th>Total Item</th>
                    <th>All Total</th>
                    <th>Payment Type</th>
                    <th>Status</th>
                  </tr>
                </tfoot>
              </table>
                    </div>
                </div>

                <div class="box">
                    <div class="box-body">
                        <table  class="table">
                <thead>
                  <tr>

                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Qty</th>
                    <th>Price (Currency)</th>
                    <th>Total Amount</th>

                  </tr>
                </thead>
                <tbody>

                <?php
                  $cartContent = getCartContent();
                    $numProduct = count($cartContent);
                    if ($numProduct > 0 ) {

                    $subTotal=0;
                    for($i=0;$i<$numProduct;$i++)
                    {
                        extract($cartContent[$i]);
                        //$subTotal+=$cunit*$ctqty;

                  ?>


                  <tr>
                    <td><?php echo $product_id; ?></td>
                    <td><?php echo $product_name; ?></td>
                   
                   
                    <td><?php echo $qty; ?></td> 
                    <td><?php echo $price; ?> MMK</td>
                    <td><?php echo $amount; ?></td>

                  </tr>
                <?php }
                    }
                ?>



                </tbody>
                 <tfoot>
                  <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    
                    <th>Qty</th>
                    <th>Price</th>
                      <th>Total Amount</th>
                  </tr>
                </tfoot>
              </table>
                    </div>
                </div>

                 <?php
          if($order_status!=1)
          {
          
          ?>
                    <input type="submit" class="btn btn-block btn-info" name="orderinvoice" value="Send Invoice"/>
                    
                   
                    <?php
          }else
      {
                    ?>
          <a href="index.php?page=orderlist" class="btn btn-block btn-info">Back</a>

          <?php
            }
          ?>
                    <!---------->
                </div>


             </div>
          </div>
        </section>

    </div>
   </form>
<!--- end Order List Detail -->
  				
			</div>
		</div>
	</div>
</div>

</body>
</html>