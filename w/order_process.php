<?php 
require 'header.php';
 
if(!isset($_SESSION['log_user']))
{
	?>
	<script>
	window.location.href="orderlist.php";
	</script>
	<?php 
}
?>

<div class="text-center">
<?php 

if(isset($_GET['order_status']))
{
	if($_GET['order_status'] == 'success')
	{
		?>
		<img src="img/loader.gif"  style="display:none;" id="loader"/>
<img src="img/order-placed.png"  id="place"/>
<img src="img/wrong.png" style="display:none;" id="wrong"/>
<script>
setTimeout(function(){ window.location.href="orderlist.php"; }, 3000);
</script>
		<?php 
	}
	else 
	{
		?>
		<img src="img/loader.gif"  style="display:none;" id="loader"/>
<img src="img/order-placed.png"  style="display:none;" id="place"/>
<img src="img/wrong.png"  id="wrong"/>
<script>
setTimeout(function(){ window.location.href="/"; }, 3000);
</script>
		<?php 
	}
}else{?>
<img src="img/loader.gif"  <?php if(isset($_POST['pay_list'])){if($_POST['pay_list'] == 'Paypal') {?> style="display:none;" <?php } }?>id="loader"/>
<img src="img/order-placed.png" style="display:none;" id="place"/>
<img src="img/wrong.png" style="display:none;" id="wrong"/>
<?php } ?>
</div>

<?php
if(isset($_POST['pay_list']))
{
 if($_POST['pay_list'] == 'Paypal') {?>
<div id="paypal-button-container" style="    padding: 10px;
    text-align: center;
    margin: 120px;"></div>
<?php } } ?>

<?php 


if(isset($_POST['payer_status']))
{
	$tid = $_POST['txn_id'];

$con->query($_SESSION['Main_Query']);
$inid = $con->insert_id;
$con->query("update orders set tid='".$tid."' where id=".$inid."");
unset($_SESSION['Main_Query']);

$con->query("delete from cart_sess where s_key='".$sessionid."'");
if(!isset($_SESSION['Main_Query']))
{
	?>
	<script>
	window.location.href="orderlist.php";
	</script>
	<?php 
}
?>
<script>
document.getElementById("loader").style.display = 'none';
document.getElementById("place").style.display = 'initial';
document.getElementById("wrong").style.display = 'none';
setTimeout(function(){ window.location.href="orderlist.php"; }, 3000);

</script>
<?php 
}

?>


<?php 
	require 'footer.php';
	?>
	
	<?php 
