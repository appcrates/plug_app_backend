<?php 
use \MyUser\MyUserPay;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'MyUserPay/init.php'; //path/to/MyUserPay library
MyUserPay::setPrivateKey('sk_test_b6fd42687e3d8b88023005ea10c906d9');


$process = MyUserPay::charge(
array(
'amount'=>$_POST['amt'],
//If request was post
'token'=>$_POST['MyUserToken'],
)
);
if($process['status']){
//success
$charge_id = $process['id'];
?>
<script>
    window.location.href="index.php?msg=payment_success&charge_id=<?php echo $charge_id;?>";
</script>
<?php 
}else{
//error
$error = $process['error']['message'];
$returnArr = array("ResponseCode"=>"200","Result"=>"false","ResponseMsg"=>$error);
$msg = json_encode($returnArr);
?>
<script>
    window.location.href="index.php?msg=<?php echo $error;?>";
</script>
<?php 
}