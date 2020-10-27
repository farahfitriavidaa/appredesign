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
                                        <h4 class="page-title">Edit Request</h4>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!-- end page title end breadcrumb -->

                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-4">
                                            <div class="mb-2 mx-auto text-center" style="max-width: 120px; max-height: 120px;">
                                                <img src="<?=base_url()."uploads/foto_user/".$user->Foto;?>" alt="foto profil umkm" class="img-thumbnail crop-center rounded-circle" style="width:120px;height:120px">
                                            </div>
                                            <span class="h5 d-block text-center"><?=$umkm->Nama_umkm?></span>
                                        </div>

                                        <div class="col-md-8">
                                            <strong class="d-block">Nama Lengkap</strong>
                                            <p><?=$user->Nama_lengkap?></p>

                                            <strong class="d-block">Username</strong>
                                            <p><?=$user->Username?></p>

                                            <strong class="d-block">Email</strong>
                                            <p><?=$user->Email?></p>

                                            <strong class="d-block">Kontak UMKM</strong>
                                            <p><?=$umkm->No_telp?></p>

                                            <strong class="d-block">Alamat UMKM</strong>
                                            <p><?=$umkm->Alamat?></p>

                                            <?php
                                                $path   = $umkm->IDUMKM;
                                                $path   = trimId('UM', $path);
                                            ?>
                                            <a class="btn btn-raised btn-secondary float-right" href="<?=base_url();?>Umkm/editProfil/<?=$path;?>">
                                                Edit Profil
                                            </a>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>

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