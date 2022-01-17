<!-- Page JS Plugins -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

<!-- toastr -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- sweetalert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- captha -->
<script src="<?= base_url('assets/plugin/jquery-captcha.min.js') ?>"></script>

<script>
    const URL = "<?= base_url() ?>";

    const captcha = new Captcha($('#canvas'), {
        length: 5,
        caseSensitive: true,
        clickRefresh:true,
    });

    var validation_tambah = function() {
        var validation_tambah = function() {
            jQuery('.js-validation-signin').validate({
                errorClass: 'invalid-feedback animate__animated animate__fadeInDown',
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    jQuery(e).parents('.form-group').append(error);
                },
                highlight: function(e) {
                    jQuery(e).removeClass('is-invalid').addClass('is-invalid');
                },
                success: function(e, ee) {
                    jQuery(ee).removeClass('is-invalid');
                    jQuery(e).remove();
                },
                rules: {
                    'username': {
                        required: true,
                    },
                    'password': {
                        required: true,
                    }
                },
                messages: {
                    'username': {
                        required: 'Username tidak boleh kosong',
                    },
                    'password': {
                        required: 'Password tidak boleh kosong',
                    }
                }
            });

            $('#form_data').on('submit', function(e) {
                if ($(this).valid()) {
                    e.preventDefault();
                    var is_valid_captha = captcha.valid($('input[name="code"]').val());
                    if (is_valid_captha) {
                        submit_data(this);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Captha tidak sesuai',
                            timer: 1500,
                            showConfirmButton: false,
                        });
                    }
                }
            });

        };

        return {
            init: function() {
                validation_tambah();
            }
        };
    }();

    $(document).ready(function() {

        jQuery(function() {
            validation_tambah.init();
        });

    });

    function submit_data(data) {
        var data = new FormData(data);

        $.ajax({
            url: URL + 'login/auth',
            type: "POST",
            data: data,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            beforeSend: function() {
                // console.log('sedang menghapus');
            },
            complete: function() {
                // console.log('Berhasil');
            },
            error: function(e) {
                console.log(e);
                toastr.error('gagal, terjadi kesalahan', {
                    timeOut: 1000,
                    fadeOut: 1000
                });
            },
            success: function(data) {
                if (data.status == 'success') {
                    toastr.success(data.msg);
                    setTimeout(() => {
                        location.replace(data.link);
                    }, 1000);
                } else {
                    toastr.error(data.msg);
                    $('input[name=password]').val('');
                }
            },
        });
    }
</script>