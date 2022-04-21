<?php

$conn = new mysqli("localhost", "root", "", "online_shopdb");

// Check connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
/*********************************************************
*                 SHOPPING CART FUNCTIONS
*********************************************************/

function getCartContent()
{
	
	if(isset($_GET['or_id']))
	{
		$or_id = (string) $_GET['or_id'];
		
		// update //
		$query1="SELECT od.order_id,od.product_id FROM tbl_orderdetail AS od,tbl_order AS o,tbl_product AS i WHERE o.order_id=od.order_id AND od.product_id=i.product_id AND od.order_id='$or_id'";
		$conn = new mysqli("localhost","root","","online_shopdb");
$logo1=$conn-> query ($query1) or die ($conn->error);
while ($irow1=mysqli_fetch_assoc($logo1))
	{
		// $supplier_id = $irow1['supplier_id'];
	}
// 	if($supplier_id=='0')
// 	{
		
		
// 			$cartContent=array();
// 	//$sid=session_id();
// $query3="SELECT od.order_id, od.item_id, od.itemname, od.qty, od.price, od.amount, od.currency,se.sellername FROM tbl_orderdetail AS od , tbl_order AS o ,tbl_item AS i, tbl_seller AS se WHERE o.order_id='$or_id' AND o.order_id = od.order_id AND i.item_id=od.item_id AND i.sellerid=se.sellerid ORDER BY od.order_id";

		
// ////
	
// $conn = new mysqli("localhost","root","","online_shopdb");
// $logo3=$conn-> query ($query3) or die ($conn->error);
// $row3=$logo3->num_rows;

// if($row3>0)
// {
// 	while ($irow3=mysqli_fetch_assoc($logo3))
// 	{

// 		$order_id = $irow3['order_id'];
// 		$item_id = $irow3['item_id'];
// 		$itemname = $irow3['itemname'];
// 		$sellername = $irow3['sellername'];
// 		$qty = $irow3['qty'];
// 		$price = $irow3['price'];
// 		$amount = $irow3['amount'];
// 		$supplier_id = '0';
// 		$currency = $irow3['currency'];


// 		$cartContent[] = $irow3;

// 			}
// 		}
	
	

	$cartContent=array();
	//$sid=session_id();
$query3="SELECT od.order_id, od.product_id, od.product_name, od.qty, od.price, od.amount FROM tbl_orderdetail AS od , tbl_order AS o ,tbl_product AS i WHERE o.order_id='$or_id' AND o.order_id = od.order_id AND i.product_id=od.product_id ORDER BY od.order_id
";

		
////
	
$conn = new mysqli("localhost","root","","online_shopdb");
$logo3=$conn-> query ($query3) or die ($conn->error);
$row3=$logo3->num_rows;

if($row3>0)
{
	while ($irow3=mysqli_fetch_assoc($logo3))
	{

		// $order_id = $irow3['order_id'];
		// $item_id = $irow3['product_id'];
		// $itemname = $irow3['product_name'];
		// $qty = $irow3['qty'];
		// $price = $irow3['price'];
		// $amount = $irow3['amount'];


		$cartContent[] = $irow3;

			}
		}

	return $cartContent;
}
}
?>
