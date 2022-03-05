<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-4">
                    Table Data

                    <?php if (hak_akses_menu($menu, 'tambah')) : ?>
                        <button id="tombol_tambah" class="btn btn-primary btn-sm float-right btn-label animate__animated animate__bounce">
                            <i class="bx bx-plus label-icon"></i> Tambah Data
                        </button>
                    <?php endif; ?>
                    <div style="clear: both;"></div>

                </div>

                <div class="table-responsive">
                    <table id="table_data" class="table table-bordered">
                        <thead class="bg-primary text-white bg-custom-thead">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Urutan</th>
                                <th>Icon</th>
                                <th>Link</th>
                                <th>Have Sub</th>
                                <th>Kode Aktif</th>
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