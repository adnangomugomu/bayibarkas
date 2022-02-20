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
            ordering: false,
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
    $('#table_data tbody').on('click', '.tombol_setting', function(e) {
        e.preventDefault();
        get_data(this);
    });

    $('#tombol_reload').on('click', function() {
        $('#modal_setting').modal('hide');
        $('#table_data').DataTable().ajax.reload();
    });
</script>

<script>
    function submit_data(form) {
        var id_barang = $(form).data('idbarang');
        var id_jenis_laundry = $(form).data('idjenislaundry');
        var val = $(form).val();

        var data = new FormData();
        data.append('id_barang', id_barang);
        data.append('id_jenis_laundry', id_jenis_laundry);
        data.append('val', val);

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
                } else {
                    toastr.error(data.msg);
                }
            },
        });
    }

    function get_data(form) {
        var id = $(form).data('id');
        var nama = $(form).data('name');
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
            success: function(res) {
                if (res.status == 'success') {
                    var row = res.data;;

                    var html = `
                        <div class="form-group">
                            <label>Nama</label>
                            <div>
                                <input type="text" value="${nama}" readonly class="form-control" name="nama" placeholder="masukkan data">
                            </div>
                        </div> 
                    `;

                    $.map(row, function(e, i) {
                        html += `
                        <div class="form-group">
                            <label>${e.jenis}</label>
                            <div>
                                <input type="text" value="${formatRupiah(''+e.harga)}" onchange="submit_data(this)" class="form-control data_rupiah" data-idbarang="${id}" data-idjenislaundry="${e.id}" placeholder="masukkan data">
                            </div>
                        </div>
                        `;
                    });

                    $('#modal_setting .list_data').html(html);
                    $('#modal_setting').modal('show');
                } else {
                    toastr.error(data.msg);
                }
            },
        });
    }
</script>