<?php
require 'db.php';
// echo "bilal";
// die;
$data = json_decode(file_get_contents('php://input'), true);
$user_id = $data['user_id'];

if($user_id == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
    $charge = $con->query("select * from user_stripe_card where user_id='".$user_id."'");
    $count = $con->query("select * from user_stripe_card where user_id='".$user_id."'")->num_rows;
    if($count != 0)
    {
	    $myarray = array();
        while($row = $charge->fetch_assoc())
        {
            $chg['id'] = $row['id'];
        	$chg['stripe_card_id'] = $row['stripe_card_id'];
        	$chg['last_4_digit'] = $row['last_4_digit'];
        	$chg['stripe_customer_id'] = $row['stripe_customer_id'];
        	$chg['stripe_card_expiry_year'] = $row['stripe_card_expiry_year'];
        	$chg['stripe_card_expiry_month'] = $row['stripe_card_expiry_month'];
        	$chg['card_brand'] = $row['card_brand'];
        	$chg['stripe_card_funding'] = $row['stripe_card_funding'];
        	$myarray[] = $chg;
        }
        $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Successfully","data"=>$myarray);
    }
    else 
    {
        $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Card Not Found!!!");	
    }
}
echo json_encode($returnArr);
mysqli_close($con);
?>