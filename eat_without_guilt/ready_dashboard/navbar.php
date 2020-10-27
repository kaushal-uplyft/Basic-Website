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

    $curl = curl_init();
    // $username = urlencode(‘user-name’);
    // $password = urlencode(‘password’);

    curl_setopt_array($curl, array(
      CURLOPT_URL => $api_endpoint."api/v1/customer-notifications/",
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
    $noti_info =  json_decode($response, true);

    }

    ?>


        <!-- BEGIN Page Wrapper -->
            <div class="page-inner">
                <!-- BEGIN Left Aside -->
                <aside class="page-sidebar">
                    <div class="page-logo">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center" data-toggle="modal" data-target="#modal-shortcut">
                            <img src="img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            <span class="page-logo-text mr-1"> <?php $title_domain ?> </span>
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
                        <!-- <ul id="js-nav-menu" class="nav-menu"> -->
                        <ul id="" class="nav-menu">

                            <li class="active open">
                                <a href="index.php" title=" Home" data-filter-tags="application intel">
                                    <span class="nav-link-text" data-i18n="nav.application_intel"> Home </span>
                                </a>
                            </li>

                            <li class="open">
                                <a href="membership_list.php" title="Membership Plans" data-filter-tags="application intel">
                                    <span class="nav-link-text" data-i18n="nav.application_intel"> Membership Plans </span>
                                </a>
                            </li>

                            <li class="open">
                                <a href="subscription_info.php" title="My Subscriptions" data-filter-tags="application intel">
                                    <span class="nav-link-text" data-i18n="nav.application_intel"> My Subscriptions </span>
                                </a>
                            </li>

                            <li class="open">
                                <a href="#" title="Courses" data-filter-tags="application intel">
                                    <span class="nav-link-text" data-i18n="nav.application_intel"> Courses </span>
                                </a>
                                <ul>
                                    <li class="active">
                                        <a href="course_list.php" title="Course List" data-filter-tags="application intel analytics dashboard">
                                            <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard"> Course List </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="customer_course.php" title="My Courses" data-filter-tags="application intel marketing dashboard">
                                            <span class="nav-link-text" data-i18n="nav.application_intel_marketing_dashboard"> My Courses </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class=" open">
                                <a href="fitness_center_info.php" title="About Us " data-filter-tags="application intel">
                                    <span class="nav-link-text" data-i18n="nav.application_intel"> About Us </span>
                                </a>
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
                                <span class="page-logo-text mr-1"> <?php $title_domain ?> </span>
                                <!-- <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i> -->
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
                                <a href="#" class="header-icon" data-toggle="dropdown" title="<?php echo $_SESSION["unReadNoti"]; ?> Notifications">
                                    <i class="fal fa-bell"></i>
                                    <!-- <span class="badge badge-icon">11</span> -->
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-xl">
                                    <!-- <div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center rounded-top mb-2">
                                        <h4 class="m-0 text-center color-white">
                                            11 New
                                            <small class="mb-0 opacity-80">User Notifications</small>
                                        </h4>
                                    </div> -->
                                    <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link px-4 fs-md js-waves-on fw-500" data-toggle="tab" href="#tab-messages" data-i18n="drpdwn.messages">Notifications</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link px-4 fs-md js-waves-on fw-500" data-toggle="tab" href="#tab-feeds" data-i18n="drpdwn.feeds">Feeds</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link px-4 fs-md js-waves-on fw-500" data-toggle="tab" href="#tab-events" data-i18n="drpdwn.events">Events</a>
                                        </li> -->
                                    </ul>
                                    <div class="tab-content tab-notification">
                                        <!-- <div class="tab-pane active p-3 text-center">
                                            <h5 class="mt-4 pt-4 fw-500">
                                                <span class="d-block fa-3x pb-4 text-muted">
                                                    <i class="ni ni-arrow-up text-gradient opacity-70"></i>
                                                </span> Select a tab above to activate
                                                <small class="mt-3 fs-b fw-400 text-muted">
                                                    This blank page message helps protect your privacy, or you can show the first message here automatically through
                                                    <a href="#">settings page</a>
                                                </small>
                                            </h5>
                                        </div> -->
                                        <div class="tab-pane active p-3 text-center">
                                            <h5 class="mt-4 pt-4 fw-500">
                                                <span class="d-block fa-3x pb-4 text-muted">
                                                    <i class="ni ni-arrow-up text-gradient opacity-70"></i>
                                                </span> No Notification
                                                <small class="mt-3 fs-b fw-400 text-muted">
                                                </small>
                                            </h5>
                                        </div>
                                        <div class="tab-pane" id="tab-messages" role="tabpanel">
                                            <div class="custom-scroll h-100">
                                                <ul class="notification">
                                                  <?php if($noti_info['data']['NotificationList']){ ?>
                                                    <?php $count = 0;
                                                    foreach($noti_info['data']['NotificationList'] as $noti){
                                                      if ($count < 10) { ?>
                                                      <li <?php if($noti['isRead'] == 'False') { ?>class="unread" <?php } ?> >
                                                          <a href="#" class="d-flex align-items-center">
                                                              <!-- <span class="status mr-2">
                                                                  <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-c.png')"></span>
                                                              </span> -->
                                                              <span class="d-flex flex-column flex-1 ml-1">
                                                                  <span class="name"> <?php echo $noti['NotificationTitle'] ?>
                                                                    <!-- <span class="badge badge-primary fw-n position-absolute pos-top pos-right mt-1">INBOX</span>  -->
                                                                  </span>
                                                                  <span class="msg-a fs-sm"> <?php echo $noti['NotificationDescription'] ?> </span>
                                                                  <span class="fs-nano text-muted mt-1"> <?php echo $noti['CreatedAt'] ?> </span>
                                                              </span>
                                                          </a>
                                                      </li>
                                                    <?php } $count++; }?>

                                                  <?php }else{ ?>
                                                    <li> No Notifications </li>

                                                  <?php } ?>

                                                    <!-- <li>
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
                                                    </li> -->

                                                </ul>
                                            </div>
                                        </div>

                                    </div>

                                    <?php if($noti_info['data']['NotificationList']){?>
                                        <div class="py-2 px-3 bg-faded d-block rounded-bottom text-right border-faded border-bottom-0 border-right-0 border-left-0">
                                            <a href="view_notifications.php" class="fs-xs fw-500 ml-auto">View All Notifications</a>
                                        </div>
                                  <?php } ?>
                                </div>
                            </div>
                            <!-- app user menu -->
                            <div>
                                <a href="#" data-toggle="dropdown" title="" class="header-icon d-flex align-items-center justify-content-center ml-2">
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
                                    <a class="dropdown-item fw-500 pt-3 pb-3" href="client_profile.php">
                                        <span data-i18n="drpdwn.page-logout"> Profile </span>
                                        <!-- <span class="float-right fw-n">&commat;codexlantern</span> -->
                                    </a>
                                    <!-- <a href="#" class="dropdown-item" data-toggle="modal" data-target=".js-modal-settings">
                                        <span data-i18n="drpdwn.settings">Settings</span>
                                    </a> -->
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="#" class="dropdown-item" data-action="app-fullscreen">
                                        <span data-i18n="drpdwn.fullscreen">Fullscreen</span>
                                        <i class="float-right text-muted fw-n">F11</i>
                                    </a>
                                    <a href="#" class="dropdown-item" data-action="app-print">
                                        <span data-i18n="drpdwn.print">Print</span>
                                        <i class="float-right text-muted fw-n">Ctrl + P</i>
                                    </a>
                                    <!-- <div class="dropdown-multilevel dropdown-multilevel-left">
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
                                    </div> -->
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item fw-500 pt-3 pb-3" href="user_verify.php">
                                        <span data-i18n="drpdwn.page-logout"> Sign out </span>
                                        <!-- <span class="float-right fw-n">&commat;codexlantern</span> -->
                                    </a>
                                </div>
                            </div>
                        </div>
                    </header>
                  <!-- </div> -->
