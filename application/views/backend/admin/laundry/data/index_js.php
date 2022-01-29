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
                    className: 'text-center'
                },
                {
                    targets: [5],
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
</script>