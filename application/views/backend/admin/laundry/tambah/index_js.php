<!-- datepicker -->
<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script>
    $('.datepicker').datepicker({
        dateFormat: 'dd-mm-yy',
        // minDate: 0,
    });

    $('#summernote').summernote({
        placeholder: 'Masukkan keterangan jika diperlukan',
        tabsize: 2,
        height: 300,
        toolbar: [
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['fullscreen', 'codeview']],
            ['help', ['help']]
        ],
    });
</script>

<script>
    var validation_tambah = function() {
        var validation_tambah = function() {
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
                    'jenis_laundry[]': {
                        required: true,
                    },
                    'estimasi_penanganan': {
                        required: true,
                    },
                    'metode_pembayaran': {
                        required: true,
                    },
                    'biaya': {
                        required: true,
                    },
                    'waktu': {
                        required: true,
                    },
                    'nama': {
                        required: true,
                    },
                    'merk': {
                        required: true,
                    },
                    'no_hp': {
                        number: true,
                    },
                },
                messages: {
                    'jenis_laundry': PESAN,
                    'estimasi_penanganan': PESAN,
                    'metode_pembayaran': PESAN,
                    'biaya': PESAN,
                    'waktu': PESAN,
                    'nama': PESAN,
                    'merk': PESAN,
                    'no_hp': PESAN,
                }
            });

            $('#form_data').on('submit', function(e) {
                if ($(this).valid()) {
                    e.preventDefault();

                    Swal.fire({
                        icon: 'question',
                        title: 'Apakah data sudah sesuai ?',
                        text: "data akan tersimpan kedalam sistem",
                        allowOutsideClick: false,
                        showCancelButton: true,
                        confirmButtonText: 'Konfirmasi',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                    }).then((result) => {
                        if (result.value) {
                            submit_data(this);
                        } else {
                            return false;
                        }
                    })

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
</script>

<script>
    function submit_data(form) {
        var keterangan = $('#summernote').summernote('code');
        var data = new FormData(form);
        data.append('keterangan', keterangan);

        $.ajax({
            url: URL + 'store',
            type: "POST",
            data: data,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#form_data button[type=submit]').prop('disabled', true);
                loading('show');
            },
            complete: function() {
                loading('hide');
                $('#form_data button[type=submit]').prop('disabled', false);
            },
            error: function(e) {
                console.log(e);
                toastr.error('gagal, terjadi kesalahan');
                $('#form_data button[type=submit]').prop('disabled', false);
                loading('hide');
            },
            success: function(res) {
                if (res.status == 'success') {
                    toastr.success(res.msg);

                    setTimeout(() => {
                        location.reload();
                    }, 1500);

                } else {
                    toastr.error(res.msg);
                }
            },
        });
    }
</script>

<script>
    $('#tombol_batal').on('click', function(e) {
        e.preventDefault();

        Swal.fire({
            icon: 'question',
            title: 'Tinggalkan halaman ?',
            text: "Data tidak tersimpan ke sistem",
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            reverseButtons: true,
        }).then((result) => {
            if (result.value) {

                history.go(-1);

            } else {
                return false;
            }
        })
    });
</script>