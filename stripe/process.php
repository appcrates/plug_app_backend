<?php
//check if stripe token exist to proceed with payment
if(!empty($_POST['stripeToken'])){
    // get token and user details
    $stripeToken  = $_POST['stripeToken'];
    $custName = $_POST['custName'];
    $custEmail = $_POST['custEmail'];
    $cardNumber = $_POST['cardNumber'];
    $cardCVC = $_POST['cardCVC'];
    $cardExpMonth = $_POST['cardExpMonth'];
    $cardExpYear = $_POST['cardExpYear'];    
    //include Stripe PHP library
    require_once('stripe-php/init.php');    
    //set stripe secret key and publishable key
    $stripe = array(
      "secret_key"      => "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",
      "publishable_key" => "pk_live_51JlwEwJazRFm94TK089VpWQNRJ4fTKB9fSIKdMTQkRGedVfPUuQjIbxRFFX6Smpy6E0K4qvODWyaOeNeTujolFWc00lMlgmCnf"
    );    
    \Stripe\Stripe::setApiKey($stripe['secret_key']);    
    //add customer to stripe
    if (isset($_POST['stripeToken'])){
    $customer = \Stripe\Customer::create(array(
        'email' => $custEmail,
        'source'  => $stripeToken
    ));    
    // item details for which payment made
    $itemName = "theplugg_items";
    $itemNumber = md5(uniqid(rand(), true));
    $itemPrice = $_POST['itemprice'];
    $currency = "inr";
    $orderID = md5(uniqid(rand(), true));    
    // details for which payment performed
    $payDetails = \Stripe\Charge::create(array(
        'customer' => $customer->id,
        'amount'   => $itemPrice,
        'currency' => $currency,
        'description' => $itemName,
        'metadata' => array(
            'order_id' => $orderID
        )
    ));  
    }
    // get payment details
    $paymenyResponse = $payDetails->jsonSerialize();
    // check whether the payment is successful
    if($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1){
        // transaction details 
        
        $amountPaid = $paymenyResponse['amount'];
        $balanceTransaction = $paymenyResponse['balance_transaction'];
        $paidCurrency = $paymenyResponse['currency'];
        $paymentStatus = $paymenyResponse['status'];
        $tid = $paymenyResponse['balance_transaction'];
        
        $paymentDate = date("Y-m-d H:i:s");        
        //insert tansaction details into database
		
       //if order inserted successfully
       if( $paymentStatus == 'succeeded'){
            
            $returnArr = array("Transaction_id"=>$tid,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"The payment was successful!!");
            
       } else{
         
          
          $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Payment failed!!");
       }
    } else{
        $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Payment failed!!");
    }
    echo json_encode($returnArr);
} 

?>