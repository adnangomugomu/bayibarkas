<div id="modal_tambah" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border border-primary">
            <div class="modal-header bg-primary">
                <h5 class="modal-title mt-0 text-white">FORM TAMBAH DATA</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="#" id="form_data" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama</label>
                        <div>
                            <input type="text" class="form-control" name="nama" placeholder="masukkan data">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Urutan</label>
                        <div>
                            <input type="text" class="form-control" name="urutan" placeholder="masukkan data">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Have Sub</label>
                        <div>
                            <select class="js-select2 form-control" name="have_sub">
                                <option value="">pilih data</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kode Active</label>
                        <div>
                            <textarea type="text" class="form-control" name="kode_active" placeholder="masukkan data"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>