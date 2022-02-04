<!-- datepicker -->
<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(document).ready(function() {
        load_table();

        $('.datepicker').datepicker({
            dateFormat: 'dd-mm-yy',
            // minDate: 0,
        });
    });
</script>

<script>
    function load_table() {
        $('#table_data').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ordering: true,
            autoWidth: false,
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            ajax: {
                url: URL + 'get_data',
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function() {

                },
                complete: function(e) {},
                error: function(e) {},
                data: {

                }
            },
            drawCallback: function(res) {

            },
            order: [],
            columnDefs: [{
                    targets: [0, -1],
                    className: 'text-center'
                },
                {
                    targets: [6],
                    className: 'text-end'
                },
                {
                    targets: [0, -1],
                    orderable: false,
                }
            ],
        })

    }
</script>

<script>
    var validation_tambah = function() {
        var validation_tambah = function() {
            jQuery('#form_status_tambah_data').validate({
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
                    'status_data': {
                        required: true,
                    },
                    'waktu': {
                        required: true,
                    },
                },
                messages: {
                    'status_data': PESAN,
                    'waktu': PESAN,
                }
            });

            $('#form_status_tambah_data').on('submit', function(e) {
                if ($(this).valid()) {
                    e.preventDefault();
                    submit_data(this);
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
    $('#table_data tbody').on('click', '.tombol_hapus', function(e) {
        e.preventDefault();
        hapus_data(this);
    });

    $('#table_data tbody').on('click', '.tombol_ubah', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        window.open(BASE_URL + 'backend/admin/laundry/edit/index/' + id, '_self');
    });

    $('#table_data tbody').on('click', '.tombol_status', function(e) {
        e.preventDefault();
        var kode = $(this).data('kode');
        $('.title_kode').html(kode)
        status_data(this);
    });

    $('#table_data tbody').on('click', '.kode', function(e) {
        e.preventDefault();
        var token = $(this).attr('title');
        Swal.fire({
            icon: 'success',
            title: 'Informasi',
            text: token,
            showConfirmButton: false,
        })
    });

    $('#tombol_tambah_status').on('click', function(e) {
        $('#modal_tambah_status').modal('show');
    });

    $('body').on('click', '.tombol_hapus_status_laundry', function(e) {
        hapus_status_laundry(this);
    });

    $('#table_data tbody').on('click', '.tombol_detail', function(e) {
        get_detail(this);
    });
</script>

<script>
    var id_data;

    function submit_data(form) {
        var data = new FormData(form);
        data.append('id_data', id_data);

        $.ajax({
            url: URL + 'store',
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
                toastr.error('gagal, terjadi kesalahan');
            },
            success: function(data) {
                if (data.status == 'success') {
                    toastr.success(data.msg);
                    $('#modal_tambah_status').modal('hide');
                    $('#form_status_tambah_data').trigger('reset');
                    load_table_status();
                    $('#table_data').DataTable().ajax.reload();
                } else {
                    toastr.error(data.msg);
                }
            },
        });
    }

    function get_detail(form) {
        var id = $(form).data('id');

        var data = new FormData();
        data.append('id_data', id);

        $.ajax({
            url: URL + 'get_detail',
            type: "POST",
            data: data,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            beforeSend: function() {
                loading('show');
            },
            complete: function() {
                loading('hide');
            },
            error: function(e) {
                console.log(e);
                toastr.error('gagal, terjadi kesalahan');
            },
            success: function(res) {
                if (res.status == 'success') {
                    var data = res.data;

                    var html = `
                        <tr>
                            <th style="width:200px;">KODE</th>
                            <td>${data.kode}</td>
                        </tr>
                        <tr>
                            <th>TOKEN</th>
                            <td>${data.token}</td>
                        </tr>
                        <tr>
                            <th>JENIS LAUNDRY</th>
                            <td>${data.get_jenis}</td>
                        </tr>
                        <tr>
                            <th>ESTIMASI PENANGANAN</th>
                            <td>${data.estimasi}</td>
                        </tr>
                        <tr>
                            <th>METODE PEMBAYARAN</th>
                            <td>${data.metode}</td>
                        </tr>
                        <tr>
                            <th>BIAYA</th>
                            <td>Rp. ${formatRupiah(data.biaya)}</td>
                        </tr>
                        <tr>
                            <th>NAMA PEMILIK</th>
                            <td>${data.nama_pemilik}</td>
                        </tr>
                        <tr>
                            <th>NAMA BARANG/MERK</th>
                            <td>${data.nama_barang}</td>
                        </tr>
                        <tr>
                            <th>NOMER HP</th>
                            <td>${data.no_hp}</td>
                        </tr>
                        <tr>
                            <th>ALAMAT</th>
                            <td>${data.alamat}</td>
                        </tr>
                        <tr>
                            <th>KETERANGAN</th>
                            <td>${data.keterangan}</td>
                        </tr>
                    `;

                    $('#table_detail_laundry tbody').html(html);

                    var html = '';
                    $.map(res.status_laundry, function(e, i) {
                        html += `
                            <tr>
                                <td>${e.waktu}</td>
                                <td>${e.status}</td>
                            </tr>
                        `;
                    });

                    $('#table_detail_status_laundry tbody').html(html);

                    $('#modal_detail').modal('show');
                } else {
                    toastr.error(res.msg);
                }
            },
        });
    }

    function hapus_data(form) {
        var id = $(form).data('id');

        Swal.fire({
            title: 'Hapus Data ?',
            icon: 'question',
            text: "Data akan dihapus dari sistem",
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {

                var data = new FormData();
                data.append('id', id);

                $.ajax({
                    url: URL + 'delete',
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
                        toastr.error('gagal, terjadi kesalahan');
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            toastr.success(data.msg);
                            $('#table_data').DataTable().ajax.reload();
                        } else {
                            toastr.error(data.msg);
                        }
                    },
                });
            } else {
                return false;
            }
        })
    }

    function hapus_status_laundry(form) {
        var id = $(form).data('id');

        Swal.fire({
            title: 'Hapus Data ?',
            icon: 'question',
            text: "Data akan dihapus dari sistem",
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {

                var data = new FormData();
                data.append('id', id);

                $.ajax({
                    url: URL + 'delete_status_laundry',
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
                        toastr.error('gagal, terjadi kesalahan');
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            toastr.success(data.msg);
                            load_table_status();
                            $('#table_data').DataTable().ajax.reload();
                        } else {
                            toastr.error(data.msg);
                        }
                    },
                });
            } else {
                return false;
            }
        })
    }

    function load_table_status() {
        var data = new FormData();
        data.append('id_data', id_data);

        $.ajax({
            url: URL + 'get_status',
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
                toastr.error('gagal, terjadi kesalahan');
            },
            success: function(res) {
                if (res.status == 'success') {
                    var html = '';
                    $.map(res.data, function(e, i) {
                        html += `
                            <tr>
                                <td>${e.waktu}</td>
                                <td>${e.status}</td>
                                <td>
                                    <span class="tombol_hapus_status_laundry btn btn-link text-danger" data-id="${e.id}">hapus</span>
                                </td>
                            </tr>
                        `;
                    });

                    $('#table_status_laundry tbody').html(html);
                }
            },
        });
    }

    function status_data(form) {
        id_data = $(form).data('id');
        load_table_status();
        $('#modal_status').modal('show');
    }
</script>