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
                                        <div class="alert alert-danger alert-dismissible fade show mb-0 mt-3" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <?=$alert?>
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
                                        <p>Belum ada request.</p>
                                        <p>Mungkin Anda ingin membuat portofolio dulu jika Anda belum membuatnya?</p>
                                        <a class="btn btn-raised btn-primary" href="<?=base_url();?>Designer/lihatPortofolio">
                                            Lihat portofolio saya
                                        </a>
                                    <?php else: ?>
                                        <div class="card m-b-30">
                                            <div class="card-body">
                                                <h4 class="mt-0 header-title">Tabel Request</h4>
                                                <p class="text-muted font-14">Lihat daftar request</p>

                                                <table id="datatable" class="table table-striped table-bordered w-100">
                                                    <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama Produk</th>
                                                        <th>Keterangan desain</th>
                                                        <th>Tgl rencana selesai</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <?php
                                                        $no = 1;
                                                        foreach ($daftar_request as $request):
                                                    ?>
                                                        <tr>
                                                            <td><?=$no++?></td>
                                                            <td><?=$request->Nama_produk?></td>
                                                            <td><?php
                                                                $tambahan = strlen($request->Keterangan_design)>=37?'...':'';
                                                                echo substr($request->Keterangan_design, '0', '47').$tambahan;
                                                            ?></td>
                                                            <td><?php
                                                                $tgl_order  = $request->Tgl_akhir;
                                                                if(!is_null($tgl_order)){
                                                                    $tgl_order  = strtotime($tgl_order);
                                                                    echo date('d M Y', $tgl_order);
                                                                }
                                                                else
                                                                    echo "Belum ditentukan"
                                                            ?></td>
                                                            <td>
                                                            <?php switch($request->Status){
                                                                case 0:
                                                                    $status = "Pending";
                                                                    $badge  = "light";
                                                                    break;
                                                                case 1:
                                                                    $status = "Telah didiskusikan";
                                                                    $badge  = "light";
                                                                    break;
                                                                case 2:
                                                                    $status = "Mulai dikerjakan desainer";
                                                                    $badge  = "light";
                                                                    break;
                                                                case 3:
                                                                    $status = "Selesai didesain";
                                                                    $badge  = "info";
                                                                    break;
                                                                case 4:
                                                                    $status = "Review hasil";
                                                                    $badge  = "info";
                                                                    break;
                                                                case 5:
                                                                    $status = "Desain disetujui";
                                                                    $badge  = "info";
                                                                    break;
                                                                case 6:
                                                                    $status = "Belum dibayar";
                                                                    $badge  = "warning";
                                                                    break;
                                                                case 7:
                                                                    $status = "Lunas";
                                                                    $badge  = "success";
                                                                    break;
                                                                case 8:
                                                                    $status = "Cancel";
                                                                    $badge  = "danger";
                                                                    break;
                                                                default:
                                                                    $status = "Pending";
                                                                    $badge  = "light";
                                                                    break;
                                                            }?>
                                                                <span class="badge badge-<?=$badge?>" style="font-size:unset"><?=$status?></span>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-raised btn-primary" href="<?=base_url();?>Designer/request/<?=trimId('PS', $request->IDPesan);?>">Lihat Detail</a>
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

        <?php $this->load->view('designer/layout/footer') ?>