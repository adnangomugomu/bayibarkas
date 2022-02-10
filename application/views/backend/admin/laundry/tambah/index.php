

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

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label">Kode ( <small class="text-danger">* digenerate oleh sistem</small> )</label>
                                    <div class="form-group">
                                        <input value="<?= $kode_laundry ?>" name="kode" autocomplete="off" type="text" class="form-control" readonly placeholder="Masukkan kode">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label">Waktu Penerimaan</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-text text-bold text-white bg-primary">
                                            <i class="bx bx-calendar"></i>
                                        </span>
                                        <input name="waktu" autocomplete="off" type="text" class="form-control datepicker" placeholder="Masukkan waktu penerimaan laundry">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Pemilik/Pelanggan</label>
                                        <div class="form-group">
                                            <input name="nama" autocomplete="off" type="text" class="form-control" placeholder="Masukkan nama pelanggan">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Nomer HP</label>
                                        <div class="form-group">
                                            <input name="no_hp" autocomplete="off" type="text" class="form-control" placeholder="Masukkan nomer hp yang bisa dihubungi">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
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
                
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- *Update Start* -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <div class="form-group">
                                            <label class="form-label">Nama Barang/Merk</label>
                                            <input name="merk" autocomplete="off" type="text" class="form-control" placeholder="Nama Merk Barang">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <div class="form-group">
                                            <label class="form-label">Warna Barang</label>
                                            <input name="warna" autocomplete="off" type="text" class="form-control" placeholder="Warna Barang">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="jenis-barang" class="form-label">Jenis Barang</label>
                                        <select class="form-control" name="jenis-barang" id="jenis-barang" placeholder="This is a search placeholder">
                                            <option value="">Pilih Salah Satu</option>
                                            <option value="1">Stroller</option>
                                            <option value="2">Box</option>
                                            <option value="3">Bouncher</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="select-multiple col-lg-6">
                                    <div class="mb-4">
                                        <label for="kelengkapan-barang" class="form-label">Kelengkapan Barang</label>
                                        <select class="form-control" name="kelengkapan-barang" id="kelengkapan-barang" placeholder="This is a placeholder" multiple>
                                            <option value="1">Kanopi</option>
                                            <option value="2">Keranjang Bawah</option>
                                            <option value="3">Bumper Depan</option>
                                            <option value="4">Handle</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- *Update End* -->

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Jenis Layanan Loundry</label>
        
                                            <div class="form-group">
                                                <?php foreach ($ref_jenis_laundry as $key) : ?>
                                                    <div class="form-check">
                                                        <input type="checkbox" name="jenis_laundry[]" value="<?= $key->id ?>" class="form-check-input" id="<?= 'jenis_' . $key->id ?>">
                                                        <label class="form-check-label" for="<?= 'jenis_' . $key->id ?>"><?= $key->jenis ?></label>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Estimasi Penanganan</label>
    
                                            <?php foreach ($ref_estimasi_penanganan_laundry as $key => $value) : ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" <?= $key == 0 ? 'checked' : '' ?> type="radio" name="estimasi_penanganan" value="<?= $value->id ?>" id="<?= 'estimasi_' . $value->id ?>">
                                                    <label class="form-check-label" for="<?= 'estimasi_' . $value->id ?>">
                                                        <?= $value->jenis ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
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
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Biaya</label>
                                <div class="form-group input-group">
                                    <span class="input-group-text text-bold text-white bg-primary">Rp</span>
                                    <input name="biaya" autocomplete="off" type="text" class="form-control text-bold data_rupiah" placeholder="Masukkan total biaya">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    
                </div>

                

                <div class="col-md-12">
                    <div class="">
                        <label class="form-label">Keterangan ( <small class="text-danger">* jika diperlukan</small> )</label>
                        <div class="form-group">
                            <textarea name="keterangan_form" id="summernote" rows="10" class="form-control" placeholder="Contoh : estimasi 3 hari"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>