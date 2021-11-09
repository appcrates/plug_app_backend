<?php
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
try {
    require_once "stripe-php/init.php";
    $stripe = new \Stripe\StripeClient($sk);
    $tokens = $stripe->tokens->create([
      'card' => [
        'number' => '4242424242424242',
        'exp_month' => 11,
        'exp_year' => 2022,
        'cvc' => '314',
      ],
    ]);
    $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Successfully","data"=>$tokens);
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