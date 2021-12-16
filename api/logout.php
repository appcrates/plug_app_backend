<?php 
require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
if($data['id'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $id = strip_tags(mysqli_real_escape_string($con,$data['id']));
    
    $update_user_token = $con->query("UPDATE user SET fcm_token = '' where id='".$id."' ");
    $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Logout successfully!");
}

echo json_encode($returnArr);
