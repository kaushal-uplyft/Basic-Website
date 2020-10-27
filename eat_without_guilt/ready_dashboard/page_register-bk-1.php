<?php
include('config.php');
// $api_endpoint = $api_endpoint;
// echo $api_endpoint; // 'localhost'
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Sign Up  - <?php echo $title_domain ?>
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
        </style>
    </head>
    <body>
        <div class="page-wrapper">
            <div class="page-inner bg-brand-gradient">
                <div class="page-content-wrapper bg-transparent m-0">
                    <div class="w-100 shadow-lg  register-nav">
                        <div class="d-flex align-items-center container register-nav-content">
                            <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9">
                                <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                                    <img src="img/logo.png" alt="Child Yogi" aria-roledescription="logo" style="height:70px;width:70px;">
                                    <span class="page-logo-text mr-1 color-white"> Child Yogis </span>
                                </a>
                            </div>
                            <span class="color-white opacity-50 ml-auto mr-2 hidden-sm-down">
                                Already a member?
                            </span>
                            <a href="user_verify.php" class="btn-link color-white ml-auto ml-sm-0">
                                Secure Login
                            </a>
                        </div>
                    </div>
                    <div class="flex-1" style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
                        <div class="container py-4  px-4 px-sm-0">
                            <div class="row">
                                <div class="col-xl-12">
                                    <h2 class="fs-xxl fw-500 mt-2 mb-6 text-white text-center">
                                        Register now &amp; Browse our memberships !
                                        <!-- <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60 hidden-sm-down">
                                            Your registration is free for a limited time. Enjoy SmartAdmin on your mobile, desktop or tablet.
                                            <br>It is ready to go wherever you go!
                                        </small> -->
                                    </h2>
                                </div>
                                <div class="col-xl-6 ml-auto mr-auto">
                                    <div class="card p-4 rounded-plus bg-faded">
                                        <!-- <div class="alert alert-primary text-dark" role="alert">
                                            <strong>Heads Up!</strong> Due to server maintenance from 9:30GTA to 12GTA, the verification emails could be delayed by up to 10 minutes.
                                        </div> -->

                                        <?php require_once 'register_process.php'  ?>
                                        <form id="js-login" novalidate="" action="register_process.php" method="POST">
                                            <div class="form-group row">
                                                <label class="col-xl-12 form-label" for="fname">Parent name</label>
                                                <div class="col-12 pr-1">
                                                    <input type="text" id="fname" class="form-control" placeholder="Name" name="user_name" required>
                                                    <div class="invalid-feedback">No, you missed this one.</div>
                                                </div>
                                                <!-- <div class="col-6 pl-1">
                                                    <input type="text" id="lname" class="form-control" placeholder="Last Name" required>
                                                    <div class="invalid-feedback">No, you missed this one.</div>
                                                </div> -->
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-12 form-label" for="fname">Parent Mobile</label>
                                                <div class="col-3">
                                                    <input type="text" id="lname" class="form-control" placeholder="+91" name="user_country_code" value="+91" required>
                                                    <div class="invalid-feedback">No, you missed this one.</div>
                                                </div>
                                                <div class="col-9 pr-1">
                                                    <input type="text" id="fname" class="form-control" placeholder="940359****" name="user_mobile" required maxlength="15">
                                                    <div class="invalid-feedback">No, you missed this one.</div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="emailverify">Parent Email </label>
                                                <input type="email" id="emailverify" class="form-control" placeholder="user@gmail.com" name="user_mail" required>
                                                <div class="invalid-feedback">No, you missed this one.</div>
                                                <!-- <div class="help-block">Your email will also be your username</div> -->
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-12 form-label" for="fname"> Reference Code </label>
                                                <div class="col-12 pr-1">
                                                    <input type="text" id="fname" class="form-control" placeholder="" name="ref_code">
                                                    <div class="invalid-feedback">No, you missed this one.</div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-12 form-label" for="fname">Child name</label>
                                                <div class="col-12 pr-1">
                                                    <input type="text" id="fname" class="form-control" placeholder="Name" name="child_name_1" required>
                                                    <div class="invalid-feedback">No, you missed this one.</div>
                                                </div>
                                                <!-- <div class="col-6 pl-1">
                                                    <input type="text" id="lname" class="form-control" placeholder="Last Name" required>
                                                    <div class="invalid-feedback">No, you missed this one.</div>
                                                </div> -->
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-12 form-label" for="fname"> Location </label>
                                                <div class="col-12 pr-1">
                                                    <input type="text" id="fname" class="form-control" placeholder="Location : eg. Mumbai or Bangalore or Delhi" name="child_location_1" required>
                                                    <div class="invalid-feedback">No, you missed this one.</div>
                                                </div>
                                                <!-- <div class="col-6 pl-1">
                                                    <input type="text" id="lname" class="form-control" placeholder="Last Name" required>
                                                    <div class="invalid-feedback">No, you missed this one.</div>
                                                </div> -->
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="emailverify"> Child DOB </label>
                                                <input type="date" id="birthday" name="child_dob_1"  class="form-control">
                                                <div class="invalid-feedback">No, you missed this one.</div>
                                                <!-- <div class="help-block">Your email will also be your username</div> -->
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="emailverify"> Child Gender </label><br>
                                                <!-- <input type="date" id="birthday" name="birthday"  class="form-control"> -->
                                                <input type="radio" id="age2" name="child_gender_1" value="male">
                                                <label for="age2" class="form-label"> Male </label>
                                                <input type="radio" id="age3" name="child_gender_1" value="female" style="margin-left:40px;">
                                                <label for="age3" class="form-label"> Female </label>
                                                <div class="invalid-feedback">No, you missed this one.</div>
                                                <!-- <div class="help-block">Your email will also be your username</div> -->
                                            </div>

                                            <div class="form-group">
                                              <button class="toggle btn btn-primary pull-right second-child-btn" type="button" style="float:left;"> Add Second Child </buttton>
                                            </div><br><br><br>

                                          <div class="second-child-container" style="margin-bottom:40px;">

                                            <div class="form-group row">
                                                <label class="col-xl-12 form-label" for="fname">Child name</label>
                                                <div class="col-12 pr-1">
                                                    <input type="text" id="fname" class="form-control" placeholder="Name" name="child_name_2">
                                                    <div class="invalid-feedback">No, you missed this one.</div>
                                                </div>
                                                <!-- <div class="col-6 pl-1">
                                                    <input type="text" id="lname" class="form-control" placeholder="Last Name" required>
                                                    <div class="invalid-feedback">No, you missed this one.</div>
                                                </div> -->
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-12 form-label" for="fname"> Location </label>
                                                <div class="col-12 pr-1">
                                                    <input type="text" id="fname" class="form-control" placeholder="Location : eg. Mumbai or Bangalore or Delhi" name="child_location_2">
                                                    <div class="invalid-feedback">No, you missed this one.</div>
                                                </div>
                                                <!-- <div class="col-6 pl-1">
                                                    <input type="text" id="lname" class="form-control" placeholder="Last Name" required>
                                                    <div class="invalid-feedback">No, you missed this one.</div>
                                                </div> -->
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="emailverify"> Child DOB </label>
                                                <input type="date" id="birthday" name="child_dob_2"  class="form-control">
                                                <div class="invalid-feedback">No, you missed this one.</div>
                                                <!-- <div class="help-block">Your email will also be your username</div> -->
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="emailverify"> Child Gender </label><br>
                                                <!-- <input type="date" id="birthday" name="birthday"  class="form-control"> -->
                                                <input type="radio" id="age2" name="child_gender_2" value="male">
                                                <label for="age2" class="form-label"> Male </label>
                                                <input type="radio" id="age3" name="child_gender_2" value="female" style="margin-left:40px;">
                                                <label for="age3" class="form-label"> Female </label>
                                                <div class="invalid-feedback">No, you missed this one.</div>
                                                <!-- <div class="help-block">Your email will also be your username</div> -->
                                            </div>

                                          </div>
                                            <div class="form-group demo" >
                                                <div class="custom-control custom-checkbox" style="float:left;">
                                                    <input type="checkbox" class="custom-control-input" id="terms" required>
                                                    <label class="custom-control-label" for="terms"> I agree to terms & conditions</label>
                                                    <div class="invalid-feedback">You must agree before proceeding</div>
                                                </div>
                                                <!-- <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="newsletter">
                                                    <label class="custom-control-label" for="newsletter">Sign up for newsletters (dont worry, we won't send so many)</label>
                                                </div> -->
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-md-4 ml-auto text-right">
                                                    <!-- <button id="js-login-btn" type="submit" class="btn btn-block btn-danger btn-lg mt-3">Submit</button> -->
                                                    <input type="submit" name='save' value="Submit" class="btn btn-block btn-danger btn-lg mt-3" id="js-login-btn">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
                            <!-- 2020 © Childyogis . All Rights Reserved -->
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

                // Fetch form to apply custom Bootstrap validation
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

        <script>

        $('.second-child-container').hide();

        $('.second-child-btn').click(function() {
            $('.second-child-container').toggle('slow');
            });
        </script>

    </body>
</html>
