<!-- highcharts -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script>
    $(document).ready(function() {
        grafik_total_laundry();
        grafik_omset_laundry();
    });
</script>

<script>
    var link = URL + 'cetak_';

    $('.tombol_cetak').on('click', function(e) {
        e.preventDefault();
        var type = $(this).data('type');
        $('.filter_data').hide();

        if (type == 'harian') {
            $('#cetak_harian').show();
            $('#modal_cetak_excel').modal('show');
        }

        if (type == 'bulanan') {
            $('#cetak_bulanan').show();
            $('#modal_cetak_excel').modal('show');
        }

        if (type == 'tahunan') {
            window.open(link + 'tahunan')
        }

    });

    $('#cetak_harian .cetak').on('click', function(e) {
        e.preventDefault();
        var bulan = $('#cetak_harian .select_bulan').val()
        var tahun = $('#cetak_harian .select_tahun').val()
        window.open(link + 'harian/' + bulan + '/' + tahun)
        $('#modal_cetak_excel').modal('hide')
    });

    $('#cetak_bulanan .cetak').on('click', function(e) {
        e.preventDefault();
        var tahun = $('#cetak_bulanan .select_tahun').val()
        window.open(link + 'bulanan/' + tahun)
        $('#modal_cetak_excel').modal('hide')
    });
</script>

<script>
    function grafik_total_laundry() {
        $.ajax({
            type: "GET",
            url: URL + 'grafik_total_laundry',
            dataType: "JSON",
            contentType: false,
            processData: false,
            beforeSend: function(res) {

            },
            complete: function(res) {

            },
            success: function(res) {
                if (res.status == 'success') {
                    var data = res.data;
                    grafik_batang('grafik_total_laundry', data.categories, data.series, 'total transaksi', 'kali', 'GRAFIK TOTAL LAUNDRY', 'rekapitulasi total transaksi aktif pada setiap tanggal');
                }
            }
        });
    }

    function grafik_omset_laundry() {
        $.ajax({
            type: "GET",
            url: URL + 'grafik_omset_laundry',
            dataType: "JSON",
            contentType: false,
            processData: false,
            beforeSend: function(res) {

            },
            complete: function(res) {

            },
            success: function(res) {
                if (res.status == 'success') {
                    var data = res.data;
                    grafik_batang('grafik_omset_laundry', data.categories, data.series, 'total omset', '', 'GRAFIK OMSET LAUNDRY', 'rekapitulasi total omset aktif pada setiap tanggal');
                }
            }
        });
    }

    function grafik_batang(container, kategori, series, yaxis, satuan, title = '', subtitle = '') {
        Highcharts.setOptions({
            lang: {
                numericSymbols: [' Rb', ' Jt', ' M', ' T']
            },
        });

        Highcharts.chart(container, {
            chart: {
                type: 'line'
            },
            title: {
                text: title
            },
            subtitle: {
                text: subtitle
            },
            xAxis: {
                categories: kategori,
                crosshair: true,
            },
            yAxis: {
                min: 0,
                title: {
                    text: yaxis
                }
            },
            plotOptions: {
                line: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    colorByPoint: true,
                }
            },
            colors: ['#4572A7', '#AA4643', '#89A54E', '#80699B', '#3D96AE',
                '#DB843D', '#92A8CD', '#A47D7C', '#B5CA92'
            ],
            tooltip: {
                valueSuffix: ' ' + satuan,
            },
            series: series
        });
    }
</script>