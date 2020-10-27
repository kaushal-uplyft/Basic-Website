<?php

include('config.php');
// session_start();
?>

<?php

  $CustomerUserId = $_GET['UserId'];
  $MembershipPlanId = $_GET['MembershipId'];

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
      CURLOPT_URL => $api_endpoint."api/v1/subscription-order-summary/",
      // CURLOPT_SSL_VERIFYPEER => true,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "CustomerUserId=$CustomerUserId&MembershipPlanId=$MembershipPlanId",
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
            Order Summary - <?php echo $title_domain ?>
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
        <link rel="stylesheet" media="screen, print" href="css/order_summary.css">
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
                        </ol>
                        <div class="subheader">
                            <h1 class="subheader-title">
                                <i class='subheader-icon fal fa-window'></i> Cards
                                <small>
                                    Cards provide a flexible and extensible content container with multiple variants and options.
                                </small>
                            </h1>
                        </div> -->
                        <!-- <div class="alert alert-primary alert-dismissible">
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
                        <!--  ###########  Custom Code  ###########  -->

                        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2> Order Summary <small> <?php echo $subscription_info['data']['PlanName']; ?> </small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
					<form action="order_summary.php?UserId=<?php echo $CustomerUserId; ?>&MembershipId=<?php echo $MembershipPlanId; ?>" method="post" id="price_summary" class="form-horizontal form-label-left">
					<!-- <form action="order_summary.php" method="post" id="price_summary" class="form-horizontal form-label-left"> -->
                    <section class="content invoice">


                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table table-responsive">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Duration</th>
																<th> Plan Name </th>
                                <!-- <th> Category </th> -->
                                <!-- <th style="width: 59%">Description</th> -->
                                <th>Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td> <?php echo $subscription_info['data']['PlanPeriodUnits']; ?> <?php echo $subscription_info['data']['PlanPeriodLength']; ?> </td>
                                <td> <?php echo $subscription_info['data']['PlanName']; ?> </td>
                                <!-- <td> <?php echo $subscription_info['data']['Category']; ?> </td> -->
                                <!-- <td>  *Note : Convenience Fee : ₹ 24 will be charged extra</td> -->
                                <td><i class="fa fa-inr"></i> <?php echo $subscription_info['data']['NewBillPrice']; ?> </td>
																<td> <input type="hidden" name="sms_credit_plan" value="{{ selected_sms_plan.sms_plan_type }}"> </td>
																<td> <input type="hidden" name="credited_sms" value="{{ selected_sms_plan.sms_get_credited }}"> </td>
																<td> <input type="hidden" name="fitness_center" value="{{ selected_sms_plan.fitness_center }}"> </td>
																<td> <input type="hidden" name="purchased_plan_price" value="{{ selected_sms_plan.sms_plan_price }}"> </td>
                              </tr>

                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-md-6 col-sm-12">
                          <p class="lead">Payment Methods:</p>
                          <!-- <img src="img/payment/mastercard.png" alt="Visa">
                          <img src="img/payment/visa.png" alt="Mastercard"> -->
                          <p><b> All payment methods are accepted. </b></p>
                          <!-- <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                          </p> -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6 col-sm-12">
                          <p class="lead">Amount</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <!-- <tr>
                                  <th style="width:50%">Subtotal:</th>
                                  <td><i class="fa fa-inr"></i> <?php echo $subscription_info['data']['NewBillPrice']; ?> </td>
                                </tr> -->
                                <tr>
                                  <th style="width:50%">Tax:</th>
                                  <td>*Inclusive of all taxes. </td>
                                </tr>
                                <tr>
                                  <th>Total:</th>
                                  <td><i class="fa fa-inr"></i> <?php echo $subscription_info['data']['NewBillPrice']; ?> </td>
                                </tr>
                                <!-- <tr>
                                  <th>Note:</th>
                                  <td>
                                  Fees : ₹ 1000.00 + ₹ 24.00 <br/>
                                  *Note : Convenience Fee : ₹ 24 will be charged extra <br> <b> TOTAL : ₹ 1024.00 </b> </td>
                                </tr> -->
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <!-- razor pay hidden buttons -->
            						  <input type="hidden" name="action_type" id="action_type"/>
            						  <input type="hidden" name="pay_id" id="pay_id"/>
                          <!-- razor pay hidden buttons -->
                          <button class="btn btn-success pull-right" id="payment_proceed" style="float:right;position:absolute;right:0px;"> Proceed to Payment</button>
                          <button class="btn btn-primary pull-left" style="margin-right: 5px;float:left"> Back</button>
                        </div>
                      </div>
                    </section>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

                        <!--  ###########  Custom Code  ###########  -->

                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
                    <footer class="page-footer" role="contentinfo">
                        <div class="d-flex align-items-center flex-1 text-muted">
                            2020 © <?php echo $title_domain ?> . All Rights Reserved
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

        <!-- Razor Pay Integration -->
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "<?php echo $subscription_info['data']['GatewayKey']; ?>",
    "amount": "<?php echo $subscription_info['data']['NewBillPrice'] * 100 ; ?>", // 2000 paise = INR 20
    "name": "<?php echo $title_domain ?>",
    "description": "",
    "image": "img/logo.png",
    "handler": function (response){
    	if (response.razorpay_payment_id){
    		 $('#action_type').val('proceed_to_payment');
    		 $('#pay_id').val(response.razorpay_payment_id);
    		 $( "#price_summary" ).submit();
    	}

    },
    "prefill": {
        "name": "",
        "email": "",
        "contact":""
    },
    "notes": {
        "plan_name": "<?php echo $subscription_info['data']['PlanName']; ?> - <?php echo $subscription_info['data']['NewBillPrice'] * 100 ; ?> ",
        "registered_email": "",
        "plan_id":"<?php echo $subscription_info['data']['MembershipPlanId']; ?>"
    },
    "theme": {
        "color": "#337ab7"
        }
    };
    var rzp1 = new Razorpay(options);

    document.getElementById('payment_proceed').onclick = function(e){
        rzp1.open();
        e.preventDefault();
    }

    </script>

    <?php
    if (!empty($_POST)) {
      $razarpay_info = $_POST;
      if($razarpay_info['action_type']=="proceed_to_payment"){
        $pay_id = $razarpay_info['pay_id'] ;

        $curl = curl_init();
        // $username = urlencode(‘user-name’);
        // $password = urlencode(‘password’);

        curl_setopt_array($curl, array(
          CURLOPT_URL => $api_endpoint."api/v1/add-subscription/",
          // CURLOPT_SSL_VERIFYPEER => true,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "CustomerUserId=$CustomerUserId&MembershipPlanId=$MembershipPlanId&PaymentType=OL",
          CURLOPT_HTTPHEADER => array(
            'content-type: application/x-www-form-urlencoded',
            'Authorization:'.$auth_key,
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $subscription_payment =  json_decode($response, true);
        $subscription_status = $subscription_payment['status_code'];
        $subscription_id = $subscription_payment['data']['SubscriptionId'];
        $transaction_id = $subscription_payment['data']['TransactionNo'];
        $install_txn_id = $subscription_payment['data']['InstallmentTranxId'];
        $plan_start_date = $subscription_payment['data']['StartDate'];
        $plan_end_date = $subscription_payment['data']['EndDate'];
        $plan_name = $subscription_payment['data']['MembershipName'];
        $customer_mail = $subscription_payment['data']['CustomerMail'];
        // var_dump($CustomerUserId);
        // var_dump($subscription_id);
        // var_dump($pay_id);
        // var_dump($transaction_id);


        // var_dump($subscription_payment);

        if($subscription_status == '200'){
          // var_dump('***** Second API ******');
          $curl_payment = curl_init();
          curl_setopt_array($curl_payment, array(
            CURLOPT_URL => $api_endpoint."api/v1/make-payment/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "CustomerUserId=$CustomerUserId&SubscriptionId=$subscription_id&TransactionNo=$transaction_id&RazorPayPaymentId=$pay_id&PaymentStatus=PI&InstallmentTranxId=$install_txn_id",
            CURLOPT_HTTPHEADER => array(
              'content-type: application/x-www-form-urlencoded',
              'Authorization:'.$auth_key,
            ),
          ));
          $response = curl_exec($curl_payment);
          $err = curl_error($curl_payment);
          curl_close($curl_payment);
          $make_payment =  json_decode($response, true);
          $payment_status = $make_payment['status_code'];
          // var_dump("***** Second API Response ****");
          // var_dump($response);
          if($payment_status == '200'){

          //   $txt = $plan_start_date;
          //   $res_start_date = (explode(" ",$txt));
          //
          //   $to = $customer_mail;
          //   $from = 'meha@childyfdfcsogis.com';
          //   $fromName = 'Child Yogis';
          //
          //   $subject = "Your Subscription Detail";
          //
          //   $htmlContent = '
          //   <html>
          //   <head>
          //       <title>Welcome to Child Yogis</title>
          //   </head>
          //   <body>
          //     <center>
          //       <img src="https://www.childyogis.com/dashboard/img/logo.png" height="150" width="150">
          //       <h4 style="margin-top:-10px;">Dear Customer, <br> Your Child Yogis Subscription has been activated and bought successfully.</h4>
          //       <table border = "1" cellpadding = "5" cellspacing = "5">
          //           <tr style="background-color: #e0e0e0;">
          //               <th>Start Date : </th><td>'. $res_start_date[0] .'</td>
          //           </tr>
          //           <tr>
          //               <th>End Date : </th><td>'. $plan_end_date .'</a></td>
          //           </tr>
          //       </table>
          //     </center>
          //   </body>
          // </html>';
          //
          //   $headers = "MIME-Version: 1.0" . "\r\n";
          //   $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          //
          //   $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n";
          //
          //   if(mail($to, $subject, $htmlContent, $headers)){
          //       echo 'Email has sent successfully.';
          //   }else{
          //      echo 'Email sending failed.';
          //   }


            echo "<script type='text/javascript'> document.location = 'thank_you.php'; </script>";
          }
        }

      }
    }
    ?>

    </body>
</html>
