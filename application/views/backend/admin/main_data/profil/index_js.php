<script>
    $('#tombol_batal').on('click', function(e) {
        e.preventDefault();
        var link = BASE_URL + 'backend/admin/dashboard';
        window.open(link, '_self');
    });
</script>

<script>
    var validation_ubah = function() {
        var validation_ubah = function() {
            jQuery('#form_data').validate({
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
                    'nama': {
                        required: true,
                        minlength: 5,
                    },
                    'username_data': {
                        required: true,
                        minlength: 5,
                    },
                    'password_data': {
                        minlength: 5,
                    },
                    'konfirmasi_password': {
                        minlength: 5,
                        equalTo: "#password"
                    },
                },
                messages: {
                    'nama': PESAN,
                    'username_data': PESAN,
                    'password_data': PESAN,
                    'konfirmasi_password': PESAN,
                }
            });

            $('#form_data').on('submit', function(e) {
                if ($(this).valid()) {
                    e.preventDefault();
                    submit_data(this);
                }
            });

        };

        return {
            init: function() {
                validation_ubah();
            }
        };
    }();

    $(document).ready(function() {

        jQuery(function() {
            validation_ubah.init();
        });

    });
</script>

<script>
    function submit_data(form) {
        var data = new FormData(form);

        $.ajax({
            url: URL + 'update_profil',
            type: "POST",
            data: data,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#form_data button[type=submit]').prop('disabled', true);
            },
            complete: function() {
                // console.log('Berhasil');
                $('#form_data button[type=submit]').prop('disabled', false);
            },
            error: function(e) {
                console.log(e);
                toastr.error('gagal, terjadi kesalahan');
                $('#form_data button[type=submit]').prop('disabled', false);
            },
            success: function(data) {
                if (data.status == 'success') {
                    toastr.success(data.msg);

                    setTimeout(() => {
                        location.reload();
                    }, 1500);

                } else {
                    toastr.error(data.msg);
                }
            },
        });
    }
</script>