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
                                        <h4 class="page-title">Buat Request Baru</h4>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-md-12 col-xl-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="general-label">
                                                <form class="mb-0">
                                                    <div class="form-group">
                                                        <textarea name="keterangan" class="form-control" id="keterangan" rows="3" placeholder="Keterangan mengenai desain yang Anda inginkan"></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" name="tanggal-akhir" class="form-control" data-mask="99-99-9999" placeholder="Target tanggal jadi">
                                                        <small class="form-text text-muted">Minimal 7 hari dari hari dibuatnya request</small>
                                                    </div>

                                                    <!-- <div class="form-group bmd-form-group">
                                                        <label for="foto">Gambar Kemasan</label>
                                                        <input type="file" class="form-control-file" id="foto">
                                                        <small class="text-muted">Tambahkan gambaran kemasan yang sekarang dimiliki</small>
                                                    </div> -->
                                                    
                                                    <div class="form-group bmd-form-group">
                                                        <button class="btn btn-secondary border-0">Batal</button>
                                                        <button type="submit" class="btn btn-primary btn-raised">Kirim</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->

                            </div> <!-- end row -->

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