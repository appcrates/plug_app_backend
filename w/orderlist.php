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
<a href="my-address.php" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-map-marker-circle"></i> My Address</a>
<a href="orderlist.php" class="list-group-item list-group-item-action active"><i aria-hidden="true" class="mdi mdi-format-list-bulleted"></i> Order List</a>
<a href="logout.php" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-lock"></i> Logout</a>
</div>
</div>
</div>
<div class="col-md-8">
<div class="card card-body account-right">
<div class="widget">
<div class="section-header">
<h5 class="heading-design-h5">
Order List
</h5>
</div>
<div class="order-list-tabel-main table-responsive">
<table class="datatabel table table-striped table-bordered order-list-tabel" width="100%" cellspacing="0">
 <thead>
<tr>
<th>Order #</th>
<th>Date Purchased</th>
<th>Status</th>
<th>Total</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php 

$o_list = $con->query("select * from orders where uid=".$_SESSION['log_user']." order by id desc");
while($row = $o_list->fetch_assoc())
{
?>
<tr>
<td>#<?php echo $row['id'];?></td>
<td><?php $date=date_create($row['order_date']); echo date_format($date,"F d, Y");?></td>
<?php 
if($row['status'] == 'completed')
{
	?>
	<td><span class="badge badge-success status-text"><?php echo $row['status'];?></span></td>
	<?php 
}
else if($row['status'] == 'processing')
{
	?>
	<td><span class="badge badge-info status-text"><?php echo $row['status'];?></span></td>
	<?php 
}
else if($row['status'] == 'pending')
{
?>
<td><span class="badge badge-primary status-text"><?php echo $row['status'];?></span></td>
<?php 	
}
else {
	?>
	<td><span class="badge badge-danger status-text"><?php echo $row['status'];?></span></td>
	<?php 
}
?>

<td><?php echo $row['total'].' '.$fset['currency'];?></td>
<td><a   data-toggle="modal" data-target="#orderinfo" title="" href="#" data-original-title="View Order Details" data-id="<?php echo $row['id'];?>" class="btn btn-secondary btn-sm preview_d"><i class="mdi mdi-eye"></i></a>
<?php
if($row['status'] == 'pending')
{
	?>
<a   title="" href="?cnid=<?php echo $row['id'];?>"   class="btn btn-danger btn-sm "><i class="fas fa-times"></i></a>
<?php } ?>
</td>
</tr>
<?php } ?>
</tbody>
</table>
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
if(isset($_GET['cnid']))
{
	
	$con->query("update `orders` set status='cancelled' where id=".$_GET['cnid']."");
	?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
	 <script>
 iziToast.error({
    title: 'Order Section!!',
    message: 'Order Cancle  Successfully!!',
    position: 'topRight'
  });
	 
	 setTimeout(function(){ 
	 window.location.href="orderlist.php"},1000);
	 </script>
	<?php
}
?>
<style>
li.list-group-item span {
    padding: 10px;
    font-size: 13px;
    font-weight: 600;
}
</style>