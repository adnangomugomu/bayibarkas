<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <button id="tombol_tambah" class="btn btn-primary btn-sm float-right btn-label animate__animated animate__bounce">
                    <i class="bx bx-plus label-icon"></i> Tambah Data
                </button>
                <div style="clear: both;"></div>

                <div class="table-responsive mt-3">
                    <table id="table_data" style="width: 100%;" class="table table-hover table-striped table-bordered">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>No</th>
                                <th>Nama Jenis Laundry</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('modal_tambah.php');
include('modal_ubah.php');
?>