



<!DOCTYPE html>
<html>
<head>
    <title>Eat Without Guilt</title>
    <!-- All Meta Details-->
    <meta charset="utf-8">
    <meta name="description" content="Dietitian is expert Nutritionist, an eminent healthcare professional with many years of experience in Nutrition Solutions Industry. ">
    <meta name="keywords" content="Best Nutrition in india , best dietitian in delhi">
    <meta name="author" content="Eat Without Guilt">
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
        li, ul {
            list-style: disc !important;
        }

        #overlay {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            cursor: pointer;
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

<div id="mySidenav" class="sidenav">
    <div class="bg-primary" style="height: 50px;">
        
            <h5 class="font-medium m-0 text-left">
                &nbsp;REGISTER
            </h5>
        
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    </div>
    <div class="col-md-12 row text-center">
        <div style="height:30px !important" class="m-t-1">
            <div class="alert col-md-12 text-left m-0" style="padding: 4px 15px;">
                <h6 class="message m-0" style="color:#c9231e;text-transform: capitalize !important;"></h6>
            </div>
        </div>
        <form method="get" action="#" id="form_register" autocomplete="off" style="margin-top: 0px !important;">
            <input type="hidden" name="csrfmiddlewaretoken" value="DK28QU60CFiTH7Xw19HuiLL7PiNMZZAA1Pv5CljfWJ0sMruPpTIkxmBOxudCWxIn">
            <div class=" form-group col-md-12 m-0">
                <label class=" col-md-12  row text-left font-medium">Country *</label>
                <select name="ccode" id="country_code" class="no-border select_country col-md-12" required
                        style="margin-top:0px">
                    <option value="0"> Select Country</option>
                </select>
            </div>
            <div class="form-group col-md-12 m-0">
                <label class="col-md-12 row  text-left font-medium">Phone Number *</label>
                <input type="number" name="username" placeholder="Phone Number" id="user_phone" class="col-md-12"
                       style="margin-top:0px"
                       value="" autocomplete="off">
                
            </div>
            <input type="hidden" name="csrfmiddlewaretoken" value="DK28QU60CFiTH7Xw19HuiLL7PiNMZZAA1Pv5CljfWJ0sMruPpTIkxmBOxudCWxIn">
            
                <div class="col-md-12 m-0" style="padding-top: 15px;padding-left:0px;">
                    <a href="#" class="verfy_otp theme-btn btn-style-one bg-primary text-white"
                       style="font-size:11px;padding:3px 15px; margin-bottom: 50px !important;">Send
                        Otp</a>
                </div>
            
            <div class="clearfix"></div>
            <div id="user_otp_div" class="m-0">
                <div class="col-md-12 m-0 p-t-1">
                    <h5 class=" text-left font-medium p-l-0">Enter OTP</h5>
                </div>
                <div class="col-md-12 m-0">
                    <input type="number" name="user_otp" id="user_otp" value=""
                           style="padding-top: 6px;margin-top: 0;">
                </div>
                <div class="col-md-12 m-0" style="padding-top:10px">
                    <a href="#" class="verfy_otp_1 theme-btn btn-style-one bg-primary text-white m-0"
                       style="font-size:11px;padding: 3px 15px;margin-bottom: 50px !important;">Verify</a>
                </div>
            </div>
            <div class="form-group col-md-12 m-0 partial_info">
                <label class="col-md-12 row  text-left font-medium">First Name *</label>
                <input type="text" name="firstname" value=""
                       required>
            </div>
            <div class="form-group col-md-12 m-0  partial_info">
                <label class="col-md-12 row  text-left font-medium">Last Name *</label>
                <input type="text" name="lastname" value=""
                       required>
            </div>
            <div class="form-group col-md-12 m-0  partial_info">
                <label class="col-md-12 row  text-left font-medium">Email</label>
                <input type="email" name="email" value=""
                >
            </div>
            <div class="form-group col-md-12 m-0  partial_info">
                <label class="col-md-12 row  text-left font-medium">Gender *</label>
                <select name="usergender" value="" id="usergender" required>
                    <option value="0">Select Gender</option>
                    <option value="Male"> Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group col-md-12 partial_info">
                <label class="col-md-12 row  text-left font-medium">Goal *</label>
                <select name="goal" required>
                    <option value="0">Select Goal</option>
                    <option value="Weight Loss">Weight Loss</option>
                    <option value="Weight Gain"> Weight Gain</option>
                    <option value="Weight Maintenance">Weight Maintenance</option>
                    <option value="Disease Management">Disease Management</option>
                </select>
            </div>
            <div class="form-group col-md-12 partial_info register_button m-0" style="text-align: center">
                
                    <div class="form-group">
                        <button type="submit" class="theme-btn btn-style-one bg-primary text-white m-0 col-md-12"
                                style="height: 25px;text-align: center;padding: 0px;">
                            Register</button>
                    </div>
                
            </div>
            <div class=" col-md-12 " style="bottom: 10% !important;">
                <img src="images/login.svg" alt="Eat Without Guilt - Login" style="height: 140px;width: 180px">
            </div>
        </form>
    </div>
