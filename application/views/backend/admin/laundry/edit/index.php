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

        <h5 class="text-center">~ FORMULIR DATA ~</h5>

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

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">Kode ( <small class="text-danger">* digenerate oleh sistem</small> )</label>
                                <div class="form-group">
                                    <input value="<?= $data->kode ?>" name="kode" autocomplete="off" type="text" class="form-control" readonly placeholder="Masukkan kode">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jenis Laundry</label>

                                <div class="form-group">
                                    <?php foreach ($ref_jenis_laundry as $key) : ?>
                                        <div class="form-check">
                                            <input <?= in_array($key->id, $jenis) ? 'checked' : '' ?> type="checkbox" name="jenis_laundry[]" value="<?= $key->id ?>" class="form-check-input" id="<?= 'jenis_' . $key->id ?>">
                                            <label class="form-check-label" for="<?= 'jenis_' . $key->id ?>"><?= $key->jenis ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Estimasi Penanganan</label>

                                        <?php foreach ($ref_estimasi_penanganan_laundry as $key => $value) : ?>
                                            <div class="form-check">
                                                <input class="form-check-input" <?= $value->id == $data->id_estimasi ? 'checked' : '' ?> type="radio" name="estimasi_penanganan" value="<?= $value->id ?>" id="<?= 'estimasi_' . $value->id ?>">
                                                <label class="form-check-label" for="<?= 'estimasi_' . $value->id ?>">
                                                    <?= $value->jenis ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Metode Pembayaran</label>

                                        <?php foreach ($ref_metode_pembayaran as $key => $value) : ?>
                                            <div class="form-check">
                                                <input class="form-check-input" <?= $value->id == $data->id_metode_pembayaran ? 'checked' : '' ?> type="radio" name="metode_pembayaran" value="<?= $value->id ?>" id="<?= 'metode_' . $value->id ?>">
                                                <label class="form-check-label" for="<?= 'metode_' . $value->id ?>">
                                                    <?= $value->jenis ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Biaya</label>
                                <div class="form-group input-group">
                                    <span class="input-group-text text-bold text-white bg-primary">Rp</span>
                                    <input value="<?= number_format($data->biaya, 0, ',', '.') ?>" name="biaya" autocomplete="off" type="text" class="form-control text-bold data_rupiah" placeholder="Masukkan total biaya">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">Nama Pemilik/Pelanggan</label>
                                <div class="form-group">
                                    <input name="nama" value="<?= $data->nama_pemilik ?>" autocomplete="off" type="text" class="form-control" placeholder="Masukkan nama pelanggan">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Barang/Merk</label>
                                <div class="form-group">
                                    <input name="merk" value="<?= $data->nama_barang ?>" autocomplete="off" type="text" class="form-control" placeholder="Masukkan nama pelanggan">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nomer HP</label>
                                <div class="form-group">
                                    <input name="no_hp" value="<?= $data->no_hp ?>" autocomplete="off" type="text" class="form-control" placeholder="Masukkan nomer hp yang bisa dihubungi">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <div class="form-group">
                                    <textarea name="alamat" rows="6" class="form-control" placeholder="Masukkan alamat pelanggan"><?= $data->alamat ?></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="">
                        <label class="form-label">Keterangan ( <small class="text-danger">* jika diperlukan</small> )</label>
                        <div class="form-group">
                            <textarea name="keterangan_form" id="summernote" rows="10" class="form-control" placeholder="Contoh : estimasi 3 hari"><?= $data->keterangan ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>