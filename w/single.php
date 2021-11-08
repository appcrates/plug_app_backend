<?php 
require 'header.php';
?>
<section class="shop-single section-padding pt-3">
<div class="container">
<div class="row">
<div class="col-md-6">
<div class="shop-detail-left">
<div class="shop-detail-slider">
<div class="favourite-icon">

<?php 

if($pdata['discount'] != 0)
{
?>
<a class="fav-btn" title="" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="<?php echo $pdata['discount']; ?>% OFF"><i class="mdi mdi-tag-outline"></i></a>
<?php } ?>
</div>
<div id="sync1" class="owl-carousel">
<?php 
for($i=0;$i<count($img);$i++)
{
?>
<div class="item"><img alt="" data-src="<?php echo $path.$img[$i]; ?>" class="img-center lazy" style="width:100%;"></div>
<?php } ?>

</div>
<?php 
if(count($img) == 1)
{
}
else 
{
?>
<div id="sync2" class="owl-carousel small-img-product">
<?php 
for($i=0;$i<count($img);$i++)
{
?>
<div class="item"><img alt="" data-src="<?php echo $path.$img[$i]; ?>" class="lazy img-center" style="width:100%;"></div>
<?php } ?>

</div>
<?php } ?>
</div>
</div>
</div>
<div class="col-md-6">
<div class="shop-detail-right">
<?php 
if($pdata['discount'] != 0)
{
?>
<span class="badge badge-success"><?php echo $pdata['discount'];?>% OFF</span>
<?php } ?>
<h2><?php echo $pdata['pname'];?></h2>
<br>
<?php 
$ptype = explode('$;',$pdata['pgms']);
$price = explode('$;',$pdata['pprice']);

?>
<div class="row">
<div class="col-md-8 change_section">
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> -  <?php echo $ptype[0];?></h6>
<?php 
if($pdata['discount'] != 0)
{
	$discount = number_format((float)$price[0] * $pdata['discount']/100, 2, '.', '');
$dis_price = number_format((float)$price[0] - $discount, 2, '.', '');
?>
<p class="regular-price"><i class="mdi mdi-tag-outline"></i> MRP : <?php echo number_format((float)$price[0], 2, '.', '').' '.$fset['currency'];?></p>
<p class="offer-price mb-0">Discount MRP: <span class="text-success"><?php echo $dis_price.' '.$fset['currency']; ?></span></p>
<?php } else { ?>
<p class="offer-price mb-0">MRP : <span class="text-success"><?php echo number_format((float)$price[0], 2, '.', '').' '.$fset['currency'];?></span></p>
<?php } ?>
</div>
<div class="col-md-4">
<?php
if(count($ptype) == 1)
{
}
else 
{	
?>
<label style="color:black;"><b>Select Variant</b></label>

<select class="form-control selec_change">
<?php 
for($o=0;$o<count($ptype);$o++)
{
	$discount = number_format((float)$price[$o] * $pdata['discount']/100, 2, '.', '');
$dis_price_new = number_format((float)$price[$o] - $discount, 2, '.', '');

	?>
	<option data-price="<?php echo number_format((float)$price[$o], 2, '.', '');?>" data-id="<?php echo $pdata['id']; ?>" data-discountprice="<?php echo $dis_price_new;?>" data-currency="<?php echo $fset['currency'];?>" value="<?php echo $ptype[$o];?>"><?php echo $ptype[$o];?></option>
	<?php 
}?>
</select>
<?php } ?>
</div>
</div>

<button type="button" data-price="<?php echo number_format((float)$price[0], 2, '.', '');?>" data-id="<?php echo $pdata['id']; ?>" data-pname="<?php echo $pdata['pname'];?>" data-pimg="<?php echo $path.$img[0]; ?>" data-ptype="<?php echo $ptype[0];?>" data-disprice="<?php if($pdata['discount'] != 0){	echo $dis_price;}else {	echo number_format((float)$price[0], 2, '.', '');}?>" class="btn btn-secondary btn-cart btn-lg"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>

<div class="short-description">
<h5>
Quick Overview
<?php 
if($pdata['stock'] == 1)
{
?>
<p class="float-right">Availability: <span class="badge badge-success">In Stock</span></p>
<?php } else {?>
<p class="float-right">Availability: <span class="badge badge-danger">Out OF Stock</span></p>
<?php } ?>
</h5>

<p class="mb-0"> <?php echo $pdata['psdesc'];?></p>
</div>
</div>
</div>
</div>
</section>
<?php 
$product = $con->query("select * from product where id!=".$_GET['id']." and cid=".$pdata['cid']." and sid=".$pdata['sid']." order by id desc limit 7");
if($product->num_rows !=0)
{
?>
<section class="product-items-slider section-padding">
<div class="container">
<div class="section-header">
 <h5 class="heading-design-h5">Related Products</span>

</h5>
</div>
<div class="owl-carousel owl-carousel-featured">
<?php 

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
<?php } ?>

<?php 
require 'footer.php';
?>
<script>
$('body').on('change','.selec_change', function() {

	var ptype = $(this).val();
	var price = $('.selec_change option:selected').data('price');
	
	var discountprice = $('.selec_change option:selected').data('discountprice');
	var currency = $('.selec_change option:selected').data('currency');
	if(price === discountprice)
	{
		
		var html_pre = '<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> -  '+ptype+'</h6> <p class="offer-price mb-0">MRP : <span class="text-success">'+price+ ' ' +currency+'</span></p>';
		$('.change_section').html(html_pre);
		$('.btn-cart').attr('data-ptype',ptype);
		$('.btn-cart').attr('data-price',price);
		$('.btn-cart').attr('data-disprice',discountprice);
		
		
	}
	else 
	{
		var html_pre = '<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> -  '+ptype+'</h6><p class="regular-price"><i class="mdi mdi-tag-outline"></i> MRP : '+price+ ' ' +currency+'</p><p class="offer-price mb-0">Discount MRP: <span class="text-success">'+discountprice+ ' ' +currency+'</span></p>';
		$('.change_section').html(html_pre);
		$('.btn-cart').attr('data-ptype',ptype);
		$('.btn-cart').attr('data-price',price);
		$('.btn-cart').attr('data-disprice',discountprice);
	}

});
</script>
