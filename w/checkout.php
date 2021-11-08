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

	<section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<a href="/"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="#">Checkout</a>
				</div>
			</div>
		</div>
	</section>
	<section class="checkout-page section-padding">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="checkout-step">
						<div class="accordion" id="accordionExample">
							<div class="card checkout-step-one">
								<div class="card-header" id="headingOne">
									<h5 class="mb-0"><button aria-controls="collapseOne" aria-expanded="true" class="btn btn-link" data-target="#collapseOne" data-toggle="collapse" type="button"><span class="number">1</span> Delivery Date</button></h5>
								</div>
								<div aria-labelledby="headingOne" class="collapse show" data-parent="#accordionExample" id="collapseOne">
									<div class="card-body">
										<p>Select Delivery Date & time so we can delivery product on same time</p>
										<form>
											<div class="form-row align-items-center">
												<div class="col-auto">
													<label class="sr-only">Date</label>
													<div class="input-group mb-2">
														<div class="input-group-prepend">
															<div class="input-group-text p-1">
																<span class="mdi mdi-calendar-check"></span>
															</div>
														</div>
														<?php 
$date = date('Y-m-d'); //today date
$weekOfdays = array();
$orig = array();
for($i =1; $i <= 6; $i++){
    $date = date('Y-m-d', strtotime('+1 day', strtotime($date)));
    $weekOfdays[] = date('Y-m-d', strtotime($date));
	$orig[] = date('d-m-Y', strtotime($date));
}
?>
 <select class="form-control" id="date-selected">
 <option value="">Select A Date</option>
 <?php
 for($i=0;$i<count($weekOfdays);$i++)
 {
	 ?>
	 <option value="<?php echo $weekOfdays[$i];?>"><?php echo $orig[$i];?></option>
	 <?php 
 }	 
 ?>
 </select>
													</div>
												</div>
												<div class="col-auto">
													<button aria-controls="collapseTwo" aria-expanded="false" class="btn btn-secondary mb-2 btn-lg" data-target="#collapseTwo" data-toggle="collapse" type="button">NEXT</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="card checkout-step-two">
								<div class="card-header" id="headingTwo">
									<h5 class="mb-0"><button aria-controls="collapseTwo" aria-expanded="false" class="btn btn-link collapsed" data-target="#collapseTwo" data-toggle="collapse" type="button"><span class="number">2</span>Delivery Time</button></h5>
								</div>
								<div aria-labelledby="headingTwo" class="collapse" data-parent="#accordionExample" id="collapseTwo">
									<div class="card-body">
										<form>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="control-label">Delivery Time <span class="required">*</span></label> 
														<?php 
														$timelist = $con->query("select * from timeslot");
														while($row = $timelist->fetch_assoc())
														{
														?>
														<div class="form-check">
														  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios<?php echo $row['id']; ?>" value="<?php echo   date("g:i A", strtotime($row['mintime'])).' - '.date("g:i A", strtotime($row['maxtime'])); ?>">
														  <label class="form-check-label" for="exampleRadios<?php echo $row['id']; ?>">
														 <?php echo   date("g:i A", strtotime($row['mintime'])).' - '.date("g:i A", strtotime($row['maxtime'])); ?>
														  </label>
														</div>
														<?php } ?>
													</div>
												</div>
												
											</div>
										
											<button aria-controls="collapseThree" aria-expanded="false" class="btn btn-secondary mb-2 btn-lg" data-target="#collapseThree" data-toggle="collapse" type="button">NEXT</button>
										</form>
									</div>
								</div>
							</div>

							<div class="card">
								<div class="card-header" id="headingThree">
									<h5 class="mb-0"><button aria-controls="collapseThree" aria-expanded="false" class="btn btn-link collapsed" data-target="#collapseThree" data-toggle="collapse" type="button"><span class="number">3</span> Payment</button></h5>
								</div>
								<div aria-labelledby="headingThree" class="collapse" data-parent="#accordionExample" id="collapseThree">
									<div class="card-body">
										<div class="row">
										<?php
              $p_list = $con->query("select * from payment_list where status=1");	
 while($row = $p_list->fetch_assoc())
 {	 
										?>
										<div class="col-lg-6 col-md-6" style="margin-bottom: 10px;">
											<div class="card p-2">
												<div class="row d-flex align-items-center">
													<div class="col-sm-4 col-6">
														<img class="card-img custom-img-payment" src="<?php echo $path.$row['img'];?>" alt="Card image"/>
													</div>
													<div class="col-sm-6 col-6">
														<div class="card-body-right">
															
																<input  value="<?php echo $row['title'];?>" id="customRadio<?php echo $row['id']; ?>" name="customRadio" type="radio">  <label class="card-title" for="customRadio<?php echo $row['id']; ?>" ><?php echo $row['title'];?></label>
															
														</div>
												 	</div>
												</div> 
  											</div>
											</div>
 <?php } ?>
  										<br>
  									

										</div>
												
										<button aria-controls="collapseThree" aria-expanded="false" class="btn btn-secondary mb-2 btn-lg" data-target="#collapseFive" data-toggle="collapse" type="button">NEXT</button>	
									</div>
								</div>
							</div>
							<div class="card checkout-step-two">
							
								<div class="card-header" id="headingFive">
									<h5 class="mb-0"><button aria-controls="collapseFive" aria-expanded="false" class="btn btn-link collapsed" data-target="#collapseFive" data-toggle="collapse" type="button"><span class="number">4</span> Delivery Address</button></h5>
								</div>
								<div aria-labelledby="headingFive" class="collapse" data-parent="#accordionExample" id="collapseFive">
									<div class="card-body">
										<form>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="control-label">Current Address <span class="required">*</span></label> 
														<address>
															

