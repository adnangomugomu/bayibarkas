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
                                    <input value="BB-20220117001L" name="kode" autocomplete="off" type="text" class="form-control" readonly placeholder="Masukkan kode">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Total Bobot</label>
                                <div class="form-group input-group">
                                    <span class="input-group-text text-bold text-white bg-primary">Kg</span>
                                    <input name="total_bobot" autocomplete="off" type="number" class="form-control" placeholder="Masukkan total bobot (kg)">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Biaya</label>
                                <div class="form-group input-group">
                                    <span class="input-group-text text-bold text-white bg-primary">Rp</span>
                                    <input name="biaya" autocomplete="off" type="text" class="form-control text-bold data_rupiah" placeholder="Masukkan total biaya">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Waktu Penerimaan</label>
                                <div class="form-group input-group">
                                    <span class="input-group-text text-bold text-white bg-primary">
                                        <i class="bx bx-calendar"></i>
                                    </span>
                                    <input name="waktu" autocomplete="off" type="text" class="form-control datepicker" placeholder="Masukkan waktu penerimaan laundry">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status Laundry</label>
                                <div class="form-group">
                                    <select name="id_status" class="form-control js_select2">
                                        <option value="">Pilih Status</option>
                                        <?php foreach ($ref_status_laundry as $key) : ?>
                                            <option <?= $key->id == 1 ? 'selected' : '' ?> value="<?= $key->id ?>"><?= $key->status ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">Nama Pelanggan</label>
                                <div class="form-group">
                                    <input name="nama" autocomplete="off" type="text" class="form-control" placeholder="Masukkan nama pelanggan">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nomer HP</label>
                                <div class="form-group">
                                    <input name="no_hp" autocomplete="off" type="text" class="form-control" placeholder="Masukkan nomer hp yang bisa dihubungi">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <div class="form-group">
                                    <textarea name="alamat" rows="3" class="form-control" placeholder="Masukkan alamat pelanggan"></textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Keterangan ( <small class="text-danger">* jika diperlukan</small> )</label>
                                <div class="form-group">
                                    <textarea name="alamat" rows="3" class="form-control" placeholder="Contoh : estimasi 3 hari"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </form>

    </div>
</div>