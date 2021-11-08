<?php 
require 'admin/include/dbconfig.php';   
$sessionid = session_id();
$path = 'admin/';
if(isset($_GET['id']))
{
	
$pdata = $con->query("select * from product where id=".$_GET['id']." and status=1")->fetch_assoc();
$img = array();
$img[] = $pdata['pimg'];
if($pdata['prel'] != '')
{
$p = explode(',',$pdata['prel']);
foreach($p as $pimg)
{
	$img[] = $pimg;
}

}
}

if(isset($_SESSION['log_user']))
{
$fet = $con->query("select * from user where id=".$_SESSION['log_user']."")->fetch_assoc();	
}

function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Hungry Grocery">
<meta name="author" content="Hungry Grocery">
<title>Hungry Grocery Delivery</title>

<link rel="icon" type="image/png" href="<?php echo $path.$fset['favicon'];?>">

<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link href="vendor/icons/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"/>

<link href="css/custom-style.css" rel="stylesheet">

<link rel="stylesheet" href="vendor/owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="vendor/owl-carousel/owl.theme.css">
</head>
<body>
	<div class="preloader"></div>
<div class="modal fade login-modal-main" id="bd-example-modal">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-body">
<div class="login-modal">
<div class="row">
<div class="col-lg-6 pad-right-0">
<div class="login-modal-left">
</div>
</div>
<div class="col-lg-6 pad-left-0">
<button type="button" class="close close-top-right" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true"><i class="mdi mdi-close"></i></span>
<span class="sr-only">Close</span>
</button>

<div class="login-modal-right">

<div class="tab-content">
<div>
<h5 class="heading-design-h5">Login to your account</h5>
<form method="post">
<fieldset class="form-group">
<label>Enter Email/Mobile number</label>
<input type="text" class="form-control" name="email" placeholder="test@gmail.com"  required >
</fieldset>
<fieldset class="form-group">
<label>Enter Password</label>
<input type="password" name="password" class="form-control" placeholder="********"  required>
</fieldset>
<fieldset class="form-group">
<button type="submit" name="log_user" class="btn btn-lg btn-secondary btn-block">Enter to your account</button>
</fieldset>
</form>
</div>

</div>

<div class="clearfix"></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="modal fade login-modal-main" id="bd-signup-modal">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-body">

<div class="row">
<div class="col-lg-6 pad-right-0">
<div class="login-modal-left">
</div>
</div>
<div class="col-lg-6 pad-left-0">
<button type="button" class="close close-top-right" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true"><i class="mdi mdi-close"></i></span>
<span class="sr-only">Close</span>
</button>
<h5 class="heading-design-h5">Register Now!</h5>
<form method="post" class="form">
<fieldset class="form-group">
<label>Enter Name</label>
<input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required>
</fieldset>

<fieldset class="form-group">
<label>Enter Email</label>
<input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required> 
</fieldset>

<fieldset class="form-group">
	<div class="row">
      <div class="col-md-4">
      	<label>Country Code</label>
      	<select name="ccode" class="form-control" name="code" id="code">
<?php 
$code = $con->query("SELECT * FROM `code` order by id desc");
while($row = $code->fetch_assoc())
{
	?>
	<option value="<?php echo $row['ccode'];?>"><?php echo $row['ccode'];?></option>
	<?php 
}
?>
</select>
      </div>
       <div class="col-md-8">
<label>Mobile Number</label>
<input type="number" class="form-control" name="mob" id="mob" placeholder="Enter Mobile No" required>
      </div>
  </div>

</fieldset>
<fieldset class="form-group">
<label>Enter Password</label>
<input type="password" class="form-control" placeholder="********" name="pass" id="pass" required>
</fieldset>
<fieldset class="form-group">
<button type="submit" class="btn btn-lg btn-secondary btn-block">Create Your Account</button>
</fieldset>
</form>
<div class="custom-control custom-checkbox">
By Signing Up, You Agree To Our Terms and Policy</label>
</div>
</div>
</div>




</div>

</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="navbar-top pt-2 pb-2">
<div class="container">
<div class="row">
<div class="col-md-6">
<a href="terms.php" class="mb-0 text-white">
Terms & Conditions <strong><span class="text-light"></strong> </a> | <a href="privacy.php" class="mb-0 text-white">
Privacy & Policy <strong><span class="text-light"></strong> </a>
</div>
<div class="col-md-6 text-right">
<?php 
if(!isset($_SESSION['log_user']))
{
?>
<a href="#" data-target="#bd-example-modal" id="loginbtn" data-toggle="modal" class="text-white ml-3 mr-3"><i class="mdi mdi-lock"></i> Sign In</a>
<a href="#" data-target="#bd-signup-modal"  data-toggle="modal" class="text-white ml-3 mr-3"><i class="mdi mdi-pencil"></i> Sign Up</a>
<?php } else {?>
<?php } ?>
</div>
</div>
</div>
</div>
<nav class="navbar navbar-light navbar-expand-lg  bg-faded hungry-menu">
<div class="container">
<a class="navbar-brand p-3" href="/"> <img src="img/logo.png" width="160"  alt="logo"> </a>
<button class="navbar-toggler navbar-toggler-white" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="navbar-collapse" id="navbarNavDropdown ">
<div class="navbar-nav mr-auto mt-5 mt-lg-2 margin-auto top-categories-search-main">
<div class="top-categories-search">
<div class="input-group">

