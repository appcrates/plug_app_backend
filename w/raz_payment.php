<?php 
require 'admin/include/dbconfig.php';

if(isset($_POST['razorpay_payment_id']))
{
	$sessionid = $_POST['sess_key'];
$tid = $_POST['razorpay_payment_id'];	
$con->query($_SESSION['Main_Query']);
$inid = $con->insert_id;
$con->query("update orders set tid='".$tid."' where id=".$inid."");
unset($_SESSION['Main_Query']);

$con->query("delete from cart_sess where s_key='".$sessionid."'");
}