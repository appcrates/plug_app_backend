<?php 
require 'header.php';
if(!isset($_SESSION['log_user']))
{
	?>
	<script>
	window.location.href="/";
	</script>
	<?php 
}
?>
<section class="account-page section-padding">
<div class="container">
<div class="row">
<div class="col-lg-9 mx-auto">
<div class="row no-gutters">
<div class="col-md-4">
<div class="card account-left">
<div class="user-profile-header">
<h5 class="border-profile-dashboard"><?php echo ucfirst(substr($fet['name'], 0, 1));?></h5>
<h5 class="mb-1 text-secondary"><strong>Hi </strong> <?php echo $fet['name'];?></h5>
<p> <?php echo $fet['ccode'].' '.$fet['mobile'];?></p>
</div>
<div class="list-group">
<a href="my-profile.php" class="list-group-item list-group-item-action active"><i aria-hidden="true" class="mdi mdi-account-outline"></i> My Profile</a>
<a href="my-address.php" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-map-marker-circle"></i> My Address</a>

<a href="orderlist.php" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-format-list-bulleted"></i> Order List</a>
<a href="logout.php" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-lock"></i> Logout</a>
</div>
</div>
</div>
<div class="col-md-8">
<div class="card card-body account-right">
<div class="widget">
<div class="section-header">
<h5 class="heading-design-h5">
My Profile
</h5>
</div>
<form method="POST">
<div class="row">
<div class="col-sm-6">
<div class="form-group">
 <label class="control-label">Name <span class="required">*</span></label>
<input class="form-control border-form-control" name="name" placeholder="Gurdeep" value="<?php echo $fet['name'];?>" type="text" required >
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label class="control-label">Email <span class="required">*</span></label>
<input class="form-control border-form-control" name="email" placeholder="hungry" value="<?php echo $fet['email'];?>" type="email" required >
</div>
</div>
</div>
<div class="row">
<div class="col-sm-3">
<div class="form-group">
<label class="control-label">Country Code <span class="required">*</span></label>
<select class="form-control border-form-control" name="ccode">
<?php
 $code = $con->query("select * from code where status=1 order by id desc ");
 while($row = $code->fetch_assoc())
 {
?>
<option value="<?php echo $row['ccode'];?>" <?php if($row['ccode'] == $fet['ccode']) {echo 'selected';}?>><?php echo $row['ccode'];?></option>
 <?php } ?>
</select>
 </div>
</div>
<div class="col-sm-9">
<div class="form-group">
<label class="control-label">Phone <span class="required">*</span></label>
<input class="form-control border-form-control" name="phone" placeholder="123 456 7890" type="number" value="<?php echo $fet['mobile'];?>">
</div>
</div>

</div>

<div class="row">
<div class="col-sm-12">
<div class="form-group">
<label class="control-label">Password <span class="required">*</span></label>
<input class="form-control border-form-control"  name="password" placeholder="*********" type="password" value="<?php echo $fet['password'];?>">
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12 text-right">
<button type="submit" name="up_profile" class="btn btn-success btn-lg">Update Profile </button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<?php
if(isset($_POST['up_profile']))
{
	$password = $_POST['password'];
    $phone = $_POST['phone'];
	$ccode = $_POST['ccode'];
	$email = $_POST['email'];
	$name = $_POST['name'];
	$con->query("update user set name='".$name."',email='".$email."',mobile='".$phone."',password='".$password."',ccode='".$ccode."' where id=".$_SESSION['log_user']."");
	?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
	 <script>
 iziToast.success({
    title: 'Profile Update Successfully!!',
    message: 'Redirect To Login!!',
    position: 'topRight'
  });
	 
	 setTimeout(function(){ 
	 window.location.href='logout.php'},2000);
	 </script>
	<?php 
}	
?>
<?php 
require 'footer.php';
?>
