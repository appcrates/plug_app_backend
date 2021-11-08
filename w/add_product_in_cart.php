<?php
require 'admin/include/dbconfig.php';
if(isset($_POST['s_key']))
{

$q=1;
	$pname = $_POST['pname'];
	$pimg = $_POST['pimg'];
	$ptype = $_POST['ptype'];
	$price = $_POST['price'];
	$disprice = trim($_POST['disprice']);
	$s_key = $_POST['s_key'];
	$pid = $_POST['pid'];
	$check_cart = $con->query("select * from cart_sess where ptype='".$ptype."' and s_key='".$s_key."' and pid=".$pid."")->num_rows;
	if($check_cart != 0)
	{
	$con->query("update cart_sess set quantity = quantity + 1 where ptype='".$ptype."' and s_key='".$s_key."' and pid=".$pid."");	
	echo 'Product Quantity Update Successfully!!';
	}
	else 
	{
	$con->query("insert into cart_sess(`s_key`,`quantity`,`pname`,`pimg`,`price`,`dprice`,`ptype`,`pid`)values('$s_key','$q','$pname','$pimg','$price','$disprice','$ptype','$pid')");
	
	echo 'Cart Update Successfully!!';
	}
}