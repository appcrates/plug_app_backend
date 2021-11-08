<?php 
require 'admin/include/dbconfig.php';
header('Content-Type: application/json');
$content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content, true);
	if(! is_array($decoded)) {
       echo '{"status":"error"}';
    } else {
$status = $decoded['status'];
        $payid = $decoded['payid'];
		$s_key = $decoded['s_key'];
		if($status == 'COMPLETED')
		{
			$con->query($_SESSION['Main_Query']);
$inid = $con->insert_id;
$con->query("update orders set tid='".$payid."' where id=".$inid."");
unset($_SESSION['Main_Query']);

$con->query("delete from cart_sess where s_key='".$s_key."'");
			echo '{"status":"ok"}';
		}
		else 
		{
			echo '{"status":"error"}';
		}
		
	}