</div>


<div class="page-wrapper">

<!--    <div class="preloader"></div>-->
    <!-- Main Header-->
    <header class="main-header">
        <!-- Header Top -->
        <div class="header-top">


            <!-- The Static Socail Links on Left -->

            <div class="callimg">
                <a href="tel: +91-9899199767">
                    <img src="images/home/strip.png" alt="Eat Without Guilt"></a>


            </div>


            <div class="footer-social-links side-social-links hidden-sm">
                <ul style="list-style: none;">
                    <li id="bar" style="display: block; margin: 3px 0px;"><a
                            href="https://www.facebook.com/EAT-without-GUILT-103521464681387/" target="_blank"><i
                            style="color: #343f19" class="fa fa-facebook hvr-pulse" data-toggle="tooltip"
                            data-placement="right" title="Tooltip on right"></i></a></li>
                    <li id="bar" style="display: block; margin: 3px 0px;"><a
                            href="None" target="_blank"><i style="color: #343f19"
                                                                                          class="fa fa-twitter hvr-pulse"></i></a>
                    </li>
                    <li id="bar" style="display: block; margin: 3px 0px;"><a
                            href="https://www.instagram.com/invites/contact/?i=1e6c1eu3tl84h&amp;utm_content=4zzkwy0" target="_blank"><i
                            style="color: #343f19" class="fa fa-instagram hvr-pulse"></i></a></li>
                    <li id="bar" style="display: block; margin: 3px 0px;" class="whats-num"><a
                            href="https://api.whatsapp.com/send?phone=+91-9899199767&text=Hi" target="_blank"><i
                            style="color: #343f19;" class="fa fa-whatsapp"></i></a></li>
                    <li id="bar" style="display: block; margin: 3px 0px;"><a
                            href="None"><i
                            style="color: #343f19;" class="fa fa-youtube"></i></a></li>

                </ul>

            </div>

            <!-- Main Box -->
            <div class="main-box">
                <div class="auto-container">
                    <div class="outer-container clearfix">
                        <!--Logo Box-->
                        <div class="logo-box">
                            <div class="logo"><a href="index.html"><img src="images/home/header_icon.png"
                                                                              style="height: 50px!important;"
                                                                              alt="Eat Without Guilt"> </a>
                            </div>
                        </div>
                        <!--Nav Outer-->
                        <div class="nav-outer clearfix">
                            <!-- Main Menu -->
                            <nav class="main-menu">
                                <div class="navbar-header">
                                    <!-- Toggle Button -->
                                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                                            data-target=".navbar-collapse">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>

                                <div class="navbar-collapse collapse clearfix">
                                    <ul class="navigation clearfix">
                                        <li><a href="index.html">Home</a></li>
                                        <li><a href="about.html">About Us</a></li>
                                        
                                        <li><a href="testimonial_SS.html">Success Stories</a></li>

                                        <li class="dropdown"><a href="/">Services</a>
                                            <ul id="fellow">
                                                
                                                    <li>
                                                        <a href="Weight-Loss-Program.html">Weight Loss Program 
                                                        </a>
                                                    </li>
                                                
                                                    <li>
                                                        <a href="Weight-Gain-Program.html">Weight Gain Program 
                                                        </a>
                                                    </li>
                                                
                                                    <li>
                                                        <a href="Monsoon-Diet.html">Monsoon Diet 
                                                        </a>
                                                    </li>
                                                
                                                    <li>
                                                        <a href="PCODorPCOS.html">Pcod/Pcos
                                                        </a>
                                                    </li>
                                                
                                                    <li>
                                                        <a href="Child-Nutrition.html">Child Nutrition
                                                        </a>
                                                    </li>
                                                
                                                    <li>
                                                        <a href="Thyroid-Disorder.html">Thyroid Disorder
                                                        </a>
                                                    </li>
                                                
                                                    <li>
                                                        <a href="Diabetes-management.html">Diabetes Management
                                                        </a>
                                                    </li>
                                                
                                                    <li>
                                                        <a href="High-Lipid-and-Cholesterol.html">High Lipid And Cholesterol
                                                        </a>
                                                    </li>
                                                
                                                    <li>
                                                        <a href="pregnancy-and-lactation.html">Pregnancy And Lactation 
                                                        </a>
                                                    </li>
                                                
                                                    <li>
                                                        <a href="Hypertension-Diet.html">Hypertension Diet
                                                        </a>
                                                    </li>
                                                
                                            </ul>
                                        </li>
                                        <li><a href="blogs_health.html">Health Feed</a></li>
                                        <li><a href="contact.html">Contact</a></li>
                                        <li class="before_login"
                                            >
                                            <button href="#" onclick="openNav()"
                                                    class="theme-btn btn-style-three text-white"
                                                    style="padding: 7px 12px;border: 2px solid white  !important;">
                                                Register
                                            </button>
                                        </li>
                                        <li class="dropdown after_login"
                                            style="display: none" ><a
                                                href="/">Hi, <span class="name"></span></a>
                                            <ul id="fellow">
                                                
                                                <li>
                                                    <a href="/clients/logout">Logout
                                                    </a>
                                                </li>

                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </nav><!-- Main Menu End-->

                        </div><!--Nav Outer End-->

                        <!-- Hidden Nav Toggler -->
                        <div class="nav-toggler">
                            <button class="hidden-bar-opener"><span class="icon fa fa-bars"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>
    <!--End Main Header -->


    <!-- Hidden Navigation Bar -->
    <section class="hidden-bar right-align">

        <div class="hidden-bar-closer">
            <button class="btn"><i class="fa fa-close"></i></button>
        </div>

        <!-- Hidden Bar Wrapper -->
        <div class="hidden-bar-wrapper">

            <!-- .logo -->
            <div class="logo text-center">
                
            </div><!-- /.logo -->

            <!-- .Side-menu -->
            <div class="side-menu ">
                <!-- .navigation -->
                <ul class="navigation">
                    <li class=""><a href="index.html">Home</a></li>
                    <li class=""><a href="about.html">About Us</a></li>
                    <li class="dropdown"><a href="#">Services</a>
                        <ul>
                            <ul>
                                
                                    <li class="bg-custom text-black">
                                        <a href="Weight-Loss-Program.html"
                                           class="text-black">Weight Loss Program 
                                        </a>
                                    </li>
                                
                                    <li class="bg-custom text-black">
                                        <a href="Weight-Gain-Program.html"
                                           class="text-black">Weight Gain Program 
                                        </a>
                                    </li>
                                
                                    <li class="bg-custom text-black">
                                        <a href="Monsoon-Diet.html"
                                           class="text-black">Monsoon Diet 
                                        </a>
                                    </li>
                                
                                    <li class="bg-custom text-black">
                                        <a href="PCODorPCOS.html"
                                           class="text-black">Pcod/Pcos
                                        </a>
                                    </li>
                                
                                    <li class="bg-custom text-black">
                                        <a href="Child-Nutrition.html"
                                           class="text-black">Child Nutrition
                                        </a>
                                    </li>
                                
                                    <li class="bg-custom text-black">
                                        <a href="Thyroid-Disorder.html"
                                           class="text-black">Thyroid Disorder
                                        </a>
                                    </li>
                                
                                    <li class="bg-custom text-black">
                                        <a href="Diabetes-management.html"
                                           class="text-black">Diabetes Management
                                        </a>
                                    </li>
                                
                                    <li class="bg-custom text-black">
                                        <a href="High-Lipid-and-Cholesterol.html"
                                           class="text-black">High Lipid And Cholesterol
                                        </a>
                                    </li>
                                
                                    <li class="bg-custom text-black">
                                        <a href="pregnancy-and-lactation.html"
                                           class="text-black">Pregnancy And Lactation 
                                        </a>
                                    </li>
                                
                                    <li class="bg-custom text-black">
                                        <a href="Hypertension-Diet.html"
                                           class="text-black">Hypertension Diet
                                        </a>
                                    </li>
                                
                            </ul>
                            
                        </ul>
                    </li>
                <li><a href="blogs_health.html">Health Feed</a></li>
                <li><a href="testimonial_SS.html">Success Stories</a></li>

                    <li><a href="contact.html">Contact</a></li>
                    <li class="before_login" >
                        <button href="#" onclick="openNav()" class="theme-btn btn-style-three text-white"
                                style="padding: 7px 12px;border: 2px solid white  !important;">Register
                        </button>
                    </li>
                    <li class="dropdown after_login"
                        style="display: none" ><a href="/">Hi, <span
                            class="name"></span></a>
                        <ul id="fellow">
                            
                            <li>
                                <a href="/clients/logout">Logout
                                </a>
                            </li>

                        </ul>
                    </li>


                </ul>
                <br>
                
                
                
                
                
                
                
            </div><!-- /.Side-menu -->

            <div class="social-icons">
                <ul class="footer-social">
                    <li>
                        <a href="https://www.facebook.com/EAT-without-GUILT-103521464681387/"><span
                                class="fa fa-facebook-f"></span></a></li>
                    <li><a href="None"><span class="fa fa-twitter"></span></a>
                    </li>
                    <li><a href="None"><span
                            class="fa fa-youtube"></span></a></li>
                    <li><a href="https://www.instagram.com/invites/contact/?i=1e6c1eu3tl84h&amp;utm_content=4zzkwy0"><span
                            class="fa fa-instagram"></span></a></li>
                </ul>
            </div>

        </div><!-- / Hidden Bar Wrapper -->
    </section>

    <section class="page-title" style="padding-top:150px"><div class="auto-container"><h2 class="text-white font-medium" style="max-width: 500px">Pregnancy And Lactation </h2></div></section>
