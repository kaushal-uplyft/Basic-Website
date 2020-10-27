<?php
include('config.php');
// echo $api_endpoint; // 'localhost'
?>

<?php
  $cust_payload = $_SESSION["cust_payload"];
  $cust_user_id = $_SESSION["cust_user_id"];
  $trainer_id = $_GET['trainer_id'];
  // $course_id = '57';
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

    if($customer_profile_response_code == '200'){

      $curl = curl_init();
      // $username = urlencode(‘user-name’);
      // $password = urlencode(‘password’);

      curl_setopt_array($curl, array(
        CURLOPT_URL => $api_endpoint."api/v1/fitness-center-trainer-profile/",
        // CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "CustomerUserId=$cust_user_id&TrainerId=$trainer_id",
        CURLOPT_HTTPHEADER => array(
          'content-type: application/x-www-form-urlencoded',
          'Authorization:'.$auth_key,
        ),
      ));
      $trainer_response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);
      $trainer_info =  json_decode($trainer_response, true);
    }


    ?>

  <?php

  if (isset($_POST['free_trial'])){

    $curl = curl_init();

    $auth_header = array(
      'content-type: application/x-www-form-urlencoded',
      'Authorization:'.$auth_key,
    );


    curl_setopt_array($curl, array(
      // CURLOPT_URL => "https://www.yourdeadlift.com/api/v1/website-customer-register/",
      CURLOPT_URL => $api_endpoint."api/v1/fitness-center-trainer-offer/",
      // CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      // CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_POSTFIELDS => "CustomerUserId=$cust_user_id&TrainerId=$trainer_id",
      CURLOPT_HTTPHEADER => $auth_header,
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $json_response = json_decode($response, true);
    $register_response_code = $json_response['status_code'];
    if(  $register_response_code == '200' ){
        header("Location: client_profile.php?trainer_id=$trainer_id");

          }
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
        <link rel="stylesheet" media="screen, print" href="css/star_rating.css">

        <style>
        .height-10{
          height:200px;
        }

        .free_trial_btn, .waves-button-input{
          background:#000;
          color:#fff;
          border:none;
        }
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

        <?php include 'navbar.php';?>
        <!-- BEGIN Page Wrapper -->

                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
                      <div class="row">
                          <div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
                              <!-- profile summary -->
                              <div class="card mb-g rounded-top">
                                  <div class="row no-gutters row-grid">
                                    <div class='bg_layer col-12'>
                                      <div class="customer_cover_pic" style="background:url('<?php echo $trainer_info['data']['TrainerCoverPic'] ?>');background-repeat: no-repeat;background-position: center;background-size: cover;" >
                                          <div class="d-flex flex-column align-items-center justify-content-center p-4">
                                            <h5 class="mb-0 fw-700 text-white text-center mt-3">
                                                <?php echo $trainer_info['data']['TrainerName'] ?>
                                                <small class="text-white mb-0"> <b> <?php echo $trainer_info['data']['TrainerAge'].' '.$trainer_info['data']['TrainerGender'] ?> </b> </small>
                                                <small class="text-white mb-0"> <b> <?php echo $trainer_info['data']['TrainerMotivationMsg'] ?> </b> </small>
                                            </h5><br>
                                            <?php if($trainer_info['data']['TrainerProfilePic']){ ?>
                                              <img src="<?php echo $trainer_info['data']['TrainerProfilePic'] ?>" height="175" width="175" class="rounded-circle shadow-2 img-thumbnail" alt="">
                                            <?php } ?>
                                              <h5 class="mb-0 fw-700 text-white text-center mt-3">
                                                  <b class="text-white mb-0"> <?php echo $trainer_info['data']['TrainerExperience'].' '.$trainer_info['data']['TrainerExperienceUnits'] ?> </b><br>
                                                  <b class="text-white mb-0"> Experience </b><br><br>
                                                  <b class="text-white mb-0"> <?php echo $trainer_info['data']['TrainerSpecialisation'] ?> </b><br>
                                                  <b class="text-white mb-0"> specialization </b>
                                                  <div class="my-rating-4" data-rating="<?php echo $trainer_info['data']['TrainerRatings'] ?>" style="margin:20px 0px;"></div>
                                                  <b class="text-white mb-0"> <?php echo $trainer_info['data']['TrainerRatingsCount'] ?> Customers have rated this trainer </b>
                                              </h5>

                                          </div>
                                      </div>
                                    </div>

                                      <div id="panel-12" class="panel col-12 row">
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <!-- <div class="panel-tag">
                                                    Display of some example optional "stuff" you can add to <code>.card-header</code>
                                                </div> -->

                                                <div class="row">
                                                <!-- <div class="col-md-12">
                                                  <div class="card border mb-g">
                                                      <div class="card-header bg-danger-700 pr-3 d-flex align-items-center flex-wrap">
                                                          <div class="card-title"> View Client Transformations </div>
                                                          <a href="customer_parq_form.php" class="btn btn-dark btn-info ml-auto">
                                                              <i class="ni ni-chevron-right"></i>
                                                          </a>

                                                      </div>
                                                  </div>
                                                </div> -->

                                                <?php if($trainer_info['data']['IsSubscribed'] == '0'){ ?>
                                                <div class="col-md-12">
                                                  <div class="card border mb-g">
                                                      <div class="card-header bg-danger-700 pr-3 d-flex align-items-center flex-wrap">
                                                          <div class="card-title"> <?php echo $trainer_info['data']['PersonalTrainingMsg'] ?> </div>
                                                          <a href="trainer_membership_list.php?trainer_id=<?php echo $trainer_id ?>" class="btn btn-dark btn-info ml-auto">
                                                              <i class="ni ni-chevron-right"></i>
                                                          </a>

                                                      </div>
                                                  </div>
                                                </div>
                                              <?php } ?>

                                              <?php if($trainer_info['data']['Offer']){ ?>
                                              <div class="col-md-12">
                                                <div class="card border mb-g">
                                                    <div class="card-header bg-danger-700 pr-3 d-flex align-items-center flex-wrap">
                                                        <div class="card-title"> <?php echo $trainer_info['data']['Offer']['OfferTitle'] ?> </div>
                                                    </div>
                                                    <div class="card-body">
                                                      <p><?php echo $trainer_info['data']['Offer']['OfferDescription'] ?></p>
                                                      <form id="js-login" novalidate="" action="trainer_profile.php?trainer_id=<?php echo $trainer_id ?>" method="POST" enctype="multipart/form-data">
                                                        <input type="submit" name="free_trial" value="<?php echo $trainer_info['data']['Offer']['OfferButton'] ?>" class="btn btn-success free_trial_btn">
                                                    </form>
                                                    </div>
                                                </div>
                                              </div>
                                            <?php } ?>


                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- certification -->
                              <?php if($trainer_info['data']['TrainerCerts']) { ?>
                              <div class="card mb-g">
                                  <div class="row row-grid no-gutters">
                                      <div class="col-12">
                                          <div class="p-3">
                                              <h2 class="mb-0 fs-xl">
                                                  Certifications
                                              </h2>
                                          </div>
                                      </div>
                                      <?php foreach($trainer_info['data']['TrainerCerts'] as $certificate){ ?>
                                      <div class="col-4">
                                          <a href="<?php echo $certificate['Image']?>" class="text-center px-3 d-flex position-relative height-10 border">
                                              <span class="position-absolute pos-top pos-left pos-right pos-bottom" style="background-image: url('<?php echo $certificate['Image']?>');background-size: cover;"></span>
                                          </a>
                                      </div>
                                    <?php } ?>
                                  </div>
                              </div>
                            <?php } ?>
                              <!-- Awards -->

                              <?php if($trainer_info['data']['TrainerAwards']) { ?>
                              <div class="card mb-g">
                                  <div class="row row-grid no-gutters">
                                      <div class="col-12">
                                          <div class="p-3">
                                              <h2 class="mb-0 fs-xl">
                                                  Awards
                                              </h2>
                                          </div>
                                      </div>
                                      <?php foreach($trainer_info['data']['TrainerAwards'] as $certificate){ ?>
                                      <div class="col-4">
                                          <a href="<?php echo $certificate['Image']?>" class="text-center px-3 py-4 d-flex position-relative height-10 border">
                                              <span class="position-absolute pos-top pos-left pos-right pos-bottom" style="background-image: url('<?php echo $certificate['Image']?>');background-size: cover;"></span>
                                          </a>
                                      </div>
                                    <?php } ?>
                                  </div>
                              </div>
                            <?php } ?>
                              <!-- contacts -->
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
        <script src="js/star_rating.js"></script>
        <script type="text/javascript">
            /* Activate smart panels */
            $('#js-page-content').smartPanel();

            /*----- Star Reating -----*/
            $(".my-rating-4").starRating({
                totalStars: 5,
                starShape: 'rounded',
                starSize: 40,
                emptyColor: 'lightgray',
                hoverColor: 'salmon',
                activeColor: 'yellow',
                useGradient: false,
                readOnly: true,
              });

        </script>
        <!-- The order of scripts is irrelevant. Please check out the plugin pages for more details about these plugins below: -->
        <script src="js/dependency/moment/moment.js"></script>
        <script src="js/miscellaneous/fullcalendar/fullcalendar.bundle.js"></script>
        <script src="js/statistics/sparkline/sparkline.bundle.js"></script>
        <script src="js/statistics/easypiechart/easypiechart.bundle.js"></script>
        <script src="js/statistics/flot/flot.bundle.js"></script>
        <script src="js/miscellaneous/jqvmap/jqvmap.bundle.js"></script>
    </body>
</html>
