<?php 
// require 'db.php';
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
if($data['user_id'] == '' )
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    require_once "stripe-php/init.php";
    $stripe = new \Stripe\StripeClient($sk);
        
    $user_id = $data['user_id'];
    $stripe_token = $data['stripe_token'];
    $stripe_card_id = $data['stripe_card_id'];
    $payment_bit = $data['payment_bit'];
    $last_4_digit = $data['last_4_digit'];
    $stripe_customer_id = $data['stripe_customer_id'];
    $stripe_card_expiry_year = $data['stripe_card_expiry_year'];
    $stripe_card_expiry_month = $data['stripe_card_expiry_month'];
    $card_brand = $data['card_brand'];
    $stripe_card_funding = $data['stripe_card_funding'];

    $amount = $data['amount'];
    $description = $data['description'];
    
    
    // $stripe_token               = empty($data['stripe_token']) ? $data['stripe_token'] : null;
    // $stripe_card_id             = empty($data['stripe_card_id']) ? $data['stripe_card_id'] : null;
    // $payment_bit                = empty($data['payment_bit']) ? $data['payment_bit'] : null;
    // $last_4_digit               = empty($data['last_4_digit']) ? $data['last_4_digit'] : null;
    // $stripe_customer_id         = empty($data['stripe_customer_id']) ? $data['stripe_customer_id'] : null;
    // $stripe_card_expiry_year    = empty($data['stripe_card_expiry_year']) ? $data['stripe_card_expiry_year'] : null;
    // $stripe_card_expiry_month   = empty($data['stripe_card_expiry_month']) ? $data['stripe_card_expiry_month'] : null;
    // $card_brand                 = empty($data['card_brand']) ? $data['card_brand'] : null;
    // $stripe_card_funding        = empty($data['stripe_card_funding']) ? $data['stripe_card_funding'] : null;
    // $amount                     = empty($data['amount']) ? $data['amount'] : null;
    // $description                = empty($data['description']) ? $data['description'] : null;

    $timestamp = date("Y-m-d H:i:s");
    
    try {
        if($payment_bit == 0){
            $charges = $stripe->charges->create([
                                                'amount' => $amount,
                                                'currency' => 'usd',
                                                'source' => $stripe_token,
                                                'description' => $description,
                                            ]);
        }elseif($payment_bit == 1){
           $charges = $stripe->customers->create([
                                                'source' => $stripe_token,
                                                'email' => "customer@theplugg.app",
                                                'description' => $description
                                            ]);
                                            
            $con->query("INSERT INTO `user_stripe_card` (`user_id`, `stripe_card_id`, `last_4_digit`, `stripe_customer_id`, `stripe_card_expiry_year`, `stripe_card_expiry_month`, `card_brand`, `stripe_card_funding`, `date_time`) 
            VALUES ('".$user_id."','".$stripe_card_id."','".$last_4_digit."','".$charges->id."','".$stripe_card_expiry_year."','".$stripe_card_expiry_month."','".$card_brand."','".$stripe_card_funding."','".$timestamp."')");
            $last_id = $con->insert_id;
            
        }elseif($payment_bit == 2){
            $charges = $stripe->charges->create([
                                                'amount' => $amount,
                                                'currency' => 'usd',
                                                // 'source' => $stripe_card_id,
                                                'customer' => $stripe_card_id,
                                                'description' => $description,
                                            ]);
        }else{
            $customers = $stripe->customers->create([
                                                'source' => $stripe_token,
                                                'email' => "customer@theplugg.app",
                                                'description' => $description
                                            ]);
            // print_r($customers);
            $charges = $stripe->charges->create([
                                                'amount' => $amount,
                                                'currency' => 'usd',
                                                'customer' => $customers->id,
                                                'source' => $customers->default_source,
                                                'description' => $description,
                                            ]);
                                            
            $con->query("INSERT INTO `user_stripe_card` (`user_id`, `stripe_card_id`, `last_4_digit`, `stripe_customer_id`, `stripe_card_expiry_year`, `stripe_card_expiry_month`, `card_brand`, `stripe_card_funding`, `date_time`) 
            VALUES ('".$user_id."','".$stripe_card_id."','".$last_4_digit."','".$customers->id."','".$stripe_card_expiry_year."','".$stripe_card_expiry_month."','".$card_brand."','".$stripe_card_funding."','".$timestamp."')");
            echo $last_id = $con->insert_id;
        }
        
        $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Successfully","data"=>$charges);
        echo json_encode($returnArr);
        // print_r($tokens);
        // die;
    }
    catch(Stripe_CardError $e) { 
        $returnArr = array('ResponseCode' => 100,
        		          'ResponseMsg' => "Your card is declined make sure its is valid or not expired"
        		          );
    }
}