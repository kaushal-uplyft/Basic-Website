<?php include 'config.php' ?>

<?php include 'register.php' ?>


<div class="page-wrapper">

<!--    <div class="preloader"></div>-->
    <!-- Main Header-->
    <header class="main-header">
        <!-- Header Top -->
        <div class="header-top">


            <!-- The Static Socail Links on Left -->

            <div class="callimg">
                <a href="tel: <?php echo $mobile ?> ">
                     <img src="images/home/strip.png" alt="yourdigitallift">
<!--                    <img src="/static/images/strip.png" alt="yourdigitallift">-->
                </a>


            </div>


            <div class="footer-social-links side-social-links hidden-sm">
                <ul style="list-style: none;">
                    <li id="bar" style="display: block; margin: 3px 0px;"><a
                            href="<?php echo $fb_url ?>" target="_blank"><i
                            style="color: #343f19" class="fa fa-facebook hvr-pulse" data-toggle="facebook"
                            data-placement="right" title="Tooltip on right"></i></a></li>
                    <li id="bar" style="display: block; margin: 3px 0px;">
                        <a href="<?php echo $andriod_app_url ?>" target="_blank">
                            <i style="color: #343f19" class="fa fa-android hvr-pulse"></i>
                        </a>
                    </li>
                    <li id="bar" style="display: block; margin: 3px 0px;">
                        <a href="<?php echo $insta_url ?>" target="_blank">
                            <i style="color: #343f19" class="fa fa-instagram hvr-pulse"></i>
                        </a>
                    </li>
                    <li id="bar" style="display: block; margin: 3px 0px;" class="whats-num">
                        <a href="<?php echo $whatsapp_url ?>" target="_blank">
                            <i style="color: #343f19;" class="fa fa-whatsapp"></i>
                        </a>
                    </li>
                    <li id="bar" style="display: block; margin: 3px 0px;">
                        <a href="<?php echo $youtube_url ?>">
                            <i style="color: #343f19;" class="fa fa-youtube">
                            </i>
                        </a>
                    </li>

                </ul>

            </div>

            <!-- Main Box -->
            <div class="main-box">
                <div class="auto-container">
                    <div class="outer-container clearfix">
                        <!--Logo Box-->
                        <div class="logo-box">
                            <div class="logo"><a href="index.html">
                                <img src="images/home/home_1.png" style="height: 50px!important;" alt="yourdigitallift"> </a>
                            </div>
                        </div>
                        <!--Nav Outer-->
                        <div class="nav-outer clearfix">
                            <!-- Main Menu -->
                            <nav class="main-menu">
                                <div class="navbar-header">
                                    <!-- Toggle Button -->
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>

                                <div class="navbar-collapse collapse clearfix">
                                    <ul class="navigation clearfix">
                                        <li><a href="index.php" class="<?php if($active_link=='home'){echo 'active';}?>" >Home</a></li>
                                        <li><a href="about.php" class="<?php if($active_link=='about'){echo 'active';}?>" >About Us</a></li>

                                        <li><a href="testimonial.php" class="<?php if($active_link=='testimonial'){echo 'active';}?>" >Success Stories</a></li>

                                        <!-- <li class="dropdown"><a href="/" class="<?php // if($active_link=='weight_loss' or $active_link=='weight_gain' or $active_link=='pco' or $active_link=='child_nutri' or $active_link=='thyroid' or $active_link=='diabetes' ){echo 'active';} ?>" >Services</a>
                                            <ul id="fellow">
                                                    <li>
                                                            <a href="weight_loss.php" class="<?php // if($active_link=='weight_loss'){echo 'active';} ?>" >Weight Loss Program
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="weight_gain.php" class="<?php // if($active_link=='weight_gain'){echo 'active';}?>" >Weight Gain Program
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="pco.php" class="<?php // if($active_link=='pco'){echo 'active';}?>" >Pcod/Pcos
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="child_nutri.php" class="<?php // if($active_link=='child_nutri'){echo 'active';}?>" >Child Nutrition
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="thyroid.php" class="<?php // if($active_link=='thyroid'){echo 'active';}?>" >Thyroid Disorder
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="diabetes.php" class="<?php // if($active_link=='diabetes'){echo 'active';}?>" >Diabetes Management
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="cholesterol.php" class="<?php // if($active_link=='cholesterol'){echo 'active';}?>" >High Lipid And Cholesterol
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="pregnancy_lactation.php" class="<?php // if($active_link=='pregnancy'){echo 'active';}?>" >Pregnancy And Lactation
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="hypertension_diet.php" class="<?php // if($active_link=='hypertension'){echo 'active';}?>" >Hypertension Diet
                                                        </a>
                                                    </li>

                                            </ul>
                                        </li> -->
                                        <!-- <li><a href="blogs_health.php" class="<?php // if($active_link=='blogs'){echo 'active';}?>" >Health Feed</a></li> -->
                                        <li><a href="contact.php" class="<?php if($active_link=='contact'){echo 'active';}?>">Contact</a></li>
                                        <!-- <li class="before_login">
                                            <button href="#" onclick="openNav()"  class="theme-btn btn-style-three text-white" style="padding: 7px 12px;border: 2px solid white  !important;">
                                                Register
                                            </button>
                                        </li> -->
                                        <li><a href="ready_dashboard/user_verify.php" class="<?php if($active_link=='about'){echo 'active';}?>" > Register </a></li>
                                        <li class="dropdown after_login"
                                            style="display: none" >
                                            <a href="/">Hi, <span class="name"></span></a>
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
                            <button class="hidden-bar-opener">
                                <span class="icon fa fa-bars"></span>
                            </button>
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
            <button class="btn">
                <i class="fa fa-close"></i>
            </button>
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
                    <li><a href="index.php" class="<?php if($active_link=='home'){echo 'active';}?>" >Home</a></li>
                    <li><a href="about.php" class="<?php if($active_link=='about'){echo 'active';}?>" >About Us</a></li>
                    <li><a href="testimonial.php" class="<?php if($active_link=='testimonial'){echo 'active';}?>" >Success Stories</a></li>
                    <!-- <li class="dropdown"><a href="#" class="<?php // if($active_link=='weight_loss' or $active_link=='weight_gain' or $active_link=='pco' or $active_link=='child_nutri' or $active_link=='thyroid' or $active_link=='diabetes' ){echo 'active';} ?>" >Services</a>
                        <ul>
                            <ul>
                                    <li class="bg-custom text-black">
                                        <a href="weight_loss.php" class="<?php // if($active_link=='weight_loss'){echo 'active';} ?>"
                                           class="text-black">Weight Loss Program
                                        </a>
                                    </li>

                                    <li class="bg-custom text-black">
                                        <a href="weight_gain.php" class="<?php // if($active_link=='weight_gain'){echo 'active';}?>"
                                           class="text-black">Weight Gain Program
                                        </a>
                                    </li>


                                    <li class="bg-custom text-black">
                                        <a href="pco.php" class="<?php // if($active_link=='pco'){echo 'active';}?>"
                                           class="text-black">Pcod/Pcos
                                        </a>
                                    </li>

                                    <li class="bg-custom text-black">
                                        <a href="child_nutri.php" class="<?php // if($active_link=='child_nutri'){echo 'active';}?>"
                                           class="text-black">Child Nutrition
                                        </a>
                                    </li>

                                    <li class="bg-custom text-black">
                                        <a href="Thyroid-Disorder.html" class="<?php // if($active_link=='thyroid'){echo 'active';}?>"
                                           class="text-black">Thyroid Disorder
                                        </a>
                                    </li>

                                    <li class="bg-custom text-black">
                                        <a href="diabetes.php" class="<?php // if($active_link=='diabetes'){echo 'active';}?>"
                                           class="text-black">Diabetes Management
                                        </a>
                                    </li>

                                    <li class="bg-custom text-black">
                                        <a href="cholesterol.php" class="<?php // if($active_link=='cholesterol'){echo 'active';}?>"
                                           class="text-black">High Lipid And Cholesterol
                                        </a>
                                    </li>

                                    <li class="bg-custom text-black">
                                        <a href="pregnancy_lactation.php" class="<?php // if($active_link=='pregnancy'){echo 'active';}?>"
                                           class="text-black">Pregnancy And Lactation
                                        </a>
                                    </li>

                                    <li class="bg-custom text-black">
                                        <a href="hypertension_diet.php" class="<?php // if($active_link=='hypertension'){echo 'active';}?>"
                                           class="text-black">Hypertension Diet
                                        </a>
                                    </li>
                            </ul>
                        </ul>
                        </li> -->
                    <!-- <li><a href="blogs_health.php" class="<?php //if($active_link=='blogs'){echo 'active';}?>">Health Feed</a></li> -->
                    <li><a href="testimonial.php" class="<?php if($active_link=='testimonial'){echo 'active';}?>">Success Stories</a></li>

                    <li><a href="contact.php" class="<?php if($active_link=='contact'){echo 'active';}?>">Contact</a></li>
                    <!-- <li class="before_login" >
                        <button href="#" onclick="openNav()" class="theme-btn btn-style-three text-white"
                                style="padding: 7px 12px;border: 2px solid white  !important;">Register
                        </button>
                    </li> -->
                    <li><a href="ready_dashboard/user_verify.php" class="<?php if($active_link=='about'){echo 'active';}?>" > Register </a></li>
                    <li class="dropdown after_login"
                        style="display: none" ><a href="/">Hi, <span
                            class="name"></span></a>
                        <ul id="fellow">

                            <li>
                                <a href="clients/logout.html">Logout
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
