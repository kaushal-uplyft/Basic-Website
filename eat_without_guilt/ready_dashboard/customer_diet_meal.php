<?php
include('config.php');
// echo $api_endpoint; // 'localhost'
?>

<?php
  $cust_payload = $_SESSION["cust_payload"];
  $cust_user_id = $_SESSION["cust_user_id"];
  $record_date = $_GET['RecordDate'];
  $day_id = $_GET['DayId'];
  $day_name = $_GET['DayName'];
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
      CURLOPT_URL => $api_endpoint."api/v1/customer-diet-plan/",
      // CURLOPT_SSL_VERIFYPEER => true,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "CustomerUserId=$cust_user_id&RecordDate=$record_date&DayId=$day_id",
      CURLOPT_HTTPHEADER => array(
        'content-type: application/x-www-form-urlencoded',
        'Authorization:'.$auth_key,
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $customer_diet_plan =  json_decode($response, true);
    // echo " membership_plan : " . $membership_plan;
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
            <?php include 'navbar.php';?>
                  <main id="js-page-content" role="main" class="page-content">
                    <div class="panel-hdr">
                        <h2>
                          Diet Plan : <span class="fw-300"><i> <?php echo  $customer_diet_plan['data']['PlanName'] ?> </i></span>
                        </h2>

                        <h2>
                          Date :  <?php echo  $record_date ?>
                        </h2>

                        <h2>
                          Day Name :  <?php echo  $day_name ?>
                        </h2>


                    </div>
                    <div id="panel-9" class="panel">
                      <div class="panel-container show">
                          <div class="panel-content">
                              <!-- <div class="panel-tag">
                                  Display of some example optional "stuff" you can add to <code>.card-header</code>
                              </div> -->

                              <?php
                                 $total_calories = 0;
                                 $total_proteins = 0;
                                 $total_carbs = 0;
                                 $total_fats = 0;
                                 $total_fibers = 0;

                                 foreach($customer_diet_plan['data']['DietPlanList'] as $plan) {

                                   foreach($plan['MealItems'] as $meal) {

                                     $total_calories += $meal['Calories'];
                                     $total_proteins += $meal['ProtiensInGms'];
                                     $total_carbs += $meal['CarbsInGms'];
                                     $total_fats += $meal['FatsInGms'];
                                     $total_fibers += $meal['FibersInGms'];

                                   }

                                 }

                              ?>


                              <div class="col-md-12 calories">
                                  <div class="row m-0">
                                      <div class="col-md-12" style="margin-bottom:15px;">
                                          <p class="one"><img src="img/quick_action/calories.png" alt=""> <b>Calories</b></p>
                                          <p class="two"><strong><?php echo $total_calories ?> kcal</strong></p>
                                      </div><hr style="width:100%;border:3px solid grey;margin-bottom:20px">
                                      <div class="col-md-3 categories text-center">
                                          <span> <img src="img/quick_action/protein.png" alt="" style="margin-bottom:10px;"><br> Proteins</span>
                                          <p class="first" style="margin-top:10px;font-weight:bold;"><?php echo $total_proteins ?> gm</p>
                                      </div>
                                      <div class="col-md-3 categories text-center">
                                          <span> <img src="img/quick_action/carbs.png" alt=""style="margin-bottom:10px;"><br> Carbs </span>
                                          <p class="second" style="margin-top:10px;font-weight:bold;"><?php echo $total_carbs ?> gm</p>
                                      </div>
                                      <div class="col-md-3 categories text-center">
                                          <span> <img src="img/quick_action/fats.png" alt="" style="margin-bottom:10px;"><br> Fats </span>
                                          <p class="third" style="margin-top:10px;font-weight:bold;"><?php echo $total_fats ?> gm</p>
                                      </div>
                                      <div class="col-md-3 categories text-center">
                                          <span> <img src="img/quick_action/fiber.png" alt="" style="margin-bottom:10px;"><br> Fibers</span>
                                          <p class="fourth" style="margin-top:10px;font-weight:bold;"><?php echo $total_fibers ?> gm</p>
                                      </div>
                                  </div>
                              </div>

                              <div class="row">

                              <?php
                              foreach($customer_diet_plan['data']['DietPlanList'] as $plan) { ?>
                              <div class="col-md-12">
                                <div class="card border mb-g">
                                    <div class="card-header bg-danger-700 pr-3 d-flex align-items-center flex-wrap">
                                        <div class="card-title"> <?php echo $plan['MealName'] ?> &nbsp; <?php echo $plan['MealTime'] ?> </div>
                                        <a href="customer_workout_exercise.php?CustomerUserId=<?php echo $cust_user_id ?>&CustomerWorkoutDay=<?php echo $plan['DayOfWeekValue'] ?>" class="btn btn-dark btn-info ml-auto">
                                            <i class="ni ni-chevron-right"></i>
                                        </a>

                                    </div>
                                    <div class="card-body">
                                      <?php
                                      foreach($plan['MealItems'] as $meal) { ?>
                                        <a data-toggle="modal" style="float:right;margin-top:15px;" class="pull-right  btn btn-xs" id="modal-<?php echo $meal['ItemId'] ?>" data-target=".bs-add-diet-item-modal-lg-<?php echo $meal['ItemId'] ?>">
                                                          <i class="fal fa-check-circle" style="font-size:20px;float:right;"></i>  </a>
                                        <p class="card-text"> <b> <?php echo $meal['ItemName'] ?> </b> </p>
                                        <p class="card-text"> <b> Quantity : <?php echo $meal['Quantity'].' '.$meal['QuantityUnits'] ?> </b> </p><hr>

                                        <!-- calculation  -->
                                        <!-- add item modal start -->

                                        <div class="modal fade bs-add-diet-item-modal-lg-<?php echo $meal['ItemId'] ?>" id="myModal-<?php echo $meal['ItemId'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                   <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">

                                       <h5 class="modal-title" id="exampleModalLabel">
                                         <?php if($meal['IsVeg'] == '1'){ ?>
                                             <i class="fal fa-circle" style="color:green" style="margin-right:10px;"></i>
                                           <?php } else{ ?>
                                             <i class="fal fa-circle" style="color:red" style="margin-right:10px;"></i>
                                           <?php } ?>
                                           <?php echo $meal['ItemName'] ?><br>
                                        <div class="sub-info" style="margin:15px;">
                                          <?php if($meal['DietCategoryName']){ ?>
                                            <small> <b>Category : </b> <?php echo $meal['DietCategoryName'] ?> </small><br>
                                          <?php } ?>
                                          <small> <b> Calories : </b> <?php echo $meal['Calories'] ?> kcal </small>
                                        </div>
                                       </h5>
                                    </div>
                                       <div class="modal-body">
                                           <div class="main">
                                               <div class="row">
                                                  <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="input-field">
                                                        <input type="text" id="id_meal_item-{{meal.ItemId}}" name="meal_item_{{meal.ItemId}}" placeholder="quantity" onkeyup="check_nutri_quantity_{{meal.ItemId}}(this.value,this.id)" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                  </div>

                                                   <div class="col-md-6 col-sm-6 col-xs-6" style="margin-bottom:20px;">
                                                      <select  name="item_food_unit_{{meal.ItemId}}" class="form-control col-md-6 col-xs-12" id="id_item_food_unit-{{meal.ItemId}}" onchange="check_nutri_unit_{{meal.ItemId}}(this.value,this.id)">
                                                         <? if($meal['Variants']){ ?>
                                                            <?php foreach($meal['Variants'] as $varient){ ?>

                                                            <?php if($meal['QuantityInGms']) { ?>
                                                              <?php if($varient['QuantityUnits'] != 'gm'){ ?>
                                                                <option value="<?php echo $varient['ItemId'] ?>"> <?php echo $varient['QuantityUnits'] ?> </option>
                                                                <option value="gm"> gm </option>
                                                              <?php } else { ?>
                                                                <option value="<?php echo $varient['ItemId'] ?>">  <?php echo $varient['QuantityUnits'] ?> </option>
                                                              <?php } ?>
                                                            <?php } ?>


                                                            <? if($meal['QuantityInMl']) { ?>
                                                              <?php if($varient['QuantityInMl'] != 'ml'){ ?>
                                                                <option value="<?php echo $varient['ItemId'] ?>"> <?php echo $varient['QuantityUnits'] ?> </option>
                                                                <option value="ml"> ml </option>
                                                              <?php } else{ ?>
                                                                <option value="<?php echo $varient['ItemId'] ?>"> <?php echo $varient['QuantityUnits'] ?> </option>
                                                              <?php } ?>
                                                            <?php } ?>

                                                          <?php } ?>
                                                        <?php } ?>

                                                       </select>
                                                   </div>

                                                   <div class="col-md-offset-1 col-sm-offset-1 col-md-10 col-sm-10 bg-danger text-white text-center" id="show-error-box-{{meal.ItemId}}" style="background:#DC3545;margin:20px 50px;padding:10px;box-sizing:border-box;display:none;"></div>

                                               </div>
                                               <hr>
                                               <div class="row">
                                                <h5> Nutritional Information </h5>
                                                <div class="nutri_content" style="margin-left:15px;">
                                                  Proteins :<span id="proteins_val_{{meal.ItemId}}"></span><br>
                                                  Carbs : <span id="carbs_val_{{meal.ItemId}}"></span><br>
                                                  Fats :   <span id="fats_val_{{meal.ItemId}}"></span><br>
                                                  Fibers : <span id="fibers_val_{{meal.ItemId}}"></span><br>
                                                  Calories : <span id="calories_val_{{meal.ItemId}}"></span><br>
                                                </div>
                                               </div>

                                           </div>
                                       </div>
                                       <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-dark" name="meal_item_modal_form_{{meal.ItemId}}" id="id_meal_item_modal_form-{{meal.ItemId}}" onclick="modal_submit_form(this.id)">Save</button>
                                       </div>
                                   </div>
                                   </div>
                                 </div>
                                        <!-- add item modal End -->
                                      <?php } ?>
                                    </div>
                                </div>
                              </div>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>


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
    </body>
</html>
