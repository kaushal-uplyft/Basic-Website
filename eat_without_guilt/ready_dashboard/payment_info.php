<?php
include('config.php');

// echo $api_endpoint; // 'localhost'
?>

<?php

  $CustomerUserId = $_GET['UserId'];
  $MembershipPlanId = $_GET['MembershipId'];

  // var_dump($_POST);

  if (!empty($_POST)) {
    $razarpay_info = $_POST;
    if($razarpay_info['action_type']=="proceed_to_payment"){
      $pay_id = $razarpay_info['pay_id'] ;

      $curl = curl_init();
      // $username = urlencode(‘user-name’);
      // $password = urlencode(‘password’);

      curl_setopt_array($curl, array(
        CURLOPT_URL => $api_endpoint,
        // CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "CustomerUserId=$CustomerUserId&MembershipPlanId=$MembershipPlanId&PaymentType=OL",
        CURLOPT_HTTPHEADER => array(
          'content-type: application/x-www-form-urlencoded',
          'Authorization:'.$auth_key,
        ),
      ));
      $response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);
      $subscription_payment =  json_decode($response, true);
      // var_dump($CustomerUserIDd);
      // var_dump($MembershipPlanId);
      // var_dump($subscription_payment);

    }
  }

?>
