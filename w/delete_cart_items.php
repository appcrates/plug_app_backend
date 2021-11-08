<?php
require 'admin/include/dbconfig.php';   
if(isset($_POST['cart_id']))
{
	$cart_id = $_POST['cart_id'];
	$s_key = $_POST['s_key'];
	$con->query("delete from cart_sess where id=".$cart_id." and s_key='".$s_key."'");
	
	


?>
<?php 
$q_cart = $con->query("select * from cart_sess where s_key='".$s_key."'");
if($q_cart->num_rows != 0)
{
?>
<div class="card card-body cart-table">
<div class="table-responsive">

<table class="table cart_summary">
<thead>
<tr>
<th class="cart_product">Product</th>
<th>Description</th>

<th>Unit price</th>
<th>Qty</th>
<th>Total</th>
<th class="action"><i class="mdi mdi-delete-forever"></i></th>
</tr>
</thead>
<tbody class="">
<?php 

$qu = 0;
$total_main = 0;
while($re = $q_cart->fetch_assoc())
{
?>
<tr>
<td class="cart_product"><a href="#"><img class="img-fluid" src="<?php echo $re['pimg'];?>" alt=""></a></td>
<td class="cart_description">
<h5 class="product-name"><a href="#"><?php echo $re['pname'];?></a></h5>
 <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - <?php echo $re['ptype'];?></h6>
</td>

<td class="price"><span><?php echo $re['dprice'].' '.$fset['currency'];?></span></td>
<td class="qty">
<div class="input-group">
<span class="input-group-btn"><button  class="btn-danger btn-theme-round btn-number ddd" data-id="<?php echo $re['id'];?>" type="button">-</button></span>
<input type="text" max="10" min="1" value="<?php echo $re['quantity'];?>" disabled class="form-control quntity-input border-form-control form-control-sm input-number">
<span class="input-group-btn"><button class="btn-primary btn-theme-round btn-number ddd" data-id="<?php echo $re['id'];?>" type="button">+</button>
</span>
</div>
</td>
<?php
$total = $re['dprice'] * $re['quantity'];
$qu = $qu + $re['quantity'];
$total_main = $total_main + $total;
?>
<td class="price"><span><?php echo $total.' '.$fset['currency'];?></span></td>
<td class="action">
<a class="btn btn-sm btn-danger remove_item" data-id="<?php echo $re['id'];?>" data-original-title="Remove <?php echo $re['pname'];?>" href="javascript:void(0)" title="" data-placement="top" data-toggle="tooltip"><i class="mdi mdi-close-circle-outline"></i></a>
</td>
</tr>
<?php } ?>
</tbody>

</table>

</div>
<?php 
if(isset($_SESSION['log_user']))
{
?>
<a href="checkout.php"><button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Checkout </span><span class="float-right"><strong><?php echo $qu.' Items | '.$total_main.' '.$fset['currency'];?></strong> <span class="mdi mdi-chevron-right"></span></span></button></a>
<?php } else { ?>
<a  data-target="#bd-example-modal" id="loginbtn" data-toggle="modal"><button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Checkout </span><span class="float-right"><strong><?php echo $qu.' Items | '.$total_main.' '.$fset['currency'];?></strong> <span class="mdi mdi-chevron-right"></span></span></button></a>

<?php } ?>
</div>
<?php } else { ?>
<div class="text-center">
<img src="img/cart.svg"/>
<h1>Your Cart Is Empty</h1>
</div>


<?php } }?>