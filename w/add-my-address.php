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
<a href="my-profile.php" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-account-outline"></i> My Profile</a>
<a href="my-address.php" class="list-group-item list-group-item-action active"><i aria-hidden="true" class="mdi mdi-map-marker-circle"></i> My Address</a>
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
Add Address
</h5>
</div>
<form method="POST">
<div class="row">
<div class="col-sm-12">
<div class="form-group">
 <label class="control-label">Name <span class="required">*</span></label>
<input class="form-control border-form-control" name="name" value="" placeholder="Hungry Grocery" type="text" required>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="form-group">
 <label class="control-label">Address Type <span class="required">*</span></label>
<input class="form-control border-form-control" name="atype" value="" placeholder="Home" type="text" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-3">
<div class="form-group">
 <label class="control-label">House No<span class="required">*</span></label>
<input class="form-control border-form-control" name="hno" value="" placeholder="A-663" type="text" required>
</div>
</div>
<div class="col-sm-9">
<div class="form-group">
 <label class="control-label">Society<span class="required">*</span></label>
<input class="form-control border-form-control" value="" name="society" placeholder="Enter Society Name" type="text" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-4">
<div class="form-group">
<label class="control-label">Area <span class="required">*</span></label>
<select class="select2 form-control border-form-control" name="area" required>
<option value="">Select Area</option>
<?php 
$area = $con->query("select * from area_db where status=1");
while($row = $area->fetch_assoc())
{
	?>
	<option value="<?php echo $row['name'];?>"> <?php echo $row['name'];?></option>
	<?php 
}
?>
</select>
</div>
 </div>
 
<div class="col-sm-4">
<div class="form-group">
<label class="control-label">Landmark <span class="required">*</span></label>
<input class="form-control border-form-control" value="" name="land" placeholder="Enter Landmark" type="text" required>
</div>
</div>

<div class="col-sm-4">
<div class="form-group">
<label class="control-label">Pincode <span class="required">*</span></label>
<input class="form-control border-form-control" value="" name="pincode" placeholder="Enter Pincode" type="text" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12 text-right">
<a href="my-address.php"><button type="button" class="btn btn-danger btn-lg"> Cancel </button></a>
<button type="submit" name="add_address" class="btn btn-success btn-lg"> Add Address </button>
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
require 'footer.php';
if(isset($_POST['add_address']))
{
	$name = $_POST['name'];
	$type = $_POST['atype'];
	$hno = $_POST['hno'];
	$society = $_POST['society'];
	$area = $_POST['area'];
	$landmark = $_POST['land'];
	$uid = $_SESSION['log_user'];
	$pincode = $_POST['pincode'];
	$con->query("insert into address(`uid`,`hno`,`society`,`pincode`,`area`,`landmark`,`type`,`name`)values(".$uid.",'".$hno."','".$society."',".$pincode.",'".$area."','".$landmark."','".$type."','".$name."')");
	?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
	 <script>
 iziToast.success({
    title: 'Address Section!!',
    message: 'Add Address Successfully!!',
    position: 'topRight'
  });
	 
	 setTimeout(function(){ 
	 window.location.href=location.href},1000);
	 </script>
	<?php 
}
?>
