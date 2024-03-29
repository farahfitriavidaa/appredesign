<!DOCTYPE html>
<html lang="en">

    <?php $this->load->view('umkm/layout/head'); ?>

    <body class="fixed-left">

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

                    <div class="page-content-wrapper dashborad-v">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item active"><?=date('d M Y');?></li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Dashboard</h4>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <!-- end page title end breadcrumb -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <span class="h2">
                                        Selamat Datang
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xl-6">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h5 class="header-title mt-0 pb-3">Diskusi Terakhir</h5>
                                            
                                            <?php if(empty($diskusi_terakhir)): ?>
                                                <p>Belum ada diskusi. Anda akan melihat daftar diskusi terakhir di sini jika ada request yang Anda atau Pengelola komentari.</p>
                                                <a href="<?=base_url();?>umkm/request" class="btn btn-primary">Lihat Request dan Beri Komentar</a>
                                            <?php else: 
                                                foreach($diskusi_terakhir as $diskusi): ?>
                                                <a href="<?=base_url();?>umkm/diskusi/<?=trimId('PS',$diskusi->IDPesan);?>" class="list-diskusi mb-2">
                                                    <div class="card" style="box-shadow:unset;border:1px solid #e5e5e5;">
                                                        <div class="card-body">
                                                            <strong><?= character_limiter($diskusi->Nama_produk, 37); ?></strong>

                                                            <p><?= character_limiter($diskusi->Komentar, 37); ?></p>

                                                            <div class="mt-2">
                                                                <span class="text-muted"><?= cetakWaktu($diskusi->Tanggal_waktu); ?></span>
                                                                <?= cetakStatus($diskusi->Status, $level); ?>                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <?php endforeach;
                                            endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-xl-6">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h5 class="header-title mt-0 pb-3">Request Saya</h5>

                                            <?php if (empty($request_terbaru)): ?>
                                                <p>Belum ada request yang telah Anda buat.</p>
                                                <p>Request adalah pesanan Anda untuk melakukan <i title="desain ulang">redesign</i> kemasan.</p>
                                                <a class="btn btn-raised btn-primary" href="<?=base_url();?>umkm/request/buatRequest">Buat Request Baru</a>
                                            <?php else: 
                                                foreach($request_terbaru as $request): ?>
                                                <a href="<?=base_url();?>umkm/diskusi/<?=trimId('PS',$request->IDPesan);?>" class="list-diskusi mb-2">
                                                    <div class="card" style="box-shadow:unset;border:1px solid #e5e5e5;">
                                                        <div class="card-body">
                                                            <strong><?= character_limiter($request->Nama_produk, 37); ?></strong>

                                                            <div class="mt-2">
                                                                <?= cetakStatus($request->Status, $level); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <?php endforeach;
                                            endif; ?>
                                        </div>
                                    </div>
                                </div> 
                            </div>

                        </div>
                        <!-- container -->

                    </div>
                    <!-- Page content Wrapper -->
                </div>
                <!-- content -->

                <footer class="footer">
                    © 2018 Urora by Mannatthemes.
                </footer>

            </div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->

        <?php $this->load->view('umkm/layout/footer') ?>
