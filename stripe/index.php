<?php 
include('header.php');
?>


<?php 
if(isset($_GET['name']))
{
?>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="payment.js"></script>
<?php include('container.php');?>



	
			
		
		<span class="paymentErrors"></span>	
		
			
			<form action="process.php" method="POST" id="paymentForm" style="display:none;">				
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="custName" value="<?php echo $_GET['name'];?>"  class="form-control">
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="custEmail" value="<?php echo $_GET['email'];?>" class="form-control">
				</div>
				<div class="form-group">
					<label>Card Number</label>
					<input type="text" name="cardNumber" size="20" autocomplete="off" id="cardNumber" value="<?php echo $_GET['cardno'];?>" class="form-control" />
				</div>	
				<div class="row">
				<div class="col-xs-4">
				<div class="form-group">
					<label>CVC</label>
					<input type="text" name="cardCVC" size="4" autocomplete="off" id="cardCVC" value="<?php echo $_GET['cvc'];?>" class="form-control" />
					<input type="text" name="itemprice" size="4" autocomplete="off" id="itemprice" value="<?php echo $_GET['amt'];?>" class="form-control" hidden/>
				</div>	
				</div>	
				</div>
				<div class="row">
				<div class="col-xs-10">
				<div class="form-group">
					<label>Expiration (MM/YYYY)</label>
					<div class="col-xs-6">
						<input type="text" name="cardExpMonth" placeholder="MM" size="2" id="cardExpMonth" value="<?php echo $_GET['mm'];?>" class="form-control" /> 
					</div>
					<div class="col-xs-6">
						<input type="text" name="cardExpYear" placeholder="YYYY" size="4" id="cardExpYear" value="<?php echo $_GET['yyyy'];?>" class="form-control" />
					</div>
				</div>	
				</div>
				</div>
				<br>	
				<div class="form-group">
					<input type="submit" id="makePayment" class="btn btn-success" value="Make Payment">
				</div>			
			</form>	
			
			<script>
			    window.setTimeout(function() { document.getElementById('makePayment').click();}, 2000);

			</script>
		<?php } ?>
		


<?php include('footer.php');?>

