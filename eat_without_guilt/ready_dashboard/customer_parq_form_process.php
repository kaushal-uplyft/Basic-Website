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

  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $cust_dob = $_POST['cust_dob'];
  $cust_email= $_POST['cust_email'];
  $cust_weight = $_POST['cust_weight'];
  $cust_height = $_POST['cust_height'];
  $cust_waist = $_POST['cust_waist'];
  $cust_goal = $_POST['cust_goal'];
  $cust_level = $_POST['cust_level'];
  $cust_diet_ques = $_POST['cust_diet_ques'];
  $cust_exercise_ques = $_POST['cust_exercise_ques'];
  $cust_drug_ques = $_POST['cust_drug_ques'];
  $cust_heart_ques = $_POST['cust_heart_ques'];
  $physical_activity_reason_ques = $_POST['physical_activity_reason_ques'];
  $cust_medicine_ques = $_POST['cust_medicine_ques'];
  $cust_surgery_ques = $_POST['cust_surgery_ques'];
  $cust_injury_ques = $_POST['cust_injury_ques'];

  if($_POST['cust_smoking_check'] == '1'){
    $cust_smoking = '1';
  }else{
    $cust_smoking = '0';
  }

  if($_POST['cust_alcohol_check'] == '1'){
    $cust_alcohol = '1';
  }else{
    $cust_alcohol = '0';
  }

  if($_POST['physical_chest_pain_check'] == '1'){
    $physical_chest_pain_check = '1';
  }else{
    $physical_chest_pain_check = '0';
  }

  if($_POST['physical_not_chest_pain_check'] == '1'){
    $physical_not_chest_pain_check = '1';
  }else{
    $physical_not_chest_pain_check = '0';
  }

  if($_POST['dizziness_on_consciouseness_check'] == '1'){
    $dizziness_on_consciouseness_check = '1';
  }else{
    $dizziness_on_consciouseness_check = '0';
  }

  if($_POST['joint_problem_check'] == '1'){
    $joint_problem_check = '1';
  }else{
    $joint_problem_check = '0';
  }

  if($_POST['drugs_on_heart_check'] == '1'){
    $drugs_on_heart_check = '1';
  }else{
    $drugs_on_heart_check = '0';
  }

  echo "cust DOB".$cust_dob;
  $curl = curl_init();

  $auth_header = array(
    'content-type: application/x-www-form-urlencoded',
    'Authorization:'.$auth_key,
  );


  curl_setopt_array($curl, array(
    // CURLOPT_URL => "https://www.yourdeadlift.com/api/v1/website-customer-register/",
    CURLOPT_URL => $api_endpoint."api/v1/add-customer-info-form/",
    // CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    // CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_POSTFIELDS => "CustomerFirstName=$first_name&CustomerLastName=$last_name&CustomerEmail=$cust_email&CustomerDOB=$cust_dob&DietDetails=$cust_diet_ques&ExerciseRoutine=$cust_exercise_ques&TakingAnyDrugPrescriptions=$cust_drug_ques&HeartCondition=$cust_heart_ques&PhysicalActivityPain=$physical_chest_pain_check&NonPhysicalActivityPain=$physical_not_chest_pain_check&AnyDizziness=$dizziness_on_consciouseness_check&AnyJointProblem=$joint_problem_check&DoctorPrescritionForBP=$drugs_on_heart_check&OtherReasonPhysicalActivity=$physical_activity_reason_ques&Smoking=$cust_smoking&Alcohol=$cust_alcohol&AnyMedicine=$cust_medicine_ques&AnySurgery=$cust_surgery_ques&AnyPreExisitingInjury=$cust_injury_ques&CustomerHeight=$cust_height&CustomerWeight=$cust_weight&CustomerWaist=$cust_waist&CustomerUserId=$cust_user_id",
    CURLOPT_HTTPHEADER => $auth_header,
  ));
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  $json_response = json_decode($response, true);
  $register_response_code = $json_response['status_code'];
  echo "****** Step 2 ******";
  // echo $json_response;
  if(  $register_response_code == '200' ){
      echo "****** Step 3 ******";
      header("Location: client_profile.php");

        }
}
 ?>
