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
                            <a class="<?= cek_aktif(@$li_active, 'laundry_data', 'active') ?>" href="<?= base_url('backend/admin/laundry/data') ?>">
                                <i class="bx bx-right-arrow-alt"></i>
                                <span>Data</span>
                            </a>
                        </li>
                        <li>
                            <a class="<?= cek_aktif(@$li_active, 'laundry_status', 'active') ?>" href="<?= base_url('backend/admin/laundry/status') ?>">
                                <i class="bx bx-right-arrow-alt"></i>
                                <span>Status</span>
                            </a>
                        </li>
                        <li>
                            <a class="<?= cek_aktif(@$li_active, 'laundry_rekap', 'active') ?>" href="<?= base_url('backend/admin/laundry/rekap') ?>">
                                <i class="bx bx-right-arrow-alt"></i>
                                <span>Rekap</span>
                            </a>
                        </li>
                    </ul>
                </li>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->