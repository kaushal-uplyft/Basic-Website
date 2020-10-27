/**
 * Created by ballkeeratsingh on 21/12/19.
 */


if (is_authenticate === 'False') {
    $(".partial_info").hide();
}
$(".alert").hide()
$("#user_otp_div").hide();


var otp_div = $("#user_otp_div")

var enableSubmit = function (id) {
    $(id).prop('disabled', false);
};

setTimeout(function () {
    $('#client_status').modal('hide');
}, 1000);

$(".verfy_otp").click(function (event) {
    event.preventDefault();

    var phone_status = true;
    var ccode = $("select[name='ccode']").val();
    var phone = $("#user_phone").val();

    // Check for the empty country code and phone length
    if (ccode.length === 0 || phone.length === 0) {
        display_message("Invalid Phone Number or Country Code");
        phone_status = false;
        return;
    }

    $(".verfy_otp").prop('disabled', true);

    if (phone_status) {
        $("#overlay").show();
        $.ajax(
            {
                type: 'GET',
                url: '/clients/number/',
                data: {
                    'c_code': ccode,
                    'phone': phone,
                },
                success: function (result) {
                    if (result['status'] === "1") {
                        // window.location.reload();
                        otp_div.show('slow');
                        $('.verfy_otp').hide();
                        $("#country_code").prop('disabled', true);
                        $("#user_phone").prop('disabled', true);
                        $("#overlay").hide();
                    }
                    else {
                        $("#overlay").hide();
                        display_message(result['message']);
                    }
                }
            });
    }
    else {

        return;
    }
});

$(".verfy_otp_1").click(function (event) {
    event.preventDefault();
    var otp = $("#user_otp");
    var phone = $("#user_phone").val();

    if (otp.val().length !== 6) {
        display_message("Invalid OTP");
        return;
    }

    if (phone.length === 0) {
        display_message("Invalid Phone Number");
        return;
    }
    $("#overlay").show();

    $.ajax(
        {
            type: 'POST',
            url: '/clients/number/',
            dataType: 'json',
            data: {
                'phone': phone,
                'otp_': otp.val(),
                'csrfmiddlewaretoken': $("input[type='hidden'][name='csrfmiddlewaretoken']").val()
            },
            success: function (result) {
                if (result['status'] === "1") {
                    // set authenticate variable true
                    is_authenticate = "True";

                    // hide the otp div
                    otp_div.hide('slow');
                    otp.val('');
                    window.location.reload();

                    // Change drop down value
                    $(".before_login").hide();
                    $(".after_login").show();
                    $(".name").text(result.data.f_name);

                    // the value fetched from the api to the fields and show the partial info div
                    // if ('data' in result || result.data.client_stage !== 0) {
                    //     $("input[name='firstname']").val(result.data.f_name);
                    //     $("input[name='lastname']").val(result.data.l_name);
                    //     $('#usergender').find("option[value='" + result.data.gender + "']").attr('selected', 'selected');
                    // }
                    $(".partial_info").fadeIn(2000);
                    $("#overlay").hide();

                    if (result.data.client_stage !== 0) {
                        // client is not the new user
                        is_lead = result.data.is_lead; // if the is_lead is false the basic info is filled else not

                        if (result.data.client_stage === 1) {

                            // Basic info not filled ask the client to fill the information first
                            display_message('PLEASE FILL YOUR INFO !');
                        }
                        else {
                            var back_ = result['pay_button'];
                            $(".register_button").css('display', 'none');
                            closeNav();

                            //check for the back_ url to initate the payment client selected before the login
                            if (back_.length > 0) {
                                $(".price_listing").find(".pricing-column").each(function () {
                                    var price = $(this).find(".pay_btn").data('price');
                                    if (price.toString() === back_) {
                                        $(this).find(".pay_btn").trigger('click');
                                        return false;
                                    }
                                });
                            }
                        }
                    }
                }
                else {
                    $("#overlay").hide();
                    display_message(result['message']);
                }
            }
        });
    return false;
});

$("#form_register").on("submit", function (e) {
    e.preventDefault();
    var formData = $(this).serialize() + "&phone=" + $("#user_phone").val();
    $("#overlay").show();
    $.ajax(
        {
            type: 'post',
            url: '/clients/save_partial/',
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            dataType: 'json',
            success: function (result) {
                if (result['status'] === "1") {
                    window.location.reload();
                    $("#overlay").hide();
                    is_lead = false;
                    var back_ = result['pay_button'];
                    $(".name").text($("input[name='firstname']").val());
                    closeNav();
                    if (back_.length > 0) {

                        $(".price_listing").find(".pricing-column").each(function () {
                            var price = $(this).find(".pay_btn").data('price');
                            if (price.toString() === back_) {
                                $(this).find(".pay_btn").trigger('click');
                                return false;
                            }
                        });
                    }
                }
                else {
                    display_message("Something Went Wrong")
                    $("#overlay").hide();
                }
            }
        });
});

function display_message(message) {
    $('.message').text(message);
    $('.alert').fadeIn('slow').animate({opacity: 1.0}, 1500).fadeOut('slow');
}