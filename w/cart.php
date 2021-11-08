<?php 
require 'header.php';
?>
<section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
<div class="container">
<div class="row">
<div class="col-md-12">
<a href="/"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="#">Cart</a>
</div>
</div>
</div>
</section>
<section class="cart-page section-padding">
<div class="container">
<div class="row">
<div class="col-md-12 cart_summary_body">
<?php 
$q_cart = $con->query("select * from cart_sess where s_key='".$sessionid."'");
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
<a class="btn btn-sm btn-danger remove_item" data-id="<?php echo $re['id'];?>" data-original-title="Remove <?php echo $re['pname'];?>" href="javascript:void(0)" title="" ><i class="mdi mdi-close-circle-outline"></i></a>
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
<img src="img/cart.svg" width="320" />
<h1>Your Cart is empty!</h1>
<h6>You have no items added in the cart</h6>
</div>
<?php } ?>
</div>
</div>
</div>
</section>


<?php 
require 'footer.php';
?>
<script>

    $(document).on("click",".ddd",function()
	{
    var $button = $(this);
    var oldValue = $button.closest('.input-group').find("input.quntity-input").val();

    if ($button.text() == "+") {
        var newVal = parseFloat(oldValue) + 1;
    } else {
        // Don't allow decrementing below zero
        if (oldValue > 1) {
            var newVal = parseFloat(oldValue) - 1;
        } else {
            newVal = 1;
        }
    }
var sessionid = "<?php echo $sessionid;?>";
var cart_id = $(this).attr('data-id');
	var new_quantity = newVal;
	$.ajax({
		url : "update_cart_quantity.php",
		data : "cart_id="+cart_id+"&new_quantity="+new_quantity+"&s_key="+sessionid,
		type : 'post',
		success : function(response) {
			
			$(".cart_summary_body").html(response);
			
		}
	});
   

});

$(document).on("click",".remove_item",function()
	{
		var cart_id = $(this).attr('data-id');
	var sessionid = "<?php echo $sessionid;?>";
	$.ajax({
		url : "delete_cart_items.php",
		data : "cart_id="+cart_id+"&s_key="+sessionid,
		type : 'post',
		success : function(response) {
			
			$(".cart_summary_body").html(response);
			
			
		}
	});
	
	$.ajax({
		url : "cart_counter.php",
		data : "s_key="+sessionid,
		type : 'post',
		success : function(response) {
			
			$(".cart-value").text(response);
			
		}
	});
	
	});


</script>
