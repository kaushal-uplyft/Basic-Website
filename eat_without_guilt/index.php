<?php include 'config.php' ?>

<?php

    $color_list = ['yellw','green','pinkbg'];

    $curl = curl_init();
    curl_setopt_array($curl, array(
      // CURLOPT_URL => "https://www.yourdigitallift.com/api/v1/fitness-center-trainers/",
      CURLOPT_URL => $api_endpoint."/api/v1/fitness-center-subscription-category/",
      // CURLOPT_SSL_VERIFYPEER => true,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      // CURLOPT_POSTFIELDS => "CategoryId=$cat_id",
      CURLOPT_HTTPHEADER => array(
        'content-type: application/x-www-form-urlencoded',
        'Authorization:'.$auth_key,
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $category =  json_decode($response, true);
    $category_list =  $category['data']['MembershipsCategory'];

    ?>

    <?php

        $curl = curl_init();
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
           CURLOPT_POSTFIELDS => "TestimonialType=TRAN",

          CURLOPT_HTTPHEADER => array(
            'content-type: application/x-www-form-urlencoded',
            'Authorization:'.$auth_key,
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $transformation =  json_decode($response, true);
        $client_transformation =  $transformation['data']['ClientTestimonial'];
        // echo " membership_plan : " . $membership_plan;
        ?>


    <?php
    if (isset($_POST["submit-form"])) {

      $user_name = $_POST['name'];
      $email = $_POST['email'];
      $mobile_no = $_POST['mobileNo'];
      $notes = $_POST['notes'];
      $entry_point = 'Website';

      $curl = curl_init();


        $auth_header = array(
          'content-type: application/x-www-form-urlencoded',
          'Authorization:'.$auth_key,
          // 'Authorization:wDgmH6BS0B5s/tcOmfAqtTIyvjBR7fqDFoNgcHEcT6A=',
        );
      curl_setopt_array($curl, array(
        // CURLOPT_URL => "http://192.168.43.191:8000/api/v1/website-customer-register/",
        CURLOPT_URL => $api_endpoint."api/v1/website-customer-register/",
        // CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        // CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_POSTFIELDS => "FirstName=$user_name&CustomerMobile=$mobile_no&CustomerEmail=$email&EntryPoint=$entry_point&Notes=$notes",
        CURLOPT_HTTPHEADER => $auth_header,
      ));
      $response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);

      echo '<script> alert("Thank you for your feedback.Our team will get in touch with you soon.") </script>';
      echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    }

    ?>


<!DOCTYPE html>
<html>
<head>
    <title><?php echo $domain_name ?></title>
    <!-- All Meta Details-->
    <meta charset="utf-8">
    <meta name="description" content="Dietitian is expert Nutritionist, an eminent healthcare professional with many years of experience in Nutrition Solutions Industry. ">
    <meta name="keywords" content="Best Nutrition in india , best dietitian in delhi">
    <meta name="author" content="<?php echo $domain_name ?>">
    <meta name="viewport" content="width=device-width">
    <meta name="revisit-after" content="3 days"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">


    <!-- Favicon -->
    <link rel="icon" href="images/leaf.png" type="image/x-icon"alt="icon-img">


    <!-- Extrernal CDNs -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Local Css Files Which are compressd here using Django Compressor -->


    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">


    <!-- Responsive -->

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>

    <!-- Datetimepicker -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <style>
        .alert {
            position: fixed;
            bottom: 0;
            z-index: 100;
            right: 20px;
            display: none;
        }
    </style>


</head>

<body>

<!--
<div class="preloader" id="overlay" style="z-index: 10000000000">
    <div class="loader">

        <div class="loader__figure" style=""></div>
        <H4 class="loader__label" style="color:white;"></H4>
    </div>
</div>
-->

    <?php  $active_link = 'home';
    include 'navbar.php' ?>

    <div class="carousel slide banner_index" data-ride="carousel">
        <!-- Indicators -->
        <div class="carousel-caption row">
            <div class="col-md-7 alng tp" style="width:100%;">
                <h4 class="foop"></h4>
                <h1> <?php echo $domain_name ?> </h1>
                <h2 class="rsp" style="color: black;font-size: 37px;">
                </h2>
                <div class="tp-caption flx">
                    <!-- <a href="#" data-toggle="modal" id="book_btn">
                        <img src="images/home/bt2.png" alt="Book Appointment -<?php echo $domain_name ?>" class="rbn">
                    </a>
                    <a href="#" data-toggle="modal" data-target="#exampleModalLong">
                        <img src="images/home/bt1.png" alt="Contactus  -<?php echo $domain_name ?>" class="rbn">
                    </a> -->

                    <a href="ready_dashboard/page_register.php">
                        <img src="images/home/bt2.png" alt="Book Appointment -<?php echo $domain_name ?>" class="rbn">
                    </a>

                    <a href="contact.php">
                        <img src="images/home/bt1.png" alt="Contactus  -<?php echo $domain_name ?>" class="rbn">
                    </a>

                </div>
            </div>
            <div class="col-md-5 text-center p-t-10" style="width:100%;">
                <img src="images/home/home_1.png"
                     class="dtp tp rst" alt="<?php echo $domain_name ?>" style="width:350px;height:350px">
            </div>
        </div>
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
            </div>
            <img src="images/home/main_banner.png" alt="<?php echo $domain_name ?>" style="width:100%;">
        </div>

        <!-- Left and right controls -->
    </div>
    <!--Why Us-->
    <section class="default-section">
        <div class="container">
            <div class="sec-title centered">
                <h2>Featured Services</h2>
                <div class="separator">
                </div>
            </div>
            <div class="row align-items-center justify-content-around mt-2">
                <div class="col-md-12 col-lg-12 col-xl-12 mb-4 mt-4">
                    <div class="large-12 columns pt-3">
                        <div class="owl-carousel owl-carousel-1">
                          <?php foreach($category_list as $cat){ ?>
                            <div class="item">
                                <a  class="ser" href="Weight-Loss-Program.html" target="_blank">
                                    <div class="icon-column-two col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="inner-box  rounded <?php echo $color_list[array_rand($color_list)] ?> text-center services_back " style="height:230px;">
                                            <h3 class="text-black font-22 font-medium" style="height:80px;">
                                                <?php echo $cat['Title'] ?> </h3>
                                            <!-- <img  src="images/home/readmore.png" class="img-fluid lej" alt="<?php echo $domain_name ?>"> -->
                                        </div>
                                    </div>
                                </a>
                            </div>
                          <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Default Section-->
    <section class="default-section">
        <section class="why-us">
            <div class="auto-container">
                <div class="sec-title centered">
                    <h2>About Us</h2>
                    <div class="separator">
                    </div>
                </div>
                <div class="row clearfix">
                    <!--Video Column-->
                    <div class="column video-column col-md-5 col-sm-12 col-xs-12 bg_img">
                        <div class="inner-box wow fadeIn animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeIn;"><!--featured-image-box--><div class="video-image-box" style="margin-top: 40px;margin-left: -40px;">
                            <figure class="image circular--portrait"><img src="images/home/home_1.png" alt="<?php echo $domain_name ?>" class="dtp cp" style="width: 475px;height: 475px;">
                            </figure>
                            </div>
                        </div>
                    </div>
                    <!--Text Column -->
                    <div class="column text-column col-md-7 col-sm-12 col-xs-12 p-5 m-0">
                        <h2 class="text-black font-medium col-md-12 m-b-3">
                            <?php echo $domain_name ?>
                            <br>
                        </h2>
                        <div class="inner-box col-md-12">
                            <div class="text" style="font-size: 18px">
                              <?php echo $about_us_1 ?>
                            </div>
                            <div class="text">
                                <a href="about.html" class="theme-btn btn-style-four">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <style>
    </style>
    <section class="experience-section pban">
        <div class="auto-container">
            <div class="row clearfix">
                <!--Title Column-->
                <div class="title-column col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <div class="inner-box wow fadeInLeft animated" data-wow-delay="0ms" data-wow-duration="1500ms"
                         style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
                        <h3 class="font-medium font-30 m-b-3" >
                            Download App Now
                        </h3>
                        <div class="text ">
                            Tracking your Diet and Workout Plans are NOW EASY! From chatting with your Dietitian and
                            following a diet plan to Tracking your Progress, e-Diet is handling everything for you.
                            <br>
                        </div>
                        <!-- <div class="plat m-b-5" style="padding-left:0px !important;">
                            <h4> Use Reference Code
                                <span class="cyb">  EATWITHOUTGUILT
                                </span>
                            </h4>
                        </div> -->
                        <div class="hero-description">
                            <h4>
                                <a href="<?php echo $andriod_app_url ?>">
                                    <img class="graf" src="images/home/google-play.png" alt=" Android App" height="45" width="140">
                                </a>
                                <a href="<?php echo $ios_app_url ?>">
                                    <img class="graf" src="images/home/app-store.png" alt=" Ios App" height="45" width="140">
                                </a>
                            </h4>
                            <!-- <p style="padding-left:8px">
                                Go to App Store or Play Store and search for e-diet
                            </p> -->
                        </div>
                    </div>
                </div>
                <!--Fact Counter--></div>
            </div>
    </section>

    <!--Testimonials Section-->
    <section class="services-style-two ">
        <div class="auto-container">
            <div class="sec-title">
                <div class="clearfix">
                    <div class="pull-left">
                        <h2>Success Stories</h2>
                        <div class="separator">
                        </div>
                    </div>
                    <div class="link-outer pull-right">
                        <a href="testimonial_SS.html" class="more-link theme-btn btn-style-three">Read More Stories</a>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-around mt-2">
                <div class="col-md-12 col-lg-12 col-xl-12 mb-4 mt-4">
                    <div class="large-12 columns pt-3">
                        <div id="" class=" owl-carousel owl-carousel-2">

                          <?php foreach($client_transformation as $trans){ ?>

                            <div class="testimonials  bg-primary rounded ">
                                <div class="col-md-6 img_div">
                                    <?php echo $domain_name ?> | Testimonials
                                    <img class="img-fluid rounded" src="<?php  echo $trans['Image'] ?>"  alt="<?php echo $domain_name ?> | Testimonials" >
                                </div>
                                <div class=" col-md-6 bunch p-3 bg-custom testimonialouterbody">
                                    <p class="name text-primary font-medium p-0 p-t-5 text-center m-0">
                                        <?php echo $trans['Title'] ?>
                                    </p>
                                    <?php if($trans['ShortDescription']){ ?>
                                    <div class="testimonialbody p-5 bg-custom ">
                                        <p>
                                            <i class="fa fa-quote-left"></i>
                                            <br>
                                            <?php echo $trans['ShortDescription'] ?>
                                    </p>
                                    </div>
                                  <?php }else{ ?>
                                    <div class="testimonialbody p-5 bg-custom ">
                                        <p>
                                            <i class="fa fa-quote-left"></i>
                                            <br>
                                            Commit To Be Fit
                                    </p>
                                    </div>
                                  <?php } ?>
                                    <div class="p-t-5 centered text-black ">
                                        <strong> <?php echo $trans['ClientName'] ?> </strong>
                                    </div>
                                </div>
                            </div>
                          <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--News Section-->
    <!-- <section class="news-section">
        <div class="auto-container">
            <div class="sec-title">
                <div class="clearfix">
                    <div class="pull-left">
                        <h2>Our Latest Blog</h2>
                        <div class="separator"></div>
                    </div>
                    <div class="link-outer pull-right">
                        <a href="blogs_health.html" class="more-link theme-btn btn-style-three">Read More</a>
                    </div>
                </div>
            </div>
            <div class="row clearfix">

                <div class="news-style-one col-md-4 col-sm-6 col-xs-12">
                    <div class="inner-box" style="height:440px">
                        <figure class="image-box">
                            <a href="/blogs/blog-reverse-fatty-liver/ ">

                                 <img src="images/home/latest_blog1j.jpg"
                                     alt="REVERSE FATTY LIVER " style="height: 200px">
                            </a>
                        </figure>
                        <div class="lower-content" style="height:240px">
                            <div class="posted-info">
                                <i class="fa fa-calendar" aria-hidden="true">
                                </i> &nbsp;&nbsp;07-07-2020
                            </div>
                            <div class="post-author-info ">
                                by EATWITHOUTGUILT
                            </div>
                            <h4 class="font-medium text-primary b-l" style="padding:7px;">
                                <a href="/blogs/blog-reverse-fatty-liver/">
                                    Reverse Fatty Liver
                                </a>
                            </h4>
                            <div class="text m-t-3">
                                Lifestyle and dietary changes are currently the most effective treatment …
                            </div>
                            <div class="p-5 rounded " style="background: #f4f4f4;position:absolute;bottom: 10px !important;left: 35% !important;">
                                <a href="/blogs/blog-reverse-fatty-liver/">
                                    Read Story
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="news-style-one col-md-4 col-sm-6 col-xs-12">
                    <div class="inner-box" style="height:440px">
                        <figure class="image-box">
                            <a href="/blogs/blog-tip-of-the-day/ ">
                                 <img src="images/home/ltst_blog2.png" alt="TIP OF THE DAY" style="height: 200px">

                            </a>
                        </figure>
                        <div class="lower-content" style="height:240px">
                            <div class="posted-info">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                &nbsp;&nbsp;04-07-2020
                            </div>
                            <div class="post-author-info ">by <?php echo $domain_name ?> </div>
                            <h4 class="font-medium text-primary b-l" style="padding:7px;">
                                <a  href="/blogs/blog-tip-of-the-day/">
                                  Tip Of The Day</a>
                            </h4>
                            <div class="text m-t-3">If you have a fatty liver, then you probably know …
                            </div>
                            <div class="p-5 rounded " style="background: #f4f4f4;position:absolute;bottom: 10px !important;left: 35% !important;">
                                <a href="/blogs/blog-tip-of-the-day/">Read Story
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="news-style-one col-md-4 col-sm-6 col-xs-12">
                    <div class="inner-box" style="height:440px">
                        <figure class="image-box">
                            <a href="/blogs/blog-classification-of-fatty-liver/ ">
                                <img src="images/home/ltst_blog3.png" alt="CLASSIFICATION OF FATTY LIVER " style="height: 200px">
                            </a>
                        </figure>
                        <div class="lower-content" style="height:240px">
                            <div class="posted-info">
                                <i class="fa fa-calendar" aria-hidden="true">
                                </i>
                                &nbsp;&nbsp;04-07-2020
                            </div>
                            <div class="post-author-info ">
                                by <?php echo $domain_name ?></div>
                            <h4 class="font-medium text-primary b-l" style="padding:7px;">
                                <a href="/blogs/blog-classification-of-fatty-liver/">Classification Of Fatty Liver </a>
                            </h4>
                            <div class="text m-t-3">
                                In many cases, fatty liver disease is diagnosed after blood …
                            </div>
                            <div class="p-5 rounded " style="background: #f4f4f4;position:absolute;bottom: 10px !important;left: 35% !important;">
                                <a href="/blogs/blog-classification-of-fatty-liver/">Read Story
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!--Two Column Fluid Section-->
    <section class="appt-section">
        <section class="title-box">
            <div class="auto-container">
                <h2>Request a Consultation</h2>
                <div class="separator">
                </div>
            </div>
        </section>
        <div class="auto-container">
            <div class="form-container">
                <form action="index.php" method="POST" id="people_id">
                    <p class="font-medium m-0">
                        For Consultation - Give your details here or Email Us - <?php echo $email ?> Call
                        Us - <?php echo $mobile_show ?>
                    </p>
                    <div style="height:23px">
                        <div class="alert_lead col-md-12 text-left m-0 p-l-0" >
                    <h6 class="message m-0 font-14" style="color:#c9231e;text-transform: capitalize !important;">
                    </h6>
                    </div>
                    </div>

                    <div class="half left cf " style="text-align: left !important;">
                        <input type="text" id="input-name" name="name" placeholder="Name *" required>
                        <div class="form-group" style="display: flex">

                    <input placeholder="Phone no. *" type="number" class="" name="mobileNo" id="recipient-name" oninput="this.value=parseInt(this.value.replace(/[^0-9]/g,''));" required>
                    </div>

                    <input type="email" name="email" id="input-email" placeholder="Email address">
                    <!-- <input type="hidden" name="csrfmiddlewaretoken" value="KbmkylJKCuixTnUuMP8NqB9gYDtVk1diL0uacnC5lmfnWaz0714dz9scGeD7I0l1"> -->
                    </div>
                    <div class="half right cf">

                        <textarea name="notes" type="text" id="input-message" placeholder="Message"></textarea>
                    </div>
                    <input type="submit" value="Submit" name="submit-form" id="input-submit">
                </form>
            </div>
        </div>
    </section>


    <?php include 'footer.php' ?>


<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target=".main-header">
    <span class="fa  fa-angle-up"></span>
    </div>
<input type="hidden" name="csrfmiddlewaretoken" value="KbmkylJKCuixTnUuMP8NqB9gYDtVk1diL0uacnC5lmfnWaz0714dz9scGeD7I0l1">


<div class="modal fade" id="exampleModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="padding: 10px;">
            <div class="modal-body" style="padding:10px 30px;color:#3f4828;border: 1px solid #3f4828;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="row clearfix">
                    <!--Title Column-->
                    <div class="title-column col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="text-align: center">
                        <div class="inner-box"
                             style="visibility: visible;">
                            <h4 style="font-size:22px; text-align: center">Download the e-Diet App Now</h4>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hero-description">
                                <h4 style="margin-top:5px; text-align: center;"><a
                                        href="<?php echo $andriod_app_url ?>">
                                    <img class="" src="images/home/google-play.png" alt=" Android App"
                                         height="auto" width="95px"></a>
                                    <a href="<?php echo $ios_app_url ?>">
                                        <img class="graf" src="images/home/app-store.png" alt=" Ios App" height="auto" width="95px"></a></h4>
                            </div>
                            <h2 style="font-size:22px;text-align: center">Or</h2>
                                <h4>Explore my <a href="services.html" type="button" class="theme-btn btn-circle" style="padding: 4px!important;color:rgba(33, 46, 2, .9);">Services
                                    </a>
                                </h4>

                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="background-color: white"></div>

            </div>
        </div>
    </div>
</div>






    <style>
        .modal-backdrop.in {
            z-index: 998 !important;
        }
    </style>


<div class="modal fade" id="book_appoint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 10px;">
            <form id="appointmentForm" style="margin: 0px !important;border-radius: 10px">
                <div class="modal-header">
                    <h4 class="modal-title">Book Appointment
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-white" aria-hidden="true">&times;</span>
                        </button>
                    </h4>

                </div>
                <div class="modal-body col-md-12 p-5" style="background: #f6f6f6;padding-bottom:20px">

                    <div class="form-group col-md-4">

                        <div id="datetimepicker12" class="m-b-5"></div>
                        <input type="hidden" id="date_" name="date">
                        <div>
                            <label class="col-md-12" for="example-text">Appointment Type
                            </label>
                            <div class="col-md-12" style="padding-top:6px;">
                                <select class="form-control" name="type" style="width: 100%;" required>
                                    <option value="In Person">In Person</option>
                                    <option value="Call">Online</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <input type="hidden" name="csrfmiddlewaretoken" value="KbmkylJKCuixTnUuMP8NqB9gYDtVk1diL0uacnC5lmfnWaz0714dz9scGeD7I0l1">
                            <label class="col-md-12">Note</label>
                            <div class="col-md-12">
                                <textarea class="form-control" name="note" rows="3"></textarea>
                            </div>
                        </div>


                    </div>
                    <div class="form-group col-md-8"><h4 class="font-medium"> Select Slot</h4>
                        <div class="day_slots p-3">
                            <ul class="col-md-12 row" id="slot_container">
                            </ul>


                        </div>
                    </div>

                </div>
                <div class="modal-footer" style="background: #f6f6f6;">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <input type="submit" class="button bg-primary p-2" value="Book" id="input-submit"
                                   style="width: 100px !important;">
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>





    <style>
        .modal-backdrop.in {
            z-index: 998 !important;
        }
    </style>


<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Query Form
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body" style="background: #f6f6f6;padding:0px">
                <div class="auto-container" style="padding:15px  !important;">
                    <div class="form-container">
                        <div style="height: 20px">
                            <div class="alert_lead col-md-12 text-left m-0 p-l-0">
                                <h6 class="message m-0"
                                    style="color:#c9231e;text-transform: capitalize !important;"></h6>
                            </div>
                        </div>
                        <form class="contactForm1 row m-t-0">
                            <input type="hidden" name="csrfmiddlewaretoken" value="KbmkylJKCuixTnUuMP8NqB9gYDtVk1diL0uacnC5lmfnWaz0714dz9scGeD7I0l1">
                            <div class="col-md-12 cf">
                                <input type="text" id="input-name" name="name" placeholder="Name*"
                                       required="">
                            </div>
                            <div class="col-md-12  cf">
                                <div style="display: flex;">
                                    <select name="ccode" class="select_country_modal" required>
                                        <option value="0" id="select_country_modal">Country</option>
                                    </select>
                                    <input placeholder="Phone no.*" type="number" class="" name="phone"
                                           id="recipient-name"
                                           style="width:175px !important;" required>
                                </div>

                            </div>
                            <div class="col-md-12 m-b-3  cf">
                                <input type="email" name="email" id="input-email" placeholder="Email address">
                            </div>
                            <div class="col-md-12  cf">
                                <select name="gender" class="gender_val" id="form1Gender" required>
                                    <option val="0" selected>Gender*</option>
                                    <option val="male">Male</option>
                                    <option val="female">Female</option>
                                    <option val="other">Other</option>

                                </select>
                                <input type="hidden" name="csrfmiddlewaretoken"
                                       value="6WvEPXPYTuqrXSAExfsUFXrGoZWEpKZxRegkJNhCFBbykW7eFlkX05f80ORSBFmV">

                            </div>
                            <div class="col-md-12   cf">
                                <textarea class="col-md-12 m-b-4" name="message"
                                          type="text"
                                          id="input-message"
                                          placeholder="Message"></textarea>
                                <input type="submit" class="newbtn" value="Submit" id="input-submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hero-description  text-center">
                    <h4 class="font-medium text-black">Download Our App Now

                </h4>

                    <a href="<?php echo $andriod_app_url ?>">
                        <img class="" src="images/home/google-play.png" alt=" Android App" height="35" width="100"></a>
                    <a href="<?php echo $ios_app_url ?>">
                        <img class="" src="images/home/app-store.png" alt=" Ios App" height="35"
                                                                                                       width="100"></a>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="client_status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="padding: 10px;">
            <div class="modal-body" style="padding:10px 30px;color:#3f4828;border: 1px solid #3f4828;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="row clearfix"><!--Title Column-->
                    <div class="title-column col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="text-align: center">
                        <div class="inner-box"
                             style="visibility: visible;">
                            <h4 style="font-size:22px; text-align: center" class="client_status_text">Download the e-Diet App Now</h4>
                            <br>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hero-description client_proceed">
                                <button class="btn btn-success client_yes">
                                    YES
                                </button>
                                <button  class="btn btn-danger client_no">
                                    NO
                                </button>
                            </div>
                            <h2 style="font-size:22px;text-align: center"></h2>
                            <h2 style="font-size:22px;text-align: center"></h2>
                                <h4 style="margin-top: 50px;" class="client_proceed" >Do you still want to proceed ??
                                </h4>

                        </div>
                    </div>
                </div>

                <div class="modal-footer b-0" style="background-color: white;border:none !important;"></div>

            </div>
        </div>
    </div>
</div>

<div class="alert alert-success">
    <strong>Success!</strong>
</div>

<script>
    var is_authenticate = 'False';
    var is_lead = '';

</script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" crossorigin="anonymous"></script>

    <script src="static/js/bootstrap.min.js"></script>
    <script src="static/js/jquery.mCustomScrollbar.concat.min.js"></script>

    <script src="static/js/jquery.fancybox.pack.js"></script>
    <script src="static/js/jquery.fancybox-media.js"></script>
    <script src="static/js/owl.js"></script>
    <script src="static/js/wow.js"></script>
    <script type="text/javascript" src="static/js/owl.carousel.js"></script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="static/js/script.js"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="static/js/ajax_register.js"></script>
<script src="static/js/appointment.js"></script>

<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "300px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>



    <script>


        $('.owl-carousel-1').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            dots: false,
            navText: [
                "<i class='fa fa-caret-left'></i>",
                "<i class='fa fa-caret-right'></i>"
            ],
            autoplay: true,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
        $('.owl-carousel-2').owlCarousel({
            loop: true,
            items: 2,
            margin: 10,
            autoplay: true,
            dots: true,
            nav: false,
            autoplayTimeout: 8500,
            smartSpeed: 450,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 1
                },
                1170: {
                    items: 2
                }
            }
        });

        $('.offer_code').on('click', function(){

            var $this = $(this);
            var inp = document.createElement('input');
            document.body.appendChild(inp);
            inp.value = $this.html();
            inp.select();
            document.execCommand('copy', false);
            $this.next().css({'opacity': 1});
            setTimeout(function(){
                $this.next().css({'opacity': 0});
            }, 2000);


            inp.remove();
        });

    </script>

</body>
</html>