<input class="form-control" placeholder="Search products Using Name" aria-label="Search products Using Name" type="text" name="search" id="search" value=""  autocomplete="off">
<div class="resultDiv"></div><!-- end of .resultDiv -->
  <div class="clearfix"></div>

</div>
</div>
</div>
<div class="my-2 my-lg-0">
<ul class="list-inline main-nav-right">
<?php 
if(isset($_SESSION['log_user']))
{
?>
<li class="list-inline-item dropdown hungry-top-dropdown">
<a class="btn btn-theme-round dropdown-toggle dropdown-toggle-top-user" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<h5 class="border-profile"><?php echo ucfirst(substr($fet['name'], 0, 1));?></h5>

</a>
<div class="dropdown-menu dropdown-menu-right dropdown-list-design">
<a href="my-profile.php" class="dropdown-item"><i aria-hidden="true" class="mdi mdi-account-outline"></i> My Profile</a>
<a href="my-address.php" class="dropdown-item"><i aria-hidden="true" class="mdi mdi-map-marker-circle"></i> My Address</a>
<a href="orderlist.php" class="dropdown-item"><i aria-hidden="true" class="mdi mdi-format-list-bulleted"></i> Order List</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="logout.php"><i class="mdi mdi-lock"></i> Logout</a>
</div>
</li>
<?php } ?>
<li class="list-inline-item cart-btn">
<a href="cart.php"  class="btn btn-link border-none"><i class="mdi mdi-cart"></i> My Cart <small class="cart-value"><?php echo $con->query("select * from cart_sess where s_key='".$sessionid."'")->num_rows;?></small></a>
</li>
</ul>
</div>
</div>
</div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light hungry-menu-2 pad-none-mobile">
<div class="container-fluid">
<div class="collapse navbar-collapse" id="navbarText">
<ul class="navbar-nav mr-auto mt-2 mt-lg-0 margin-auto">
<li class="nav-item">
<a class="nav-link shop" href="/"><span class="mdi mdi-home"></span> Home </a>
</li>

<?php 
if($_SERVER['REQUEST_URI'] == '/index.php' or $_SERVER['REQUEST_URI'] == '/' or $_SERVER['REQUEST_URI'] == '')
{
$category = $con->query("select * from category");
while($row = $category->fetch_assoc())
{
	if($con->query("select * from subcategory where cat_id=".$row['id']."")->num_rows != 0)
	{
?>

<li class="nav-item">
<a href="javascript:void(0);" class="cat_click nav-link" data-id="<?php echo $row['id'];?>"><?php echo $row['catname'];?></a>
</li>
<?php }  } }?>

<li class="nav-item">
<a class="nav-link" href="about.php">About</a>
</li>
<li class="nav-item">
<a class="nav-link" href="contact.php">Contact</a>
</li>
<li class="nav-item">
<a class="nav-link" href="privacy.php">Privacy &amp; Policy</a>
</li>
<li class="nav-item">
<a class="nav-link" href="terms.php">Terms &amp; Conditions</a>
</li>

</ul>
</div>
</div>
</nav>
<?php 
if(isset($_POST['log_user']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	$chek = $con->query("select * from user where (mobile='".$email."' or email='".$email."') and status = 1 and password='".$password."'");
$status = $con->query("select * from user where status = 1");
if($status->num_rows !=0)
{
if($chek->num_rows != 0)
{
	$uid = $chek->fetch_assoc();
	$_SESSION['log_user'] = $uid['id'];
	?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
	 <script>
 iziToast.success({
    title: 'Login Successfully!!',
    message: 'Welcome Admin!!',
    position: 'topRight'
  });
	 
	 setTimeout(function(){ 
	 window.location.href=location.href},1000);
	 </script>
	<?php 
}
else 
{
	?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
	 <script>
 iziToast.error({
    title: 'Login Data Invaild!!',
    message: 'Try Again!!',
    position: 'topRight'
  });
	 
	 setTimeout(function(){ 
	 window.location.href=location.href},1000);
	 </script>
	<?php 
	
}

}
else 
{
	?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
	 <script>
 iziToast.error({
    title: 'Your Status Deactivate!!!',
    message: 'Sorry Contact Admin!!',
    position: 'topRight'
  });
	 
	 setTimeout(function(){ 
	 window.location.href=location.href},1000);
	 </script>
	<?php 
}
}
?>