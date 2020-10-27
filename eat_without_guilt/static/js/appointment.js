/**
 * Created by ashish on 26/5/20.
 */

let calander;
let modal = $('#book_appoint');

$(function () {
    calander = $('#datetimepicker12');
    calander.datetimepicker({
        inline: true,
        sideBySide: true,
        format: 'DD-MM-YYYY',
        minDate: new Date()

    }).on("dp.change", function (e) {
        fetch_slots(e);
        $('#date_').val(e.date.date() + '-' +( e.date.month() + 1) + '-' + e.date.year())
    });
    calander.data("DateTimePicker").date(new Date());

});


$('#book_btn').click(function () {


    if (is_authenticate === "False") {
        openNav();
        display_message("REGISTER FIRST TO PROCEED !");
    }
    else  if (is_lead === "True"){
        openNav();
        display_message("PLEASE FILL THE INFO !");
    }
    else {
        calander.data("DateTimePicker").date(new Date());
        modal.modal('show');
    }
});

function fetch_slots(e) {
    // let dateStr = format_date(e.date);

    // if (dateStr !== "") {

    let start = format_date(start_date(e));
    let end = format_date(end_date(e));
    let ul = $('#slot_container');
    ul.html("");
    $.ajax({
        url: '/clients/appointment/',
        type: 'GET',
        data: {'start': start, 'end': end},
        success: function (r) {
            let response = r.res;
            if (response) {
                let slots = r.data;
                if (r.data) {
                    for (let i = 0; i < r.data.length; i++) {
                        if (slots[i]['status']) {
                            ul.append('<li class="slots col-md-2 col-sm-5 col-xs-5"> ' +
                                '<input type="radio" name="slots" required value="'+ slots[i]['slot'] +'"> ' +
                                '<label class="m-0 font-medium " >' + parse_back(slots[i]['slot']) + '</label> </li>');
                        }
                    }


                }
            } else {
                alert(r.msg)
            }
        },
        error: function () {

        }
    })
    // }
}

function format_date(d) {
    return d.getUTCDate() + '-' + d.getUTCMonth() + '-' + d.getUTCFullYear() + ' ' + d.getUTCHours() + ':' + d.getUTCMinutes();
}

function start_date(e) {
    return new Date(Date.UTC(e.date._d.getFullYear(),  e.date._d.getMonth() + 1 , e.date._d.getDate(),
        0, 0, 0));
}

function end_date(e) {
    return new Date(Date.UTC(e.date._d.getFullYear(), e.date._d.getMonth() + 1, e.date._d.getDate(),
        23, 59, 0));
}

function parse_back(date_str) {
    let options = {
        hour: 'numeric',
        minute: 'numeric',
        hour12: true
    };
    let date = new Date(date_str);
    return date.toLocaleString('en-US', options);
}


$('#appointmentForm').on('submit', function(e){
   let form_ = $(this);
    e.preventDefault();
    let overlay = $('#overlay');
    overlay.show();
    $.ajax({
        url: '/clients/appointment/',
        type: 'POST',
        data: $(this).serialize() + '&'+$.param({ 'is_lead': is_lead }),
        success: function(r){
            overlay.hide();
            let response = r.res;
            if(response){
                alert("Appointment Booked Successfully");
                form_.trigger('reset');
                modal.modal('hide');
            }else{
                alert(r.msg);
            }

        },
        error: function(err){
            overlay.hide();
            alert(err);
        }
    })




});