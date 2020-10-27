<?php
include('config.php');
$cust_payload = $_SESSION["cust_payload"];
$cust_user_id = $_SESSION["cust_user_id"];
// echo $api_endpoint; // 'localhost'
?>

<?php

echo "cust DOB";
$api_endpoint = $api_endpoint;
if (isset($_POST['save'])){
// if (!isset($_POST['save'])){

  $record_date = $_POST['class_record_date'];

  $format_record_date = date_create($record_date);
  $class_record_date = date_format($format_record_date,"Y-m-d");

  $curl = curl_init();

  $auth_header = array(
    'content-type: application/x-www-form-urlencoded',
    'Authorization:'.$auth_key,
  );


  curl_setopt_array($curl, array(
    // CURLOPT_URL => "https://www.yourdeadlift.com/api/v1/website-customer-register/",
    CURLOPT_URL => $api_endpoint."api/v1/class-listing/",
    // CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    // CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_POSTFIELDS => "CustomerUserId=$cust_user_id&RecordDate=$class_record_date",
    CURLOPT_HTTPHEADER => $auth_header,
  ));
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  $json_response = json_decode($response, true);
  $register_response_code = $json_response['status_code'];
  // echo $json_response;
  if(  $register_response_code == '200' ){
      echo "****** Step 3 ******";
      $class_list_obj = $json_response['data']['ClassList'];
      header("Location: class_book.php");

        }
}
 ?>
