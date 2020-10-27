<?php
include('config.php');
// echo $api_endpoint; // 'localhost'
?>

<?php
  $cust_payload = $_SESSION["cust_payload"];
  $cust_user_id = $_SESSION["cust_user_id"];
  // $course_id = '57';
  if($cust_user_id and $show_book_class=='1'){
  }
  else{
    echo "<script type='text/javascript'> document.location = 'user_verify.php'; </script>";
  }
?>

<?php

if (isset($_POST['save'])){
// if (!isset($_POST['save'])){

  $record_date = $_POST['class_record_date'];

  $format_record_date = date_create($record_date);
  $class_record_date = date_format($format_record_date,"Y-m-d");

}else{
  $record_date = '';
  $record_date = $_GET['RecordDate'];
    if($record_date){
      $class_record_date = date('Y-m-d',strtotime($record_date));
    }else{
      $class_record_date = date('Y-m-d');
    }
}

?>

<?php


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
  $class_json_response = json_decode($response, true);
  $register_response_code = $class_json_response['status_code'];
  $class_list_obj = $class_json_response['data']['ClassList'];
  // echo '**** $class_list_obj ****';
  // echo $class_list_obj;
  // echo $json_response;
  if(  $register_response_code == '200' ){
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

    if($customer_profile_response_code == '200'){
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
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <style>
          .form-submit_button{
            background:#F21F55 !important;
            color:#fff !important;
          }

          #js-login-btn{
            background:transparent !important;
            color:#fff !important;
            border:none;
          }

          .bg-brand-gradient{
            background: url('img/login_bg.jpg') no-repeat center bottom fixed;
            background-size: cover;
          }
        </style>

        <style>
          /* .nav-function-top .page-content-wrapper{
            margin-top:0px;
          } */
        </style>

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
            <?php include 'navbar.php';?>
                    <main id="js-page-content" role="main" class="page-content">
                      <div class="row">
                        <div class="col-xl-12">
                            <div id="panel-1" class="panel">

                                <div class="panel-container show">
                                    <div class="panel-content">
                                        <!-- <div class="panel-tag">
                                            Be sure to use an appropriate type attribute on all inputs (e.g., code <code>email</code> for email address or <code>number</code> for numerical information) to take advantage of newer input controls like email verification, number selection, and more.
                                        </div> -->
                                        <form id="js-login" novalidate="" action="class_book.php" method="POST" enctype="multipart/form-data">

                                          <center class="row">
                                           <div class="input-group col-md-4 input-group-append">
                                             <input id="record_date_classes" name="class_record_date" class="form-control" aria-describedby="basic-addon2" style="height:50px;">

                                             <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2" style="height:50px;"> <i class="fal fa-calendar-alt"></i> </span>
                                              </div>

                                           </div>

                                           <div class="input-group col-md-2" style="position:relative;top:-17px;height:50px;">
                                              <input type="submit" name='save' value="Submit" class="btn btn-block btn-danger form-submit_button btn-lg mt-3" id="js-login-btn">
                                           </div>

                                         </center>

                                         <div class="h-100 row" style="margin-top:30px;">
                                         <!-- <center> -->

                                         <?php
                                           foreach($class_list_obj as $class_obj){  ?>
                                            <?php if($class_obj['MembershipId']){ ?>
                                           <div class="col-md-6 col-sm-6 col-xs-12">
                                             <div class="card border m-lg-30" style="margin-bottom:30px">
                                               <?php if($class_obj['MembershipImage']){ ?>
                                               <center>
                                                 <img src="<?php echo $class_obj['MembershipImage'] ?>" class="card-img-top" style="height:215px;width:215px;" alt="...">
                                               </center>
                                             <?php } ?>
                                                 <div class="card-body">
                                                     <h5 class="card-title"> <b> <?php echo $class_obj['ClassName']; ?> </b> </h5>
                                                     <!-- <a href="course_detail.php?course_id=<?php //  echo $class_obj['CourseId']; ?>" class="btn btn-primary text-center"> View </a> -->
                                                     <?php if($class_obj['CanBook'] == '1' and $class_obj['IsBooked'] == '0'){ ?>
                                                        <?php if($class_obj['ClassSessionType'] == 'PAID') { ?>
                                                            <a href="paid_class_order.php?UserId=<?php echo $cust_user_id ?>&MembershipId=<?php echo $class_obj['MembershipId']; ?>&BatchId=<?php echo $class_obj['ClassId']; ?>&SubscriptionStartDate=<?php echo $class_record_date; ?>&ClassMembershipType=<?php echo $class_obj['ClassSessionType']; ?>" class="btn btn-primary text-center"> Book Now  </a>
                                                        <?php } else{ ?>
                                                            <a href="free_class_order.php?UserId=<?php echo $cust_user_id ?>&MembershipId=<?php echo $class_obj['MembershipId']; ?>&BatchId=<?php echo $class_obj['ClassId']; ?>&SubscriptionStartDate=<?php echo $class_record_date; ?>&ClassMembershipType=<?php echo $class_obj['ClassSessionType']; ?>" class="btn btn-primary text-center" onclick="alertBox()"> Book Now  </a>
                                                        <?php } ?>
                                                   <?php } else{ ?>

                                                        <?php if($class_obj['IsCanceled'] == '1'){ ?>
                                                          <a class="btn btn-primary text-center text-white" disabled style="background:#4B4453;border-color:#4B4453;"> Canceled  </a>
                                                      <?php }else{ ?>
                                                          <a class="btn btn-primary text-center text-white" disabled style="background:#4B4453;border-color:#4B4453;"> Booked  </a>
                                                      <?php } ?>

                                                      <?php if($class_obj['ShowCancel'] == '1'){ ?>
                                                          <a  href="class_cancle.php?SubscriptionId=<?php echo $class_obj['SubscriptionId']; ?>&ClassId=<?php echo $class_obj['ClassId']; ?>&RecordDate=<?php echo $class_record_date; ?>" class="btn btn-primary text-center text-white" style="background:#D13A28;border-color:#D13A28;"> Cancle  </a>
                                                      <?php } ?>
                                                  <?php } ?>
                                                     <?php if($class_obj['Trainer']) { ?>

                                                       <h3 style="margin-top:20px;"> Trainers </h3>
                                                       <div class="row">
                                                       <?php
                                                         foreach($class_obj['Trainer'] as $trainer){  ?>
                                                       <div class="col-lg-3 col-md-4 col-sm-12">
                                                           <center style="margin:10px 0px 5px 0px">
                                                             <span class=" ml-3">
                                                               <span class="profile-image rounded-circle d-inline-block" style="background-image:url('<?php echo $trainer['TrainerProfilePic'] ?>')"></span>
                                                             </span>
                                                           </center>
                                                         <div class="ml-3">
                                                             <a href="javascript:void(0);" title="Lisa Hatchensen" class="d-block fw-700 text-dark text-center"> <?php echo $trainer['TrainerName'] ?> </a>
                                                         </div>
                                                       </div>
                                                     <?php } ?>
                                                   </div>
                                                    <?php } ?>

                                                 </div>
                                                 <ul class="list-group list-group-flush">
                                                     <li class="list-group-item"> Start Time : <?php  echo $class_obj['StartTime']; ?>    </li>
                                                     <li class="list-group-item"> End Time : <?php  echo $class_obj['EndTime']; ?>    </li>
                                                     <li class="list-group-item"> Membership Name : <?php  echo $class_obj['MembershipName']; ?>    </li>

                                                 </ul>
                                                 <!-- <div class="card-body">
                                                     <a href="#" class="card-link">Card link</a>
                                                     <a href="#" class="card-link">Another link</a>
                                                 </div> -->
                                             </div>
                                           </div>
                                         <?php  }?>
                                       <?php  }?>

                                         <!-- </center> -->
                                         </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>


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
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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

          <!-- <script>
          function alertBox(){
            if (confirm("Are you sure, You want to book this class ?")) {
              } else {
                window.stop();
                return false;
                event.preventDefault();
              }
          }
          </script> -->

        <script>

        // $('#record_date_classes').datepicker("setDate", new Date());

        var ip_record_date = '';
        $(document).ready(function() {
            $('#record_date_classes').datepicker({
              dateFormat: 'dd-mm-yy',
              minDate: new Date(),
              // 'defaultDate': new Date(),
            });


            var ip_record_date = '<?php echo $record_date ?>' ;
            if(ip_record_date){
              $('#record_date_classes').datepicker("setDate", ip_record_date);
            }else{
              $('#record_date_classes').datepicker("setDate", new Date());
            }


            });

            $('#basic-addon2').on('click',function(){
              $('#record_date_classes').datepicker('show');
            }
          );

        </script>

    </body>
</html>
