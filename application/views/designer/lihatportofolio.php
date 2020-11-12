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

                                    <p><?=$designer->Keterangan?></p>
                                </div>
                            </div>

                            <a class="btn btn-raised btn-primary mb-4" href="<?=base_url();?>Designer/buatPortofolio">
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
                                        <div class="card-body"  style="min-height:285px;">
                                            <h4 class="d-block h5 mt-0 mb-4"><?=$portofolio->Judul?></h4>

                                            <p><?=$portofolio->Detail_portofolio?></p>

                                            <div>
                                                <?php
                                                    $bukti = cekPortofolio($portofolio->Bukti_portofolio);
                                                    if ($bukti==='image'):
                                                ?>
                                                    <div style="height:160px;">
                                                        <img src="<?=base_url()."uploads/bukti_portofolio/".$portofolio->Bukti_portofolio;?>" alt="bukti portofolio" class="img-thumbnail" style="height:inherit">
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
                                            <a href="<?=base_url();?>Designer/editPortofolio/<?=$path?>" class="btn btn-secondary border-0 float-right" style="font-size:1.25rem">
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
                                                        <a class="btn btn-raised btn-danger ml-2" href="<?=base_url();?>Designer/hapusPortofolio/<?=$path;?>">Iya</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>

<!--
                            <div class="row">
                                <?php foreach($daftar_portofolio as $portofolio): ?>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="card mb-4">
                                            <?php if( ! strchr($portofolio->Bukti_portofolio, '/') ): ?>
                                                <img class="card-img-top img-fluid crop-center" src="<?=base_url();?>Uploads/bukti_portofolio/<?=$portofolio->Bukti_portofolio?>" alt="Gambar portofolio" style="max-height:240px;">
                                            <?php endif; ?>
                                            <?php
                                                $path = trimId('PRT', $portofolio->IDPortofolio);
                                            ?>
                                            <a href="<?=base_url();?>Designer/portofolio/<?=$path?>" class="hoverable">
                                                <div class="card-body">
                                                    <span class="d-block h5 card-title"><?=$portofolio->Judul?></span>
                                                    <p class="card-text text-muted">
                                                    <?php
                                                        $tambahan = strlen($portofolio->Detail_portofolio)>=47?'...':'';
                                                        echo substr($portofolio->Detail_portofolio, '0', '47').$tambahan;
                                                    ?>
                                                    </p>
                                                </div>
                                            </a>
                                            <div class="card-footer px-2">
                                                <button type="button" class="btn btn-secondary border-0 float-right py-0 px-2 mb-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:1.5rem;">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item hoverable" href="<?=base_url();?>Designer/editPortofolio/<?=$path?>">Edit</a>
                                                    <div class="dropdown-divider"></div>
                                                    <button class="dropdown-item hoverable" data-toggle="modal" data-target="#konfirmasi-hapus-<?=$path?>">Hapus</button>
                                                </div>
                                                
                                                <div class="modal fade" id="konfirmasi-hapus-<?=$path?>" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModal" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <p>Hapus data portofolio ini?</p>
                                                            </div>
                                                            <div class="modal-footer">                                                            
                                                                <button type="button" class="btn btn-raised btn-secondary" data-dismiss="modal">Tidak</button>
                                                                <a class="btn btn-raised btn-danger ml-2" href="<?=base_url();?>Designer/hapusPortofolio/<?=$path;?>">Iya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?> -->
                            </div> <!-- end of row --->

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