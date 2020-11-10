<!DOCTYPE html>
<html lang="en">

    <?php $this->load->view('designer/layout/head'); ?>

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

                <?php $this->load->view('designer/layout/sidebar') ?>
                <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <?php $this->load->view('designer/layout/navbar') ?>
                    <!-- Top Bar End -->

                    <div class="page-content-wrapper ">

                        <div class="container-fluid">
                            <?php
                                if($this->session->flashdata('alert')):
                                    $alert = $this->session->flashdata('alert');
                            ?>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-danger alert-dismissible fade show  mb-0 mt-3" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            Maaf, pembuatan portofolio gagal
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
                                        <h4 class="page-title">Buat Portofolio Baru</h4>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!-- end page title end breadcrumb -->

                            <div class="row">
                                <div class="col-md-12 col-xl-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <form action="<?=base_url();?>Designer/tambahPortofolio" method="POST" class="mb-0" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="judul" class="bmd-label-floating">Judul Protofolio</label>
                                                    <input type="text" name="judul-portofolio" class="form-control" id="judul" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="detil" class="bmd-label-floating">Deskripsi Protofolio</label>
                                                    <textarea name="detil-portofolio" class="form-control" id="detil" required></textarea>
                                                </div>

                                                <div style="margin:48px 0 -16px">
                                                    <span class="text-muted">Bukti Portofolio (link atau file)</span>
                                                </div>

                                                <div class="form-group">
                                                    <label for="link" class="bmd-label-floating">Link portofolio</label>
                                                    <input type="text" name="link-portofolio" class="form-control" id="link" >
                                                </div>

                                                <div class="form-group">
                                                    <input type="file" name="bukti-portofolio" id="input-file-now" class="dropify"/>
                                                    <small class="text-muted">format .jpg, .png, atau .pdf</small>
                                                </div>

                                                <div class="form-group mt-4">
                                                    <button type="submit" class="btn btn-primary btn-raised float-right">Submit</button>
                                                    <a href="<?=base_url();?>Designer/lihatPortofolio" class="btn btn-secondary border-0 float-right">Batal</a>
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

        <?php $this->load->view('designer/layout/footer') ?>