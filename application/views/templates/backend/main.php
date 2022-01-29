<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title><?= @$title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="<?= data_sistem('deskripsi') ?>" name="description" />
    <meta content="<?= data_sistem('nama') ?>" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('uploads/img/toko.png') ?>">
    <!-- preloader css -->
    <link rel="stylesheet" href="<?= base_url('assets/template/') ?>assets/css/preloader.min.css" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="<?= base_url('assets/template/') ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url('assets/template/') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url('assets/template/') ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- my custom css -->
    <link rel="stylesheet" href="<?= base_url('assets/custom/my_style.css') ?>">
</head>

<body>

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a target="_blank" href="<?= base_url() ?>" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="<?= base_url('uploads/img/toko.png') ?>" alt="" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="<?= base_url('uploads/img/toko.png') ?>" alt="" height="24"> <span class="logo-txt">BayiBarkas</span>
                            </span>
                        </a>

                        <a target="_blank" href="<?= base_url() ?>" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="<?= base_url('uploads/img/toko.png') ?>" alt="" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="<?= base_url('uploads/img/toko.png') ?>" alt="" height="24"> <span class="logo-txt">BayiBarkas</span>
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <form id="form_cari" class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" name="keyword" required autocomplete="off" class="form-control" placeholder="Search ...">
                            <button class="btn btn-primary" type="submit"><i class="bx bx-search-alt align-middle"></i></button>
                        </div>
                    </form>

                </div>

                <div class="d-flex">

                    <div class="dropdown d-none d-sm-inline-block">
                        <button type="button" class="btn header-item" id="mode-setting-btn">
                            <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                            <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" onerror="this.src='<?= base_url('uploads/users/default.png') ?>'" src="<?= base_url('uploads/users/') . $_SESSION['foto'] ?>" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1 fw-medium"><?= $_SESSION['nama'] ?></span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="<?= base_url('backend/admin/main_data/profil') ?>"><i class="bx bx-user font-size-16 align-middle me-1"></i> Profil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('login/logout') ?>"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <?php include($include_sidebar) ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18"><?= @$title ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <?php foreach ($breadcrumb as $key => $value) : ?>
                                            <?php if ($key == 0) : ?>
                                                <li class="breadcrumb-item"><a href="javascript: void(0);"><?= $value ?></a></li>
                                            <?php else : ?>
                                                <li class="breadcrumb-item <?= ($key + 1) == count($breadcrumb) ? 'active' : '' ?>"><?= $value ?></li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <?php $this->load->view($content); ?>

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                <?= data_sistem('nama') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <?php include('right_side.php') ?>

    <!-- JAVASCRIPT -->
    <script src="<?= base_url('assets/template/') ?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/template/') ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/template/') ?>assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?= base_url('assets/template/') ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url('assets/template/') ?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url('assets/template/') ?>assets/libs/feather-icons/feather.min.js"></script>
    <!-- pace js -->
    <script src="<?= base_url('assets/template/') ?>assets/libs/pace-js/pace.min.js"></script>

    <script src="<?= base_url('assets/template/') ?>assets/js/app.js"></script>

    <!-- jquery validation -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <!-- toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- loading overlay -->
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- animated -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- cdn select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- DataTables -->
    <link href="<?= base_url('assets/template/') ?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <script src="<?= base_url('assets/template/') ?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/template/') ?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script>
        const BASE_URL = "<?= base_url() ?>";
        const URL = "<?= base_url(@$uri_segment) ?>";
    </script>

    <script src="<?= base_url('assets/custom/my_app.js') ?>"></script>

    <?php $this->load->view($script); ?>

</body>

</html>