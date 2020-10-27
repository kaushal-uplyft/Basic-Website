<?php
include('config.php');

// echo $api_endpoint; // 'localhost'
?>
<?php
$is_verify = $_POST['verify'];
$user_number = $_POST['phone_no'];
// echo '<script>alert($is_verify)</script>';
// $user_number = "<script>document.writeln(number);</script>";
if($is_verify == '1'){
    $_SESSION["user_mobile_no"] = $user_number;
    $curl = curl_init();
    $auth_header = array(
        'content-type: application/x-www-form-urlencoded',
        'Authorization:'.$auth_key,
      );
      curl_setopt_array($curl, array(
      // CURLOPT_URL => "https://www.yourdeadlift.com/api/v1/website-customer-register/",
      CURLOPT_URL => $api_endpoint."api/v1/customer-login/",
      // CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      // CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_POSTFIELDS => "CustomerMobile=$user_number",
      CURLOPT_HTTPHEADER => $auth_header,
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $json_response = json_decode($response, true);
    // echo " Response : " . $response;
    $user_payload =  $json_response['data']['Payload'];
    $cust_user_id =  $json_response['data']['CustomerUserId'];

    $_SESSION["cust_payload"] = $user_payload;
    $_SESSION["cust_user_id"] = $cust_user_id;

    //echo "<script type='text/javascript'> document.location = 'membership_list.php'; </script>";

    // echo 'user_payload  ' . $_SESSION["cust_payload"];
    // echo 'cust_user_id  ' . $_SESSION["cust_user_id"];
    // echo "USerId : ". $json_response[0];
    header('Content-Type: application/json; charset=UTF-8');
    $result=array();
    $result['messages'] = "test";
    if($_SESSION["cust_payload"]){
      $result['cust_payload'] = 'Fv14sMRkz8uYqd3VMbKy5YB5jkJhVq8LTAPnYdlEP74=';
    }
    else{
      $result['cust_payload'] = 'Fv14sMRkz8uYqd3VMbKy5YB5jkJhVq8LTAPnYdlEP74=';
    }
    $result['cust_user_id'] = $_SESSION["cust_user_id"];
    //feel free to add other information like $result['errorcode']
    print json_encode($result);

}

?>
