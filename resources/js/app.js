require('./bootstrap');

window.moment = require('moment');
window.bootbox = require('bootbox');
window.momentDurationFormatSetup = require("moment-duration-format");

import 'jquery-datetimepicker/build/jquery.datetimepicker.full';

// listener to use bootbox confirm
$(document).on('click', '.bootBoxConfirm', function(){
    let msg = $(this).data('msg');
    let form = $(this).data('form');
    bootbox.confirm({
        buttons: {
            confirm: {
                label: 'Confirm',
                className: 'btn-danger'
            },
            cancel: {
                label: 'Cancel',
                className: 'btn-default'
            }
        },
        message: msg,
        callback: function(result) {
            if (result == true)
            {
                console.log(form)
                $(form).submit()
            }
        },
    });
})
