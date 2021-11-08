<?php 
require 'admin/include/dbconfig.php'; 
$path = 'admin/';  
if(isset($_POST['sid']))
{
	$sid = $_POST['sid'];
	$gettitle = $con->query("select * from subcategory where id=".$sid."")->fetch_assoc();
	?>
	<div class="section-header">
 <h5 class="heading-design-h5">
<?php echo $gettitle['name']. ' Products' ;?>
</h5>
</div>
<div class="owl-carousel owl-carousel-featured">
<?php 
$product = $con->query("select * from product where sid=".$sid." and status=1");
while($row = $product->fetch_assoc())
{
?>
<div class="item">
<div class="product">
<?php 

if($row['stock'] == 1)
{
	?>
<a href="single.php?id=<?php echo $row['id'];?>">
<?php } else 
{?>
<a href="javascript:void(0)">
<?php } ?>
<div class="product-header">
<?php
if($row['discount'] != 0)
{	
?>
<span class="badge badge-success"><?php echo $row['discount'];?>% OFF</span>
<?php } ?>
<img class="img-fluid " src="<?php echo $path.$row['pimg'];?>" alt="">
<!-- <span class="veg text-success mdi mdi-circle"></span> -->
</div>
<div class="product-body">
<h5><?php echo $row['pname'];?></h5>
<?php 
$ptype = explode('$;',$row['pgms']);
$price = explode('$;',$row['pprice']);
?>
<h6><strong><span class="mdi mdi-approval"></span> <?php if($row['stock'] == 1) { ?> Available in <?php } else { ?>Out Of Stock <?php } ?></strong> - <?php echo $ptype[0];?></h6>
</div>
<div class="product-footer">
<?php
if($row['discount'] != 0)
{	
$discount = number_format((float)$price[0] * $row['discount']/100, 2, '.', '');
$dis_price = number_format((float)$price[0] - $discount, 2, '.', '');
?>
<p class="offer-price mb-0"><?php echo $dis_price.' '.$fset['currency']; ?> <i class="mdi mdi-tag-outline"></i> <span class="regular-price"><?php echo number_format((float)$price[0], 2, '.', '').' '.$fset['currency'];?></span></p>
<?php }else { ?>
<p class="offer-price mb-0"><?php echo number_format((float)$price[0], 2, '.', '').' '.$fset['currency'];?></p>
<?php } ?>
</a>
<?php 

if($row['stock'] == 1)
{
	?>

<button type="button"  data-price="<?php echo number_format((float)$price[0], 2, '.', '');?>" data-id="<?php echo $row['id']; ?>" data-pname="<?php echo $row['pname'];?>" data-pimg="<?php echo $path.$row['pimg']; ?>" data-ptype="<?php echo $ptype[0];?>" data-disprice="<?php if($row['discount'] != 0){	echo $dis_price;}else {	echo number_format((float)$price[0], 2, '.', '');}?>" class="btn btn-secondary btn-cart btn-lg"><i class="mdi mdi-cart-outline"></i> </button>

<?php } else 
{?>
<button type="button" class="btn btn-secondary btn-sm" disabled><i class="mdi mdi-cancel"></i></button>
<?php } ?>

</div>

</div>
</div>
<?php } ?>

</div>
	<?php 
}