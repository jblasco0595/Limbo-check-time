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
                label: 'Confirmar',
                className: 'btn-warning'
            },
            cancel: {
                label: 'Cancelar',
                className: 'btn-secondary'
            }
        },
        message: msg,
        callback: function(result) {
            if (result == true)
            {
                $('#'+form).submit()
            }
        },
    });
})
