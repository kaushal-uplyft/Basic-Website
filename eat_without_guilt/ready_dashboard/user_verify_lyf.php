
<!DOCTYPE html>
<?php
include('config.php');
// echo $api_endpoint; // 'localhost'
?>

<?php
  // $cust_payload = $_SESSION["cust_payload"];
  // $cust_user_id = $_SESSION["cust_user_id"];
  // echo "cust_payload" . $cust_payload;
  // echo "cust_payload" . $cust_user_id;
  // if($cust_payload and $cust_user_id){
  //
  // }
  // else{
  //   // echo "<script type='text/javascript'> document.location = 'user_verify.php'; </script>";
  // }
?>

<!--
Template Name:  SmartAdmin Responsive WebApp - Template build with Twitter Bootstrap 4
Version: 4.0.0
Author: Sunnyat Ahmmed
Website: http://gootbootstrap.com
Purchase: https://wrapbootstrap.com/theme/smartadmin-responsive-webapp-WB0573SK0
License: You must have a valid license purchased only from wrapbootstrap.com (link above) in order to legally use this theme for your project.
-->

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Sign In - <?php echo $title_domain ?>
        </title>
        <meta name="description" content="Login">
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
        <!-- Optional: page related CSS-->
        <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
        <style>
          .waves-themed{
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

          .login_container_box {
            background: transparent;
            box-shadow: 3px 3px 3px 3px #000;
          }

          .form-control{
            border: 3px solid #000;
          }

          .rc-anchor-light{
                border: 2px solid #000 !important;
            }

          .otp_btn{
                box-shadow: 2px 2px 2px 2px #000;
          }
        </style>
    </head>
    <body>
        <div class="page-wrapper">
            <div class="page-inner bg-brand-gradient">
                <div class="page-content-wrapper bg-transparent m-0">
                    <!-- <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">
                        <div class="d-flex align-items-center container p-0">
                            <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9">
                                <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                                    <img src="img/logo.png" alt="Child Yogi" aria-roledescription="logo" style="height:70px;width:70px;">
                                    <span class="page-logo-text mr-1">SmartAdmin WebApp</span>
                                </a>
                            </div>
                            <a href="page_register.html" class="btn-link text-white ml-auto">
                                Create Account
                            </a>
                        </div>
                    </div> -->
                    <div class="w-100 shadow-lg  register-nav">
                        <div class="d-flex align-items-center container register-nav-content">
                            <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9">
                                <a href="<?php echo $website_link ?>" class="page-logo-link press-scale-down d-flex align-items-center">
                                    <!-- <img src="img/logo.png" alt="Child Yogi" aria-roledescription="logo" style="height:auto;width:170px;"> -->
                                    <img src="img/logo.png" alt="Child Yogi" aria-roledescription="logo">
                                    <span class="page-logo-text mr-1 color-white"> <?php  $title_domain ?> </span>
                                </a>
                            </div>
                            <!-- <span class="color-white opacity-50 ml-auto mr-2 hidden-sm-down">
                                Already a member?
                            </span> -->
                            <a href="page_register.php" class="btn-link text-white ml-auto">
                                Create Account
                            </a>
                        </div>
                    </div>
                    <div class="flex-1" style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
                        <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                            <div class="col-md-12">
                              <div class="row">
                              <!-- <center> -->
                                <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 ml-auto" style="margin-right:auto !important">
                                    <h1 class="text-white fw-300 mb-3 d-sm-block d-md-none">
                                        Secure login
                                    </h1>
                                    <div class="card p-4 rounded-plus bg-faded login_container_box">
                                        <form id="js-login" novalidate="" action="user_login.php">
                                            <div class="form-group row">
                                                <label class="col-xl-12 form-label" for="username"> <b> Username </b> </label>
                                                <div class="col-4">
                                                  <input type="text" id="isd_code" class="form-control form-control-lg" placeholder="+91" value="+91" name="isd_code" required>
                                                  <div class="invalid-feedback">No, you missed this one.</div>
                                                </div>

                                                <div class="col-8">
                                                <input type="text" id="username" class="form-control form-control-lg" placeholder="943053XXXX" value="" name="login_number" required maxlength="10">
                                                <div class="invalid-feedback">No, you missed this one.</div>
                                              </div>
                                                <!-- <div class="help-block">Your unique username to app</div> -->
                                            </div>
                                            <!--  Delete LAter -->
                                            <div class="container-code">
                                              <div id="recaptcha-container"></div><br>
                                              <button type="button" onclick="phoneAuth();" class="form-control otp_btn">Send OTP</button><br>
                                            </div>
                                            <div class="container_verify">
                                            <input type="text" id="verificationCode" placeholder="Enter verification code" class="form-control"><br>
                                            <button type="button" onclick="codeverify();" class="form-control otp_btn">Verify OTP</button>
                                          </div>
                                            <!--  Delete LAter -->
                                            <!-- <div class="form-group">
                                                <label class="form-label" for="password">Password</label>
                                                <input type="password" id="password" class="form-control form-control-lg" placeholder="password" value="" name="login_password" required>
                                                <div class="invalid-feedback">Sorry, you missed this one.</div>
                                                <div class="help-block">Your password</div>
                                            </div> -->

                                            <!-- <div class="form-group text-left">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="rememberme">
                                                    <label class="custom-control-label" for="rememberme"> Remember me for the next 30 days</label>
                                                </div>
                                            </div> -->


                                            <!-- <div class="row no-gutters">
                                                <div class="col-lg-12 pl-lg-1 my-2">
                                                    <button id="js-login-btn" type="submit" name="submit_login" class="btn btn-danger btn-block btn-lg">Login</button>
                                                </div>
                                            </div> -->
                                        </form>
                                    </div>
                                </div>
                              <!-- </center> -->
                             </div>
                            </div>
                            <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
                                2020 © health 'n' wellness . All Rights Reserved
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            $("#js-login-btn").click(function(event)
            {

                // Fetch form to apply+ custom Bootstrap validation
                var form = $("#js-login")

                if (form[0].checkValidity() === false)
                {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.addClass('was-validated');
                // Perform ajax submit here...
            });

        </script>

        <!-- Firebase code -->
              <!-- The core Firebase JS SDK is always required and must be listed first -->
                <!-- <script src="https://www.gstatic.com/firebasejs/7.16.0/firebase-app.js"></script> -->
                <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

                <!-- TODO: Add SDKs for Firebase products that you want to use
                   https://firebase.google.com/docs/web/setup#available-libraries -->
                <!-- <script src="https://www.gstatic.com/firebasejs/7.16.0/firebase-analytics.js"></script> -->

                <script>
                // Your web app's Firebase configuration
                var firebaseConfig = {
                  apiKey: "AIzaSyBswMTLtEySWBAgAzvjR7ig-HPGELyb23Q",
                  authDomain: "fir-383bd.firebaseapp.com",
                  databaseURL: "https://fir-383bd.firebaseio.com",
                  projectId: "fir-383bd",
                  storageBucket: "fir-383bd.appspot.com",
                  messagingSenderId: "322738856360",
                  appId: "1:322738856360:web:5fb789af7251d8e64f7d9d",
                  measurementId: "G-R5GV3FVM4J"
                };
                // Initialize Firebase
                firebase.initializeApp(firebaseConfig);
                // firebase.analytics();
                </script>
            <!-- <script src="js/NumberAuthentication.js" type="text/javascript"></script> -->

            <script>
            $('.container_verify').hide();
            window.onload=function () {
              render();
            };
            function render() {
                window.recaptchaVerifier=new firebase.auth.RecaptchaVerifier('recaptcha-container');
                recaptchaVerifier.render();
            }
            function phoneAuth() {
                //get the number
                var user_isd = document.getElementById('isd_code').value;
                var user_no = document.getElementById('username').value;
                var number=user_isd+user_no;
                //phone number authentication function of firebase
                //it takes two parameter first one is number,,,second one is recaptcha
                firebase.auth().signInWithPhoneNumber(number,window.recaptchaVerifier).then(function (confirmationResult) {
                    //s is in lowercase
                    window.confirmationResult=confirmationResult;
                    coderesult=confirmationResult;
                    console.log(coderesult);
                    alert("OTP Sent");
                    $('.container-code').hide();
                    $('.container_verify').show();
                }).catch(function (error) {
                    alert(error.message);
                });
            }
            function codeverify() {
                var verify = '0';
                var code=document.getElementById('verificationCode').value;
                coderesult.confirm(code).then(function (result) {
                    var verify = '1';
                    alert(" You Have Been Successfully Verified ! ");
                    // window.location.replace("http://localhost/customer_dashboard/user_login.php");
                    var user=result.user;
                    console.log(user);

                    var postForm = { //Fetch form data
                          'verify'     : verify, //Store name fields value
                          'phone_no'     : document.getElementById('username').value, //Store name fields value
                      };

                    $.ajax({ //Process the form using $.ajax()
                            type      : 'POST', //Method type
                            url       : 'signin_process.php', //Your form processing file URL
                            data      : postForm, //Forms name
                            dataType  : 'json',
                            success   : function(data) {
                                            // alert(data['cust_payload']);
                                            // console.log(data);l
                                            // console.log(data['cust_payload']);
                                            window.location = "index.php";
                                            }
                        });
                        event.preventDefault(); //Prevent the default submit

                }).catch(function (error) {
                    alert(error.message);
                });
            }

            </script>
          <!-- Firebase code -->

        <!-- PHP CODE FOR API -->
        <?php

            $is_verify = "<script>document.writeln(verify);</script>";
            $user_number = "<script>document.writeln(number);</script>";
            if($is_verify == '1'){
                $_SESSION["user_mobile_no"] = $user_number;
                $curl = curl_init();
                $auth_header = array(
                    'content-type: application/x-www-form-urlencoded',
                    'Authorization:'.$auth_key,
                  );
                  curl_setopt_array($curl, array(
                  // CURLOPT_URL => "https://www.yourdeadlift.com/api/v1/website-customer-register/",
                  CURLOPT_URL => $api_endpoint."api/v1/customer-login/",
                  // CURLOPT_SSL_VERIFYPEER => false,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "POST",
                  // CURLOPT_POSTFIELDS => json_encode($data),
                  CURLOPT_POSTFIELDS => "CustomerMobile=$user_number",
                  CURLOPT_HTTPHEADER => $auth_header,
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                echo " Response : " . $response;

                echo "<script type='text/javascript'> document.location = 'user_login.php'; </script>";
            }
            else{
              // echo "*********************************";
              // echo '<script>alert("Thank you registering with health n wellness. Please log in to book a package. !")</script>';
            }

            // if(isset($_POST['submit_login'])) {
            // 	$mobile = $_POST['login_number'];
            // 	$password = $_POST['login_password'];
            //
            // 	echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
            // }
      ?>

    </body>
</html>