<!--
    <div class="preloader" id="overlay" style="z-index: 10000000000">
        <div class="loader">
            <div class="loader__figure" style="">
            </div>
            <H4 class="loader__label" style="color:white;">PLEASE WAIT.... </H4>
        </div>
    </div>
-->
    <!--Page Info--><section class="page-info"><div class="auto-container clearfix"><div class="breadcrumb-outer"><ul class="bread-crumb clearfix"><li><a href="/">Home</a></li><li class="active">Pregnancy And Lactation </li></ul></div></div></section><div class="sec-title centered bg-white m-t-5"><h3 class="font-medium">Plans & Pricing</h3></div><section class="price-plans m-t-5"><div class="auto-container"><div class="row clearfix price_listing text-center " style="margin-top: 30px;"><div class="text-center" style="margin: auto;"><!--Price Column--><div class="pricing-column" style="width:250px;margin-right: 20px;display:inline-block"><div class="inner-box wow fadeInUp animated" data-wow-delay="0ms" data-wow-duration="1500ms"
                                 style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;"><div class=""></div><div class="pricing-info clearfix"><div class="duration">1 month pregnancy + 1 month lactation </div><div class="price styled-font" style="font-size: 16px;"><span
                                            style="font-size: 12px;">INR</span><span>4500</span></div></div><div class="lower-content"><input type="hidden" name="csrfmiddlewaretoken" value="DK28QU60CFiTH7Xw19HuiLL7PiNMZZAA1Pv5CljfWJ0sMruPpTIkxmBOxudCWxIn"><div class="link-box"><input value="4500" class="pack_price" hidden><a
                                            type="button" class="pay_btn btn bg-primary" data-price="4500"
                                            data-coupon=""
                                            data-duration="60"
                                    >Pay
                                        Now</a><span style="cursor: pointer; text-decoration: underline;
                                    font-size: 10px; display: block" class="hvCpn" id="pBox_0">Have a Coupon Code</span><span style=" color: green;
                                    font-size: 10px; display: none" class="cpnApplied">Promo Code Applied</span></div></div></div></div><div class="pricing-column" style="width:250px;margin-right: 20px;display:inline-block"><div class="inner-box wow fadeInUp animated" data-wow-delay="0ms" data-wow-duration="1500ms"
                                 style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;"><div class=""></div><div class="pricing-info clearfix"><div class="duration">2 month pregnancy+ 1 month lactation</div><div class="price styled-font" style="font-size: 16px;"><span
                                            style="font-size: 12px;">INR</span><span>9000</span></div></div><div class="lower-content"><input type="hidden" name="csrfmiddlewaretoken" value="DK28QU60CFiTH7Xw19HuiLL7PiNMZZAA1Pv5CljfWJ0sMruPpTIkxmBOxudCWxIn"><div class="link-box"><input value="9000" class="pack_price" hidden><a
                                            type="button" class="pay_btn btn bg-primary" data-price="9000"
                                            data-coupon=""
                                            data-duration="90"
                                    >Pay
                                        Now</a><span style="cursor: pointer; text-decoration: underline;
                                    font-size: 10px; display: block" class="hvCpn" id="pBox_1">Have a Coupon Code</span><span style=" color: green;
                                    font-size: 10px; display: none" class="cpnApplied">Promo Code Applied</span></div></div></div></div><div class="pricing-column" style="width:250px;margin-right: 20px;display:inline-block"><div class="inner-box wow fadeInUp animated" data-wow-delay="0ms" data-wow-duration="1500ms"
                                 style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;"><div class=""></div><div class="pricing-info clearfix"><div class="duration">3 month pregnancy+1 month lactation</div><div class="price styled-font" style="font-size: 16px;"><span
                                            style="font-size: 12px;">INR</span><span>10000</span></div></div><div class="lower-content"><input type="hidden" name="csrfmiddlewaretoken" value="DK28QU60CFiTH7Xw19HuiLL7PiNMZZAA1Pv5CljfWJ0sMruPpTIkxmBOxudCWxIn"><div class="link-box"><input value="10000" class="pack_price" hidden><a
                                            type="button" class="pay_btn btn bg-primary" data-price="10000"
                                            data-coupon=""
                                            data-duration="120"
                                    >Pay
                                        Now</a><span style="cursor: pointer; text-decoration: underline;
                                    font-size: 10px; display: block" class="hvCpn" id="pBox_2">Have a Coupon Code</span><span style=" color: green;
                                    font-size: 10px; display: none" class="cpnApplied">Promo Code Applied</span></div></div></div></div><div class="alert form-group padd-top-15 col-md-12 text-center"><h3 class="message" style="color:#2aa07d"></h3></div></div></div></div></section><!--Sidebar Page--><div class="auto-container"><div class="row clearfix"><!--Content Side--><div class="content-side col-lg-12 col-md-8 col-sm-12 col-xs-12"><!--Blog Details--><section class="blog-details post-details"><div class="news-style-one"><div class="inner-box"><div class="lower-content"><br><h3><span class="b-b font-medium">Description</span></h3><br><div class="text text-content"><p>PREGNANCY is one of the most beautiful as well as tough phase in women life. &nbsp;Lot of body changes and lot of hormones are going up and down. A good diet can help you improve many &nbsp;symptoms like morning sickness. A diet &nbsp;good in all macro and micro nutrients is important for baby growth but it is also important to gain weight in limit as excess weight gain can create many problems like difficulty in delivery , &nbsp;gestational diabetes&nbsp;</p><p>After pregnancy phase of LACTATION steps in . In this phase toddlers completely depends on you for nourishment and your body is already recovering from pregnancy procedures and loads of hormonal changes .</p><p>Usually during lactation most mother faces a problem of inadequate milk production &nbsp;. There are some functional foods termed as ‘ galactagogues’ that naturally enhances milk production</p><p>Gift yourself and your baby gift health</p><p>&nbsp;</p></div><div class="post-bottom clearfix"></div></div></div></div><!--Comments Area--></section></div><!--End Content Side--></div></div><div class="modal fade" id="exampleModals1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content" style="padding: 10px;"><div class="modal-body" style="padding:10px 30px;color:#3f4828;border: 1px solid #3f4828;"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><div class="row clearfix"><!--Title Column--><div class="title-column col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="text-align: center"><div class="inner-box"
                             style="visibility: visible;"><h4 style="font-size:22px; text-align: center"> Payment Recieved !!! <br> Download the
                                e-Diet App Now</h4><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hero-description"><h4 style="margin-top:5px; text-align: center;"><a
                                        href="https://play.google.com/store/apps/details?id=com.dietitio.ediet&hl=en"><img class="" src="images/home/google-play.png" alt="ediet Android App"
                                         height="auto" width="95px"></a><a href="https://apps.apple.com/in/app/e-diet-formerly-dietitio/id1465083090"><img
                                            class="graf" src="images/home/app-store.png" alt="ediet Ios App"
                                            height="auto" width="95px"></a></h4></div><br><br><h5 style="color:#28340a;">** PLEASE USE SAME PHONE NUMBER FOR LOGIN IN MOBILE APP **</h5></div></div></div><div class="modal-footer" style="background-color: white"></div></div></div></div></div><div class="modal fade" id="couponModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true"><div class="modal-dialog modal-sm" role="document"><div class="modal-content"><div class="modal-header"><h6 class="modal-title" id="modal-title-notification">Apply Promo Code</h6><button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#coupon_error').html('');
                        $('#coupon_code').val('');"><span aria-hidden="true">×</span></button></div><div class="modal-body"><form id="couponForm"><div class="form-group"><div class="form-group" style="display: flex"><input class="form-control form-control-sm"
                                       name="promo_code"
                                       placeholder="promo code.."
                                       id="coupon_code" style="margin: 0; text-transform: uppercase"
                                       data-box=""
                                       required

                                /><button type="submit"
                                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing Order"
                                        class="btn"
                                        id="apply_coupon"
                                        style="cursor:pointer;
                                        margin-left: 10px;
                                        background-color: #2aa07d;
                                     color: white;">apply
                                </button><input type="hidden" name="csrfmiddlewaretoken" value="DK28QU60CFiTH7Xw19HuiLL7PiNMZZAA1Pv5CljfWJ0sMruPpTIkxmBOxudCWxIn"></div><input type="hidden" name="programId" value="490" id="programId" required><input type="hidden" name="duration" value="" id="pg_duration" required><div id="coupon_error" style="text-align: center; color: red; font-size: 10px;"></div></div></form></div></div></div></div>


    <footer class="main-footer">
        <div class="auto-container">

            <!--Widgets Section-->
            <div class="pad" style="padding-bottom: 0px !important;">
                <div class="row clearfix">
                    <div class="col-md-4 footer-column">
                        <div class="footer-widget links-widget">
                            <h2>Quick Links</h2>
                            <div class="widget-content">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <ul class="list">
                                            <li><a href="about.html">About Us</a></li>
                                            <li><a href="contact.html">Contact Us</a></li>
                                            <li><a href="services.html">Services</a></li>
                                            <li><a href="Privacy-Security.html">Privacy & Security</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <ul class="list">
                                            <li><a href="index.html">Home</a></li>
                                            <li><a href="Refund-Policy.html">Refund Policy</a></li>
                                            <li><a href="Disclaimer.html">Disclaimer</a></li>
                                            <li><a href="Terms-of-Service.html">Terms Of Service</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 footer-column">
                        <div class="footer-widget contact-widget">
                            <h2>Contact Us</h2>
                            <div class="widget-content">
                                <ul class="contact-info">
                                    <li><span
                                            class="icon flaticon-telephone-1"></span><strong>Phone:</strong>
                                        +91-9899199767
                                    </li>
                                    <li><span
                                            class="icon flaticon-interface-4"></span><strong>Email:</strong>
                                        withoutguilteat@gmail.com
                                    </li>
                                    <li><span
                                            class="icon flaticon-location"></span><strong>Address:</strong>
                                        B-15 bhagwan das nagar east punjabi bagh, Bhagwan das naga
                                        , New Delhi, Delhi
                                        , India ,110026
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 footer-column">
                        <div class="footer-widget contact-widget">
                            <img src="images/footer.png" alt="Eat Without Guilt">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!--Footer Bottom-->
        <div class="footer-bottom">
            <div class="auto-container">
                <div class="clearfix">
                    <div class="pull-left">
                        <div class="copyright">&copy; 2020 Powered by <a
                                href="https://www.zoconut.com" class="author-name" target="_blank"><img
                                src="images/home/png.webp" class="fl" alt="Zoconut"></a></div>
                    </div>
                    <div class="pull-right">
                        <ul class="footer-social">
                            <li>
                                <a href="https://www.facebook.com/EAT-without-GUILT-103521464681387/"><span
                                        class="fa fa-facebook-f"></span></a></li>
                            <li><a href="None"><span class="fa fa-twitter"></span></a>
                            </li>
                            <li><a href="None"><span
                                    class="fa fa-youtube"></span></a></li>
                            <li><a href="https://www.instagram.com/invites/contact/?i=1e6c1eu3tl84h&amp;utm_content=4zzkwy0"><span
                                    class="fa fa-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>
