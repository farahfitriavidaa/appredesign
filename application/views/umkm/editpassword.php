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
                                if( ! is_null($this->session->flashdata('alert'))):
                                    $alert = $this->session->flashdata('alert');
                            ?>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-danger alert-dismissible fade show  mb-0 mt-3" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            Maaf, tidak bisa mengunggah foto atau gambar.
                                            <ul>
                                            <?php
                                                foreach($alert as $a):
                                                    if(!empty($a) && $a!=='sukses'):
                                            ?>
                                                        <li><?=$a?>
                                                    <?php  endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- end alert -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <h4 class="page-title">Edit Profil</h4>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!-- end page title end breadcrumb -->

                            <div class="row">
                                <div class="col-md-12 col-xl-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <form action="<?=base_url();?>umkm/profil/editPwd" method="POST" enctype="multipart/form-data" autocomplete="off">
                                                <div class="row mx-1">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="password-lama" class="text-dark bmd-label-floating">Password Lama</label>
                                                            <input type="password" name="password-lama" class="form-control" id="password-lama" required>
                                                            <!-- <small class="text-danger">Password lama tidak boleh kosong</small> -->
                                                            <small class="text-danger"><?=isset($pesan_error)?$pesan_error:''?></small>
                                                            <?=form_error('password-lama', '<small class="d-block text-danger">', '</small>'); ?>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="password-baru" class="text-dark bmd-label-floating">Password Baru</label>
                                                            <input type="password" name="password-baru" class="form-control" id="password-baru" required>
                                                            <!-- <small class="text-danger">Password batu tidak boleh kosong</small> -->
                                                            <?=form_error('password-baru', '<small class="d-block text-danger">', '</small>'); ?>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="konfirmasi" class="text-dark bmd-label-floating">Konfirmasi Password Baru</label>
                                                            <input type="password" name="konfirmasi" class="form-control" id="konfirmasi" required>
                                                            <!-- <small class="text-danger">Konfirmasi password baru tidak boleh kosong</small> -->
                                                            <?=form_error('konfirmasi', '<small class="d-block text-danger">', '</small>'); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group bmd-form-group mt-4">
                                                    <button type="submit" class="btn btn-primary btn-raised float-right">Simpan Perubahan</button>
                                                    <a href="<?=base_url();?>umkm/profil" class="btn btn-secondary border-0 mr-2 float-right">Batal</a>
                                                </div>
                                            </form>
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