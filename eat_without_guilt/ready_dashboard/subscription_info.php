<?php
include('config.php');
// session_start();

// echo $api_endpoint; // 'localhost'
?>

<?php
  $cust_payload = $_SESSION["cust_payload"];
  $cust_user_id = $_SESSION["cust_user_id"];
  // echo "cust_payload" . $cust_payload;
  // echo "cust_payload" . $cust_user_id;
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

    ?>


<?php

    $curl = curl_init();
    // $username = urlencode(‘user-name’);
    // $password = urlencode(‘password’);

    curl_setopt_array($curl, array(
      CURLOPT_URL => $api_endpoint."api/v1/customer-subscriptions/",
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
    $subscription_info =  json_decode($response, true);
    // echo " membership_plan : " . $membership_plan;
    ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
          My Subscriptions - <?php echo $title_domain ?>
        </title>
        <meta name="description" content="Cards">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/app.bundle.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
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
                        <!-- <ol class="breadcrumb page-breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
                            <li class="breadcrumb-item">UI Components</li>
                            <li class="breadcrumb-item active">Cards</li>
                            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                        </ol> -->
                        <!-- <div class="subheader">
                            <h1 class="subheader-title">
                                <i class='subheader-icon fal fa-window'></i> Cards
                                <small>
                                    Cards provide a flexible and extensible content container with multiple variants and options.
                                </small>
                            </h1>
                        </div>
                        <div class="alert alert-primary alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">
                                    <i class="fal fa-times"></i>
                                </span>
                            </button>
                            <div class="d-flex flex-start w-100">
                                <div class="mr-2 d-sm-none d-md-block">
                                    <span class="icon-stack icon-stack-lg">
                                        <i class="base base-6 icon-stack-3x opacity-100 color-primary-500"></i>
                                        <i class="base base-10 icon-stack-2x opacity-100 color-primary-300 fa-flip-vertical"></i>
                                        <i class="fal fa-info icon-stack-1x opacity-100 color-white"></i>
                                    </span>
                                </div>
                                <div class="d-flex flex-fill">
                                    <div class="flex-fill">
                                        <span class="h5">About</span>
                                        <p>Cards are built with as little markup and styles as possible, but still manage to deliver a ton of control and customization. Built with flexbox, they offer easy alignment and mix well with other Bootstrap components. They have no <code>margin</code> by default, so use spacing utilities as needed. Although cards are a lightweight solution for 'widget' or 'panel', we recommend you check out SmartAdmin's <a href="ui_panels.html" title="Components Panels" target="_blank">panels page</a> for further flexible and an alternative option.</p>
                                        <p class="mb-0">While we displayed some examples of cards here, you can learn more details of its usage at the official <a href="https://getbootstrap.com/docs/4.3/components/card/" target="_blank">bootstrap documentation</a>.</p>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="row">
                          <?php
        //  foreach($subscription_info['data']['CustomerSubscriptions'] as $subscription_obj){  ?>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="card border m-lg-30" style="margin-bottom:30px">
                                  <img src="img/plan_bg.jpeg" class="card-img-top" alt="...">
                                  <div class="card-body">
                                      <h5 class="card-title"> <b> <?php echo $subscription_obj['MembershipPlanName']; ?> </b> </h5>
                                      <p class="card-text"> Duration : <?php echo $subscription_obj['PlanPeriodUnits']; ?> <?php echo $subscription_obj['PlanPeriodLength']; ?> </p>
                                      <a href="order_summary.php?UserId=<?php echo $cust_user_id ?>&MembershipId=<?php echo $subscription_obj['MembershipPlanId']; ?>" class="btn btn-primary text-center"> Renew Now </a>
                                  </div>
                                  <ul class="list-group list-group-flush">
                                      <li class="list-group-item"> Status : <?php echo $subscription_obj['Status']; ?> </li>
                                      <li class="list-group-item"> Total Price : <?php echo $subscription_obj['TotalPrice']; ?> </li>
                                      <li class="list-group-item"> Start Date : <?php echo $subscription_obj['StartDate']; ?> </li>
                                      <li class="list-group-item"> End Date : <?php echo $subscription_obj['EndDate']; ?> </li>
                                  </ul>
                              </div>
                            </div>
                        <?php // }?>
                        </div> -->


                        <div class="row">

          <div class="table-responsive">
          <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Customer Name</th>
                          <th>Plan Name</th>
                          <th> Duration </th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Total Bill Amount</th>
                          <th> Status </th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
        foreach($subscription_info['data']['CustomerSubscriptions'] as $subscription_obj){  ?>
                        <tr>
                          <td style="vertical-align: middle;width:12%;" ><a><?php echo $cust_first_name.' '.$cust_last_name ?></a><br/>
                            <br/><span><?php echo $cust_email  ?></span> <br/><br/>
                            <span> <?php echo $cust_phone ?> </span><br/>
                          </td>
                          <td style="vertical-align: middle;width:15%;" > <?php echo $subscription_obj['MembershipPlanName']; ?> </td>
                          <td style="vertical-align: middle;width:8%;" > <?php echo $subscription_obj['PlanPeriodUnits']; ?> <?php echo $subscription_obj['PlanPeriodLength']; ?> </td>
                          <td style="vertical-align: middle;width:8%;" > <?php echo $subscription_obj['StartDate']; ?>  </td>
                          <td style="vertical-align: middle;width:8%;" class="red" > <?php echo $subscription_obj['EndDate']; ?> </td>
                          <td style="vertical-align: middle;width:8%;" class="red" > <?php echo $subscription_obj['TotalPrice']; ?> </td>
                          <td style="vertical-align: middle;width:8%;" class="red" > <?php if($subscription_obj['Status']=='AC'){ ?>  Active <?php } elseif($subscription_obj['Status']=='PD'){ ?>  Pending
                          <?php } elseif($subscription_obj['Status']=='EX'){ ?> Expired <?php } elseif($subscription_obj['Status']=='CN'){ ?> Cancelled <?php } elseif($subscription_obj['Status']=='US'){ ?> Used <?php }  ?>
                           </td>
                          <?php if($subscription_obj['Status'] == 'AC' or $subscription_obj['Status'] == 'CN' or $subscription_obj['Status'] == 'EX') { ?>
                          <td> <a href="order_summary.php?UserId=<?php echo $cust_user_id ?>&MembershipId=<?php echo $subscription_obj['MembershipPlanId']; ?>" class="btn btn-primary text-center"> Renew Now </a> </td>
                        <?php } else{?> <td> N/A </td> <?php } ?>
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                    </div>
                    </div>

                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
                    <footer class="page-footer" role="contentinfo">
                        <div class="d-flex align-items-center flex-1 text-muted">
                            2020 © Childyogis . All Rights Reserved
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
        <script>
            /* infinite nav pills */
            $('#js-nav-pills-menu').menuSlider(
            {
                element: $('#js-nav-pills-menu'),
                wrapperId: 'test-nav'
            });


            var ng_bgColors,
                ng_bgColors_URL = "media/data/ng-bg-colors.json",
                formatBgColors = [];

            $.when(
                $.getJSON(ng_bgColors_URL, function(data)
                {
                    ng_bgColors = data;
                })
            ).then(function()
            {
                if (ng_bgColors)
                {

                    formatBgColors.push($('<option></option>').attr("value", null).text("select background"));

                    //formatTextColors
                    jQuery.each(ng_bgColors, function(index, item)
                    {
                        formatBgColors.push($('<option></option>').attr("value", item).addClass(item).text(item))
                    });

                    $("select.js-bg-color").empty().append(formatBgColors);

                }
                else
                {
                    console.log("somethign went wrong!")
                }
            });

            /* change background */
            $(document).on('change', '.js-bg-color', function()
            {
                var setBgColor = $('select.js-bg-color').val();
                var setValue = $('select.js-bg-target').val();

                $('select.js-bg-color').removeClassPrefix('bg-').addClass(setBgColor);
                $(setValue).removeClassPrefix('bg-').addClass(setBgColor);
            })

            /* change border */
            $(document).on('change', '.js-border-color', function()
            {
                var setBorderColor = $('select.js-border-color').val();
                $("#cp-2").removeClassPrefix('border-').addClass(setBorderColor);
                $('select.js-border-color').removeClassPrefix('border-').addClass(setBorderColor);
            })

            /* change target */
            $(document).on('change', '.js-bg-target', function()
            {
                //reset color selection
                $('select.js-bg-color').prop('selectedIndex', 0).removeClassPrefix('bg-');
            })

        </script>
    </body>
</html>