<?php 
$add = $con->query("select * from address where uid=".$_SESSION['log_user']." and status=1 and primary_add=1")->fetch_assoc();
$add_list = $con->query("select * from address where uid=".$_SESSION['log_user']." and  primary_add=1");
if($add_list->num_rows == 0)
{
	?>
	<img src="img/address.svg"/>
	<h6 style="text-align:center;margin-top:10px;"><b>Click Add Button And Add New Address And Make A Primary Address Then Visible Here</b></h6>
	<?php 
}
else 
{

echo $add['name'].' '.$add['type'].'<br>'.$add['hno'].','.$add['society'].','.$add['landmark'].'<br>'.$add['area'].'-'.$add['pincode'];
$d_charge = $con->query("select * from area_db where name='".$add['area']."'")->fetch_assoc();
$d_charges = $d_charge['dcharge'];
}
?>

														</address>
														<input type="hidden" id="add_id" value="<?php echo $add['id'];?>"/>
													</div>
												</div>
												<div class="col-sm-6 text text-right">
													<a href="my-address.php"  class="btn btn-secondary mb-2 btn-lg">CHANGE OR ADD ADDRESS</a>
												</div>
											</div>
										
											<button aria-controls="collapseThree" aria-expanded="false" class="btn btn-secondary mb-2 btn-lg" data-target="#collapsefour" data-toggle="collapse" type="button">NEXT</button>
										</form>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-header" id="headingThree">
									<h5 class="mb-0"><button aria-controls="collapsefour" aria-expanded="false" class="btn btn-link collapsed" data-target="#collapsefour" data-toggle="collapse" type="button"><span class="number">5</span> Coupon or Promo Code  <i class="mdi mdi-tag-outline"></i></button></h5>
								</div>
								<div aria-labelledby="headingThree" class="collapse" data-parent="#accordionExample" id="collapsefour">
									<div class="card-body">
										<div class="text-center">
											<div class="col-lg-10 col-md-10 mx-auto order-done">
												<p class="offer-price font">Have a Coupon Code?</p>
											</div>
											<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="YOUR COUPON CODE" id="c_value_coupon" value="" aria-label="Recipient's username" aria-describedby="basic-addon2" disabled="">
  <div class="input-group-append cou-btn">
    <a href="" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalCenter">APPLY</a>
  </div>
