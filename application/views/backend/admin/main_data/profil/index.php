<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <form enctype="multipart/form-data" id="form_data" action="#" method="post">

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9 form-group">
                            <input name="nama" autocomplete="off" value="<?= $data->nama ?>" type="text" class="form-control" placeholder="Masukkan Nama">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9 form-group">
                            <input name="username_data" autocomplete="new-password" value="<?= $data->username ?>" type="text" class="form-control" placeholder="Masukkan Username">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9 form-group">
                            <input name="password_data" id="password" autocomplete="new-password" type="password" class="form-control" placeholder="Masukkan Password">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-9 form-group">
                            <input name="konfirmasi_password" autocomplete="new-password" type="password" class="form-control" placeholder="Masukkan Password konfirmasi">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Foto Profil</label>
                        <div class="col-sm-9 form-group">
                            <input name="foto" type="file" accept="image/*" class="input-control">
                        </div>
                    </div>

                    <div class="float-end">
                        <button id="tombol_batal" type="button" class="btn btn-outline-secondary me-2">Batal</button>
                        <button id="tombol_simpan" type="submit" class="btn btn-primary waves-effect">Simpan</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>