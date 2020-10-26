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
                                if($this->session->flashdata('alert')):
                            ?>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-primary alert-dismissible fade show mb-0 mt-3" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <?=$this->session->flashdata('alert'); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- end alert -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <h4 class="page-title">Lihat Request</h4>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-12">
                                    <?php if(!$has_request): ?>
                                        <p>Tidak ada daftar request, Anda belum membuat request.</p>
                                        <a class="btn btn-raised btn-primary" href="<?=base_url();?>Umkm/buatRequest">
                                        <i class="mdi mdi-plus"></i>
                                            Buat Request Baru
                                        </a>
                                    <?php else: ?>
                                        <div class="card m-b-30">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h4 class="mt-0 header-title">Tabel Request</h4>
                                                        <p class="text-muted font-14">Lihat daftar request yang telah dibuat</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <a class="btn btn-raised btn-primary float-right" href="<?=base_url();?>Umkm/buatRequest">
                                                        <i class="mdi mdi-plus"></i>
                                                            Buat Request Baru
                                                        </a>
                                                    </div>
                                                </div>

                                                <table id="datatable" class="table table-striped table-bordered w-100">
                                                    <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Keterangan</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <?php
                                                        $no = 1;
                                                        foreach ($requests as $request):
                                                    ?>
                                                        <tr>
                                                            <td><?=$no++?></td>
                                                            <td><?=$request->Keterangan_design?></td>
                                                            <td>
                                                                <?php switch($request->Status){
                                                                    case 0:
                                                                        echo 'Pending';
                                                                        break;
                                                                    case 1:
                                                                        echo 'Telah didiskusikan';
                                                                        break;
                                                                    case 2:
                                                                        echo 'Mulai dikerjakan desainer';
                                                                        break;
                                                                    case 3:
                                                                        echo 'Selesai didesain';
                                                                        break;
                                                                    case 4:
                                                                        echo 'Review hasil';
                                                                        break;
                                                                    case 5:
                                                                        echo 'Desain disetujui';
                                                                        break;
                                                                    case 6:
                                                                        echo 'Belum dibayar';
                                                                        break;
                                                                    case 7:
                                                                        echo 'Lunas';
                                                                        break;
                                                                    case 8:
                                                                        echo 'Cancel';
                                                                        break;
                                                                    default:
                                                                        echo 'Pending';
                                                                        break;
                                                                }?>
                                                            </td>
                                                            <td>
                                                            <?php
                                                                $path   = $request->IDPesan;
                                                                $path   = trimId('PS', $path);
                                                            ?>
                                                            <a class="btn btn-raised btn-primary" href="<?=base_url();?>Umkm/detilRequest/<?=$path;?>">Lihat Detil</a>
                                                            <a class="btn btn-raised btn-secondary" href="<?=base_url();?>Umkm/editRequest/<?=$path;?>">Edit</a>
                                                            <a class="btn btn-raised btn-danger" href="<?=base_url();?>Umkm/hapusRequest/<?=$path;?>">Hapus</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php endif; ?>
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