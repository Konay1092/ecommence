<?php
 $_SESSION['shop_return_url'] = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>HT Online Shopping</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">

    <link rel="stylesheet" type="text/css" href="custom.css">

  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.html"><h2>HT <em>Computer Sales</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index.html">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="products.html">Our Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.html">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Page Content -->
    

    

    <div class="best-features header-text">
      <div class="container">
        
        <div class="bg-white pt-5">
<div class="row hedding m-0 pl-3 pt-0 pb-3">
<h2>Product Detail</h2>
</div>
<?php
  $productid = $_REQUEST['itemid'];
  $selectp = mysqli_query($conn,"SELECT * FROM tbl_product,tbl_brand WHERE tbl_brand.brand_id=tbl_product.brand_id AND tbl_product.product_id = '" . $productid . "'");
  $rowp1 = mysqli_fetch_assoc ($selectp);

?>
<div class="row m-0">
<div class="col-lg-4 left-side-product-box pb-3">
<img src="photo/<?php echo $rowp1['image']; ?>" class="border p-3">
<span class="sub-img">
<img src="photo/<?php echo $rowp1['image']; ?>" class="border p-2">
<img src="photo/<?php echo $rowp1['image']; ?>" class="border p-2">
<img src="photo/<?php echo $rowp1['image']; ?>" class="border p-2">
</span>
</div>
<div class="col-lg-8">
<div class="right-side-pro-detail border p-3 m-0">
<div class="row">
<div class="col-lg-12">
<span>Product Code</span>
<p class="m-0 p-0"><?php echo $rowp1['product_code']; ?></p>
</div>
<div class="col-lg-12">
<p class="m-0 p-0 price-pro"><?php echo $rowp1['price']; ?> MMK</p>
<hr class="p-0 m-0">
</div>
<div class="col-lg-12 pt-2">
<h5>Product Detail</h5>
<span><?php echo $rowp1['p_detail']; ?></span><hr class="m-0 pt-2 mt-2">
</div>
<div class="col-lg-12">
<p class="tag-section"><strong>Brand : </strong><a>
<?php echo $rowp1['brand']; ?>
</a></p>
</div>
<div class="col-lg-12">
<h6>Quantity :</h6>
<form method="post" action="index.php?page=cart&action=add&pdid=<?php echo $_REQUEST['itemid']; ?>">
<input type="number" class="form-control text-center w-100" value="1" name="qty" id="qty">

</div>
<div class="col-lg-12 mt-3">
<div class="row">
<div class="col-lg-6 pb-2">
  
<!--<a href="index.php?pg=cart&action=add&pdid=<?php echo $_REQUEST['pid']; ?>" class="btn btn-danger w-100">Add To Cart</a>-->

<?php
  if(@$_SESSION['customer_id']=="")
  {
    

?>
<a href="index.php?page=login" class="btn btn-danger w-100">Add To Cart</a>
<?php
  }
  else
  {

?>

<button type="submit" class="btn btn-danger w-100">Add To Cart</button>

<!-- <a href="index.php?page=cart&action=add&pdid=<?php echo $productid; ?>&qty=" class="btn btn-danger w-100">Add To Cart</a>  -->

<!-- <button id="submit" onclick="javascript:window.location.href='index.php?page=cart&action=add&pdid=<?php echo $_REQUEST['itemid']; ?>&qty=' + document.getElementById('qty').value" class="btn btn-danger w-100">Add To Cart</button> -->
<?php
  }
?>

 </form>
</div>
<div class="col-lg-6">
<a href="index.php?page=productlist.php" class="btn btn-success w-100">Shop Now</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12 text-center pt-3">
<h4>More Product</h4>
</div>
</div>

<div class="row mt-3 p-0 text-center pro-box-section">
  <?php
  $selectmp= mysqli_query($conn, "SELECT * FROM tbl_product WHERE brand_id = '" . $rowp1['brand_id'] . "'");
  while($row=mysqli_fetch_assoc($selectmp))
  {
  ?>
<div class="col-lg-3 pb-2">
<div class="pro-box border p-0 m-0">
<img src="photo/<?php echo $row['image']; ?>">
</div>
</div>
  <?php
  }
  ?>


</div>
</div>

      </div>
    </div>


    <div class="call-to-action">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
              <div class="row">
                <div class="col-md-8">
                  <h4>Creative &amp; Unique <em>Sixteen</em> Products</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque corporis amet elite author nulla.</p>
                </div>
                <div class="col-md-4">
                  <a href="#" class="filled-button">Purchase Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
              <p>Copyright &copy; HT Online Shopping Co., Ltd.
            
            - Design: <a rel="nofollow noopener" href="https://templatemo.com" target="_blank">TemplateMo</a></p>
            </div>
          </div>
        </div>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>


    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>


  </body>

</html>
