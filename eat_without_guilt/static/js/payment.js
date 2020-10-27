/**
 * Created by ballkeeratsingh on 24/12/19.
 */

$('.alert').hide();

$('.pay_btn').on('click', function () {

    let payBtn = $(this);

    if (is_lead === "True") {
        openNav();
        display_message("PLEASE FILL THE INFO !");
        return 0;
    } else {
        get_details(payBtn);
    }


});

function get_details(payBtn) {
    let pay_obj = payBtn;
    let price_ = pay_obj.data('price');
    let price = pay_obj.prev("input").val();
    let duration = pay_obj.data('duration');
    let coupon_obj = $(document.getElementById("c_" + duration));
    let couponId = coupon_obj.val() !== undefined ? coupon_obj.val() : "0";
    let overlay = $('#overlay');

    overlay.show();
    $.ajax({
        url: '/raz_pay_details/',
        type: 'POST',
        data: {
            'price': price,
            'name': p_name,
            'p_btn': price_,
            'tag': coupon_obj.val() !== undefined ? coupon_obj.data('tag') : "",
            'duration': duration,
            'couponId': couponId,
            'claim': coupon_obj.val() !== undefined ? coupon_obj.data('claim') : "",
            'csrfmiddlewaretoken': $("input[type='hidden'][name='csrfmiddlewaretoken']").val()
        },
        success: function (d) {
            if (d.status === 1) {
                let options = d.options;
                options["handler"] = function (response) {
                    save_payment(response, d.amount, couponId, duration);
                };

                let rzp1 = new Razorpay(options);
                overlay.hide();
                rzp1.open();

            } else {
                overlay.hide();
                alert(d.message);
                if (d.hasOwnProperty('url')) {
                    openNav()
                }
            }
        },
        error: function (jqXHR, status, error) {
            overlay.hide();
             openNav()
        }
    });
}


function save_payment(response, amount, couponId, duration) {
    $.ajax({
        url: '/raz_pay_success/',
        type: 'POST',
        data: {
            'payment_id': response.razorpay_payment_id,
            'csrfmiddlewaretoken': csrf_token,
            'name': p_name,
            'id': p_id,
            'amount': amount,
            'is_lead': is_lead,
            'promoId': couponId,
            'duration': duration
        },
        success: function (d) {
            if (d.status === 1) {
                $('.message').text(d.message);
                $('.alert').fadeIn('slow').animate({opacity: 1.0}, 1500).fadeOut('slow');
                $("#exampleModals1").modal("show");
            }
            else {
                $('.message').text(d.message);
                $('.alert').fadeIn('slow').animate({opacity: 1.0}, 1500).fadeOut('slow');
            }
        }
    });

}

$('.hvCpn').on('click', function () {
    if (is_authenticate === "False") {
        openNav();
        display_message("PLEASE FILL THE INFO !");
        return 0;
    }
    else {
        let payBtn = $(this).prev();
        let thisID = $(this).attr('id');
        let modal = $('#couponModal');
        let duration = payBtn.data('duration');
        modal.find('#coupon_code').attr('data-id', '');
        modal.find('#coupon_code').attr('data-box', thisID);
        modal.find('#pg_duration').val(duration);
        modal.modal('show');
    }

});


$('#couponForm').on('submit', function (e) {

    e.preventDefault();
    let formData = $(this).serialize();
    let coupon_error = $('#coupon_error');
    let box_id = '#' + $('#coupon_code').data('box');
    let data_box = $(box_id);
    coupon_error.html("");

    $('#overlay').show();
    $.ajax({
        url: '/services/validate_coupon/',
        type: 'post',
        data: formData,
        success: function (r) {
            $('#overlay').hide();
            if (r.res === 1) {
                coupon_error.html(r.msg);
                coupon_error.css({"color": "green"});
                data_box.next().css({'display': 'block'});
                data_box.css({'display': 'None'});
                create_div($('#pg_duration').val(), r, data_box);
                $('#couponModal').modal('hide');
            } else {
                coupon_error.css({"color": "red"});
                coupon_error.html(r.msg);
            }
        }
    });

});


function create_div(duration, r, data_box) {

    var input = document.createElement("input");
    input.setAttribute('type', 'hidden');
    input.setAttribute('id', 'c_' + duration);
    input.setAttribute('value', r.promoId);
    input.setAttribute('data-tag', r.tag);
    input.setAttribute('data-claim', r.claim);
    input.setAttribute('data-duration', duration);
    $('body').append(input);

    let amount = parseInt($(data_box.prev()).data('price'));
    let prev_amount = amount;
    if (r.tag === 1) {
        amount -= parseInt(r.claim)
    } else {
        amount -= (amount * r.claim) / 100
    }
    let price_box = $(data_box.parent().parent().prev()).find('.price');
    price_box.find('span:last-child').html('<s> ' + prev_amount + '</s>');
    price_box.append('<span> ' + amount + ' </span>')
}