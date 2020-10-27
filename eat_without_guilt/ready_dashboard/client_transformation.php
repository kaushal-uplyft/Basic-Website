<?php
// session_start();
include('config.php');
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
      CURLOPT_URL => $api_endpoint."api/v1/fitness-center-clients/",
      // CURLOPT_SSL_VERIFYPEER => true,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
//       CURLOPT_POSTFIELDS => "CustomerUserId=$cust_user_id&TestimonialType:TRAN",
       CURLOPT_POSTFIELDS => "TestimonialType=TRAN&CustomerUserId=$cust_user_id",

      CURLOPT_HTTPHEADER => array(
        'content-type: application/x-www-form-urlencoded',
        'Authorization:'.$auth_key,
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $client_list =  json_decode($response, true);
    // echo " membership_plan : " . $membership_plan;
    ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Client Transformation - <?php echo $title_domain ?>
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

<!--        internal stylesheet-->
        <style>
            .team-box {
                  box-shadow: 0 0 30px -5px rgb(0 0 0 / 25%);
                  padding: 16px;
                  padding-bottom: 25px;
/*                padding-top: 10px;*/
            }
            .team-box img {
                float: right;
/*                margin-right: 20px;*/
                border-radius: 50%;
                width: 60px;
                height: 60px;
            }
        </style>


        <!-- BEGIN Page Wrapper -->
        <?php include 'navbar.php';?>
                    <main id="js-page-content" role="main" class="page-content">
                        <h2>
                          Client Transformations
                        </h2>

<!--------------------------------------------------->
<!--                      <img src="<?php //echo $fitness_center_info['data']['FitnessCenterCover'] ?>" class="card-img-top" alt="...">-->

                        <div class="row">
                          <?php foreach($client_list['data']['ClientTestimonial'] as $clienttrans_obj){  ?>
                            <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom:40px;">
<!--                            <div class="col-md-3 col-sm-6 col-xs-12" style="margin-bottom:40px;">-->
                                <div class="inner-box">
<!--                            <figure class="image-box"><img src="images/phy/2.jpg" alt="Gym management Software"></figure>-->
                                    <?php if($clienttrans_obj['Image']){ ?>
                                     <img src="<?php echo $clienttrans_obj['Image'] ?>" style="height:200px;width:100%;"  class="card-img-top" alt="Transformation">
                                   <?php } ?>
                                    <div class="team-box">
<!--                                <img src="image/team-2.jpg" alt="team-photo" class="team-image">-->
                                        <img src="<?php echo $clienttrans_obj['TrainerImage']?>" alt="team-photo" >
                                        <p><?php echo $clienttrans_obj['SubTitle']; ?></p>
                                        <b class="position"> <?php echo $clienttrans_obj['Title']; ?></b>
                                    </div>
                                  </div>
                            </div>
                          <?php  }?>

                        </div>
<!------------------------------------------------------------->

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




    </body>
