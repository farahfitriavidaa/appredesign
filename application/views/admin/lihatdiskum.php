<!DOCTYPE html>
<html lang="en">

    <?php $this->load->view('admin/layout/head'); ?>

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

                <?php $this->load->view('admin/layout/sidebar') ?>
                <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <?php $this->load->view('admin/layout/navbar') ?>
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
                                <p>Belum ada diskusi. Anda akan melihat daftar diskusi di sini jika Anda memberi komentar mengenai order <i>redesign</i> produk UMKM.</p>
                                <a class="btn btn-raised btn-primary" href="<?=base_url();?>Admin/kelolaPemesanan">
                                    Lihat Pemesanan dan Beri Komentar
                                </a>
                            <?php else: ?>

                            <div class="mb-4">
                            <?php foreach($daftar_diskusi as $diskusi): ?>
                                <a href="<?=base_url();?>Admin/diskum/<?=trimId('PS', $diskusi->IDPesan)?>" target="_blank" class="list-diskusi mb-2" noopener noreferer>
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
                                                <span class="text-muted"><?=cetakWaktu($diskusi->Tanggal_waktu)?></span>
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

        <?php $this->load->view('admin/layout/footer') ?>