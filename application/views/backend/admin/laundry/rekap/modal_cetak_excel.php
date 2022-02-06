<div id="modal_cetak_excel" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">

                <div id="cetak_harian" class="filter_data" style="display: none;">
                    <div class="form-group row mb-3">
                        <label class="col-12">Bulan</label>
                        <div class="col-md-12">
                            <select class="js-select2 form-control select_bulan">
                                <option value="all">Semua Bulan</option>
                                <?php foreach ($ref_bulan as $key) : ?>
                                    <option value="<?= $key->id ?>"><?= $key->bulan ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-12">Tahun</label>
                        <div class="col-md-12">
                            <select class="js-select2 form-control select_tahun">
                                <?php foreach ($ref_tahun as $key) : ?>
                                    <option value="<?= $key->tahun ?>"><?= $key->tahun ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-primary cetak">CETAK</button>
                    </div>
                </div>

                <div id="cetak_bulanan" class="filter_data" style="display: none;">
                    <div class="form-group row mb-3">
                        <label class="col-12">Tahun</label>
                        <div class="col-md-12">
                            <select class="js-select2 form-control select_tahun">
                                <?php foreach ($ref_tahun as $key) : ?>
                                    <option value="<?= $key->tahun ?>"><?= $key->tahun ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-primary cetak">CETAK</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>