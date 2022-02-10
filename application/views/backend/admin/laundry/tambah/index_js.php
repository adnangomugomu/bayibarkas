<!-- choices -->
<!-- <link href="<?= base_url('assets/template/') ?>assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
<script src="<?= base_url('assets/template/') ?>assets/libs/choices.js/public/assets/scripts/choices.min.js"></script> -->

<script>
    $(document).ready(function() {

        // new Choices("#kelengkapan_barang", {
        //     removeItemButton: !0
        // });

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
        var data = new FormData(form);

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

    $('#select_jenis_barang').on('change', function() {
        var id = $(this).val();

        var data = new FormData();
        data.append('id', id);

        $.ajax({
            url: URL + 'get_kelengkapan_data',
            type: "POST",
            data: data,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            async: false,
            beforeSend: function() {},
            complete: function() {},
            error: function(e) {
                console.log(e);
                toastr.error('gagal, terjadi kesalahan');
            },
            success: function(res) {
                if (res.status == 'success') {

                    $('#kelengkapan_barang').html('');
                    var html = '';
                    $.map(res.data.kelengkapan, function(e, i) {
                        html += `
                            <option data-biaya="${e.biaya}" value="${e.id}">${e.nama}</option>
                        `;
                    });
                    $('#kelengkapan_barang').html(html);

                    $('#checkbox_jenis_laundry').html('');
                    var html = '';
                    $.map(res.data.jenisLaundry, function(e, i) {
                        html += `
                            <div class="form-check">
                                <input type="checkbox" name="jenis_laundry[]" value="${e.id}" class="form-check-input" id="${'jenis_'+i}">
                                <label class="form-check-label" for="${'jenis_'+i}">${e.jenis +' - '+ formatRupiah(e.biaya)}</label>
                            </div>
                        `;
                    });
                    $('#checkbox_jenis_laundry').html(html);

                    $('#radio_estimasi_penanganan').html('');
                    var html = '';
                    $.map(res.data.jenisPenanganan, function(e, i) {
                        html += `
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="estimasi_penanganan" value="${e.id}" id="${'estimasi_'+i}">
                                <label class="form-check-label" for="${'estimasi_'+i}">
                                    ${e.jenis +' - '+ formatRupiah(e.biaya)}
                                </label>
                            </div>
                        `;
                    });
                    $('#radio_estimasi_penanganan').html(html);
                }
            },
        });
    });

    $('#kelengkapan_barang').on('change', function() {
        var total = 0;
        $('#kelengkapan_barang option:selected').each(function() {
            var val = $(this).data('biaya');
            total += val;
        });
        console.log(total);
    });
</script>