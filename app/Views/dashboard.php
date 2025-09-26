<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema RoBoto - by Calama Devs</title>
    
    <link rel="stylesheet" href="<?= base_url("assets/vendors/mdi/css/materialdesignicons.min.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("assets/vendors/css/vendor.bundle.base.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/modern-vertical/style.css"); ?>">

    <link rel="shortcut icon" href="<?= base_url("assets/images/logo-ifro-mini.png"); ?>" />

    <script src="<?= base_url("assets/vendors/js/vendor.bundle.base.js"); ?>"></script>
    <script src="<?= base_url("assets/js/off-canvas.js"); ?>"></script>
    <script src="<?= base_url("assets/js/hoverable-collapse.js"); ?>"></script>
    <script src="<?= base_url("assets/js/misc.js"); ?>"></script>
</head>
<body>
    <div class="container-scroller">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a href="<?php echo base_url("/") ?>">
                    <img src="<?php echo base_url("assets/images/logo-ifro.png"); ?>" class="sidebar-brand brand-logo" alt="logo" />
                    <img src="<?php echo base_url("assets/images/logo-ifro-mini.png"); ?>" class="sidebar-brand brand-logo-mini" alt="logo" />
                </a>
            </div>
            <ul class="nav">
                <li class="nav-item nav-category">
                    <span class="nav-link">Menu</span>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="<?= site_url('/') ?>">
                        <span class="menu-icon"><i class="mdi mdi-speedometer"></i></span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="#">
                        <span class="menu-icon"><i class="mdi mdi-account-plus"></i></span>
                        <span class="menu-title">Cadastros</span>
                    </a>
                </li>
                 <li class="nav-item menu-items">
                    <a class="nav-link" href="#">
                        <span class="menu-icon"><i class="mdi mdi-chart-bar"></i></span>
                        <span class="menu-title">Relatórios</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="container-fluid page-body-wrapper">
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="<?= site_url('/') ?>">
                        <img src="<?= base_url('assets/images/logo-ifro-mini.png') ?>" alt="logo" />
                    </a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                                <div class="navbar-profile">
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name">Usuário</p>
                                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                                <a class="dropdown-item preview-item" href="#">
                                    <div class="preview-thumbnail"><div class="preview-icon bg-dark rounded-circle"><i class="mdi mdi-logout text-danger"></i></div></div>
                                    <div class="preview-item-content"><p class="preview-subject mb-1">Sair</p></div>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="mdi mdi-format-line-spacing"></span>
                    </button>
                </div>
            </nav>
            <div class="main-panel">
                <div class="content-wrapper">
                    
                    <h1>Página Inicial</h1>
                    <p class="text-muted">Bem-vindo ao sistema do RoBoto.</p>

                </div>
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">

                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright© 2025~ <a href="javascript: void()">Calama Dev's</a>.</span>

                        <span class="text-muted float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Feito a mão e com <i class="mdi mdi-heart text-danger"></i></span>

                    </div>
                </footer>
            </div>
            </div>
        </div>
</body>
</html>