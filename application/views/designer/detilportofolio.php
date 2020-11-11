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

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <h4 class="page-title">Edit Portofolio</h4>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!-- end page title end breadcrumb -->

                            <div class="card" style="min-height:60vh;">
                                <div class="card-body">
                                    <strong class="d-block h5 mb-4"><?=$portofolio->Judul?></strong>

                                    <p><?=$portofolio->Detail_portofolio?></p>

                                    <div>
                                        <?php if ($bukti==='image'): ?>
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
                                    
                                    <a class="btn btn-raised btn-secondary position-absolute mt-4" href="<?=base_url();?>Designer/editPortofolio/<?=trimId('PRT', $portofolio->IDPortofolio)?>" style="right:16px;bottom:16px;">
                                        Edit Portofolio
                                    </a>
                                </div>
                            </div><!-- end card -->

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