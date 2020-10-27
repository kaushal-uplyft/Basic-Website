<?php
include('config.php');

// echo $api_endpoint; // 'localhost'
?>

<?php
$api_endpoint = $api_endpoint;
if (isset($_POST['save'])){

  $first_name = $_POST['user_name'];
  $email = $_POST['user_mail'];
  $isd_code = $_POST['user_country_code'];
  $mobile_no = $_POST['user_mobile'];

  $notes = 'Customer Enquiry From The Website';
  $entry_point = 'Website';

  $curl = curl_init();

  $auth_header = array(
    'content-type: application/x-www-form-urlencoded',
    'Authorization:'.$auth_key,
  );


  curl_setopt_array($curl, array(
    // CURLOPT_URL => "https://www.yourdeadlift.com/api/v1/website-customer-register/",
    CURLOPT_URL => $api_endpoint."api/v1/customer-register/",
    // CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    // CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_POSTFIELDS => "FirstName=$first_name&IsdCode=$isd_code&CustomerMobile=$mobile_no&CustomerEmail=$email&EntryPoint=$entry_point&Notes=$notes",
    CURLOPT_HTTPHEADER => $auth_header,
  ));
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  $json_response = json_decode($response, true);
  $register_response_code = $json_response['status_code'];
  $cust_user_id = $json_response['data']['CustomerUserId'];
  $cust_profile_id = $json_response['data']['CustomerProfileId'];
  if(  $register_response_code == '200' ){

    $user_payload =  $json_response['data']['Payload'];
    $cust_user_id =  $json_response['data']['CustomerUserId'];

    $_SESSION["cust_payload"] = $user_payload;
    $_SESSION["cust_user_id"] = $cust_user_id;

    header("Location: membership_list.php"); /* Redirect browser */
    exit();
  }

}
 ?>
