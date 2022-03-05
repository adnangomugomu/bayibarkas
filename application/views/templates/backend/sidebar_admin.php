<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li class="<?= cek_aktif(@$li_active, 'dashboard') ?>">
                    <a href="<?= base_url('backend/admin/dashboard') ?>">
                        <i class="bx bx-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="<?= cek_aktif(@$li_open, 'laundry') ?>">
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bxs-t-shirt"></i>
                        <span>Laundry</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a class="<?= cek_aktif(@$li_active, 'tambah_laundry', 'active') ?>" href="<?= base_url('backend/admin/laundry/tambah') ?>">
                                <i class="bx bx-right-arrow-alt"></i>
                                <span>Tambah Laundry</span>
                            </a>
                        </li>
                        <li>
                            <a class="<?= cek_aktif(@$li_active, 'data_laundry', 'active') ?>" href="<?= base_url('backend/admin/laundry/data') ?>">
                                <i class="bx bx-right-arrow-alt"></i>
                                <span>Data Laundry</span>
                            </a>
                        </li>
                        <li>
                            <a class="<?= cek_aktif(@$li_active, 'laundry_rekap', 'active') ?>" href="<?= base_url('backend/admin/laundry/rekap') ?>">
                                <i class="bx bx-right-arrow-alt"></i>
                                <span>Rekap Data</span>
                            </a>
                        </li>
                        <li>
                            <a class="<?= cek_aktif(@$li_active, 'laundry_ref_jenis_barang', 'active') ?>" href="<?= base_url('backend/admin/laundry/ref_jenis_barang') ?>">
                                <i class="bx bx-share-alt"></i>
                                <span>Ref. Jenis Barang</span>
                            </a>
                        </li>
                        <li>
                            <a class="<?= cek_aktif(@$li_active, 'laundry_ref_jenis_laundry', 'active') ?>" href="<?= base_url('backend/admin/laundry/ref_jenis_laundry') ?>">
                                <i class="bx bx-share-alt"></i>
                                <span>Ref. Jenis Laundry</span>
                            </a>
                        </li>
                        <li>
                            <a class="<?= cek_aktif(@$li_active, 'laundry_ref_kelengkapan_barang', 'active') ?>" href="<?= base_url('backend/admin/laundry/ref_kelengkapan_barang') ?>">
                                <i class="bx bx-share-alt"></i>
                                <span>Ref. Kelengkapan Brg</span>
                            </a>
                        </li>
                        <li>
                            <a class="<?= cek_aktif(@$li_active, 'laundry_setting_estimasi_penanganan', 'active') ?>" href="<?= base_url('backend/admin/laundry/setting_estimasi_penanganan') ?>">
                                <i class="bx bx-cog"></i>
                                <span>Conf. Estimasi Pgn</span>
                            </a>
                        </li>
                        <li>
                            <a class="<?= cek_aktif(@$li_active, 'laundry_setting_jenis_laundry', 'active') ?>" href="<?= base_url('backend/admin/laundry/setting_jenis_laundry') ?>">
                                <i class="bx bx-cog"></i>
                                <span>Conf. Jenis Laundry</span>
                            </a>
                        </li>
                    </ul>
                </li>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->