if(isset($_POST['pay_list']))
{
$uid = $_SESSION['log_user'];
$timestamp = date("Y-m-d");
$pay_name = $_POST['pay_list'];
$timesloat = $_POST['timslot'];
$ddate = $_POST['date_new'];
$add_id = $_POST['add_id'];
$wallet = 0;
$coupon_id = $_POST['coupon_id'];
$cdata = $con->query("SELECT * FROM `tbl_coupon` where id=".$coupon_id."")->fetch_assoc();
$c_amt = $cdata['c_value'];
if($c_amt == '')
{
	$c_amt = 0;
}
$s_key = $_POST['s_key'];
$oid ='#'.uniqid();
$add = $con->query("select * from address where uid=".$_SESSION['log_user']." and status=1 and primary_add=1")->fetch_assoc();
$d_charge = $con->query("select * from area_db where name='".$add['area']."'")->fetch_assoc();
$d_chargess = $d_charge['dcharge'];

$q_carts = $con->query("select * from cart_sess where s_key='".$s_key."'");

$qu_list = 0;
$total_main_list = 0;
$pname= array();
$price = array();
$ptype =array();
$pid = array();
$quantity = array();
while($res = $q_carts->fetch_assoc())
{
	$total_list = $res['dprice'] * $res['quantity'];
$qu_list = $qu_list + $res['quantity'];
$total_main_list = $total_main_list + $total_list;
$pname[] = $res['pname'];
$price[] = $res['price'];
$ptype[] = $res['ptype'];
$pid[] = $res['pid'];
$quantity[] = $res['quantity'];
}
$status = 'pending';
$pname = implode('$;',$pname);
$pid = implode('$;',$pid);
$ptype = implode('$;',$ptype);
$pprice = implode('$;',$price);
$qty = implode('$;',$quantity);
$tid = 0;
$taxs = $total_main_list * $fset['tax']/100;
$main_total_list = $total_main_list + $d_chargess + $taxs;

if($coupon_id != 0)
{
	$main_total_list = $main_total_list - $c_amt;
}
$main_query = "insert into orders(`oid`,`uid`,`pname`,`pid`,`ptype`,`pprice`,`ddate`,`timesloat`,`order_date`,`status`,`qty`,`total`,`p_method`,`address_id`,`tax`,`tid`,`cou_amt`,`coupon_id`,`wal_amt`)values('".$oid."',".$uid.",'".$pname."','".$pid."','".$ptype."','".$pprice."','".$ddate."','".$timesloat."','".$timestamp."','".$status."','".$qty."',".$main_total_list.",'".$pay_name."',".$add_id.",".$fset['tax'].",'".$tid."',".$c_amt.",".$coupon_id.",".$wallet.")";
$_SESSION['Main_Query'] = $main_query;
if($pay_name == 'Razorpay')
{
?>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "rzp_test_5MuBh6FB59ekR5", // Enter the Key ID generated from the Dashboard
    "amount": "<?php echo number_format((float)$main_total_list, 2, '.', '') * 100; ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "Hungry Grocery Soluation",
    "description": "Hungry Order total",
    "handler": function (response){
        var pay_id = response.razorpay_payment_id;
        var sess_key = "<?php echo $sessionid; ?>";
		$.ajax({
		url : "raz_payment.php",
		data : "razorpay_payment_id="+pay_id+"&sess_key="+sess_key,
		type : 'post'
		})
		$("#loader").hide();
$("#place").show();
$("#wrong").hide();
setTimeout(function(){ window.location.href="orderlist.php"; }, 3000);
    },
	"modal": {
    "ondismiss": function(){
         $("#loader").hide();
$("#place").hide();
$("#wrong").show();
setTimeout(function(){ window.location.href="/"; }, 3000);
     }
	},
};
var rzp1 = new Razorpay(options);

    rzp1.open();
   

</script>
<?php 	
}
else if($pay_name == 'Cash On Delivery')
{
	$con->query($_SESSION['Main_Query']);

unset($_SESSION['Main_Query']);
$con->query("delete from cart_sess where s_key='".$sessionid."'");
?>
<script>
$("#loader").hide();
$("#place").show();
$("#wrong").hide();
setTimeout(function(){ window.location.href="orderlist.php"; }, 3000);

</script>
<?php 
}
else if($pay_name == 'Pickup Myself')
{
	$con->query($_SESSION['Main_Query']);

unset($_SESSION['Main_Query']);
$con->query("delete from cart_sess where s_key='".$sessionid."'");
?>
<script>
$("#loader").hide();
$("#place").show();
$("#wrong").hide();
setTimeout(function(){ window.location.href="orderlist.php"; }, 3000);

</script>
<?php 
}

else if($pay_name == 'Paypal')
{
	?>
	
    <script
    src="https://www.paypal.com/sdk/js?client-id=AW8CqmItuz06cc5UedjUrm8BuxX4dERd29RD2cwc-GOc6XF35v6jv3fZYak10mi6fRSvx24R-XMqo5EE&disable-funding=credit,card&currency=USD"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
  </script>    
     <script>
  paypal.Buttons({
	  style: {
    layout:  'vertical',
    color:   'gold',
    shape:   'pill',
    label:   'pay'
  },
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: "<?php echo number_format((float)$main_total_list, 2, '.', ''); ?>"
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
	  
	  $(".preloader").show();
      actions.order.capture().then(function(details) {
                // Call your server to validate and capture the transaction
				
                return fetch('paypal_order.php', {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify({
					payid: details.id, 
              status: details.status,
			  s_key:"<?php echo $sessionid; ?>"
					})
                }).then((response) => response.json())
.then((responseData) => {
	
      if(responseData.status == "ok"){
           window.location.href="order_process.php?order_status=success";
      }
	  else 
	  {
		  window.location.href="order_process.php?order_status=failed";
	  }
})
            });
        }
  }).render('#paypal-button-container');
</script>
	<?php 
}
else 
{
	
}
}
?>