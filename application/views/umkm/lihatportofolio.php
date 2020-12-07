<!DOCTYPE html>
<html lang="en">

    <?php $this->load->view('umkm/layout/head'); ?>

    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                    <i class="mdi mdi-close"></i>
                </button>

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <img src="<?=base_url()?>asset/logo2.png" alt="logo gDESK" style="height:100%;">
                    </div>
                </div>

                <?php $this->load->view('umkm/layout/sidebar-portofolio') ?>
                <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <?php $this->load->view('umkm/layout/navbar') ?>
                    <!-- Top Bar End -->

                    <div class="page-content-wrapper ">

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <h1 class="page-title m-0">Designer</h1>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!-- end page title end breadcrumb -->

                            <div class="card mb-4">
                                <div class="card-body">
                                    <h2 class="d-block h4 mt-0 mb-3"><?=$designer->Nama_lengkap?></h2>

                                    <p><?=$designer->Keterangan?></p>
                                </div>
                            </div>

                            <h3 class="h6 my-4">Daftar Portofolio</h3>

                            <?php if(empty($daftar_portofolio)): ?>
                                <i>Belum ada portofolio</i>
                            <?php else: ?>
                            <div class="row">
                                <?php foreach($daftar_portofolio as $portofolio): ?>
                                <div class="col-lg-6 col-md-12 mb-4">
                                    <div class="card" style="min-height:365px;">
                                        <div class="card-body">
                                            <h4 class="d-block h5 mt-0 mb-4"><?=$portofolio->Judul?></h4>

                                            <p><?=$portofolio->Detail_portofolio?></p>

                                            <div>
                                                <?php
                                                    $bukti = cekPortofolio($portofolio->Bukti_portofolio);
                                                    if ($bukti==='image'):
                                                ?>
                                                    <div>
                                                        <img src="<?=base_url()."uploads/bukti_portofolio/".$portofolio->Bukti_portofolio;?>" alt="bukti portofolio" class="img-thumbnail" style="max-height:240px;">
                                                    </div>
                                                <?php elseif($bukti==='link'): ?>
                                                    <a href="<?=$portofolio->Bukti_portofolio?>" class="btn btn-secondary" target="_blank" rel="noopener noreferrer">
                                                        <i class="mdi mdi-link"></i>
                                                        Link portofolio
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>

                        </div><!-- container -->

                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->

                <footer class="footer">
                    © 2018 Urora by Mannatthemes.
                </footer>

            </div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->

        <?php $this->load->view('umkm/layout/footer') ?>