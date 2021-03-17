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
                                            <?=$alert;?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- end alert -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <h4 class="page-title">Edit Portofolio</h4>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!-- end page title end breadcrumb -->

                            <div class="row">
                                <div class="col-md-12 col-xl-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <?=form_open_multipart('designer/portofolio/updatePortofolio', ['class' => 'mb-0', 'autocomplete' => 'off']);?>

                                                <div class="form-group">
                                                    <label for="judul" class="bmd-label-floating">Judul Protofolio</label>
                                                    <input type="text" name="judul-portofolio" class="form-control" id="judul" value="<?=$portofolio->Judul?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="detil" class="bmd-label-floating">Deskripsi Protofolio</label>
                                                    <textarea name="detil-portofolio" class="form-control" id="detil" required><?=$portofolio->Detail_portofolio?></textarea>
                                                </div>

                                                <div style="margin:48px 0 -16px">
                                                    <span class="text-muted">Bukti Portofolio (link <strong>atau</strong> file)</span>
                                                </div>

                                                <div class="form-group">
                                                    <label for="link" class="bmd-label-floating">Link portofolio</label>
                                                    <input type="text" name="link-portofolio" class="form-control" id="link" value="<?=$bukti==='link'?$portofolio->Bukti_portofolio:''?>">
                                                </div>

                                                <?php if ($bukti==='link') :?>
                                                    <span class="btn btn-secondary mt-3" id="change" role="button">Ganti portofolio dengan file</span>
                                                <?php endif;?>

                                                <div class="form-group">
                                                    <input type="file" name="bukti-portofolio" id="input-file-now" class="dropify"/>
                                                    <small class="text-muted">format .png atau .jpg</small>
                                                </div>

                                                <?php if ($bukti==='image'): ?>
                                                <span>Bukti portofolio sebelumnya: </span>
                                                <div class="form-group" style="height:160px;">
                                                    <img src="<?=base_url()."uploads/bukti_portofolio/".$portofolio->Bukti_portofolio;?>" alt="bukti portofolio" class="img-thumbnail" style="height:inherit">
                                                </div>
                                                <?php endif; ?>

                                                
                                                <div class="form-group">
                                                    <input type="hidden" name="np" value="<?=$id_portofolio?>">
                                                </div>
                                                <div class="form-group mt-4">
                                                    <button type="submit" class="btn btn-primary btn-raised float-right ml-4">Submit</button>
                                                    <a href="<?=base_url();?>designer/portofolio" class="btn btn-secondary border-0 float-right">Batal</a>
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