<!--End pagewrapper-->


<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target=".main-header"><span class="fa  fa-angle-up"></span></div>
<input type="hidden" name="csrfmiddlewaretoken" value="DK28QU60CFiTH7Xw19HuiLL7PiNMZZAA1Pv5CljfWJ0sMruPpTIkxmBOxudCWxIn">


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
                                        href="https://play.google.com/store/apps/details?id=com.dietitio.ediet&hl=en">
                                    <img class="" src="images/home/google-play.png" alt="ediet Android App"
                                         height="auto" width="95px"></a>
                                    <a href="https://apps.apple.com/in/app/e-diet-formerly-dietitio/id1465083090"> <img
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
                            <input type="hidden" name="csrfmiddlewaretoken" value="DK28QU60CFiTH7Xw19HuiLL7PiNMZZAA1Pv5CljfWJ0sMruPpTIkxmBOxudCWxIn">
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
                            <input type="hidden" name="csrfmiddlewaretoken" value="DK28QU60CFiTH7Xw19HuiLL7PiNMZZAA1Pv5CljfWJ0sMruPpTIkxmBOxudCWxIn">
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
                                    <option val="">Gender*</option>
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

                    <a href="https://play.google.com/store/apps/details?id=com.dietitio.ediet&amp;hl=en"><img
                            class="" src="images/home/google-play.png" alt="ediet Android App" height="35"
                            width="100"></a>
                    <a href="https://apps.apple.com/in/app/e-diet-formerly-dietitio/id1465083090"><img class=""
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
    <script type='text/javascript'>
        var p_name = "pregnancy and lactation "
        var p_id = "490"
        var csrf_token = $("input[type='hidden'][name='csrfmiddlewaretoken']").val();
        var is_authenticate = 'False'
    </script>
    <script src="static/js/payment.js"></script>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</body>
</html>