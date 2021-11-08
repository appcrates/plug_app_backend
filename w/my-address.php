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
<div class="row">
<div class="col-md-10">
<h5 class="heading-design-h5">
Contact Address List
</h5>
</div>
<div class="col-md-2">
<h5 class="heading-design-h5">
<a data-toggle="tooltip" data-placement="top" title="" href="add-my-address.php" data-original-title="Add New Address" class="btn btn-primary btn-sm"><i class="mdi mdi-plus"></i></a>
</h5>
</div>
</div>
</div>
<div style="height:500px;overflow-x:hidden;">

<?php 
$add_list = $con->query("select * from address where uid=".$_SESSION['log_user']."");
if($add_list->num_rows == 0)
{
	?>
	<img src="img/address.svg"/>
	<h3 style="text-align:center;margin-top:10px;"><b>Click + Icon And Add New Address</b></h3>
	<?php 
}
else 
{
while($row = $add_list->fetch_assoc())
{
?>
<div class="row" style="    padding: 10px;
    border-bottom: 1px solid;">
<div class="col-md-9">
<p><?php echo $row['name'].','.$row['type'];?></p>
<p><?php echo $row['hno'].','.$row['society'].','.$row['landmark'].'<br>'.$row['area'].'-'.$row['pincode'];?></p>
</div>
<div class="col-md-3">
<a data-toggle="tooltip" data-placement="top" title="" href="edit-my-address.php?cid=<?php echo $row['id'];?>" data-original-title="Update Address" class="btn btn-info btn-sm">Edit Address</a>

<?php 
if($row['primary_add'] !=1)
{
?>
<a data-toggle="tooltip" data-placement="top" title="" href="?deid=<?php echo $row['id'];?>" data-original-title="Make Default Address" class="btn btn-success btn-sm" >Make Primary</a>

<?php } ?>
</div>
</div>
<?php } }?>
</div>
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
if(isset($_GET['deid']))
{
	$con->query("update address set primary_add=0 where uid=".$_SESSION['log_user']."");
	$con->query("update address set primary_add=1 where id=".$_GET['deid']."");
	?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
	 <script>
 iziToast.success({
    title: 'Address Section!!',
    message: 'Primary Address  Successfully!!',
    position: 'topRight'
  });
	 
	 setTimeout(function(){ 
	 window.location.href="my-address.php"},1000);
	 </script>
	<?php 
}

if(isset($_GET['aid']))
{
	$con->query("delete from address where id=".$_GET['aid']." and primary_add=0");
	?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
	 <script>
 iziToast.error({
    title: 'Address Section!!',
    message: 'Address Delete  Successfully!!',
    position: 'topRight'
  });
	 
	 setTimeout(function(){ 
	 window.location.href="my-address.php"},1000);
	 </script>
	<?php 
}
?>



