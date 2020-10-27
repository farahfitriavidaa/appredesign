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
                                        <h4 class="page-title">Edit Request</h4>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!-- end page title end breadcrumb -->

                            <div class="row">
                                <div class="col-md-12 col-xl-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <form action="<?=base_url();?>Umkm/updateRequest" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="np" value="<?php echo trimId('PS', $detil_request->IDPesan)?>">
                                                <div class="form-group">
                                                    <input type="text" name="nama-produk" class="form-control" placeholder="Nama Produk" value="<?=$data_produk->Nama_produk?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <textarea name="keterangan-produk" class="form-control" rows="3" placeholder="Keterangan singkat mengenai produk Anda" required><?=$data_produk->Keterangan?></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <textarea name="keterangan-desain" class="form-control" rows="3" placeholder="Keterangan mengenai desain yang diinginkan" required><?=$detil_request->Keterangan_design?></textarea>
                                                </div>

                                                <div class="form-group bmd-form-group">
                                                    <label for="foto">Foto Produk</label>
                                                    <input type="file" name="foto-produk" class="form-control-file" id="foto">
                                                </div>

                                                <div class="form-group bmd-form-group">
                                                    <label for="logo">Logo Produk</label>
                                                    <input type="file" name="logo-produk" class="form-control-file" id="logo">
                                                    <small class="text-muted">Tambahkan logo produk jika ada</small>
                                                </div>

                                                <div class="form-group bmd-form-group">
                                                    <label for="kemasan">Kemasan Produk</label>
                                                    <input type="file" name="kemasan-produk" class="form-control-file" id="kemasan">
                                                    <small class="text-muted">Tambahkan gambar kemasan yang sekarang dimiliki</small>
                                                </div>

                                                <div class="form-group bmd-form-group">
                                                    <a href="<?=base_url();?>Umkm/lihatRequest" class="btn btn-secondary border-0">Batal</a>
                                                    <button type="submit" class="btn btn-primary btn-raised">Simpan Perubahan</button>
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