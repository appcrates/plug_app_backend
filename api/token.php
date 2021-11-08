<?php

$url = "https://api.stripe.com/v1/terminal/connection_tokens";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Accept: application/json",
   "Authorization: Bearer sk_test_5ojZQQ2ww8JM2uieGz4r6XqG008CLj4jqO",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POST, 1);
$resp = curl_exec($curl);
curl_close($curl);
$data = json_decode($resp);

echo json_encode(array('secret' => $data->secret));

?>