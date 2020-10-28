<?php include 'config.php' ?>

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
  echo "<script type='text/javascript'> document.location = 'contact.php'; </script>";
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
    <link rel="icon" href="images/leaf.png" type="image/x-icon">


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

    <style>
        .select2-container {
            margin-top: 0.22em !important;
            text-align: left;
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
<?php  $active_link = 'contact';
include 'navbar.php' ?>

    <section class="page-title">
      <div class="auto-container">
        <h1>Contact Us </h1>
        <h3 class="styled-font">We Offer healthier lifestyle.</h3>
      </div>
    </section>

    <section class="page-info">
      <div class="auto-container clearfix">
        <div class="breadcrumb-outer">
          <ul class="bread-crumb clearfix">
            <li><a href="index.html">Home</a></li>
            <li class="active">Contact Us</li>
          </ul>
        </div>
      </div>
    </section>

    <section class="contact-section">
      <div class="auto-container">
        <div class="row clearfix">
          <div class="column form-column pull-right col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="sec-title">
              <h2>Send Us Message</h2>
              <div class="separator">
              </div>
            </div><!--form-box-->
            <div class="appt-section">
              <div class="auto-container ">
                <div class="form-container " style="margin-top:0px!important;">
                  <div style="height: 20px">
                    <div class="alert_lead col-md-12 text-left m-0  p-l-0 " >
                      <h6 class="message m-0 font-14" style="color:#c9231e;text-transform: capitalize !important;">
                      </h6>
                    </div>
                  </div>

                  <form action="index.php" method="POST" id="people_id">
                    <div class="row clearfix">
                      <div class="form-group col-md-12 col-sm-12 col-xs-12 p-r-1">
                        <input type="text" name="name" value="" placeholder="Your Name *" required>
                      </div>

                      <div class="form-group col-md-12 col-sm-12 col-xs-12 p-r-1">
                        <input placeholder="Phone no.*" type="number" class="  " name="mobileNo" id="recipient-name" required>
                      </div>

                      <div class="form-group col-md-12 col-sm-12 col-xs-12 p-r-1">
                        <input type="email" name="email" value="" placeholder="Your Mail *" required>
                      </div>

                      <div class="form-group col-md-12 col-sm-12 col-xs-12 p-r-1">
                        <textarea name="notes" placeholder="Message"></textarea>
                      </div>

                      <div class="form-group col-md-12 col-sm-12 col-xs-12 p-r-1">
                        <input type="submit" value="Submit" name="submit-form" id="input-submit">
                      </div>


                    </div>

                      <!-- <div class="col-md-12 col-sm-12 col-xs-12 " style="display: flex">

                      <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <textarea name="notes" placeholder="Message"></textarea>
                      </div>

                      <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <input type="submit" value="Submit" name="submit-form" id="input-submit">
                      </div>
                    </div> -->
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="column info-column pull-left col-lg-6 col-md-8 col-sm-12 col-xs-12">
            <div class="sec-title">
              <h2>Get In Touch</h2>
              <div class="separator"></div>
            </div>

            <div class="tabs-box info-tabs">
              <ul class="tab-buttons clearfix"></ul>
              <div class="tabs-content">
                <div class="tab active-tab" id="info-tab-1">
                  <div class="info-style-one" style="">
                    <ul>
                      <li>
                        <div class="icon-box"><span class="fa fa-globe"></span></div><h4>Address :</h4><div class="text"><b> <?php echo $address ?> </b></div>
                      </li>

                      <li>
                        <div class="icon-box">
                          <span class="flaticon-envelope"></span>
                        </div>
                        <h4>Ask Some Thing Us :</h4>
                        <div class="text">
                          <b> <?php echo $email ?> </b>
                        </div>
                      </li>

                      <li>
                        <div class="icon-box">
                          <span class="flaticon-technology-1"></span>
                        </div>
                        <h4>Call Us:</h4>
                        <div class="text">
                          <b> <?php echo $mobile_show ?> </b>
                        </div>
                      </li>

                      </ul>

                      <div class="  col-lg-12 col-md-12 col-sm-12 col-xs-12   text-center" style="margin-top: 20px;">
                        <div class="inner-box wow fadeInLeft animated" data-wow-delay="0ms"
                                             data-wow-duration="1500ms"
                                             style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">

                                             <h3 style="color:#3f4828;">Download Our App Now</h3><br>
                                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hero-description ">
                                                   <a href="<?php echo $andriod_app_url ?>" target="_blank">

                                                     <img src="images/home/google-play.png"
                                                            alt="Ediet android app" height="45"
                                                            width="140">
                                                  </a>

                                                  <a href="<?php echo $ios_app_url ?>" target="_blank">

                                                    <img class="graf" src="images/home/app-store.png"
                                                             style="" alt="Ediet ios app"
                                                             height="45"
                                                             width="140">

                                                  </a>
                                            </div>
                                          </div>
                                        </div>
                                       </div>
                                     </div>
                                   </div>
                                 </div>
                               </div>
                             </div>
                           </div>
                         </div>
                       </section>


    <?php include 'footer.php' ?>

</div>
<!--End pagewrapper-->


<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target=".main-header"><span class="fa  fa-angle-up"></span></div>
<input type="hidden" name="csrfmiddlewaretoken" value="YoWlaUhZTSre3FctSZHxV1BjUakZFFMhZd4bOWakCKo46sRZdbDX4zUfCLub3EU0">


<div class="modal fade" id="exampleModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                            <h4 style="font-size:22px; text-align: center">Download the e-Diet App Now</h4>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hero-description">
                                <h4 style="margin-top:5px; text-align: center;"><a
                                        href="<?php echo $andriod_app_url ?>">
                                    <img class="" src="images/home/google-play.png" alt="ediet Android App"
                                         height="auto" width="95px"></a>
                                    <a href="<?php echo $ios_app_url ?>"> <img
                                            class="graf" src="images/home/app-store.png" alt="ediet Ios App"
                                            height="auto" width="95px"></a></h4>
                            </div>
                            <h2 style="font-size:22px;text-align: center">Or</h2>
                                <h4>Explore my <a href="/services/" type="button" class="theme-btn btn-circle" style="padding: 4px!important;color:rgba(33, 46, 2, .9);">Services
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
                            <input type="hidden" name="csrfmiddlewaretoken" value="YoWlaUhZTSre3FctSZHxV1BjUakZFFMhZd4bOWakCKo46sRZdbDX4zUfCLub3EU0">
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
                            <input type="hidden" name="csrfmiddlewaretoken" value="YoWlaUhZTSre3FctSZHxV1BjUakZFFMhZd4bOWakCKo46sRZdbDX4zUfCLub3EU0">
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hero-description  text-center"><h4
                        class="font-medium text-black">Download Our App Now

                </h4>

                    <a href="<?php echo $andriod_app_url ?>"><img
                            class="" src="images/home/google-play.png" alt="ediet Android App" height="35"
                            width="100"></a>
                    <a href="<?php echo $ios_app_url ?>"><img class=""
                                                                                                       src="images/home/app-store.png"
                                                                                                       alt="ediet Ios App"
                                                                                                       height="35"
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



<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</body>
</html>
