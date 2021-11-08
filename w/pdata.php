
<?php 

require 'admin/include/dbconfig.php';
$path = 'admin/';
$pid = $_POST['pid'];
$c = $con->query("select * from orders where id=".$pid."")->fetch_assoc();
$uinfo = $con->query("select * from address where id=".$c['address_id']."")->fetch_assoc();
$user = $con->query("select * from user where id=".$c['uid']."")->fetch_assoc();
 

?>

<div id="divprint">
<div class="pdpt-bg">
                    <div class="pdpt-title">
                      <h6><b>Delivery Timing:</b> <?php echo str_replace('--','',$c['ddate']);?>, <?php echo $c['timesloat'];?> <span class="float-right"><b>Order Id :- <?php echo $pid;?></b></span></h6>
                      <h6><b>Name:</b><?php echo $uinfo['name'];?> <span class="float-right"><b>Mobile Number: </b><?php echo $user['mobile'];?></span></h6>
                      <h6><b>Address:</b><?php echo $uinfo['hno'].','.$uinfo['society'].','.$uinfo['area'].'-'.$uinfo['pincode'];?> <span class="float-right"><b>Landmark: </b><?php echo $uinfo['landmark'];?></span></h6>
                    </div> 
                    <?php 
$prid = explode('$;',$c['pid']);
$qty = explode('$;',$c['qty']);
$ptype = explode('$;',$c['ptype']);
$pprice = explode('$;',$c['pprice']);
$pcount = count($qty);

$op = 0;
$subtotal = 0;
   $ksub = array();
   
for($i=0;$i<$pcount;$i++)
{
  $op = $op + 1;
$pinfo = $con->query("select * from product where id=".$prid[$i]."")->fetch_assoc();
$discount = $pprice[$i] * $pinfo['discount']*$qty[$i] /100;
  ?>
                    <div class="order-body10">
                      <ul class="order-dtsll">
                        <li>
                          <div class="order-dt-img">
                            <img src="<?php echo $path.$pinfo['pimg'];?>"/>
                          </div>
                        </li>
                        <li>
                          <div class="order-dt47">
                            <h4><?php echo $pinfo['pname'];?> </h4>
                            <p><?php echo $ptype[$i];?> | Discount: <?php echo $pinfo['discount'];?></p>
                            <div class="order-title"><?php echo $pprice[$i];?> x <?php echo $qty[$i];?> =  <span ><?php echo ($pprice[$i] * $qty[$i]) - $discount;?></span></div>
                            <div class="order-title"></div>
                          </div>
                        </li>
                      </ul>
<?php


        $ksub [] = $subtotal  + ($qty[$i] * $pprice[$i]) - $discount;
        
} ?>
<?php
$subtotal = number_format((float)array_sum($ksub), 2, '.', '');
$tax = number_format((float) $subtotal * $c['tax']/100, 2, '.', '');
$coupon = $c['cou_amt'];
 $wallet = $c['wal_amt'];
?>
                      <div class="total-dt">
                        <div class="total-checkout-group">
                          <div class="cart-total-dil">
                            <h4>Sub Total</h4>
                            <span><?php echo $subtotal ?></span>
                          </div>
                          <div class="cart-total-dil pt-3">
                            <h4>Tax</h4>
                            <span><?php echo $tax;?></span>
                          </div>
                          <div class="cart-total-dil pt-3">
                            <h4>Delivery Charges</h4>
                            <span><?php echo $c['total']- (($subtotal+$tax) - ($coupon + $wallet));?></span>
                          </div>
                          <?php 
                          if($coupon != 0)
                          {
                          ?>
                          <div class="cart-total-dil pt-3">
                            <h4>Coupon</h4>
                            <span><?php echo $coupon;?></span>
                          </div>
                          <?php } ?>
                        </div>
                        <div class="main-total-cart">
                          <h2>Total</h2>
                          <span><?php echo $c['total'];?></span>
                        </div>
                      </div>
                      <?php 
					  if($c['p_method'] == 'Pickup Myself')
					  {
					  ?>
                      <div class="alert-offer ml-2">
                         <b>You need to pickup order by seller shop, Seller address you can find on contact page.</b>
                      </div>
					  <?php } ?>
                      <div class="call-bill">
                        <div class="delivery-man">
						<?php 
						if($c['tid'] == '0')
						{
							?>
							 <i class="mdi  mdi-package-variant"></i> <b><?php echo $c['p_method'];?></b>
							<?php 
						}
						else 
						{
						?>
                          <i class="mdi  mdi-package-variant"></i> <b><?php echo $c['p_method'].'( Transaction Id : '.$c['tid'].' )';?></b>
						<?php } ?>
                        </div>
                        <div class="order-bill-slip">
                          <a href="#" class="btn btn-secondary btn-lg"><?php echo $c['status'];?></a>
                        </div>
                      </div>
                    </div>
                  </div>

</div>