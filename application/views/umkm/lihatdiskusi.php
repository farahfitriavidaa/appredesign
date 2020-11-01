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
                        <!--<a href="index.html" class="logo"><i class="mdi mdi-assistant"></i> Urora</a>-->
                        <a href="index.html" class="logo">
                            <img src="assets/images/logo-lg.png" alt="" class="logo-large">
                        </a>
                    </div>
                </div>

                <?php $this->load->view('umkm/layout/sidebar') ?>
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
                                        <h4 class="page-title">Lihat Diskusi</h4>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!-- end page title end breadcrumb -->

                            <?php if(!$has_diskum): ?>
                                <p>Belum ada diskusi. Anda akan melihat daftar diskusi di sini jika Anda memberi komentar atau mendapat respon dari Pengelola mengenai <i>re-design</i> produk Anda.</p>
                            <?php else: ?>

                            <div class="mb-4">
                            <?php foreach($daftar_diskusi as $diskusi): ?>
                                <a href="<?=base_url();?>Umkm/diskusi/<?=trimId('PS', $diskusi->IDPesan)?>" target="_blank" class="d-block mb-2 text-dark" noopener noreferer>
                                    <div class="card">
                                        <div class="card-body">
                                            <strong><?=$diskusi->Nama_produk?></strong>
                                            <p>
                                                <?php
                                                    $tambahan = strlen($diskusi->Komentar)>=47?'...':'';
                                                    echo substr($diskusi->Komentar, '0', '47').$tambahan;
                                                ?>
                                            </p>
                                            <div class="mt-2">
                                                <?php
                                                    $timestamp  = strtotime($diskusi->Tanggal_waktu);
                                                    $tgl_waktu  = date('d M', $timestamp);
                                                    $hari_ini   = date('d M');
                                                    
                                                    if($tgl_waktu == $hari_ini)
                                                        $tgl_waktu = date('H.i', $timestamp);
                                                ?>
                                                <span class="text-muted"><?=$tgl_waktu?></span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
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