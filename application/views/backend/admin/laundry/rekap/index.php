<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body bg-primary rounded">
                <span class="text-white d-block">Laporan Excel Harian</span>
                <button class="btn btn-success btn-rounded btn-sm float-end tombol_cetak" data-type="harian">
                    <i class="bx bx-printer"></i>
                    Cetak
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body bg-primary rounded">
                <span class="text-white d-block">Laporan Excel Bulanan</span>
                <button class="btn btn-success btn-rounded btn-sm float-end tombol_cetak" data-type="bulanan">
                    <i class="bx bx-printer"></i>
                    Cetak
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body bg-primary rounded">
                <span class="text-white d-block">Laporan Excel Tahunan</span>
                <button class="btn btn-success btn-rounded btn-sm float-end tombol_cetak" data-type="tahunan">
                    <i class="bx bx-printer"></i>
                    Cetak
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div id="grafik_total_laundry"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div id="grafik_omset_laundry"></div>
            </div>
        </div>
    </div>
</div>

<?php
include('modal_cetak_excel.php');
?>