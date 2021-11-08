<?php 
require 'header.php';
?>
<section class="carousel-slider-main text-center border-top border-bottom bg-white">
<div class="owl-carousel owl-carousel-slider">
<?php 
$banner = $con->query("select * from banner");
while($row = $banner->fetch_assoc())
{
	

?>
<div class="item">
<a href="javascript:void(0);" class="cat_click" data-id="<?php echo $row['cid'];?>"><img class="img-fluid"  src="<?php echo $path.$row['bimg'];?>" alt="First slide"></a>
</div>
<?php } ?>
</div>
</section>
<section class="top-category section-padding">
<div class="container own-main">
<div class="owl-carousel owl-carousel-category">
<?php 
$category = $con->query("select * from category");
while($row = $category->fetch_assoc())
{
	if($con->query("select * from subcategory where cat_id=".$row['id']."")->num_rows != 0)
	{
?>
<div class="item">
<div class="category-item">
<a href="javascript:void(0);" class="cat_click" data-id="<?php echo $row['id'];?>">
<img class="img-fluid lazy" data-src="<?php echo $path.$row['catimg'];?>" alt="">
<h6><?php echo $row['catname'];?></h6>
<p><?php echo $con->query("select * from subcategory where cat_id=".$row['id']."")->num_rows.' Subcategory';?></p>
</a>
</div>
</div>
<?php }  }?>

</div>
</div>
</section>
<section class="product-items-slider section-padding">
<div class="container own-subcat">
<div class="section-header">
 <h5 class="heading-design-h5">Want Shop For <span class="badge badge-success">Popular</span>

</h5>
</div>
<div class="owl-carousel owl-carousel-featured">
<?php 
$product = $con->query("select * from product where popular=1 and status=1 order by rand() desc limit 7");
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
<img class="img-fluid lazy" data-src="<?php echo $path.$row['pimg'];?>" alt="">
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
</div>
</section>

<?php 

$slist = $con->query("select * from home where status = 1")->num_rows;
if($slist !=0)
{
	$plist = $con->query("select * from home where status = 1");
    
 $sev = array();
 while($rp = $plist->fetch_assoc())
    {
	?>
<section class="product-items-slider section-padding">
<div class="container">
<div class="section-header">
 <h5 class="heading-design-h5"><?php echo $rp['title'];?> 
 
</h5>
</div>
<div class="owl-carousel owl-carousel-featured">
<?php 
$product = $con->query("select * from product where status=1 and sid=".$rp['sid']." and cid=".$rp['cid']."  order by id desc");
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
<img class="img-fluid lazy" data-src="<?php echo $path.$row['pimg'];?>" alt="">
<!-- <span class="veg text-success mdi mdi-circle"></span> -->
</div>
<div class="product-body">
<h5><?php echo $row['pname'];?></h5>
<?php 
$ptype = explode('$;',$row['pgms']);
$price = explode('$;',$row['pprice']);
?>
<h6><strong><span class="mdi mdi-approval"></span><?php if($row['stock'] == 1) { ?> Available in <?php } else { ?>Out Of Stock <?php } ?> </strong> - <?php echo $ptype[0];?></h6>
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
</div>
</section>
<?php }  }?>

<?php 
require 'footer.php';
?>
