<?php

$data = json_decode(file_get_contents('php://input'), true);
$token = $data['token'];

$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Successfully","data" => $token);
echo json_encode($returnArr);
// echo json_encode("sdfsdfasdfasdfasdfasdfs");
die;

//check if stripe token exist to proceed with payment
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$adata = $con->query("select cred_value from payment_list where title='Stripe' ")->fetch_assoc();
$cred_value = $adata['cred_value'];
$keys = explode(",",$cred_value);
$pk = $keys[0];
$sk = $keys[1];
// echo $sk;
// die;
require_once "stripe-php/init.php";
$stripe = new \Stripe\StripeClient($sk);
if(isset($_POST['token'])){
    
}
try {
    if(isset($_POST['token'])){
        $customer=  $stripe->customers->create([
          'description' => 'My First Test Customer (created for API docs)',
          'source'=>$_POST['token']
        ]);
        $customer=$customer["id"];
    }else if(isset($_POST['stripe_customer_id'])){
        $customer=$_POST['stripe_customer_id'];
    }
    
 
    // $payment=$stripe->charges->create([
    //   'amount' => $_POST['amount'],
    //   'currency' => 'usd',
    // //   'source' => $token,
    //   "customer" => $customer,
    //   'description' => 'My First Test Charge (created for API docs)',
    // ]);
    
    $payment = $stripe->charges->create([
            "amount" => $_POST['amount'] * 100,
            "currency" => "USD",
            "source" => $_POST['token'],
            "description" => "Making test payment."
        ]);
    
    $data=$con->query("update user set stripe_customer_id='".$customer."' where id=".$_POST['user_id']." ");
    $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Successfully","data"=>$payment);
    echo json_encode($returnArr);
    // print_r($tokens);
    die;
}
catch(Stripe_CardError $e) { 
    $finalresult = array('code' => 100,
    		          'msg' => "Your card is declined make sure its is valid or not expired"
    		          );
}
catch (Stripe_InvalidRequestError $e) { 
    $finalresult = array('code' => 100,
    		          'msg' => "Your card is declined make sure its is valid or not expired",
    		          );
}
catch (Stripe_AuthenticationError $e) { 
    $finalresult = array('code' => 100,
                        'msg' => "Your card is declined make sure its is valid or not expired",
                        ); 
}
catch (Stripe_ApiConnectionError $e) { 
    $finalresult = array('code' => 100,
                        'msg' => "Your card is declined make sure its is valid or not expired",
                        );
} 
catch (Stripe_Error $e) { 
    $finalresult = array('code' => 100,
                        'msg' => "Your card is declined make sure its is valid or not expired",
    		           );
} 
catch (Exception $e) { 
    $finalresult = array('code' => 100,
    		          'msg' => "Your card is declined make sure its is valid or not expired",
    		          );
}



?>