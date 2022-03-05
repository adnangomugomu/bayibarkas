$(document).ready(function() {
    var mode = localStorage.getItem("type_mode");
    if (mode == 'dark') $('#mode-setting-btn').trigger('click');

});

// $(function() {
//     $(window).bind('load', function() {
//         var sidebar = localStorage.getItem("type_sidebar");
//         if (sidebar == 'mini') {
//             $('#vertical-menu-btn').trigger('click');
//         }
//     });
// });

const type_mode = {
    'mode': 'default',
    'sidebar': 'default',
};

$('#mode-setting-btn').on('click', function() {
    var type = type_mode.mode;
    if (type == 'default') {
        localStorage.setItem("type_mode", "dark");
        type_mode.mode = 'dark';
    } else {
        localStorage.setItem("type_mode", "default");
        type_mode.mode = 'default';
    }
});

$('#vertical-menu-btn').on('click', function() {
    var type = type_mode.sidebar;
    if (type == 'default') {
        localStorage.setItem("type_sidebar", "mini");
        type_mode.sidebar = 'mini';
    } else {
        localStorage.setItem("type_sidebar", "default");
        type_mode.sidebar = 'default';
    }
});

$('.js_select2').select2({
    width: '100%'
});

$.LoadingOverlaySetup({
    background: "rgba(0, 0, 0, 0.5)",
    image: BASE_URL + "uploads/img/loader.png",
    imageAnimation: "1s fadein",
    imageColor: "#ffcc00"
});

function loading(type = 'show', body = 'body') {
    if (type == 'show') {
        $(body).LoadingOverlay("show");
    } else {
        $(body).LoadingOverlay("hide");
    }
}

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": 300,
    "hideDuration": 1000,
    "timeOut": 5000,
    "extendedTimeOut": 1000,
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}


const PESAN = {
    required: "This field is required.",
    remote: "Please fix this field.",
    email: "Please enter a valid email address.",
    url: "Please enter a valid URL.",
    date: "Please enter a valid date.",
    dateISO: "Please enter a valid date (ISO).",
    number: "Please enter a valid number.",
    digits: "Please enter only digits.",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "Please enter the same value again.",
    accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
    minlength: jQuery.validator.format("Please enter at least {0} characters."),
    rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
    min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
};

function formatRupiah(angka) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return rupiah;
}

$('body').on('keyup', '.data_rupiah', function() {
    $(this).val(formatRupiah(this.value));
});