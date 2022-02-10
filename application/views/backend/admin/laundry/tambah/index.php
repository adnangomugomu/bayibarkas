<style>
    .form-control:disabled,
    .form-control[readonly] {
        background-color: #e5e5e55c !important;
        font-weight: bold;
        font-size: 14px;
    }
</style>

<div class="row">
    <div class="col-md-12">

        <form class="mt-4" id="form_data" action="#" method="post">
            <div class="row">

                <div class="col-md-12 mb-4">
                    <div class="float-end">
                        <button id="tombol_batal" type="button" class="btn btn-outline-secondary me-2">
                            <i class="fa fa-times"></i>
                            Batal
                        </button>
                        <button id="tombol_simpan" type="submit" class="btn btn-success waves-effect">
                            <i class="bx bx-save"></i>
                            Simpan
                        </button>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Kode ( <small class="text-danger">* digenerate oleh sistem</small> )</label>
                                        <div class="form-group">
                                            <input value="<?= $kode_laundry ?>" name="kode" autocomplete="off" type="text" class="form-control" readonly placeholder="Masukkan kode">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Pemilik/Pelanggan</label>
                                        <div class="form-group">
                                            <input name="nama" autocomplete="off" type="text" class="form-control" placeholder="Masukkan nama pelanggan">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Nomer HP</label>
                                        <div class="form-group">
                                            <input name="no_hp" autocomplete="off" type="text" class="form-control" placeholder="Masukkan nomer hp yang bisa dihubungi">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Metode Pembayaran</label>

                                        <?php foreach ($ref_metode_pembayaran as $key => $value) : ?>
                                            <div class="form-check">
                                                <input class="form-check-input" <?= $key == 0 ? 'checked' : '' ?> type="radio" name="metode_pembayaran" value="<?= $value->id ?>" id="<?= 'metode_' . $value->id ?>">
                                                <label class="form-check-label" for="<?= 'metode_' . $value->id ?>">
                                                    <?= $value->jenis ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <div class="form-group">
                                            <textarea name="alamat" rows="1" class="form-control" placeholder="Masukkan alamat pelanggan"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Barang</label>
                                        <div class="form-group">
                                            <select name="jenis_barang" id="select_jenis_barang" class="js_select2 form-control">
                                                <option value="">Pilih jenis barang</option>
                                                <?php foreach ($ref_jenis_barang as $key) : ?>
                                                    <option value="<?= $key->id ?>"><?= $key->nama ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Kelengkapan Barang</label>
                                        <select placeholder="Pilih data" class="form-control js_select2" name="kelengkapan_barang[]" id="kelengkapan_barang" multiple></select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Laundry</label>
                                        <div id="checkbox_jenis_laundry" class="form-group">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Estimasi Penanganan</label>
                                        <div id="radio_estimasi_penanganan" class="form-group">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="text-bold float-end">Sub Total Rp <span class="sub_total">0</span> </p>

                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>