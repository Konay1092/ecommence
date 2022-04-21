<?php
// require_once('controller/cart_function.php');
// require_once('connection/connection.php');

$conn = new mysqli("localhost", "root", "", "online_shopdb");

// Check connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if(isset($_REQUEST['confirmorder']) && $_GET['page'] == "checkoutconfirm")
 {
	@$regurl=$_SESSION['shop_return_url'];
	
	$customername = $conn->real_escape_string((isset($_POST['customername']) ? $_POST['customername'] : ""));
  $email = $conn->real_escape_string((isset($_POST['email']) ? $_POST['email'] : ""));
  $phone = $conn->real_escape_string((isset($_POST['phone']) ? $_POST['phone'] : ""));
  $address = $conn->real_escape_string((isset($_POST['address']) ? $_POST['address'] : ""));

	 $pm = $conn->real_escape_string((isset($_POST['pm']) ? $_POST['pm'] : ""));

	// $d = date('Y-m-d');
	// $hms = date("H:i:s");

  $uid = (!empty($_SESSION['customer_id']) ? $_SESSION['customer_id'] : "");
  $uname = (!empty($_SESSION['customer_name']) ? $_SESSION['customer_name'] : "");
	

  $mtotal = $conn->real_escape_string((isset($_POST['mtotal']) ? $_POST['mtotal'] : ""));

	$sid = session_id();
	$sql="SELECT SUM(cart_qty) FROM tbl_cart WHERE cart_session_id ='$sid'" ;
	$result = $conn->query($sql)or die($conn->error);
	while ($row = $result->fetch_assoc())
	{


		$cart_qtytl=number_format($row['SUM(cart_qty)']);

    $cart_qtyt=$row['SUM(cart_qty)'];

	}




 		$stmt = $conn->stmt_init();
 		$stmt->prepare("INSERT INTO tbl_order(customer_id,payment_id,alltotal_amount,totalqty,order_email) VALUES (?,?,?,?,?)");
 		$stmt->bind_param("iiiis", $uid, $pm, $mtotal, $cart_qtyt, $email);
 		$stmt->execute() or die($stmt->error);
 		$stmt->close();



    $aaa="SELECT order_id FROM tbl_order WHERE customer_id = '$uid' ORDER BY order_id DESC ";
    $query1 = $conn->query($aaa)or die($conn->error);
    $arow1 = $query1->fetch_assoc();
    $order1 = $arow1['order_id'];



    $stmt = $conn->stmt_init();
    $stmt->prepare("INSERT INTO tbl_shipping(order_id,customer_id,shipping_name,shipping_address,shipping_phone) VALUES (?,?,?,?,?)");
    $stmt->bind_param("iisss", $order1, $uid, $customername, $address,$phone);
    $stmt->execute() or die($stmt->error);
    $stmt->close();


//$getpar = (!empty($_GET['par']) ? $_GET['par'] : "");

$aa="SELECT order_id FROM tbl_order WHERE customer_id= '$uid' ORDER BY order_id DESC LIMIT 1";
$query = $conn->query($aa)or die($conn->error);
$arow = $query->fetch_assoc();
$orderId = $arow['order_id'];

//$_SESSION['orderidonly'] = $orderId;
//$orderId = $order + 1;


	$sid = session_id();



	if($uid!="")
	{
		$cartContent = getCartContent($conn);
		$numItem = count($cartContent);
		if ($orderId)
		{

			for ($i = 0; $i < $numItem; $i++)
			{
				$cartContent[$i]['product_id'];
				$cartContent[$i]['product_name'];
				$cartContent[$i]['cart_price'];
				$cartContent[$i]['cart_qty'];
				$cartContent[$i]['alltotal'];
		

				$sql1="INSERT INTO tbl_orderdetail (order_id,product_id,product_name,price,qty,amount)
				VALUES ('$orderId','{$cartContent[$i]['product_id']}','{$cartContent[$i]['product_name']}','{$cartContent[$i]['cart_price']}','{$cartContent[$i]['cart_qty']}',
					'{$cartContent[$i]['alltotal']}')";

					$sql = $conn->query($sql1);


				// $result1 = dbQuery($sql1,$conn) or die("Can't Insert all total");
			}
			$oqry = $conn->query("SELECT order_id FROM tbl_order WHERE customer_id='$uid' ORDER BY order_id DESC LIMIT 1")or die($conn->error);
			$orow = $oqry->fetch_assoc();
			$oridd = $orow['order_id'];
		}

		
		
		// add mail portion //
		
		if ($uid!="") {

    $cust = "SELECT order_id, order_date, order_email FROM tbl_order WHERE customer_id = '$uid' ORDER BY order_id DESC";
	
	
	
    $custq = $conn->query($cust)or die($conn->error);
    $crow = $custq->fetch_assoc();

   
    $orderdate=$crow['order_date'];

    $orid = $crow['order_id'];
   
     $orderemail = $crow['order_email'];
    
   
  }
 else {
    echo "error";
    exit();
  }

  // $result = $conn->query("UPDATE tbl_order1 SET orderstatus='0', payment='Cash on Delivery' WHERE orderid='$invoiceNob'")or die($conn->error);

  // $sid = session_id();
  // $del="DELETE FROM tbl_cart WHERE cartsessionid='$sid'";
  // $dquery = $conn->query($del)or die($conn->error);




    
    $toqo = $orderemail; // customer email select from order table
    $subjectStr ="Order Confirmation #$orid from HT Online Shopping Site";

    $message ="<table width=\"60%\">
    <tr>
    <th width=\"5%\" align=\"left\">No</th>
    <th width=\"20%\" align=\"left\">Item</th>
    <th width=\"20%\" align=\"right\">Price(MMK)</th>
    <th width=\"10%\" align=\"right\">Qty.</th>
    <th width=\"10%\" align=\"right\">Subtotal(MMK)</th>
    </tr>";

    $message .="<tr><td colspan=\"5\"><hr></td></tr>";
    $queryb=$conn->query("SELECT od.product_name, od.price, od.qty, od.amount FROM tbl_orderdetail AS od WHERE od.order_id='$orid'") or die($conn->error);
    $no = 1;
    while($abrow = $queryb->fetch_assoc())
    {
   

    $product_name = $abrow['product_name'];
      $price = $abrow['price'];
      $qty = $abrow['qty'];
      $amount = $abrow['amount'];

      $message.="<tr><td width=\"5%\">$no</td>
      <td width=\"20%\">$product_name</td>
      <td width=\"20%\" align='right'>$price</td>
      <td width=\"10%\" align='right'>$qty</td>
      <td width=\"10%\" align='right'>$amount</td>
      </tr>";
      $no++;
    }


			$stmt = $conn->stmt_init();
			$stmt->prepare("SELECT o.alltotal_amount,s.shipping_address FROM tbl_order AS o, tbl_shipping AS s WHERE s.order_id=o.order_id AND o.order_id= $orid ");
		// $stmt->bind_param("i", $orid);
		$stmt->execute() or die($stmt->error);
		$stmt->store_result();
		$stmt->bind_result($alltotal_amount, $shipping_add);
		$stmt->fetch();

   
    $message .="<tr><td colspan=\"5\"><hr></td></tr>";
    $message .="<tr><td colspan=\"4\" align='right'>Subtotal (MMK) :</td> 
    <td align='right'>$alltotal_amount</td></tr>";
    
    $message .="<tr><td colspan=\"5\"><hr></td></tr>";
    

    $message .= "</table>";
    $footer="";

    $email1 = "postmaster@htonlineshopping.com.mm";
    $mailBodyText = "
    <p><strong>Dear $customername,</strong></p>
    <p>Thank you for shopping at htonlineshopping.com.mm! Your order has been confirmed and we will process to deliver within 2-3 working days.</p>

    <p><strong>Your Order Details</strong></p>
    <p>Order Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ($orderdate)</p>
    <p>Receipt Number&nbsp;&nbsp;&nbsp; ($orid)</p>
    
    $message

    <p>Shipping Address: $shipping_add</p>
    <p>If you have any question, please visit <a href=\"http://connping.com.mm/ht_online_shoppingnew\" target=\"_top\"><strong>www.connping.com.mm/ht_online_shoppingnew</strong></a><br />
    or send mail to <a href=\"mailto:$email1\" target=\"_top\"><strong>connping@gmail.com</strong></a> or <strong>call our customer care at <a href=\"tel:09-459830988\" target=\"_top\">09-3687 8811</a>, working hours every day from 09:00 a.m.-06:00 p.m.</strong></p>
    <p><em>Please do not reply to this message as it is a system-generated acknowledgement and any e-mails sent in reply to this message will not be received by us.</em></p>

    <p>&nbsp;</p>
    <p>Thank you.</p>
    <p>Your Online Shopping Partner.</p>
    ";
    $headers = "From: ".$email1."\r\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // $headers .= "Reply-To: ".$email."\r\n";
    // $headers .= "Return-Path: ".$email."\r\n";
    // $headers .= "Content-type: text/html\r\n";
    mail($toqo,$subjectStr,$mailBodyText,$headers);
    // echo "$mailBodyText";
    /////////////////////////////////Mail to Customer end ////////////////////////////////
		
		/////////////////////
		
		
		
		
		
		

		$del="DELETE FROM tbl_cart WHERE cart_session_id='$sid'";
		$dquery = $conn->query($del)or die($conn->error);
          
          print "<script language=\"JavaScript\">window.location.href=\"index.php\";</script>";
    }
	}

 	

  // order cancel //


if(isset($_REQUEST['deleteorder']) && $_GET['page'] == "checkoutconfirm")
 {
  $sid=session_id();
  $del="DELETE FROM tbl_cart WHERE cart_session_id='$sid'";
    $dquery = $conn->query($del)or die($conn->error);
          
          print "<script language=\"JavaScript\">window.location.href=\"index.php\";</script>";
 }
  



 ?>
