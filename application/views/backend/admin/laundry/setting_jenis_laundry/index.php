<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">              

                <div class="table-responsive mt-3">
                    <table id="table_data" style="width: 100%;" class="table table-hover table-striped table-bordered">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>No</th>
                                <th>Nama Jenis Laundry</th>
                                <?php foreach ($ref_jenis_laundry as $key) : ?>
                                    <th><?= $key->jenis ?></th>
                                <?php endforeach; ?>
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
include('modal_setting.php');
?>