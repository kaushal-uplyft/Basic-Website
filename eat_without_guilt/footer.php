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
                                        <li><a href="about.php">About Us</a></li>
                                        <li><a href="contact.php">Contact Us</a></li>
                                        <!-- <li><a href="Privacy-Security.html">Privacy & Security</a></li> -->
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <ul class="list">
                                        <li><a href="index.php">Home</a></li>
                                        <li><a href="services.php">Services</a></li>
                                        <!-- <li><a href="Refund-Policy.html">Refund Policy</a></li> -->
                                        <!-- <li><a href="Disclaimer.html">Disclaimer</a></li> -->
                                        <!-- <li><a href="Terms-of-Service.html">Terms Of Service</a></li> -->
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
                                    <?php echo $mobile_show ?>
                                </li>
                                <li><span
                                        class="icon flaticon-interface-4"></span><strong>Email:</strong>
                                    <?php echo $email ?>
                                </li>
                                <li><span
                                        class="icon flaticon-location"></span><strong>Address:</strong>
                                    <?php echo $address ?>
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
                            href="https://www.yourdigitallift.com/" class="author-name" target="_blank"><img
                            src="https://www.yourdigitallift.com/static/new_frontend/images/website-logo.png" class="fl" alt="<?php echo $domain_name ?>"></a> &nbsp; Yourdigitallift </div>
                </div>
                <div class="pull-right">
                    <ul class="footer-social">
                        <li>
                            <a href="<?php echo $fb_url ?>"><span
                                    class="fa fa-facebook-f"></span></a></li>
                        <li><a href="<?php echo $andriod_app_url ?>"><span class="fa fa-android"></span></a>
                        </li>
                        <li><a href="<?php echo $youtube_url ?>"><span
                                class="fa fa-youtube"></span></a></li>
                        <li><a href="<?php echo $insta_url ?>"><span
                                class="fa fa-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--End pagewrapper-->
