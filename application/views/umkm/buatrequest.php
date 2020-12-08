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
                                            <form action="<?=base_url();?>Umkm/tambahRequest" method="POST" class="mb-0" enctype="multipart/form-data" autocomplete="off">
                                            <div class="form-group">
                                                    <label for="nama-produk" class="bmd-label-floating">Nama Produk</label>
                                                    <input type="text" name="nama-produk" class="form-control" id="nama-produk" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="keterangan-produk" class="bmd-label-floating">Keterangan singkat mengenai produk Anda</label>
                                                    <textarea name="keterangan-produk" class="form-control" id="keterangan-produk" required></textarea>
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
                                                    <label for="kemasan">Kemasan Produk (diperlukan)</label>
                                                    <input type="file" name="kemasan-produk" class="form-control-file" id="kemasan" required>
                                                    <small class="text-muted">Tambahkan gambar kemasan yang sekarang dimiliki</small>
                                                </div>

                                                <div class="form-group">
                                                    <label for="keterangan-desain" class="bmd-label-floating">Keterangan mengenai desain yang diinginkan</label>
                                                    <textarea name="keterangan-desain" class="form-control" id="keterangan-produk" required></textarea>
                                                </div>

                                                <div class="form-group bmd-form-group">
                                                    <span class="text-secondary">Pilih designer</span>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio" name="desainer" id="tidak-ada" value="0" checked>
                                                        <label class="form-check-label text-dark" for="tidak-ada">
                                                            Dipilihkan pengelola saja
                                                        </label>
                                                    </div>
                                                    <?php
                                                        $no = 0;
                                                        foreach ($desainers as $desainer):
                                                            $path   = trimId('DG', $desainer->IDDesigner);
                                                    ?>
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="radio" name="desainer" id="<?='desainer-'.$no?>" value="<?=$path?>">
                                                            <label class="form-check-label text-dark" for="<?='desainer-'.$no?>">
                                                                <?=$desainer->Nama_lengkap?>
                                                            </label>
                                                            <a href="<?=base_url();?>Umkm/lihatPortofolio/<?=$path?>" target="_blank" class="ml-2 text-muted" noopener noreferer>(Lihat Portofolio)</a>
                                                        </div>
                                                    <?php
                                                        $no++;
                                                        endforeach;
                                                    ?>

                                                </div>

                                                <div class="form-group bmd-form-group">
                                                    <a href="<?=base_url();?>Umkm/lihatRequest" class="btn btn-secondary border-0">Batal</a>
                                                    <button type="submit" class="btn btn-primary btn-raised">Kirim</button>
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