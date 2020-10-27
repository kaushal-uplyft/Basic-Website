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
        <!-- BEGIN Page Wrapper -->
            <div class="page-inner">
                <!-- BEGIN Left Aside -->
                <aside class="page-sidebar">
                    <div class="page-logo">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center" data-toggle="modal" data-target="#modal-shortcut">
                            <img src="img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            <span class="page-logo-text mr-1">SmartAdmin WebApp</span>
                            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                        </a>
                    </div>
                    <!-- BEGIN PRIMARY NAVIGATION -->
                    <nav id="js-primary-nav" class="primary-nav" role="navigation">
                        <div class="nav-filter">
                            <div class="position-relative">
                                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                                    <i class="fal fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="info-card">
                            <img src="img/demo/avatars/avatar-admin.png" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
                            <div class="info-card-text">
                                <a href="#" class="d-flex align-items-center text-white">
                                    <span class="text-truncate text-truncate-sm d-inline-block">
                                        Dr. Codex Lantern
                                    </span>
                                </a>
                                <span class="d-inline-block text-truncate text-truncate-sm">Toronto, Canada</span>
                            </div>
                            <img src="img/card-backgrounds/cover-2-lg.png" class="cover" alt="cover">
                            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                                <i class="fal fa-angle-down"></i>
                            </a>
                        </div>
                        <ul id="js-nav-menu" class="nav-menu">
                            <li class="open">
                                <a href="#" title="Application Intel" data-filter-tags="application intel">
                                    <i class="fal fa-info-circle"></i>
                                    <span class="nav-link-text" data-i18n="nav.application_intel">Application Intel</span>
                                </a>
                                <ul>
                                    <li class="active">
                                        <a href="intel_analytics_dashboard.html" title="Analytics Dashboard" data-filter-tags="application intel analytics dashboard">
                                            <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard">Analytics Dashboard</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="intel_marketing_dashboard.html" title="Marketing Dashboard" data-filter-tags="application intel marketing dashboard">
                                            <span class="nav-link-text" data-i18n="nav.application_intel_marketing_dashboard">Marketing Dashboard</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="intel_introduction.html" title="Introduction" data-filter-tags="application intel introduction">
                                            <span class="nav-link-text" data-i18n="nav.application_intel_introduction">Introduction</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="intel_privacy.html" title="Privacy" data-filter-tags="application intel privacy">
                                            <span class="nav-link-text" data-i18n="nav.application_intel_privacy">Privacy</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="intel_build_notes.html" title="Build Notes" data-filter-tags="application intel build notes">
                                            <span class="nav-link-text" data-i18n="nav.application_intel_build_notes">Build Notes</span>
                                            <span class="">v4.0.0</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="active open">
                                <a href="index.php" title="Application Intel" data-filter-tags="application intel">
                                    <i class="fal fa-info-circle"></i>
                                    <span class="nav-link-text" data-i18n="nav.application_intel"> Home </span>
                                </a>
                            </li>

                            <li class="open">
                                <a href="membership_list.php" title="Application Intel" data-filter-tags="application intel">
                                    <i class="fal fa-info-circle"></i>
                                    <span class="nav-link-text" data-i18n="nav.application_intel"> Membership Plans </span>
                                </a>
                            </li>

                            <li class="open">
                                <a href="subscription_info.php" title="Application Intel" data-filter-tags="application intel">
                                    <i class="fal fa-info-circle"></i>
                                    <span class="nav-link-text" data-i18n="nav.application_intel"> My Subscriptions </span>
                                </a>
                            </li>

                            <li class="open">
                                <a href="#" title="Application Intel" data-filter-tags="application intel">
                                    <i class="fal fa-info-circle"></i>
                                    <span class="nav-link-text" data-i18n="nav.application_intel"> Courses </span>
                                </a>
                                <ul>
                                    <li class="active">
                                        <a href="course_list.php" title="Analytics Dashboard" data-filter-tags="application intel analytics dashboard">
                                            <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard"> Course List </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="customer_course.php" title="Marketing Dashboard" data-filter-tags="application intel marketing dashboard">
                                            <span class="nav-link-text" data-i18n="nav.application_intel_marketing_dashboard"> My Courses </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                        </ul>
                        <div class="filter-message js-filter-message bg-success-600"></div>
                    </nav>
                    <!-- END PRIMARY NAVIGATION -->

                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper">
                    <!-- BEGIN Page Header -->
                    <header class="page-header" role="banner">
                        <!-- we need this logo when user switches to nav-function-top -->
                        <div class="page-logo">
                            <a href="#" class="page-logo-link press-scale-down d-flex align-items-center" data-toggle="modal" data-target="#modal-shortcut">
                                <img src="img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                                <span class="page-logo-text mr-1">SmartAdmin WebApp</span>
                                <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                            </a>
                        </div>
                        <!-- DOC: nav menu layout change shortcut -->

                        <!-- DOC: mobile button appears during mobile width -->
                        <div class="hidden-lg-up">
                            <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
                                <i class="ni ni-menu"></i>
                            </a>
                        </div>

                        <div class="ml-auto d-flex">
                            <!-- activate app search icon (mobile) -->



                            <!-- app notification -->
                            <div>
                                <a href="#" class="header-icon" data-toggle="dropdown" title="You got 11 notifications">
                                    <i class="fal fa-bell"></i>
                                    <span class="badge badge-icon">11</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-xl">
                                    <div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center rounded-top mb-2">
                                        <h4 class="m-0 text-center color-white">
                                            11 New
                                            <small class="mb-0 opacity-80">User Notifications</small>
                                        </h4>
                                    </div>
                                    <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link px-4 fs-md js-waves-on fw-500" data-toggle="tab" href="#tab-messages" data-i18n="drpdwn.messages">Messages</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link px-4 fs-md js-waves-on fw-500" data-toggle="tab" href="#tab-feeds" data-i18n="drpdwn.feeds">Feeds</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link px-4 fs-md js-waves-on fw-500" data-toggle="tab" href="#tab-events" data-i18n="drpdwn.events">Events</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content tab-notification">
                                        <div class="tab-pane active p-3 text-center">
                                            <h5 class="mt-4 pt-4 fw-500">
                                                <span class="d-block fa-3x pb-4 text-muted">
                                                    <i class="ni ni-arrow-up text-gradient opacity-70"></i>
                                                </span> Select a tab above to activate
                                                <small class="mt-3 fs-b fw-400 text-muted">
                                                    This blank page message helps protect your privacy, or you can show the first message here automatically through
                                                    <a href="#">settings page</a>
                                                </small>
                                            </h5>
                                        </div>
                                        <div class="tab-pane" id="tab-messages" role="tabpanel">
                                            <div class="custom-scroll h-100">
                                                <ul class="notification">
                                                    <li class="unread">
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status mr-2">
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-c.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Melissa Ayre <span class="badge badge-primary fw-n position-absolute pos-top pos-right mt-1">INBOX</span></span>
                                                                <span class="msg-a fs-sm">Re: New security codes</span>
                                                                <span class="msg-b fs-xs">Hello again and thanks for being part...</span>
                                                                <span class="fs-nano text-muted mt-1">56 seconds ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="unread">
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status mr-2">
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-a.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Adison Lee</span>
                                                                <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                                <span class="fs-nano text-muted mt-1">2 minutes ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status status-success mr-2">
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-b.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Oliver Kopyuv</span>
                                                                <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                                <span class="fs-nano text-muted mt-1">3 days ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status status-warning mr-2">
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-e.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Dr. John Cook PhD</span>
                                                                <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                                <span class="fs-nano text-muted mt-1">2 weeks ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status status-success mr-2">
                                                                <!-- <img src="img/demo/avatars/avatar-m.png" data-src="img/demo/avatars/avatar-h.png" class="profile-image rounded-circle" alt="Sarah McBrook" /> -->
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-h.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Sarah McBrook</span>
                                                                <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                                <span class="fs-nano text-muted mt-1">3 weeks ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status status-success mr-2">
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-m.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Anothony Bezyeth</span>
                                                                <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                                <span class="fs-nano text-muted mt-1">one month ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status status-danger mr-2">
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-j.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Lisa Hatchensen</span>
                                                                <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                                <span class="fs-nano text-muted mt-1">one year ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab-feeds" role="tabpanel">
                                            <div class="custom-scroll h-100">
                                                <ul class="notification">
                                                    <li class="unread">
                                                        <div class="d-flex align-items-center show-child-on-hover">
                                                            <span class="d-flex flex-column flex-1">
                                                                <span class="name d-flex align-items-center">Administrator <span class="badge badge-success fw-n ml-1">UPDATE</span></span>
                                                                <span class="msg-a fs-sm">
                                                                    System updated to version <strong>4.0.0</strong> <a href="intel_build_notes.html">(patch notes)</a>
                                                                </span>
                                                                <span class="fs-nano text-muted mt-1">5 mins ago</span>
                                                            </span>
                                                            <div class="show-on-hover-parent position-absolute pos-right pos-bottom p-3">
                                                                <a href="#" class="text-muted" title="delete"><i class="fal fa-trash-alt"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center show-child-on-hover">
                                                            <div class="d-flex flex-column flex-1">
                                                                <span class="name">
                                                                    Adison Lee <span class="fw-300 d-inline">replied to your video <a href="#" class="fw-400"> Cancer Drug</a> </span>
                                                                </span>
                                                                <span class="msg-a fs-sm mt-2">Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day...</span>
                                                                <span class="fs-nano text-muted mt-1">10 minutes ago</span>
                                                            </div>
                                                            <div class="show-on-hover-parent position-absolute pos-right pos-bottom p-3">
                                                                <a href="#" class="text-muted" title="delete"><i class="fal fa-trash-alt"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center show-child-on-hover">
                                                            <!--<img src="img/demo/avatars/avatar-m.png" data-src="img/demo/avatars/avatar-k.png" class="profile-image rounded-circle" alt="k" />-->
                                                            <div class="d-flex flex-column flex-1">
                                                                <span class="name">
                                                                    Troy Norman'<span class="fw-300">s new connections</span>
                                                                </span>
                                                                <div class="fs-sm d-flex align-items-center mt-2">
                                                                    <span class="profile-image-md mr-1 rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-a.png'); background-size: cover;"></span>
                                                                    <span class="profile-image-md mr-1 rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-b.png'); background-size: cover;"></span>
                                                                    <span class="profile-image-md mr-1 rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-c.png'); background-size: cover;"></span>
                                                                    <span class="profile-image-md mr-1 rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-e.png'); background-size: cover;"></span>
                                                                    <div data-hasmore="+3" class="rounded-circle profile-image-md mr-1">
                                                                        <span class="profile-image-md mr-1 rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-h.png'); background-size: cover;"></span>
                                                                    </div>
                                                                </div>
                                                                <span class="fs-nano text-muted mt-1">55 minutes ago</span>
                                                            </div>
                                                            <div class="show-on-hover-parent position-absolute pos-right pos-bottom p-3">
                                                                <a href="#" class="text-muted" title="delete"><i class="fal fa-trash-alt"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center show-child-on-hover">
                                                            <!--<img src="img/demo/avatars/avatar-m.png" data-src="img/demo/avatars/avatar-e.png" class="profile-image-sm rounded-circle align-self-start mt-1" alt="k" />-->
                                                            <div class="d-flex flex-column flex-1">
                                                                <span class="name">Dr John Cook <span class="fw-300">sent a <span class="text-danger">new signal</span></span></span>
                                                                <span class="msg-a fs-sm mt-2">Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.</span>
                                                                <span class="fs-nano text-muted mt-1">10 minutes ago</span>
                                                            </div>
                                                            <div class="show-on-hover-parent position-absolute pos-right pos-bottom p-3">
                                                                <a href="#" class="text-muted" title="delete"><i class="fal fa-trash-alt"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center show-child-on-hover">
                                                            <div class="d-flex flex-column flex-1">
                                                                <span class="name">Lab Images <span class="fw-300">were updated!</span></span>
                                                                <div class="fs-sm d-flex align-items-center mt-1">
                                                                    <a href="#" class="mr-1 mt-1" title="Cell A-0012">
                                                                        <span class="d-block img-share" style="background-image:url('img/thumbs/pic-7.png'); background-size: cover;"></span>
                                                                    </a>
                                                                    <a href="#" class="mr-1 mt-1" title="Patient A-473 saliva">
                                                                        <span class="d-block img-share" style="background-image:url('img/thumbs/pic-8.png'); background-size: cover;"></span>
                                                                    </a>
                                                                    <a href="#" class="mr-1 mt-1" title="Patient A-473 blood cells">
                                                                        <span class="d-block img-share" style="background-image:url('img/thumbs/pic-11.png'); background-size: cover;"></span>
                                                                    </a>
                                                                    <a href="#" class="mr-1 mt-1" title="Patient A-473 Membrane O.C">
                                                                        <span class="d-block img-share" style="background-image:url('img/thumbs/pic-12.png'); background-size: cover;"></span>
                                                                    </a>
                                                                </div>
                                                                <span class="fs-nano text-muted mt-1">55 minutes ago</span>
                                                            </div>
                                                            <div class="show-on-hover-parent position-absolute pos-right pos-bottom p-3">
                                                                <a href="#" class="text-muted" title="delete"><i class="fal fa-trash-alt"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center show-child-on-hover">
                                                            <!--<img src="img/demo/avatars/avatar-m.png" data-src="img/demo/avatars/avatar-h.png" class="profile-image rounded-circle align-self-start mt-1" alt="k" />-->
                                                            <div class="d-flex flex-column flex-1">
                                                                <div class="name mb-2">
                                                                    Lisa Lamar<span class="fw-300"> updated project</span>
                                                                </div>
                                                                <div class="row fs-b fw-300">
                                                                    <div class="col text-left">
                                                                        Progress
                                                                    </div>
                                                                    <div class="col text-right fw-500">
                                                                        45%
                                                                    </div>
                                                                </div>
                                                                <div class="progress progress-sm d-flex mt-1">
                                                                    <span class="progress-bar bg-primary-500 progress-bar-striped" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></span>
                                                                </div>
                                                                <span class="fs-nano text-muted mt-1">2 hrs ago</span>
                                                                <div class="show-on-hover-parent position-absolute pos-right pos-bottom p-3">
                                                                    <a href="#" class="text-muted" title="delete"><i class="fal fa-trash-alt"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab-events" role="tabpanel">
                                            <div class="d-flex flex-column h-100">
                                                <div class="h-auto">
                                                    <table class="table table-bordered table-calendar m-0 w-100 h-100 border-0">
                                                        <tr>
                                                            <th colspan="7" class="pt-3 pb-2 pl-3 pr-3 text-center">
                                                                <div class="js-get-date h5 mb-2">[your date here]</div>
                                                            </th>
                                                        </tr>
                                                        <tr class="text-center">
                                                            <th>Sun</th>
                                                            <th>Mon</th>
                                                            <th>Tue</th>
                                                            <th>Wed</th>
                                                            <th>Thu</th>
                                                            <th>Fri</th>
                                                            <th>Sat</th>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted bg-faded">30</td>
                                                            <td>1</td>
                                                            <td>2</td>
                                                            <td>3</td>
                                                            <td>4</td>
                                                            <td>5</td>
                                                            <td><i class="fal fa-birthday-cake mt-1 ml-1 position-absolute pos-left pos-top text-primary"></i> 6</td>
                                                        </tr>
                                                        <tr>
                                                            <td>7</td>
                                                            <td>8</td>
                                                            <td>9</td>
                                                            <td class="bg-primary-300 pattern-0">10</td>
                                                            <td>11</td>
                                                            <td>12</td>
                                                            <td>13</td>
                                                        </tr>
                                                        <tr>
                                                            <td>14</td>
                                                            <td>15</td>
                                                            <td>16</td>
                                                            <td>17</td>
                                                            <td>18</td>
                                                            <td>19</td>
                                                            <td>20</td>
                                                        </tr>
                                                        <tr>
                                                            <td>21</td>
                                                            <td>22</td>
                                                            <td>23</td>
                                                            <td>24</td>
                                                            <td>25</td>
                                                            <td>26</td>
                                                            <td>27</td>
                                                        </tr>
                                                        <tr>
                                                            <td>28</td>
                                                            <td>29</td>
                                                            <td>30</td>
                                                            <td>31</td>
                                                            <td class="text-muted bg-faded">1</td>
                                                            <td class="text-muted bg-faded">2</td>
                                                            <td class="text-muted bg-faded">3</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="flex-1 custom-scroll">
                                                    <div class="p-2">
                                                        <div class="d-flex align-items-center text-left mb-3">
                                                            <div class="width-5 fw-300 text-primary l-h-n mr-1 align-self-start fs-xxl">
                                                                15
                                                            </div>
                                                            <div class="flex-1">
                                                                <div class="d-flex flex-column">
                                                                    <span class="l-h-n fs-md fw-500 opacity-70">
                                                                        October 2020
                                                                    </span>
                                                                    <span class="l-h-n fs-nano fw-400 text-secondary">
                                                                        Friday
                                                                    </span>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <p>
                                                                        <strong>2:30PM</strong> - Doctor's appointment
                                                                    </p>
                                                                    <p>
                                                                        <strong>3:30PM</strong> - Report overview
                                                                    </p>
                                                                    <p>
                                                                        <strong>4:30PM</strong> - Meeting with Donnah V.
                                                                    </p>
                                                                    <p>
                                                                        <strong>5:30PM</strong> - Late Lunch
                                                                    </p>
                                                                    <p>
                                                                        <strong>6:30PM</strong> - Report Compression
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-2 px-3 bg-faded d-block rounded-bottom text-right border-faded border-bottom-0 border-right-0 border-left-0">
                                        <a href="#" class="fs-xs fw-500 ml-auto">view all notifications</a>
                                    </div>
                                </div>
                            </div>
                            <!-- app user menu -->
                            <div>
                                <a href="#" data-toggle="dropdown" title="drlantern@gotbootstrap.com" class="header-icon d-flex align-items-center justify-content-center ml-2">
                                    <img src="<?php echo $cust_profile_pic ?>" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
                                    <!-- <img src="<?php echo $cust_profile_pic; ?> " class="profile-image rounded-circle" alt="Dr. Codex Lantern"> -->
                                    <!-- you can also add username next to the avatar with the codes below:
									<span class="ml-1 mr-1 text-truncate text-truncate-header hidden-xs-down">Me</span>
									<i class="ni ni-chevron-down hidden-xs-down"></i> -->
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                                    <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                        <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                            <span class="mr-2">
                                                <img src="<?php echo $cust_profile_pic ?>" class="rounded-circle profile-image" alt="Dr. Codex Lantern">
                                            </span>
                                            <div class="info-card-text">
                                                <div class="fs-lg text-truncate text-truncate-lg"> <?php echo $cust_first_name .' '. $cust_last_name ?> </div>
                                                <span class="text-truncate text-truncate-md opacity-80"> <?php echo $cust_email ?> </span>
                                                <span class="text-truncate text-truncate-md opacity-80"> <?php echo $cust_phone ?> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="#" class="dropdown-item" data-action="app-reset">
                                        <span data-i18n="drpdwn.reset_layout">Reset Layout</span>
                                    </a>
                                    <a href="#" class="dropdown-item" data-toggle="modal" data-target=".js-modal-settings">
                                        <span data-i18n="drpdwn.settings">Settings</span>
                                    </a>
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="#" class="dropdown-item" data-action="app-fullscreen">
                                        <span data-i18n="drpdwn.fullscreen">Fullscreen</span>
                                        <i class="float-right text-muted fw-n">F11</i>
                                    </a>
                                    <a href="#" class="dropdown-item" data-action="app-print">
                                        <span data-i18n="drpdwn.print">Print</span>
                                        <i class="float-right text-muted fw-n">Ctrl + P</i>
                                    </a>
                                    <div class="dropdown-multilevel dropdown-multilevel-left">
                                        <div class="dropdown-item">
                                            Language
                                        </div>
                                        <div class="dropdown-menu">
                                            <a href="#?lang=fr" class="dropdown-item" data-action="lang" data-lang="fr">Français</a>
                                            <a href="#?lang=en" class="dropdown-item active" data-action="lang" data-lang="en">English (US)</a>
                                            <a href="#?lang=es" class="dropdown-item" data-action="lang" data-lang="es">Español</a>
                                            <a href="#?lang=ru" class="dropdown-item" data-action="lang" data-lang="ru">Русский язык</a>
                                            <a href="#?lang=jp" class="dropdown-item" data-action="lang" data-lang="jp">日本語</a>
                                            <a href="#?lang=ch" class="dropdown-item" data-action="lang" data-lang="ch">中文</a>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item fw-500 pt-3 pb-3" href="user_verify.php">
                                        <span data-i18n="drpdwn.page-logout"> Sign out </span>
                                        <!-- <span class="float-right fw-n">&commat;codexlantern</span> -->
                                    </a>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
                      <!-- <p> <?php //echo $home_response['status'] ?> </p> -->
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
                            <a href="customer_live_session.php?live_session_id=<?php echo $home_response['data']['LiveSessions'][0]['LiveSessionId'] ?>&room_name=<?php echo $home_response['data']['LiveSessions'][0]['RoomName'] ?>" class="btn btn-info col-md-3 join-session-btn" style="float:right;font-weight:bold;"> Join Now </a>
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
                            <div class="col-xs-6 col-md-3">
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
                            <div class="col-xs-6 col-md-3">
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
                            <div class="col-xs-6 col-md-3">
                                <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g">
                                    <div class="">
                                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                            <?php echo $customer_info['data']['TodayStep']  ?>
                                            <small class="m-0 l-h-n"> Today's Step Count </small>
                                        </h3>
                                    </div>
                                    <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                                    <div class="">
                                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                            <?php echo $customer_info['data']['StepsTarget'] ?>
                                            <small class="m-0 l-h-n"> Steps Target </small>
                                        </h3>
                                    </div>
                                    <i class="fal fa-globe position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 6rem;"></i>
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
                                        THIS WEEK'S ACTIVITY
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
                                                          <input type="checkbox" class="custom-control-input" id="defaultInline1" <?php foreach($home_response['data']['User']['ThisWeekActivity'] as $days){ if($days == 'Sun') { ?> checked  <?php } else{ ?> disabled <?php  } } ?>  >
                                                          <label class="custom-control-label" for="defaultInline1"> Sunday
                                                          </label>
                                                      </div>

                                                      <div class="custom-control custom-checkbox custom-control-inline">
                                                          <input type="checkbox" class="custom-control-input" id="defaultInline2"  <?php foreach($home_response['data']['User']['ThisWeekActivity'] as $days){ if($days == 'Mon') { ?> checked  <?php } else{ ?> disabled <?php  } } ?> >
                                                          <label class="custom-control-label" for="defaultInline2"> Monday </label>
                                                      </div>

                                                      <div class="custom-control custom-checkbox custom-control-inline">
                                                          <input type="checkbox" class="custom-control-input" id="defaultInline1" <?php foreach($home_response['data']['User']['ThisWeekActivity'] as $days){ if($days == 'Tue') { ?> checked  <?php } else{ ?> disabled <?php  } } ?> >
                                                          <label class="custom-control-label" for="defaultInline1"> Tuesday  </label>
                                                      </div>

                                                      <div class="custom-control custom-checkbox custom-control-inline">
                                                          <input type="checkbox" class="custom-control-input" id="defaultInline2" <?php foreach($home_response['data']['User']['ThisWeekActivity'] as $days){ if($days == 'Wed') { ?> checked  <?php } else{ ?> disabled <?php  } } ?> >
                                                          <label class="custom-control-label" for="defaultInline2"> Wednesday </label>
                                                      </div>

                                                      <div class="custom-control custom-checkbox custom-control-inline">
                                                          <input type="checkbox" class="custom-control-input" id="defaultInline1" <?php foreach($home_response['data']['User']['ThisWeekActivity'] as $days){ if($days == 'Thu') { ?> checked  <?php } else{ ?> disabled <?php  } } ?> >
                                                          <label class="custom-control-label" for="defaultInline1"> Thusday </label>
                                                      </div>

                                                      <div class="custom-control custom-checkbox custom-control-inline">
                                                          <input type="checkbox" class="custom-control-input" id="defaultInline2" <?php foreach($home_response['data']['User']['ThisWeekActivity'] as $days){ if($days == 'Fri') { ?> checked  <?php } else{ ?> disabled <?php  } } ?> >
                                                          <label class="custom-control-label" for="defaultInline2"> Friday </label>
                                                      </div>

                                                      <div class="custom-control custom-checkbox custom-control-inline">
                                                          <input type="checkbox" class="custom-control-input" id="defaultInline1" <?php foreach($home_response['data']['User']['ThisWeekActivity'] as $days){ if($days == 'Sat') { ?> checked  <?php } else{ ?> disabled <?php  } } ?> >
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
                                                        <center style="margin:10px 0px 5px 0px">
                                                          <span class=" ml-3">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/workout_plan.png')"></span>
                                                          </span>
                                                        </center>
                                                      <div class="ml-3">
                                                        <?php  if($customer_info['data']['isWorkoutAssigned'] == '1') { ?>
                                                          <a href="customer_workout_plan.php?CustomerUserId=<?php echo $cust_user_id ?>" title="Lisa Hatchensen" class="d-block fw-700 text-dark text-center">Workout Plan </a>
                                                        <?php } else {?>
                                                          <a href="javascript:void(0);" title="Lisa Hatchensen" class="d-block fw-700 text-dark text-center" data-toggle="modal" data-target="#WorkoutPlanModal"> Workout Plan </a>
                                                        <?php } ?>
                                                      </div>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                                        <center style="margin:10px 0px 5px 0px">
                                                          <span class=" ml-3">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/diet_plan.png')"></span>
                                                          </span>
                                                        </center>
                                                      <div class="ml-3">
                                                          <!-- <a href="javascript:void(0);" title="Lisa Hatchensen" class="d-block fw-700 text-dark text-center"> Diet Plan </a> -->
                                                          <a href="javascript:void(0);" title="Lisa Hatchensen" class="d-block fw-700 text-dark text-center" data-toggle="modal" data-target="#DietPlanModal"> Diet Plan </a>
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
                                                        <center style="margin:10px 0px 5px 0px">
                                                          <span class=" ml-3">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/cardio_analysis.png')"></span>
                                                          </span>
                                                        </center>
                                                      <div class="ml-3">
                                                          <a href="javascript:void(0);" title="Lisa Hatchensen" class="d-block fw-700 text-dark text-center"> Programs </a>
                                                      </div>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                                        <center style="margin:10px 0px 5px 0px">
                                                          <span class=" ml-3">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/cardio_analysis.png')"></span>
                                                          </span>
                                                        </center>
                                                      <div class="ml-3">
                                                          <a href="javascript:void(0);" title="Lisa Hatchensen" class="d-block fw-700 text-dark text-center"> Recipes </a>
                                                      </div>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                                        <center style="margin:10px 0px 5px 0px">
                                                          <span class=" ml-3">
                                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/quick_action/cardio_analysis.png')"></span>
                                                          </span>
                                                        </center>
                                                      <div class="ml-3">
                                                          <a href="javascript:void(0);" title="Lisa Hatchensen" class="d-block fw-700 text-dark text-center"> Subscriptions </a>
                                                      </div>
                                                    </div>

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
                        <!-- Quack Action End -->
                        <!-- Todays Task & Traffic Start -->
                        <div class="row">
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
                                                                <li class="workout-timer-list"><span id="days"> <?php echo $gym_live_traffic['data']['TotalCheckins'] ?> </span> Male </li>

                                                                <li class="workout-timer-list"><span id="hours"> <?php echo $gym_live_traffic['data']['TotalFemaleCheckins'] ?> </span> Female </li>

                                                                <li class="workout-timer-list"><span id="minutes"> <?php echo $gym_live_traffic['data']['TotalCheckins'] ?> </span> Total </li>

                                                                <li class="workout-timer-list"><span id="seconds"> <?php echo $gym_live_traffic['data']['GymMeterPercent'] ?> % </span> Capacity </li>
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
                          <div class="col-xl-6">
                                  <div class="timer-container" style="background-image: url('img/quick_action/transformation.png');background-repeat:no-repeat;background-size: cover;background-color:transparent;padding:30px;height:300px;">
                                    <div class="container time-box">
                                    <h1 class="workout-timer-title" style="color:#fff;"> Transformation </h1>
                                  </div>
                                  </div>
                                </div>

                                <div class="col-xl-6">
                                        <div class="timer-container" style="background-image: url('img/quick_action/transformation.png');background-repeat:no-repeat;background-size: cover;background-color:transparent;padding:30px;height:300px;">
                                          <div class="container time-box">
                                          <h1 class="workout-timer-title" style="color:#fff;"> My Activity </h1>
                                        </div>
                                        </div>
                                      </div>
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
                            <span class="hidden-md-down fw-700">2019 © SmartAdmin by&nbsp;<a href='https://www.gotbootstrap.com' class='text-primary fw-500' title='gotbootstrap.com' target='_blank'>gotbootstrap.com</a></span>
                        </div>
                        <div>
                            <ul class="list-table m-0">
                                <li><a href="#" class="text-secondary fw-700">About</a></li>
                                <li class="pl-3"><a href="#" class="text-secondary fw-700">License</a></li>
                                <li class="pl-3"><a href="#" class="text-secondary fw-700">Documentation</a></li>
                                <li class="pl-3 fs-xl"><a href="#" class="text-secondary"><i class="fal fa-question-circle" aria-hidden="true"></i></a></li>
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
                <p><b> No Plan Available. Consult your trainer/management for a plan orr create your own customized plan. </b></p>
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
                <p><b> No Plan Available. Consult your trainer/management for a plan orr create your own customized plan. </b></p>
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
