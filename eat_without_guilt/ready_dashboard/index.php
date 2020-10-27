<?php
include('config.php');
// echo $api_endpoint; // 'localhost'
?>

<?php
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
      CURLOPT_URL => $api_endpoint."api/v1/customer-profile/",
      // CURLOPT_SSL_VERIFYPEER => true,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "CustomerUserId=$cust_user_id",
      CURLOPT_HTTPHEADER => array(
        'content-type: application/x-www-form-urlencoded',
        'Authorization:'.$auth_key,
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $customer_info =  json_decode($response, true);
    $customer_profile_response_code = $customer_info['status_code'];

    $cust_first_name =  $customer_info['data']['CustomerFirstName'];
    $cust_last_name =  $customer_info['data']['CustomerLastName'];
    $cust_email =  $customer_info['data']['CustomerEmail'];
    $cust_phone =  $customer_info['data']['CustomerMobile'];
    $cust_profile_pic =  $customer_info['data']['CustomerProfilePic'];

    $_SESSION["cust_first_name"] = $cust_first_name;
    $_SESSION["cust_last_name"] = $cust_last_name;
    $_SESSION["cust_email"] = $cust_email;
    $_SESSION["cust_phone"] = $cust_phone;
    $_SESSION["cust_profile_pic"] = $cust_profile_pic;

    if ($customer_profile_response_code == '200' ){

      // **** Home Screen API ****
      $curl = curl_init();
      $auth_header = array(
          'content-type: application/x-www-form-urlencoded',
          'Authorization:'.$auth_key,
        );
        curl_setopt_array($curl, array(
        // CURLOPT_URL => "https://www.yourdeadlift.com/api/v1/website-customer-register/",
        CURLOPT_URL => $api_endpoint."api/v1/home-api/",
        // CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        // CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_POSTFIELDS => "CustomerUserId=$cust_user_id",
        CURLOPT_HTTPHEADER => $auth_header,
      ));
      $response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);
      $home_response = json_decode($response, true);
      $unReadNoti = $home_response['data']['UnReadNotifications'];
      $_SESSION["unReadNoti"] = $unReadNoti;

      // **** Live Trainer API ****

      $curl = curl_init();
      $auth_header = array(
          'content-type: application/x-www-form-urlencoded',
          'Authorization:'.$auth_key,
        );
        curl_setopt_array($curl, array(
        // CURLOPT_URL => "https://www.yourdeadlift.com/api/v1/website-customer-register/",
        CURLOPT_URL => $api_endpoint."api/v1/live-trainers/",
        // CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        // CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_POSTFIELDS => "CustomerUserId=$cust_user_id",
        CURLOPT_HTTPHEADER => $auth_header,
      ));
      $response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);
      $live_trainer_obj = json_decode($response, true);

      /* ----- Gym Live Traffic ----- */

      $curl = curl_init();
      $auth_header = array(
          'content-type: application/x-www-form-urlencoded',
          'Authorization:'.$auth_key,
        );
        curl_setopt_array($curl, array(
        // CURLOPT_URL => "https://www.yourdeadlift.com/api/v1/website-customer-register/",
        CURLOPT_URL => $api_endpoint."api/v1/gym-traffic-meter/",
        // CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        // CURLOPT_POSTFIELDS => json_encode($data),
        // CURLOPT_POSTFIELDS => "CustomerUserId=$cust_user_id",
        CURLOPT_HTTPHEADER => $auth_header,
      ));
      $response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);
      $gym_live_traffic = json_decode($response, true);

    }
    else{
      echo "<script type='text/javascript'> document.location = 'user_verify.php'; </script>";
    }
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
              Home - <?php echo $title_domain ?>
        </title>
        <meta name="description" content="Analytics Dashboard">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/app.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/slick.min.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="css/miscellaneous/reactions/reactions.css">
        <link rel="stylesheet" media="screen, print" href="css/miscellaneous/fullcalendar/fullcalendar.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/miscellaneous/jqvmap/jqvmap.bundle.css">
    </head>
    <body class="mod-bg-1 nav-function-top">
        <!-- DOC: script to save and load page settings -->
        <script>
            /**
             *	This script should be placed right after the body tag for fast execution
             *	Note: the script is written in pure javascript and does not depend on thirdparty library
             **/
            'use strict';

            var classHolder = document.getElementsByTagName("BODY")[0],
                /**
                 * Load from localstorage
                 **/
                themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
                {},
                themeURL = themeSettings.themeURL || '',
                themeOptions = themeSettings.themeOptions || '';
            /**
             * Load theme options
             **/
            if (themeSettings.themeOptions)
            {
                classHolder.className = themeSettings.themeOptions;
                console.log("%c✔ Theme settings loaded", "color: #148f32");
            }
            else
            {
                console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
            }
            if (themeSettings.themeURL && !document.getElementById('mytheme'))
            {
                var cssfile = document.createElement('link');
                cssfile.id = 'mytheme';
                cssfile.rel = 'stylesheet';
                cssfile.href = themeURL;
                document.getElementsByTagName('head')[0].appendChild(cssfile);
            }
            /**
             * Save to localstorage
             **/
            var saveSettings = function()
            {
                themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
                {
                    return /^(nav|header|mod|display)-/i.test(item);
                }).join(' ');
                if (document.getElementById('mytheme'))
                {
                    themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
                };
                localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
            }
            /**
             * Reset settings
             **/
            var resetSettings = function()
            {
                localStorage.setItem("themeSettings", "");
            }

        </script>

        <?php include 'navbar.php';?>
        <!-- BEGIN Page Wrapper -->

                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">

                      <!-- book class banner Start -->
                      <?php if($show_book_class == '1'){ ?>
                      <div id="banner-noti">
                          <ul class="banner-container">
                            <li class="slide-noti" style="background:#F21F55;">  <a href="class_book.php" style="color:#fff;text-decoration:none;">  Book Your Class Now ! </a> </li>
                          </ul>
                      </div><br>
                    <?php } ?>

                      <!-- book class banner End -->


                      <!-- <p> <?php //echo $home_response['status'] ?> </p> -->
                      <?php if($home_response['data']['Notifications']) { ?>
                      <div id="slider-noti">
                          <ul class="slides-container">
                            <?php
                            foreach($home_response['data']['Notifications'] as $noti_obj){  ?>
                            <li class="slide-noti" style="background:<?php echo $noti_obj['ColorCode'] ?>"> <i class="ni ni-bell"></i> <?php echo $noti_obj['Text'] ?> </li>
                            <?php  }?>
                            <!-- <li class="slide-noti slide2"> <i class="ni ni-bell"></i>  slide2</li>
                            <li class="slide-noti slide3"> <i class="ni ni-bell"></i> slide3</li> -->
                            <!-- <li class="slide-noti slide4"> <i class="ni ni-bell"></i> slide4</li>
                            <li class="slide-noti slide5"> <i class="ni ni-bell"></i> slide5</li>
                            <li class="slide-noti slide1"> <i class="ni ni-bell"></i> slide1</li> -->
                          </ul>
                      </div>
                    <?php } ?>

                        <!-- Slider Start -->
                      <?php if($home_response['data']['Sponsored']) { ?>
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-md-12 heroSlider-fixed">
                            <div class="overlay">
                          </div>
                             <!-- Slider -->
                             <div class="slider blog-responsive">
                               <?php
                               foreach($home_response['data']['Sponsored'] as $blog_obj){  ?>
                                 <div>
                       						<img src="<?php echo $blog_obj['BlogImage'] ?>" alt="" class="blog-img"/>
                       					</div>
                              <?php  }?>

                             </div>
                    				 <!-- control arrows -->
                    				<div class="prev">
                    					<!-- <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> -->
                              <i class="fal fa-angle-left" aria-hidden="true"></i>
                    				</div>
                    				<div class="next">
                    					<!-- <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> -->
                              <i class="fal fa-angle-right" aria-hidden="true"></i>
                    				</div>

                          </div>
                        </div>
                      </div>
                    <?php }?>
                        <!-- Slider End -->

                        <!-- Workout timer box start -->
                        <?php if($home_response['data']['LiveSessions']) { ?>
                        <div class="timer-container" style="background:#6AB8F7">
                          <div class="container time-box">
                          <div class="container-btn row" style="color:#fff;">
                            <!-- <h1 class="workout-timer-title col-md-9" style="text-align:left;"> Live Session <?php // var_dump($home_response['data']['LiveSessions']) ?> </h1> -->
                            <h1 class="workout-timer-title col-md-9" style="text-align:left;"> Live Session</h1>
                            <?php if($home_response['data']['LiveSessions'][0]['ExternalLink']){ ?>
                            <a href="<?php echo $home_response['data']['LiveSessions'][0]['ExternalLink'] ?>" target="_blank" class="btn btn-info col-md-3 join-session-btn" style="float:right;font-weight:bold;"> Join Now </a>
                          <?php }else{ ?>
                            <a href="customer_live_session.php?live_session_id=<?php echo $home_response['data']['LiveSessions'][0]['LiveSessionId'] ?>&room_name=<?php echo $home_response['data']['LiveSessions'][0]['RoomName'] ?>" class="btn btn-info col-md-3 join-session-btn" style="float:right;font-weight:bold;"> Join Now </a>
                          <?php } ?>
                          </div>
                          <ul class="workout-timer">
                            <li class="workout-timer-list"><span id="days" style="font-size:x-large;margin-bottom:30px;"> <img src="<?php echo $home_response['data']['LiveSessions'][0]['TrainerProfilePic'] ?>" class="rounded-circle profile-image" alt=""> </span> <?php echo $home_response['data']['LiveSessions'][0]['TrainerFirstName'] ?>  <?php echo $home_response['data']['LiveSessions'][0]['TrainerLastName'] ?> </li>

                            <li class="workout-timer-list"><span id="hours" style="font-size:x-large;margin-bottom:30px;">  Topic </span> <?php echo $home_response['data']['LiveSessions'][0]['SessionName'] ?> </li>

                            <li class="workout-timer-list"><span id="minutes" style="font-size:x-large;margin-bottom:30px;">  Scheduled On </span> <?php echo $home_response['data']['LiveSessions'][0]['SessionStartTime'] ?> </li>

                            <!-- <li class="workout-timer-list"><span id="seconds"> 40 </span>Seconds</li> -->
                          </ul>
                        </div>
                        </div>
                      <?php } ?>

                        <div class="row">
                            <div class="col-xs-12 col-md-4">
                                <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                                    <div class="">
                                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                            <?php echo $home_response['data']['TotalWorkoutTime']  ?>
                                            <small class="m-0 l-h-n"> Total Workout Hours </small>
                                        </h3>
                                    </div>
                                    <i class="fal fa-globe position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 6rem;"></i>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="p-3 bg-info-200 rounded overflow-hidden position-relative text-white mb-g">
                                    <div class="">
                                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                            <?php echo $customer_info['data']['TotalCheckins']  ?>
                                            <small class="m-0 l-h-n"> Total Check-Ins </small>
                                        </h3>
                                    </div>
                                    <i class="fal fa-user position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g">
                                    <div class="">
                                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                            <?php echo $customer_info['data']['TodayStep']  ?> Out Of <?php echo $customer_info['data']['StepsTarget'] ?>
                                            <small class="m-0 l-h-n"> Today's Step Count </small>
                                        </h3>
                                    </div>
                                    <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Workout timer box end -->

                        <!-- Online Trainer Start -->
                        <div class="row">
                        <div class="col-xl-6">
                            <div id="panel-2" class="panel" data-panel-fullscreen="false">
                                <div class="live-trainer-title">
                                    <h2>
                                        Live Trainers
                                    </h2>
                                </div>
                                <div class="panel-container show">
                                    <div class="panel-content p-0">
                                        <div class="d-flex flex-column">
                                            <div class="bg-subtlelight-fade custom-scroll" style="height: 244px">
                                                <div class="h-100 row">
                                                <?php if($live_trainer_obj['data']['LiveTrainers']){ ?>
                                                <?php foreach($live_trainer_obj['data']['LiveTrainers'] as $trainer){ ?>

                                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                                        <center style="margin:10px 0px 5px 0px">
                                                          <span class="status status-success ml-3">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('<?php echo $trainer['TrainerProfilePic'] ?>')"></span>
                                                          </span>
                                                        </center>
                                                      <div class="ml-3">
                                                          <a href="javascript:void(0);" title="Lisa Hatchensen" class="d-block fw-700 text-dark text-center"> <?php echo $trainer['TrainerName'] ?> </a>
                                                      </div>
                                                    </div>
                                                    <?php } ?>
                                                  <?php } else{ ?>
                                                    <h2 style="width:100%;position:absolute;top:45%;"> <center> No trainer online right now </center> </h2>
                                                  <?php } ?>


                                                    <!-- <div class="col-lg-2 col-md-3 col-sm-4">
                                                        <center style="margin:10px 0px 5px 0px">
                                                          <span class=" ml-3">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-admin.png')"></span>
                                                          </span>
                                                        </center>
                                                      <div class="ml-3">
                                                          <a href="javascript:void(0);" title="Lisa Hatchensen" class="d-block fw-700 text-dark text-center">Dr. Codex Lantern</a>
                                                      </div>
                                                    </div> -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        <!-- Online Trainer End -->
                        <!-- Week Activity Start -->
                        <div class="col-xl-6">
                            <div id="panel-2" class="panel" data-panel-fullscreen="false">
                                <div class="live-trainer-title">
                                    <h2>
                                        This week's activity
                                    </h2>
                                </div>
                                <div class="panel-container show">
                                    <div class="panel-content p-0">
                                        <div class="d-flex flex-column">
                                            <div class="bg-subtlelight-fade custom-scroll" style="height: 244px">
                                                <div class="h-100 row">
                                                <center style="height:100%;width:100%;">
                                                  <div class="frame-wrap text-center" style="padding:30px;height:100%;width:100%;">

                                                      <div class="custom-control custom-checkbox custom-control-inline">
                                                          <input type="checkbox" class="custom-control-input" id="defaultInline1" disabled <?php foreach($home_response['data']['User']['ThisWeekActivity'] as $days){ if($days == 'Sun') { ?> checked  <?php } else{ ?> disabled <?php  } } ?>  >
                                                          <label class="custom-control-label" for="defaultInline1"> Sunday
                                                          </label>
                                                      </div>

                                                      <div class="custom-control custom-checkbox custom-control-inline">
                                                          <input type="checkbox" class="custom-control-input" id="defaultInline2" disabled  <?php foreach($home_response['data']['User']['ThisWeekActivity'] as $days){ if($days == 'Mon') { ?> checked  <?php } else{ ?> disabled <?php  } } ?> >
                                                          <label class="custom-control-label" for="defaultInline2"> Monday </label>
                                                      </div>

                                                      <div class="custom-control custom-checkbox custom-control-inline">
                                                          <input type="checkbox" class="custom-control-input" id="defaultInline1" disabled <?php foreach($home_response['data']['User']['ThisWeekActivity'] as $days){ if($days == 'Tue') { ?> checked  <?php } else{ ?> disabled <?php  } } ?> >
                                                          <label class="custom-control-label" for="defaultInline1"> Tuesday  </label>
                                                      </div>

                                                      <div class="custom-control custom-checkbox custom-control-inline">
                                                          <input type="checkbox" class="custom-control-input" id="defaultInline2"  disabled<?php foreach($home_response['data']['User']['ThisWeekActivity'] as $days){ if($days == 'Wed') { ?> checked  <?php } else{ ?> disabled <?php  } } ?> >
                                                          <label class="custom-control-label" for="defaultInline2"> Wednesday </label>
                                                      </div>

                                                      <div class="custom-control custom-checkbox custom-control-inline">
                                                          <input type="checkbox" class="custom-control-input" id="defaultInline1" disabled <?php foreach($home_response['data']['User']['ThisWeekActivity'] as $days){ if($days == 'Thu') { ?> checked  <?php } else{ ?> disabled <?php  } } ?> >
                                                          <label class="custom-control-label" for="defaultInline1"> Thursday </label>
                                                      </div>

                                                      <div class="custom-control custom-checkbox custom-control-inline">
                                                          <input type="checkbox" class="custom-control-input" id="defaultInline2" disabled <?php foreach($home_response['data']['User']['ThisWeekActivity'] as $days){ if($days == 'Fri') { ?> checked  <?php } else{ ?> disabled <?php  } } ?> >
                                                          <label class="custom-control-label" for="defaultInline2"> Friday </label>
                                                      </div>

                                                      <div class="custom-control custom-checkbox custom-control-inline">
                                                          <input type="checkbox" class="custom-control-input" id="defaultInline1" disabled <?php foreach($home_response['data']['User']['ThisWeekActivity'] as $days){ if($days == 'Sat') { ?> checked  <?php } else{ ?> disabled <?php  } } ?> >
                                                          <label class="custom-control-label" for="defaultInline1"> Saturday </label>
                                                      </div>

                                                  </div>
                                                </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <!-- Week Activity End -->

                        <!-- Quack Action Start -->
                        <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div id="panel-2" class="panel" data-panel-fullscreen="false">
                                <div class="live-trainer-title">
                                    <h2>
                                        Quick Actions
                                    </h2>
                                </div>
                                <div class="panel-container show">
                                    <div class="panel-content p-0">
                                        <div class="d-flex flex-column">
                                            <div class="bg-subtlelight-fade custom-scroll" style="height: 244px">
                                                <div class="h-100 row">
                                                    <!-- <div class="col-lg-2 col-md-3 col-sm-4">
                                                        <center style="margin:10px 0px 5px 0px">
                                                          <span class="status-success ml-3">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/workout_analysis_2.png')"></span>
                                                          </span>
                                                        </center>
                                                      <div class="ml-3">
                                                          <a href="javascript:void(0);" title="Lisa Hatchensen" class="d-block fw-700 text-dark text-center"> Workout Analysis </a>
                                                      </div>
                                                    </div> -->

                                                    <!-- <div class="col-lg-2 col-md-3 col-sm-4">
                                                        <center style="margin:10px 0px 5px 0px">
                                                          <span class=" ml-3">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/volume_graph.png')"></span>
                                                          </span>
                                                        </center>
                                                      <div class="ml-3">
                                                          <a href="javascript:void(0);" title="Lisa Hatchensen" class="d-block fw-700 text-dark text-center"> Exercise Volumes Graphs </a>
                                                      </div>
                                                    </div> -->

                                                    <!-- <div class="col-lg-2 col-md-3 col-sm-4">
                                                        <center style="margin:10px 0px 5px 0px">
                                                          <span class=" ml-3">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/cardio_analysis.png')"></span>
                                                          </span>
                                                        </center>
                                                      <div class="ml-3">
                                                          <a href="javascript:void(0);" title="Lisa Hatchensen" class="d-block fw-700 text-dark text-center"> Cardio Analysis </a>
                                                      </div>
                                                    </div> -->


                                                    <!-- <div class="col-lg-2 col-md-3 col-sm-4">
                                                        <center style="margin:10px 0px 5px 0px">
                                                          <span class=" ml-3">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/weekly_diet_analysis.png')"></span>
                                                          </span>
                                                        </center>
                                                      <div class="ml-3">
                                                          <a href="javascript:void(0);" title="Lisa Hatchensen" class="d-block fw-700 text-dark text-center"> Weekly Diet Analysis </a>
                                                      </div>
                                                    </div> -->

                                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                                        <!-- <center style="margin:10px 0px 5px 0px">
                                                          <span class=" ml-3">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/workout_plan.png')"></span>
                                                          </span>
                                                        </center> -->
                                                      <div class="ml-3">
                                                        <?php  if($customer_info['data']['isWorkoutAssigned'] == '1') { ?>
                                                          <a href="customer_workout_plan.php?CustomerUserId=<?php echo $cust_user_id ?>" style="margin:10px 0px 5px 0px" title="Yoga Plan" class="d-block fw-700 text-dark text-center">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/yoga_plan.png')"></span>
                                                            <br> Yoga Plan </a>
                                                        <?php } else {?>
                                                          <a href="javascript:void(0);" style="margin:10px 0px 5px 0px" title="Yoga Plan" class="d-block fw-700 text-dark text-center" data-toggle="modal" data-target="#WorkoutPlanModal">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/yoga_plan.png')"></span>
                                                            <br> Yoga Plan </a>
                                                        <?php } ?>
                                                      </div>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                                        <!-- <center style="margin:10px 0px 5px 0px">
                                                          <span class=" ml-3">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/diet_plan.png')"></span>
                                                          </span>
                                                        </center> -->
                                                      <div class="ml-3">
                                                        <?php  if($customer_info['data']['isDietAssigned'] == '1') { ?>
                                                          <a href="customer_diet_plan.php?CustomerUserId=<?php echo $cust_user_id ?>" style="margin:10px 0px 5px 0px" title="Diet Plan" class="d-block fw-700 text-dark text-center">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/diet_plan.png')"></span>
                                                            <br> Diet Plan </a>
                                                        <?php } else {?>
                                                          <a href="javascript:void(0);" style="margin:10px 0px 5px 0px" title="Diet Plan" class="d-block fw-700 text-dark text-center" data-toggle="modal" data-target="#DietPlanModal">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/diet_plan.png')"></span>
                                                            <br> Diet Plan </a>
                                                        <?php } ?>
                                                    </div>
                                                  </div>

                                                    <!-- <div class="col-lg-2 col-md-3 col-sm-4">
                                                        <center style="margin:10px 0px 5px 0px">
                                                          <span class=" ml-3">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/fitness_tools.png')"></span>
                                                          </span>
                                                        </center>
                                                      <div class="ml-3">
                                                          <a href="javascript:void(0);" title="Lisa Hatchensen" class="d-block fw-700 text-dark text-center"> Fitness Tools </a>
                                                      </div>
                                                    </div> -->

                                                    <!-- <div class="col-lg-2 col-md-3 col-sm-4">
                                                        <center style="margin:10px 0px 5px 0px">
                                                          <span class=" ml-3">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/log_weight.png')"></span>
                                                          </span>
                                                        </center>
                                                      <div class="ml-3">
                                                          <a href="javascript:void(0);" title="Lisa Hatchensen" class="d-block fw-700 text-dark text-center"> Log Weight </a>
                                                      </div>
                                                    </div> -->

                                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                                        <!-- <center style="margin:10px 0px 5px 0px">
                                                          <span class=" ml-3">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/courses.png')"></span>
                                                          </span>
                                                        </center> -->
                                                      <div class="ml-3">
                                                          <a href="course_list.php" style="margin:10px 0px 5px 0px" title="Programs" class="d-block fw-700 text-dark text-center">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/courses.png')"></span>
                                                             Programs </a>
                                                      </div>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                                        <!-- <center style="margin:10px 0px 5px 0px">
                                                          <span class=" ml-3">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/recipe.png')"></span>
                                                          </span>
                                                        </center> -->
                                                      <div class="ml-3">
                                                          <a href="receipe_list.php" style="margin:10px 0px 5px 0px" title="Recipes" class="d-block fw-700 text-dark text-center">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/recipe.png')"></span>
                                                             Recipes </a>
                                                      </div>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                                        <!-- <center style="margin:10px 0px 5px 0px">
                                                          <span class=" ml-3">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/subscription.png')"></span>
                                                          </span>
                                                        </center> -->
                                                      <div class="ml-3">
                                                          <a href="subscription_info.php" title="Subscriptions" style="margin:10px 0px 5px 0px"  class="d-block fw-700 text-dark text-center">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/subscription.png')"></span>
                                                             Subscriptions </a>
                                                      </div>
                                                    </div>


                                                    <?php if($show_book_class == '1'){ ?>
                                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                                        <!-- <center style="margin:10px 0px 5px 0px">
                                                          <span class=" ml-3">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/subscription.png')"></span>
                                                          </span>
                                                        </center> -->
                                                      <div class="ml-3">
                                                          <a href="class_book.php" title="Browse Classes" style="margin:10px 0px 5px 0px"  class="d-block fw-700 text-dark text-center">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/subscription.png')"></span>
                                                             Browse Classes </a>
                                                      </div>
                                                    </div>

                                                  <?php } ?>

                                                    <!-- <div class="col-lg-2 col-md-3 col-sm-4">
                                                        <center style="margin:10px 0px 5px 0px">
                                                          <span class=" ml-3">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/cardio_analysis.png')"></span>
                                                          </span>
                                                        </center>
                                                      <div class="ml-3">
                                                          <a href="javascript:void(0);" title="Lisa Hatchensen" class="d-block fw-700 text-dark text-center"> Measurement </a>
                                                      </div>
                                                    </div> -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="col-xl-6">
                                  <div id="panel-2" class="panel" data-panel-fullscreen="false">
                                      <div class="live-trainer-title">
                                          <h2>
                                              Today Task
                                          </h2>
                                      </div>
                                      <div class="panel-container show">
                                          <div class="panel-content p-0">
                                              <div class="d-flex flex-column">
                                                  <div class="bg-subtlelight-fade custom-scroll" style="height: 244px">
                                                      <div class="h-100 row">
                                                      <!-- <center> -->
                                                        <div class="frame-wrap" style="padding:30px;height:100%;width:100%;overflow:auto;">
                                                            <div class="demo">
                                                              <?php  foreach($home_response['data']['DailyCheckList'] as $task){ ?>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="defaultUncheckedDisabled" disabled <?php if($task['IsLogged'] == '1'){ ?> checked <?php } ?> >
                                                                    <label class="custom-control-label" for="defaultUncheckedDisabled"><b> <?php echo $task['Title'] ?> </b> <br> <?php echo $task['SubTitle'] ?> </label>
                                                                </div><div class="clearfix"></div><hr>
                                                              <?php } ?>

                                                                <!-- <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="defaultCheckedDisabled" checked="" disabled="">
                                                                    <label class="custom-control-label" for="defaultCheckedDisabled">Track your workout</label>
                                                                </div><div class="clearfix"></div><hr>

                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="defaultUncheckedDisabled" disabled="">
                                                                    <label class="custom-control-label" for="defaultUncheckedDisabled"> Track your steps </label>
                                                                </div><div class="clearfix"></div><hr> -->

                                                            </div>
                                                        </div>
                                                      <!-- </center> -->
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                        <!-- Quack Action End -->
                        <!-- Todays Task & Traffic Start -->
                        <div class="row">
                          <!-- <div class="col-xl-6">
                              <div id="panel-2" class="panel" data-panel-fullscreen="false">
                                  <div class="live-trainer-title">
                                      <h2>
                                          Today Task
                                      </h2>
                                  </div>
                                  <div class="panel-container show">
                                      <div class="panel-content p-0">
                                          <div class="d-flex flex-column">
                                              <div class="bg-subtlelight-fade custom-scroll" style="height: 244px">
                                                  <div class="h-100 row">
                                                    <div class="frame-wrap" style="padding:30px;height:100%;width:100%;overflow:auto;">
                                                        <div class="demo">
                                                          <?php // foreach($home_response['data']['DailyCheckList'] as $task){ ?>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="defaultUncheckedDisabled" disabled <?php if($task['IsLogged'] == '1'){ ?> checked <?php } ?> >
                                                                <label class="custom-control-label" for="defaultUncheckedDisabled"><b> <?php echo $task['Title'] ?> </b> <br> <?php echo $task['SubTitle'] ?> </label>
                                                            </div><div class="clearfix"></div><hr>
                                                          <?php // } ?>
                                                        </div>
                                                    </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                </div> -->

                                <!-- <div class="col-xl-6">
                                    <div id="panel-2" class="panel" data-panel-fullscreen="false">
                                        <div class="live-trainer-title">
                                            <h2>
                                                LIve Gym Traffic
                                            </h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content p-0">
                                                <div class="d-flex flex-column">
                                                    <div class="bg-subtlelight-fade custom-scroll" style="height: 244px">
                                                        <div class="h-100 row">
                                                        <center style="height:100%;width:100%;overflow:hidden;">
                                                          <div class="frame-wrap text-center">

                                                            <div class="timer-container">
                                                              <div class="container time-box">
                                                              <h1 class="workout-timer-title"> People working out now in the gym </h1>
                                                              <ul class="workout-timer">
                                                                <li class="workout-timer-list"><span id="days"> <?php// echo $gym_live_traffic['data']['TotalCheckins'] ?> </span> Male </li>

                                                                <li class="workout-timer-list"><span id="hours"> <?php// echo $gym_live_traffic['data']['TotalFemaleCheckins'] ?> </span> Female </li>

                                                                <li class="workout-timer-list"><span id="minutes"> <?php// echo $gym_live_traffic['data']['TotalCheckins'] ?> </span> Total </li>

                                                                <li class="workout-timer-list"><span id="seconds"> <?php// echo $gym_live_traffic['data']['GymMeterPercent'] ?> % </span> Capacity </li>
                                                              </ul>
                                                            </div>
                                                            </div>

                                                          </div>
                                                        </center>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div> -->
                        </div>
                        <!-- Todays Task & Traffic End -->

                        <!--- Transformation Start -->
                        <div class="row">
                          <div class="col-xl-12">
                                  <div class="timer-container" style="background-image: url('img/quick_action/transformation.png');background-repeat:no-repeat;background-size: cover;background-color:transparent;padding:30px;height:300px;">
                                    <div class="container time-box">
                                      <a href="client_transformation.php" title="transformation">
                                        <h1 class="workout-timer-title" style="color:#000;text-shadow: 3px 3px #fff;"> Transformation </h1>
                                      </a>
                                  </div>
                                  </div>
                                </div>

                                <!-- <div class="col-xl-6">
                                        <div class="timer-container" style="background-image: url('img/quick_action/transformation.png');background-repeat:no-repeat;background-size: cover;background-color:transparent;padding:30px;height:300px;">
                                          <div class="container time-box">
                                          <h1 class="workout-timer-title" style="color:#000;text-shadow: 3px 3px #fff;"> My Activity </h1>
                                        </div>
                                        </div>
                                      </div> -->
                        </div>
                        <!--- Transformation End -->

                        <!-- <ol class="breadcrumb page-breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
                            <li class="breadcrumb-item">Application Intel</li>
                            <li class="breadcrumb-item active">Analytics Dashboard</li>
                            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                        </ol> -->


                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
                    <footer class="page-footer" role="contentinfo">
                        <div class="d-flex align-items-center flex-1 text-muted">
                            <span class="hidden-md-down fw-700">2020 © <?php echo $title_domain ?> by&nbsp;<a href='<?php echo $website_link ?>' class='text-primary fw-500' title='' target='_blank'><?php echo $display_website_link ?></a></span>
                        </div>
                        <div>
                            <ul class="list-table m-0">
                                <li><a href="<?php echo $about_us ?>" class="text-secondary fw-700">About</a></li>
                                <!-- <li class="pl-3"><a href="#" class="text-secondary fw-700">License</a></li>
                                <li class="pl-3"><a href="#" class="text-secondary fw-700">Documentation</a></li> -->
                                <!-- <li class="pl-3 fs-xl"><a href="#" class="text-secondary"><i class="fal fa-question-circle" aria-hidden="true"></i></a></li> -->
                            </ul>
                        </div>
                    </footer>
                    <!-- END Page Footer -->
                    <!-- BEGIN Shortcuts -->
                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->

        <!-- BEGIN Page Settings -->
        <div class="modal fade js-modal-settings modal-backdrop-transparent" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-right modal-md">
                <div class="modal-content">
                    <div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center w-100">
                        <h4 class="m-0 text-center color-white">
                            Layout Settings
                            <small class="mb-0 opacity-80">User Interface Settings</small>
                        </h4>
                        <button type="button" class="close text-white position-absolute pos-top pos-right p-2 m-1 mr-2" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="settings-panel">
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        App Layout
                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="fh">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="header-function-fixed"></a>
                                <span class="onoffswitch-title">Fixed Header</span>
                                <span class="onoffswitch-title-desc">header is in a fixed at all times</span>
                            </div>
                            <div class="list" id="nff">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-fixed"></a>
                                <span class="onoffswitch-title">Fixed Navigation</span>
                                <span class="onoffswitch-title-desc">left panel is fixed</span>
                            </div>
                            <div class="list" id="nfm">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-minify"></a>
                                <span class="onoffswitch-title">Minify Navigation</span>
                                <span class="onoffswitch-title-desc">Skew nav to maximize space</span>
                            </div>
                            <div class="list" id="nfh">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-hidden"></a>
                                <span class="onoffswitch-title">Hide Navigation</span>
                                <span class="onoffswitch-title-desc">roll mouse on edge to reveal</span>
                            </div>
                            <div class="list" id="nft">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-top"></a>
                                <span class="onoffswitch-title">Top Navigation</span>
                                <span class="onoffswitch-title-desc">Relocate left pane to top</span>
                            </div>
                            <div class="list" id="mmb">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-main-boxed"></a>
                                <span class="onoffswitch-title">Boxed Layout</span>
                                <span class="onoffswitch-title-desc">Encapsulates to a container</span>
                            </div>
                            <div class="expanded">
                                <ul class="">
                                    <li>
                                        <div class="bg-fusion-50" data-action="toggle" data-class="mod-bg-1"></div>
                                    </li>
                                    <li>
                                        <div class="bg-warning-200" data-action="toggle" data-class="mod-bg-2"></div>
                                    </li>
                                    <li>
                                        <div class="bg-primary-200" data-action="toggle" data-class="mod-bg-3"></div>
                                    </li>
                                    <li>
                                        <div class="bg-success-300" data-action="toggle" data-class="mod-bg-4"></div>
                                    </li>
                                </ul>
                                <div class="list" id="mbgf">
                                    <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-fixed-bg"></a>
                                    <span class="onoffswitch-title">Fixed Background</span>
                                </div>
                            </div>
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        Mobile Menu
                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="nmp">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-push"></a>
                                <span class="onoffswitch-title">Push Content</span>
                                <span class="onoffswitch-title-desc">Content pushed on menu reveal</span>
                            </div>
                            <div class="list" id="nmno">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-no-overlay"></a>
                                <span class="onoffswitch-title">No Overlay</span>
                                <span class="onoffswitch-title-desc">Removes mesh on menu reveal</span>
                            </div>
                            <div class="list" id="sldo">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-slide-out"></a>
                                <span class="onoffswitch-title">Off-Canvas <sup>(beta)</sup></span>
                                <span class="onoffswitch-title-desc">Content overlaps menu</span>
                            </div>
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        Accessibility
                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="mbf">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-bigger-font"></a>
                                <span class="onoffswitch-title">Bigger Content Font</span>
                                <span class="onoffswitch-title-desc">content fonts are bigger for readability</span>
                            </div>
                            <div class="list" id="mhc">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-high-contrast"></a>
                                <span class="onoffswitch-title">High Contrast Text (WCAG 2 AA)</span>
                                <span class="onoffswitch-title-desc">4.5:1 text contrast ratio</span>
                            </div>
                            <div class="list" id="mcb">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-color-blind"></a>
                                <span class="onoffswitch-title">Daltonism <sup>(beta)</sup> </span>
                                <span class="onoffswitch-title-desc">color vision deficiency</span>
                            </div>
                            <div class="list" id="mpc">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-pace-custom"></a>
                                <span class="onoffswitch-title">Preloader Inside</span>
                                <span class="onoffswitch-title-desc">preloader will be inside content</span>
                            </div>
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        Global Modifications
                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="mcbg">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-clean-page-bg"></a>
                                <span class="onoffswitch-title">Clean Page Background</span>
                                <span class="onoffswitch-title-desc">adds more whitespace</span>
                            </div>
                            <div class="list" id="mhni">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-hide-nav-icons"></a>
                                <span class="onoffswitch-title">Hide Navigation Icons</span>
                                <span class="onoffswitch-title-desc">invisible navigation icons</span>
                            </div>
                            <div class="list" id="dan">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-disable-animation"></a>
                                <span class="onoffswitch-title">Disable CSS Animation</span>
                                <span class="onoffswitch-title-desc">Disables CSS based animations</span>
                            </div>
                            <div class="list" id="mhic">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-hide-info-card"></a>
                                <span class="onoffswitch-title">Hide Info Card</span>
                                <span class="onoffswitch-title-desc">Hides info card from left panel</span>
                            </div>
                            <div class="list" id="mlph">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-lean-subheader"></a>
                                <span class="onoffswitch-title">Lean Subheader</span>
                                <span class="onoffswitch-title-desc">distinguished page header</span>
                            </div>
                            <div class="list" id="mnl">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-nav-link"></a>
                                <span class="onoffswitch-title">Hierarchical Navigation</span>
                                <span class="onoffswitch-title-desc">Clear breakdown of nav links</span>
                            </div>
                            <div class="list mt-3">
                                <span class="onoffswitch-title">Global Font Size <small>(RESETS ON REFRESH)</small> </span>
                                <div class="btn-group btn-group-sm btn-group-toggle my-2" data-toggle="buttons">
                                    <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-sm" data-target="html">
                                        <input type="radio" name="changeFrontSize"> SM
                                    </label>
                                    <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text" data-target="html">
                                        <input type="radio" name="changeFrontSize" checked=""> MD
                                    </label>
                                    <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-lg" data-target="html">
                                        <input type="radio" name="changeFrontSize"> LG
                                    </label>
                                    <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-xl" data-target="html">
                                        <input type="radio" name="changeFrontSize"> XL
                                    </label>
                                </div>
                                <span class="onoffswitch-title-desc d-block mb-g">Change <strong>root</strong> font size to effect rem values</span>
                            </div>
                            <hr class="m-0">
                            <div class="p-3 d-flex align-items-center justify-content-center bg-faded">
                                <a href="#" class="btn btn-outline-danger fw-500 mr-2" data-action="app-reset">Reset Settings</a>
                                <a href="#" class="btn btn-danger fw-500" data-action="factory-reset">Factory Reset</a>
                            </div>
                        </div>
                        <span id="saving"></span>
                    </div>
                </div>
            </div>
        </div> <!-- END Page Settings -->

        <!-- Blog Section Start -->
        <div class="modal fade" id="DietPlanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"> <b> Diet Plan </b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p><b> No Plan Available. Consult your trainer/management for a plan or create your own customized plan. </b></p>
                <div class="text-center">
                  <a class="btn btn-dark" style="color:#fff"> Create your Diet plan </a>
                  <p style="margin-top:25px;"> <b> OR </b> </p>
                  <a class="btn btn-dark" style="color:#fff"> Try our standard plans </a>
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="WorkoutPlanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"> <b> Workout Plan </b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p><b> No Plan Available. Consult your trainer/management for a plan or create your own customized plan. </b></p>
                <div class="text-center">
                  <a class="btn btn-dark" style="color:#fff"> Create your workout plan </a>
                  <p style="margin-top:25px;"> <b> OR </b> </p>
                  <a class="btn btn-dark" style="color:#fff"> Try our standard plans </a>
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Blog Section End -->

        <!-- base vendor bundle:
			 DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations
						+ pace.js (recommended)
						+ jquery.js (core)
						+ jquery-ui-cust.js (core)
						+ popper.js (core)
						+ bootstrap.js (core)
						+ slimscroll.js (extension)
						+ app.navigation.js (core)
						+ ba-throttle-debounce.js (core)
						+ waves.js (extension)
						+ smartpanels.js (extension)
						+ src/../jquery-snippets.js (core) -->
        <script src="js/vendors.bundle.js"></script>
        <script src="js/app.bundle.js"></script>
        <script src="js/slick.min.js"></script>
        <script type="text/javascript">
            /* Activate smart panels */
            $('#js-page-content').smartPanel();

        </script>
        <!-- The order of scripts is irrelevant. Please check out the plugin pages for more details about these plugins below: -->
        <script src="js/dependency/moment/moment.js"></script>
        <script src="js/miscellaneous/fullcalendar/fullcalendar.bundle.js"></script>
        <script src="js/statistics/sparkline/sparkline.bundle.js"></script>
        <script src="js/statistics/easypiechart/easypiechart.bundle.js"></script>
        <script src="js/statistics/flot/flot.bundle.js"></script>
        <script src="js/miscellaneous/jqvmap/jqvmap.bundle.js"></script>


        <script>
        /*---- blog slider -----*/
        $('.blog-responsive').slick({
            dots: false,
          	autoplay: true,
          	autoplaySpeed: 5000,
          	infinite: true,
          	prevArrow: $('.prev'),
          	nextArrow: $('.next'),
            // infinite: false,
            speed: 300,
            slidesToShow: 2,
            slidesToScroll: 2,
            responsive: [
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2,
                  infinite: true,
                  dots: true
                }
              },
              {
                breakpoint: 600,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1
                }
              },
              {
                breakpoint: 480,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1
                }
              }
              // You can unslick at a given breakpoint now by adding:
              // settings: "unslick"
              // instead of a settings object
            ]
          });
        </script>
    </body>
</html>
