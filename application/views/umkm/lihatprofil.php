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
                            <?php
                                if($this->session->flashdata('alert')):
                            ?>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-primary alert-dismissible fade show mb-0 mt-3" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <?=$this->session->flashdata('alert')?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- end alert -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <h4 class="page-title">Profil Saya</h4>
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
                                            
                                            <strong class="d-block">Password</strong>
                                            <p><a href="<?=base_url();?>umkm/profil/editPwd">(Ubah password)</a></p>

                                            <strong class="d-block">Kontak UMKM</strong>
                                            <p><?=$umkm->No_telp?></p>

                                            <strong class="d-block">Alamat UMKM</strong>
                                            <p><?=$umkm->Alamat?></p>

                                            <a class="btn btn-raised btn-secondary float-right" href="<?=base_url();?>umkm/profil/editProfil">
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