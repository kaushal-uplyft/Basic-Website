<?php

include('config.php');
// session_start();
?>

<?php

  $CustomerUserId = $_GET['UserId'];
  $MembershipPlanId = $_GET['MembershipId'];
  $MembershipType = $_GET['ClassMembershipType'];
  $class_id = $_GET['BatchId'];
  $record_date = $_GET['SubscriptionStartDate'];
  // $format_record_date = $record_date;
  $format_record_date = date('d-m-Y', strtotime($record_date));
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
      // CURLOPT_URL => $api_endpoint."api/v1/subscription-order-summary/",
      CURLOPT_URL => $api_endpoint."api/v1/add-subscription/",
      // CURLOPT_SSL_VERIFYPEER => true,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      // CURLOPT_POSTFIELDS => "CustomerUserId=$cust_user_id&RecordDate=$record_date&ClassId=$class_id&SubscriptionId=$subscription_id",
      CURLOPT_POSTFIELDS => "CustomerUserId=$CustomerUserId&MembershipPlanId=$MembershipPlanId&ClassId=$class_id&SubscriptionStartDate=$record_date&ClassMembershipType=$MembershipType",
      CURLOPT_HTTPHEADER => array(
        'content-type: application/x-www-form-urlencoded',
        'Authorization:'.$auth_key,
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $book_info =  json_decode($response, true);
    $book_info_status_code = $book_info['status_code'];

    if($book_info_status_code == '200'){

      echo "<script type='text/javascript'> document.location = 'class_book.php?RecordDate=$format_record_date'; </script>";
    }
    ?>
