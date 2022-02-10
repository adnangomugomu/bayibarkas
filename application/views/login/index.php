<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Login | <?= data_sistem() ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="<?= data_sistem('deskripsi') ?>" name="description" />
    <meta content="Bayibarkas, Bayi barkas, Bayi barkas solo" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/template/') ?>assets/images/favicon.ico">

    <!-- preloader css -->
    <link rel="stylesheet" href="<?= base_url('assets/template/') ?>assets/css/preloader.min.css" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="<?= base_url('assets/template/') ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url('assets/template/') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url('assets/template/') ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- animated -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>

<body>

    <!-- <body data-layout="horizontal"> -->
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">

                                <div class="mb-2 text-center">
                                    <a href="<?= base_url() ?>" class="d-block auth-logo">
                                        <img src="<?= base_url('uploads/img/logo-75h.png') ?>" alt=""> <span class="logo-txt">BayiBarkas.com</span>
                                    </a>
                                </div>

                                <div class="auth-content my-auto">
                                    <div class="text-center animate__animated animate__bounce">
                                        <h5 class="mb-0">Selamat Datang !</h5>
                                        <p class="text-muted mt-2">Silahkan login terlebih dahulu</p>
                                    </div>
                                    <form class="mt-4 pt-2 js-validation-signin" id="form_data" action="#">
                                        <div class="mb-3 form-group">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan Username">
                                        </div>

                                        <div class="mb-5 form-group">
                                            <label class="form-label">Kata Sandi</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" name="password" class="form-control" placeholder="Masukkan Kata Sandi" aria-label="Password" aria-describedby="password-addon">
                                                <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>                                       

                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
                                        </div>

                                        <a href="<?= base_url() ?>" class="text-center d-block">Kembali ke Beranda</a>
                                    </form>

                                </div>
                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">© <script>
                                            document.write(new Date().getFullYear())
                                        </script>
                                        <a href="<?= base_url() ?>">www.bayibarkas.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
                <div class="col-xxl-9 col-lg-8 col-md-7">
                    <div class="auth-bg pt-md-5 p-4 d-flex">
                        <div style="opacity: .5;" class="bg-overlay bg-primary"></div>
                        <ul class="bg-bubbles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <!-- end bubble effect -->
                        <div class="row justify-content-center align-items-center">
                            <div class="col-xl-7">
                                <div class="p-0 p-sm-4 px-xl-0">
                                    <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                            <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                            <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                            <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                        </div>
                                        <!-- end carouselIndicators -->
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div class="testi-contain text-white">
                                                    <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                    <h4 class="mt-4 fw-medium lh-base text-white">
                                                        “Barang bayi yang dijual maupun mainan yang disewakan dipastikan dalam kondisi SIAP PAKAI”
                                                    </h4>
                                                    <div class="mt-4 pt-3 pb-5">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-shrink-0">
                                                                <img src="<?= base_url('uploads/img/icon-bayibarkas-bulat-jualbeli.png') ?>" class="avatar-md img-fluid rounded-circle" alt="...">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3 mb-4">
                                                                <h5 class="font-size-18 text-white">Jual beli atau tukar tambah</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="carousel-item">
                                                <div class="testi-contain text-white">
                                                    <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                    <h4 class="mt-4 fw-medium lh-base text-white">
                                                        “Jasa Service & Profesional Laundry + Antiseptik Perlengkapan Bayi (bahan khusus, aman untuk bayi)”
                                                    </h4>
                                                    <div class="mt-4 pt-3 pb-5">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-shrink-0">
                                                                <img src="<?= base_url('uploads/img/icon-bayibarkas-bulat-service.png') ?>" class="avatar-md img-fluid rounded-circle" alt="...">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3 mb-4">
                                                                <h5 class="font-size-18 text-white">Service & Laundry + antiseptik</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="carousel-item">
                                                <div class="testi-contain text-white">
                                                    <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                    <h4 class="mt-4 fw-medium lh-base text-white">
                                                        “Tersedia layan pick up & delivery untuk wilayah Solo dan sekitar”
                                                    </h4>
                                                    <div class="mt-4 pt-3 pb-5">
                                                        <div class="d-flex align-items-start">
                                                            <img src="<?= base_url('uploads/img/icon-bayibarkas-bulat-sewa1.png') ?>" class="avatar-md img-fluid rounded-circle" alt="...">
                                                            <div class="flex-1 ms-3 mb-4">
                                                                <h5 class="font-size-18 text-white">Sewa mainan</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end carousel-inner -->
                                    </div>
                                    <!-- end review carousel -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>


    <!-- JAVASCRIPT -->

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/template/') ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/template/') ?>assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?= base_url('assets/template/') ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url('assets/template/') ?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url('assets/template/') ?>assets/libs/feather-icons/feather.min.js"></script>
    <!-- pace js -->
    <script src="<?= base_url('assets/template/') ?>assets/libs/pace-js/pace.min.js"></script>
    <!-- password addon init -->
    <script src="<?= base_url('assets/template/') ?>assets/js/pages/pass-addon.init.js"></script>
    <?php include('index_js.php') ?>
</body>

</html>