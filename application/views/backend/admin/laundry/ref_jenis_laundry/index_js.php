<script>
    $(document).ready(function() {

        load_table();
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
                className: 'text-center',
                orderable: false,
            }, ],
        })

    }
</script>

<script>
    $('#tombol_tambah').on('click', function(e) {
        e.preventDefault();
        $('#modal_tambah').modal('show');
    });

    $('#table_data tbody').on('click', '.tombol_ubah', function(e) {
        e.preventDefault();
        get_data(this);
    });

    $('#table_data tbody').on('click', '.tombol_hapus', function(e) {
        e.preventDefault();
        hapus_data(this);
    });
</script>

<script>
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
                'jenis': {
                    required: true,
                },
                'urutan': {
                    required: true,
                    number: true,
                },
            },
        });

        $('#form_data').on('submit', function(e) {
            if ($(this).valid()) {
                e.preventDefault();
                submit_data(this);
            }
        });
    }();

    var validation_ubah = function() {
        jQuery('#form_ubah').validate({
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
                'jenis': {
                    required: true,
                },
                'urutan': {
                    required: true,
                    number: true,
                },
            },
        });

        $('#form_ubah').on('submit', function(e) {
            if ($(this).valid()) {
                e.preventDefault();
                ubah_data(this);
            }
        });
    }();

    $(document).ready(function() {

        jQuery(function() {
            validation_tambah;
            validation_ubah;
        });

    });
</script>

<script>
    var id_data;

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
                // console.log('sedang menghapus');
                $('#form_data button[type=submit]').attr('disabled', true);
            },
            complete: function() {
                // console.log('Berhasil');
                $('#form_data button[type=submit]').attr('disabled', false);
            },
            error: function(e) {
                console.log(e);
                toastr.error('gagal, terjadi kesalahan');
                $('#form_data button[type=submit]').attr('disabled', false);
            },
            success: function(data) {
                if (data.status == 'success') {
                    toastr.success(data.msg);
                    $('#modal_tambah').modal('hide');
                    $('#form_data').trigger('reset');
                    $('#table_data').DataTable().ajax.reload();
                } else {
                    toastr.error(data.msg);
                }
            },
        });
    }

    function ubah_data(form) {
        var data = new FormData(form);
        data.append('id', id_data);

        $.ajax({
            url: URL + 'update',
            type: "POST",
            data: data,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            beforeSend: function() {
                // console.log('sedang menghapus');                
                $('#form_ubah button[type=submit]').attr('disabled', true);
            },
            complete: function() {
                // console.log('Berhasil');
                $('#form_ubah button[type=submit]').attr('disabled', false);
            },
            error: function(e) {
                console.log(e);
                toastr.error('gagal, terjadi kesalahan');
                $('#form_ubah button[type=submit]').attr('disabled', false);
            },
            success: function(data) {
                if (data.status == 'success') {
                    toastr.success(data.msg);

                    $('#form_ubah').trigger('reset');
                    $('#modal_ubah').modal('hide');
                    $('#table_data').DataTable().ajax.reload();
                } else {
                    toastr.error(data.msg);
                }
            },
        });
    }

    function hapus_data(form) {
        var id = $(form).attr('data-id');

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

    function get_data(form) {
        var id = $(form).attr('data-id');
        var data = new FormData();
        data.append('id', id);

        $.ajax({
            url: URL + 'get',
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
                    var row = data.data;
                    id_data = row.id;
                    $('#form_ubah input[name=jenis]').val(row.jenis);
                    $('#form_ubah input[name=urutan]').val(row.urutan);

                    $('#modal_ubah').modal('show');

                    var form_validasi = $('#form_ubah').validate();
                    form_validasi.resetForm();
                } else {
                    toastr.error(data.msg);
                }
            },
        });
    }
</script>