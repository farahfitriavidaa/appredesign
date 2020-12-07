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
                                $alert = $this->session->flashdata('alert');
                                if($alert):
                            ?>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert <?=$alert['jenis']?> alert-dismissible fade show mb-0 mt-3" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <?=$alert['isi']?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- end alert -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <h4 class="page-title">Lihat Portofolio</h4>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!-- end page title end breadcrumb -->

                            <div class="card mb-4">
                                <div class="card-body">
                                    <span class="d-block h4 mb-3"><?=$designer->Nama_lengkap?></span>

                                    <p><?php
                                        if( ! is_null($designer->Keterangan) ):
                                            echo $designer->Keterangan;
                                        else:
                                    ?>
                                        <span class="text-muted">Belum ada bio/keterangan</span>
                                    <?php endif; ?>
                                    </p>
                                </div>
                            </div>

                            <a class="btn btn-raised btn-primary mb-4" href="<?=base_url();?>designer/portofolio/buatPortofolio">
                                <i class="mdi mdi-plus"></i>
                                Tambah Portofolio
                            </a>

                            <?php if(empty($daftar_portofolio)): ?>
                                <i>Belum ada portofolio</i>
                            <?php else: ?>
                            <div class="row">
                                <?php foreach($daftar_portofolio as $portofolio): ?>
                                <div class="col-lg-6 col-md-12 mb-4">
                                    <div class="card">
                                        <div class="card-body"  style="min-height:365px;">
                                            <h4 class="d-block h5 mt-0 mb-4"><?=$portofolio->Judul?></h4>

                                            <p><?=$portofolio->Detail_portofolio?></p>

                                            <div>
                                                <?php
                                                    $bukti = cekPortofolio($portofolio->Bukti_portofolio);
                                                    if ($bukti==='image'):
                                                ?>
                                                    <div>
                                                        <img src="<?=base_url()."uploads/bukti_portofolio/".$portofolio->Bukti_portofolio;?>" alt="bukti portofolio" class="img-thumbnail" style="max-height:240px;">
                                                    </div>
                                                <?php elseif($bukti==='link'): ?>
                                                    <a href="<?=$portofolio->Bukti_portofolio?>" class="btn btn-secondary" target="_blank" rel="noopener noreferrer">
                                                        <i class="mdi mdi-link"></i>
                                                        Link portofolio
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <?php $path = trimId('PRT', $portofolio->IDPortofolio); ?>
                                        <div class="card-footer">
                                            <button class="btn btn-danger border-0 float-right ml-2" data-toggle="modal" data-target="#konfirmasi-hapus-<?=$path?>" style="font-size:1.25rem">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                            <a href="<?=base_url();?>designer/portofolio/editPortofolio/<?=$path?>" class="btn btn-secondary border-0 float-right" style="font-size:1.25rem">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="konfirmasi-hapus-<?=$path?>" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModal" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <p>Hapus data portofolio ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-raised btn-secondary" data-dismiss="modal">Tidak</button>
                                                        <a class="btn btn-raised btn-danger ml-2" href="<?=base_url();?>designer/portofolio/hapusPortofolio/<?=$path;?>">Iya</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

        <?php $this->load->view('designer/layout/footer') ?>