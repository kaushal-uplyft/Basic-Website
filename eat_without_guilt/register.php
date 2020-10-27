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
            <input type="hidden" name="csrfmiddlewaretoken" value="KbmkylJKCuixTnUuMP8NqB9gYDtVk1diL0uacnC5lmfnWaz0714dz9scGeD7I0l1">
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
            <input type="hidden" name="csrfmiddlewaretoken" value="KbmkylJKCuixTnUuMP8NqB9gYDtVk1diL0uacnC5lmfnWaz0714dz9scGeD7I0l1">

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
