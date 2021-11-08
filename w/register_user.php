<?php 
require 'admin/include/dbconfig.php'; 
$path = 'admin/';

if(isset($_POST['name']))
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$mobile = $_POST['mob'];
	$ccode = $_POST['code'];
	$password = $_POST['pass'];
	$imei = uniqid();
	$timestamp = date("Y-m-d H:i:s");
	$checkmob = $con->query("select * from user where mobile='".$mobile."'");
    $checkemail = $con->query("select * from user where email='".$email."'");
   
    if($checkmob->num_rows != 0)
    {
        $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Mobile Number Already Used!");
    }
     else if($checkemail->num_rows != 0)
    {
        $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Email Address Already Used!");
    }
    else
    {
	$con->query("insert into user(`name`,`imei`,`email`,`mobile`,`rdate`,`password`,`ccode`,`v_email`)values('".$name."','".$imei."','".$email."','".$mobile."','".$timestamp."','".$password."','".$ccode."',0)");
    
        $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Registration successfully Please Check Mail Id Verification Code Sent!");

}
echo json_encode($returnArr);
}