<?php
require 'admin/include/dbconfig.php';   
if(isset($_POST['s_key']))
{
	
	$s_key = $_POST['s_key'];
	echo $con->query("select * from cart_sess where s_key='".$s_key."'")->num_rows;
	
	
}

?>