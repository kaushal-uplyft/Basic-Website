<?php
include('config.php');
$cust_payload = $_SESSION["cust_payload"];
$cust_user_id = $_SESSION["cust_user_id"];
// echo $api_endpoint; // 'localhost'
?>

<?php
$api_endpoint = $api_endpoint;
if (isset($_POST['save'])){
// if (!isset($_POST['save'])){

  $chief_complain = $_POST['chief_complain'];
  $when_problem_start = $_POST['when_problem_start'];
  $how_problem_start = $_POST['how_problem_start'];
  $pain_value = $_POST['pain_value'];
  $notes = $_POST['notes'];
  $physio_id = $_POST['physio_id'];
  // $image_one = $_FILES['image_one']['tmp_name'];
  // $type = pathinfo($image_one, PATHINFO_EXTENSION);
  // $allowed_ext= array('jpg','jpeg','png','gif');
  // $file_name =$_FILES['image_one']['name'];
  // $file_ext = strtolower( end(explode('.',$file_name)));
  // $data = file_get_contents($file_ext);
  // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
  //
  // echo "Base64 is ".$base64;
  //
  // echo "*** fail 1 ***";
  // echo $chief_complain;
  // echo $when_problem_start;
  // echo $how_problem_start;
  // echo $pain_value;
  // echo $notes;
  // echo $physio_id;
  // echo $image_one;

  $curl = curl_init();

  $auth_header = array(
    'content-type: application/x-www-form-urlencoded',
    'Authorization:'.$auth_key,
  );


  curl_setopt_array($curl, array(
    // CURLOPT_URL => "https://www.yourdeadlift.com/api/v1/website-customer-register/",
    CURLOPT_URL => $api_endpoint."api/v1/add-physio-form/",
    // CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    // CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_POSTFIELDS => "CheifComplain=$chief_complain&ProblemDuration=$when_problem_start&HowStart=$how_problem_start&PainGrade=$pain_value&Note=$notes&PhysioId=$physio_id&CustomerUserId=$cust_user_id",
    CURLOPT_HTTPHEADER => $auth_header,
  ));
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  $json_response = json_decode($response, true);
  $register_response_code = $json_response['status_code'];
  // echo "****** Step 2 ******";
  // print_r($json_response);
  // echo $json_response;
  if(  $register_response_code == '200' ){
      // echo "****** Step 3 ******";
      header("Location: client_profile.php");

        }
}
 ?>
