<?php

include('config.php');
// session_start();
?>

<?php

  $subscription_id = $_GET['SubscriptionId'];
  $class_id = $_GET['ClassId'];
  $record_date = $_GET['RecordDate'];
  $format_record_date = $record_date;
  $record_date = date('Y-m-d', strtotime($record_date));

  $cust_payload = $_SESSION["cust_payload"];
  $cust_user_id = $_SESSION["cust_user_id"];
  if($cust_user_id){

  }
  else{
    echo "<script type='text/javascript'> document.location = 'user_verify.php'; </script>";
  }
?>


<?php

    $curl = curl_init();
    // $username = urlencode(‘user-name’);
    // $password = urlencode(‘password’);

    curl_setopt_array($curl, array(
      CURLOPT_URL => $api_endpoint."api/v1/cancel-class/",
      // CURLOPT_SSL_VERIFYPEER => true,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "CustomerUserId=$cust_user_id&RecordDate=$record_date&ClassId=$class_id&SubscriptionId=$subscription_id",
      CURLOPT_HTTPHEADER => array(
        'content-type: application/x-www-form-urlencoded',
        'Authorization:'.$auth_key,
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $cancle_info =  json_decode($response, true);
    $cancle_info_status_code = $cancle_info['status_code'];

    if($cancle_info_status_code == '200'){
      echo "<script type='text/javascript'> document.location = 'class_book.php?RecordDate=$format_record_date'; </script>";
    }
    ?>
