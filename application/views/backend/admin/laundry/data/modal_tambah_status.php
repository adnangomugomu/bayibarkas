<div style="background-color: rgba(0, 0, 0, .7);" id="modal_tambah_status" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="form_status_tambah_data" method="post">

                <div class="modal-body">

                    <div class="form-group row mb-3">
                        <label class="col-12">Status Data (KODE <span class="title_kode">-</span>)</label>
                        <div class="col-md-12">
                            <select class="js-select2 form-control" name="status_data">
                                <option value="">pilih status data</option>
                                <?php foreach ($ref_status_laundry as $key) : ?>
                                    <option value="<?= $key->id ?>"><?= $key->status ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-12">Waktu</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control datepicker" autocomplete="off" name="waktu" placeholder="pilih tanggal">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>