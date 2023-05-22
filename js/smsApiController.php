<?php  

class smsApiController{
	public function text($phone, $message)
	{
	   $message = [
      "secret" => "135288b4fc70dee1f98963b33bf1c82b13e473b6", // your API secret from (Tools -> API Keys) page
      "mode" => "devices",
      "device" => "00000000-0000-0000-7178-a7687f7fb6ff",
      "sim" => 1,
      "priority" => 1,
      "phone" => $phone,
      "message" => $message
  ];

  $cURL = curl_init("https://sms.uncgateway.com/api/send/sms");
  curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($cURL, CURLOPT_POSTFIELDS, $message);
  $response = curl_exec($cURL);
  curl_close($cURL);

  $result = json_decode($response, true);

  // do something with response
  print_r($result);
	}
}


?>