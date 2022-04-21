<?php

// require_once('cart_function.php');
//require_once('../connection/db.php');


if(isset($_POST['orderinvoice']) && $_REQUEST['page'] == "orderlistdetail")
{

$orderno = $_REQUEST['or_id'];
$remark = $_POST['remark'];
$d=date("Y-m-d H:i:s");
$conf="HT-";
$conf .=rand(5,1000);


// $stmt = $conn->stmt_init();

  $updates= mysqli_query($conn,"UPDATE tbl_order SET order_status = 1, delivered_date1= NOW(), confirm_code= '" . $conf . "', remark = '" . $remark . "' WHERE order_id = '" . $orderno ."'");



  
 
}

?>
