<?php
function addToCart($conn)
{
	//$size=$_GET['size'];
	//$color=$_GET['color'];
	if(isset($_REQUEST['pdid']))
	{
		$product_id = $_REQUEST['pdid'];
		

		$sql ="SELECT * FROM tbl_product WHERE product_id = $product_id";
		
		$result = $conn->query($sql)or die($conn->error);
		if ($result->num_rows == 0)
		{
			print "<script language=\"JavaScript\">window.location.href=\"index.php?page=product_detail&pdid=$product_id\";</script>";
		}
		else
		{
			$row = $result->fetch_assoc();
			$product_id=$row['product_id'];
			$product_name= $row['product_name'];
			$image=$row['image'];
			//$quantity=$row['qty'];
			$price=$row['price'];
			$brandid=$row['brand_id'];
			 $sid = session_id();
			//$useragent = $_SERVER['HTTP_USER_AGENT'];

			$sql = "SELECT product_id, cart_qty FROM tbl_cart WHERE product_id='$product_id' AND cart_session_id='$sid'";
			$result1 = $conn->query($sql)or die($conn->error);
			$cartprice = $price;

			if ($result1->num_rows == 0)
			{
				$quantity = $_REQUEST['qty'];
				$totalmmkprice = $cartprice;

				$totalprice = $totalmmkprice * $quantity;

				$sql = "INSERT INTO tbl_cart(product_id, cart_qty, cart_price, alltotal, cart_session_id)
				VALUES ('$product_id','$quantity','$cartprice',' $totalprice','$sid')";
				$result = $conn->query($sql)or die($conn->error);


				//echo $sql;

				print "<script language=\"JavaScript\">window.location.href=\"index.php?page=cart\";</script>";
			}
			else
			{

				$row1 = $result1 -> fetch_assoc();
				$cartqty = $row1['cart_qty'];
				$cartqty = $cartqty + $_REQUEST['qty'];
				$totalmmkprice = $cartqty*$cartprice;
					$sql = "UPDATE tbl_cart SET cart_qty='$cartqty', alltotal='$totalmmkprice' WHERE cart_session_id= '$sid' AND product_id= '$product_id'";
					$result = $conn->query($sql)or die($conn->error);
			}
		}
	}
}

function getCartContent()
{
	$cartContent=array();
	$sid=session_id();
	//echo $sid."+++++++++";
	//$icid=$_GET['icid'];

$query3="SELECT c.cart_id, c.product_id, c.cart_price,c.cart_qty, c.alltotal, c.cart_date, p.product_name, p.product_code, p.p_detail, p.image FROM tbl_product as p,tbl_cart as c WHERE c.cart_session_id='$sid' AND c.product_id=p.product_id";

//echo $query3;

// MD ///
	$conn = new mysqli("localhost","root","","online_shopdb");
		// MD ///
$logo3=$conn-> query ($query3) or die ($conn->error);

$row3=$logo3->num_rows;

//echo $row3."+++++++++=";

if($row3>0)

{
	while ($irow3=mysqli_fetch_assoc($logo3))
	{

		
		$cartContent[] = $irow3;
		
	}
}

	return $cartContent;
}

function updateCart()
{

	
	$cartId     = $_POST['hidCartId'];
	$productId  = $_POST['hidProductId'];
	$itemQty    = $_POST['txtQty'];
	
	$numItem    = count($itemQty);
	$numDeleted = 0;
	// $notice     = '';

	for($i=0;$i<$numItem;$i++)
	{
		$newQty=(int)$itemQty[$i];

		$sql = "SELECT * FROM tbl_product WHERE product_id={$productId[$i]}";

			$conn = new mysqli("localhost","root","","online_shopdb");
			$result = $conn->query($sql)or die($conn->error);
			$irow = $result->fetch_assoc();

			//$stquantity = $irow['store_qty'];

			/*$sql1 = "SELECT product_name FROM tbl_product WHERE product_id={$productId[$i]}";


				$result1 = $conn->query($sql1)or die($conn->error);
				$irow1 = $result1->fetch_assoc();*/



		if($newQty>$irow['qty'])
		{
			// print ('We have currently(' .$irow['store_qty'].') qty in <strong>'. $irow1['itemname'].'</strong> stock. You type quantity is ('.$newQty.') qty.');

			print "<script language=\"JavaScript\">window.location.href=\"index.php?page=cart&stqu=$irow[qty]&pname=$irow[product_name]&typequan=$newQty\";</script>";
		}
		else
		{
			if($newQty<=0)
			{


				$de = "DELETE FROM tbl_cart WHERE cart_id={$cartId[$i]}";
				$conn->query($de)or die($conn->error);



				$numDeleted += 1;
			}
			else
			{

				$sql1 = "UPDATE tbl_cart SET cart_qty='$newQty',alltotal=cart_qty*cart_price WHERE cart_id={$cartId[$i]}";
		$conn->query($sql1)or die($conn->error);

			}
		}
	}//end for

	if($numDeleted==$numItem)
	{
		print"<script language=\"javascript\"> window.location.href=\"index.php?page=productlist\";</script>";
		//all_product.php
	}
	else
	{
		print"<script language=\"javascript\"> window.location.href=\"index.php?page=cart\";</script>";
		//cart.php
	}
	exit;
}


function deleteFromCart()
{
	if(isset($_GET['cid']) && (int)$_GET['cid']>0)
	{
		$cartId=(int)$_GET['cid'];
		//echo $cartId."++++++++++++";
	}
	if($cartId)
	{
		//echo $cartId;
		$qry4="DELETE FROM tbl_cart WHERE cart_id=$cartId";
		// MLO ///
	$conn = new mysqli("localhost","root","","online_shopdb");
		// MLO ///
		$req4=$conn->query($qry4)or die($conn->error);
	}

	print"<script language=\"javascript\"> window.location.href=\"index.php?page=cart\";</script>";
	//cart.php
}
?>