</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					
<div class="cart-sidebar-payment">
<div class="cart-sidebar-header">
<h5>
My Cart <span class="text-success">(<?php echo $con->query("select * from cart_sess where s_key='".$sessionid."'")->num_rows;?> item)</span> 
</h5>
</div>
<div class="cart-sidebar-body-payment">
<?php 
$q_cart = $con->query("select * from cart_sess where s_key='".$sessionid."'");

$qu = 0;
$total_main = 0;
while($re = $q_cart->fetch_assoc())
{
?>
<div class="cart-list-product">

<img class="img-fluid" src="<?php echo $re['pimg'];?>" alt="">
<h5><a href="#"><?php echo $re['pname'];?></a></h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - <?php echo $re['ptype'];?></h6>
<p class="offer-price mb-0"><?php echo $re['dprice'].' '.$fset['currency'];?> X <?php echo $re['quantity'];?></p>
</div>
<?php
$total = $re['dprice'] * $re['quantity'];
$qu = $qu + $re['quantity'];
$total_main = $total_main + $total;

?>
<?php } 
$tax = $total_main * $fset['tax']/100;
$main_total = $total_main + $d_charges + $tax;
?>
</div>
<div class="cart-sidebar-footer">
<div class="cart-store-details">
<p>Sub Total <strong class="float-right"><?php echo $total_main.' '.$fset['currency'];?></strong></p>
<p>Delivery Charges <strong class="float-right text-danger"><?php echo $d_charges.' '.$fset['currency'];?></strong></p>
<p>Discount <strong class="float-right text-success discount_txt"><?php echo 0;?></strong>
<input type="hidden" id="c_id" value="0"/>
</p>
<p>Tax <strong class="float-right text-danger">+ <?php echo $tax.' '.$fset['currency']; ?></strong></p>

</div>
<a href="javascript:void(0);"><button class="btn btn-secondary btn-lg btn-block text-left order_btn" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Order </span><span class="float-right"><strong id="main_total"><?php echo $qu.' Items | '.$main_total.' '.$fset['currency']; ?></strong> <span class="mdi mdi-chevron-right"></span></span></button></a>
</div>
</div>

				</div>
			</div>
		</div>
	</section>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLongTitle">Have a Coupon Code?
</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
		<?php 
		$sel = $con->query("select * from tbl_coupon where status=1");
		$timestamp = date("Y-m-d");
		while($row = $sel->fetch_assoc())
{
    if($row['cdate'] < $timestamp)
	{
		$con->query("update tbl_coupon set status=0 where id=".$row['id']."");
	}
	else 
	{
		?>
        	<div class="main-coupon ">
			    <div class="row">
			      <div class="col-md-6 coupon-design">
			      	<div class="coupon">
			      		<img src="<?php echo $path.$row['c_img'];?>">
			      		<h5><?php echo $row['c_title'];?></h5>
			      	</div>
			      </div>
			      <div class="col-md-6">
			      	<div class="text-right">
					<?php
                     if($main_total >= $row['min_amt'])
					 {						 
					?>
			      		<button type="button" data-val="<?php echo $row['c_value'];?>" data-title="<?php echo $row['c_title'];?>" data-id="<?php echo $row['id'];?>" class="btn btn-secondary btn-coupon"><?php echo $row['c_value'].' '.$fset['currency'];?></button>
					 <?php } else { 
					 ?>
					 <button type="button" class="btn btn-secondary">Not Applicable</button>
					 <?php 
					 }?>
			      	</div>
			      </div>
			      <div class="col-md-12 more">
			      	<h5 class="pt-2"><?php echo $row['ctitle'];?></h5>
			      	<p ><?php echo $row['c_desc'];?></p>
			      </div>
			    </div>
		    </div>
		    <hr>
<?php } }?>
		</div>
      </div>
      
    </div>
  </div>
</div>
<input type="hidden" id="final_total_order_verify" value="<?php echo $total_main; ?>"/>
	<?php 
	require 'footer.php';
	?>
	
