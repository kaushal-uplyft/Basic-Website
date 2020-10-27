<?php
$api_endpoint = 'https://www.yourdigitallift.com/';
if (isset($_POST['save'])){

  $first_name = $_POST['user_name'];
  $email = $_POST['user_mail'];
  $isd_code = $_POST['user_country_code'];
  $mobile_no = $_POST['user_mobile'];
  $child_name_1 = $_POST['child_name_1'];
  $child_location_1 = $_POST['child_location_1'];
  $child_dob_1 = $_POST['child_dob_1'];
  $child_gender_1 = $_POST['child_gender_1'];
  $child_name_2 = $_POST['child_name_2'];
  $child_location_2 = $_POST['child_location_2'];
  $child_dob_2 = $_POST['child_dob_2'];
  $child_gender_2 = $_POST['child_gender_2'];
  $notes = 'Customer Enquiry From The Website';
  $entry_point = 'Website';

  $curl = curl_init();

  $auth_header = array(
    'content-type: application/x-www-form-urlencoded',
    'Authorization:Fv14sMRkz8uYqd3VMbKy5YB5jkJhVq8LTAPnYdlEP74=',
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
  var_dump("***** First Api *****");
  var_dump($json_response);
  if(  $register_response_code == '200' ){
      $curl = curl_init();

      $auth_header = array(
        'content-type: application/x-www-form-urlencoded',
        'Authorization:wDgmH6BS0B5s/tcOmfAqtTIyvjBR7fqDFoNgcHEcT6A=',
      );


      curl_setopt_array($curl, array(
        // CURLOPT_URL => "https://www.yourdeadlift.com/api/v1/website-customer-register/",
        CURLOPT_URL => $api_endpoint."api/v1/child-yogi-register/",
        // CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        // CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_POSTFIELDS => "CustomerUserID=$cust_user_id&CustomerProfileId=$cust_profile_id&ChildName1=$child_name_1&ChildLocation1=$child_location_1&ChildDOB1=$child_dob_1&ChildGender1=$child_gender_1&ChildName2=$child_name_2&ChildLocation2=$child_location_2&ChildDOB2=$child_dob_2&ChildGender2=$child_gender_2",
        CURLOPT_HTTPHEADER => $auth_header,
      ));
      $response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);
      $child_response = json_decode($response, true);
      $child_response_code = $json_response['status_code'];
      var_dump("***** Second Api *****");
      var_dump($child_response);
      if ($child_response_code == '200' ){
        var_dump("***** Second success *****");
        echo "<script type='text/javascript'> document.location = 'user_verify.php'; </script>";
      }
  }

}
 ?>
