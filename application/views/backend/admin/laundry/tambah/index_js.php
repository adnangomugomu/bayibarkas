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
                    'metode_pembayaran': {
                        required: true,
                    },
                    'biaya': {
                        required: true,
                    },
                    'nama': {
                        required: true,
                    },
                    'no_hp': {
                        number: true,
                    },
                },
                messages: {
                    'metode_pembayaran': PESAN,
                    'biaya': PESAN,
                    'nama': PESAN,
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

        var metode_pembayaran = $('input[name=metode_pembayaran]:checked').val();
        var nama = $('input[name=nama]').val();
        var alamat = $('textarea[name=alamat]').val();
        var no_hp = $('input[name=no_hp]').val();
        var total_harga = $('input[name=total_harga]').val();
        var data_barang = [];

        $.map(tmp_generate, function(e, i) {
            var jenis_barang = $('.data_select_' + e).val();
            var kelengkapan = $('.data_kelengkapan_' + e).val();
            var estimasi_penanganan = $('.estimasi_penanganan_generate_' + e + ':checked').val();
            var sub_total = $('.data_sub_total_' + e).html();
            var biaya_servis = $('.data_servis_' + e).val();
            var jenis_laundry = [];

            $('input:checkbox.jenis_laundry_generate_' + e).each(function() {
                var val = (this.checked ? $(this).val() : '');
                if (val != '') jenis_laundry.push(val);
            });

            if (jenis_laundry.length == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Perhatian',
                    text: 'Jenis Laundry tidak boleh kosong !',
                    timer: 2000,
                    showConfirmButton: false,
                });
                throw '-';
            }

            var x = {
                jenis_barang: jenis_barang,
                kelengkapan: kelengkapan,
                estimasi_penanganan: estimasi_penanganan,
                jenis_laundry: jenis_laundry,
                biaya_servis: biaya_servis,
                sub_total: sub_total,
            };
            data_barang.push(x);
        });

        if (data_barang.length == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Perhatian',
                text: 'Data barang masih kosong !',
                timer: 2000,
                showConfirmButton: false,
            });
            throw '-';
        }

        var data = new FormData();
        data.append('metode_pembayaran', metode_pembayaran);
        data.append('nama', nama);
        data.append('alamat', alamat);
        data.append('no_hp', no_hp);
        data.append('total_harga', total_harga);
        data.append('data_barang', JSON.stringify(data_barang));

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

    function load_jenis_barang(class_data) {
        $.ajax({
            url: URL + 'jenis_barang',
            type: "POST",
            dataType: 'JSON',
            processData: false,
            contentType: false,
            error: function(e) {
                console.log(e);
                toastr.error('gagal, terjadi kesalahan');
            },
            success: function(res) {
                if (res.status == 'success') {

                    var html = ' <option value="">Pilih jenis barang</option>';
                    $.map(res.data, function(e, i) {
                        html += `
                            <option value="${e.id}">${e.nama}</option>
                        `;
                    });
                    $('.data_select_' + class_data).html(html);

                } else {
                    toastr.error(res.msg);
                }
            },
        });
    }

    function change_pilihan(data_generate) {
        var total = 0;

        $('.jenis_laundry_generate_' + data_generate + ':checked').each(function() {
            var val = $(this).data('biaya');
            total += val;
        });

        var estimasi = $('.estimasi_penanganan_generate_' + data_generate + ':checked').data('biaya');
        if (estimasi != undefined) total += estimasi;

        var biaya_servis = $('.data_servis_' + data_generate).val();
        biaya_servis = (biaya_servis == '' || biaya_servis == undefined ? 0 : parseInt(biaya_servis.replaceAll('.', '')));
        total += biaya_servis;

        var key = 'total_generate_' + data_generate;
        tmp_data_total[key] = total;

        total = formatRupiah(total.toString());
        $('.data_sub_total_' + data_generate).html(total);

        var row_total = 0;
        $.map(tmp_data_total, function(e, i) {
            row_total += e;
        });
        row_total = formatRupiah(row_total.toString());
        $('#total_harga').val(row_total);

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

    function removeItem(array, item) {
        for (var i in array) {
            if (array[i] == item) {
                array.splice(i, 1);
                break;
            }
        }
    }

    $('body').on('click', '.tombol_hapus_generate', function() {
        var data_generate = $(this).data('generate');

        $('.list_data_generate_' + data_generate).remove();
        change_pilihan(data_generate);

        var key = 'total_generate_' + data_generate;
        delete tmp_data_total[key];
        removeItem(tmp_generate, data_generate);

    });
</script>

<script>
    var count_generate = 0;
    var tmp_generate = [];
    var tmp_data_total = {};

    $('#tombol_tambah_barang').on('click', function(e) {
        count_generate++;
        tmp_generate.push(count_generate);

        var html = `
            <div class="col-md-12 list_data_generate_${count_generate}">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" data-generate="${count_generate}" class="btn btn-outline-danger btn-sm mb-1 float-end tombol_hapus_generate"><i class="bx bx-trash"></i> Hapus</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Jenis Barang</label>
                                    <div class="form-group">
                                        <select name="jenis_barang" data-generate="${count_generate}" class="js_select2 form-control data_select_${count_generate} select_jenis_barang">
                                            <option value="">Pilih jenis barang</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Kelengkapan Barang</label>
                                    <select data-placeholder="Pilih kelengkapan barang" data-generate="${count_generate}" class="form-control js_select2 data_kelengkapan_${count_generate} kelengkapan_barang" name="kelengkapan_barang[]" multiple></select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Jenis Laundry</label>
                                            <div data-generate="${count_generate}" class="form-group data_jenis_laundry_${count_generate} checkbox_jenis_laundry">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Estimasi Penanganan</label>
                                            <div data-generate="${count_generate}" class="form-group data_estimasi_${count_generate} radio_estimasi_penanganan">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                           </div>
                            <div class="col-md-6">
                           
                                <label class="form-label">Biaya Servis</label>
                                <input placeholder="biaya servis" data-generate="${count_generate}" class="form-control data_rupiah data_servis_${count_generate} servis_biaya"/>
                          
                                <p class="text-bold float-end">Sub Total Rp <span data-generate="${count_generate}" class="data_sub_total_${count_generate} sub_total">0</span> </p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        `;

        $('#list_data').append(html);
        load_jenis_barang(count_generate);

        $('.js_select2').select2({
            width: '100%'
        });

        $("html, body").animate({
            scrollTop: $(document).height()
        }, 200);
    });

    $('body').on('change', '.select_jenis_barang', function() {
        var id = $(this).val();
        var data_generate = $(this).data('generate');

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

                    $('.data_kelengkapan_' + data_generate).html('');
                    var html = '';
                    $.map(res.data.kelengkapan, function(e, i) {
                        html += `
                            <option data-generate="${data_generate}" value="${e.id}">${e.nama}</option>
                        `;
                    });
                    $('.data_kelengkapan_' + data_generate).html(html);

                    $('.data_jenis_laundry_' + data_generate).html('');
                    var html = '';
                    $.map(res.data.jenisLaundry, function(e, i) {
                        html += `
                            <div class="form-check">
                                <input data-generate="${data_generate}" type="checkbox" name="jenis_laundry[]" value="${e.id}" data-biaya="${e.biaya}" class="form-check-input jenis_laundry jenis_laundry_generate_${data_generate}" id="${'jenis_'+i+'_'+data_generate}">
                                <label class="form-check-label" for="${'jenis_'+i+'_'+data_generate}">${e.jenis +' - '+ formatRupiah(e.biaya)}</label>
                            </div>
                        `;
                    });
                    $('.data_jenis_laundry_' + data_generate).html(html);

                    $('.data_estimasi_' + data_generate).html('');
                    var html = '';
                    $.map(res.data.jenisPenanganan, function(e, i) {
                        html += `
                            <div class="form-check">
                                <input required data-generate="${data_generate}" class="form-check-input estimasi_penanganan estimasi_penanganan_generate_${data_generate}" data-biaya="${e.biaya}" type="radio" name="estimasi_penanganan_${data_generate}" value="${e.id}" id="${'estimasi_'+i+'_'+data_generate}">
                                <label class="form-check-label" for="${'estimasi_'+i+'_'+data_generate}">
                                    ${e.jenis +' - '+ formatRupiah(e.biaya)}
                                </label>
                            </div>
                        `;
                    });
                    $('.data_estimasi_' + data_generate).html(html);
                    $('.data_servis_' + data_generate).val('');
                    change_pilihan(data_generate);
                }
            },
        });
    });

    $('body').on('change', '.estimasi_penanganan', function() {
        var data_generate = $(this).data('generate');
        change_pilihan(data_generate);
    });

    $('body').on('change', '.jenis_laundry', function() {
        var data_generate = $(this).data('generate');
        change_pilihan(data_generate);
    });

    $('body').on('change', '.servis_biaya', function() {
        var data_generate = $(this).data('generate');
        change_pilihan(data_generate);
    });
</script>