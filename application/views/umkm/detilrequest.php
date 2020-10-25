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

                            <div class="row">
                                <div class="col-lg-6 mt-4 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <strong class="d-block">Nama Produk</strong>
                                            <p><?=$data_produk->Nama_produk?></p>

                                            <strong class="d-block">Keterangan</strong>
                                            <p><?=$data_produk->Keterangan?></p>

                                            <strong class="d-block">Foto Produk</strong>
                                            <div class="mb-4" style="height: 160px;">
                                                <img src="<?=base_url()."uploads/foto_produk/".$data_produk->Foto_produk;?>" alt="foto produk" class="img-thumbnail" style="height:inherit">
                                            </div>

                                            <strong class="d-block">Logo Produk</strong>
                                            <div class="mb-4" style="height: 160px;">
                                                <img src="<?=base_url()."uploads/logo_produk/".$data_produk->Logo_produk;?>" alt="logo produk" class="img-thumbnail" style="height:inherit">
                                            </div>

                                            <strong class="col-sm-3">Kemasan Produk</strong>
                                            <div style="height: 160px;">
                                                <img src="<?=base_url()."uploads/foto_kemasan_lama/".$data_produk->Kemasan_produk;?>" alt="kemasan produk" class="img-thumbnail" style="height:inherit">
                                            </div>

                                            <a class="btn btn-raised btn-secondary float-right" href="<?=base_url();?>Umkm/editRequest/#">
                                                Edit Produk
                                            </a>
                                        </div>
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-lg-6 mt-4 mb-4 h-100">
                                    <div class="card">
                                        <div class="card-body">
                                            <strong class="d-block">Tanggal Request</strong>
                                            <p>
                                            <?php
                                                $tgl_order  = $detil_request->Tgl_order;
                                                $tgl_order  = strtotime($tgl_order);
                                                echo date('d-M-Y', $tgl_order);
                                            ?>
                                            </p>
                                            <strong class="d-block">Status</strong>
                                            <p>
                                            <?php switch($detil_request->Status){
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
                                            </p>
                                            <strong class="d-block">Harga</strong>
                                            <p>
                                            <?php
                                                $harga = $detil_request->Harga;
                                                echo $harga==NULL?'Belum ditentukan':$harga;
                                            ?>
                                            </p>
                                            <strong class="d-block">Tanggal Mulai Desain</strong>
                                            <p>
                                            <?php
                                                $tgl_mulai = $detil_request->Tgl_mulai;
                                                echo $tgl_mulai==NULL?'Belum ditentukan':$tgl_mulai;
                                            ?>
                                            </p>
                                            <strong class="d-block">Rencana Desain Selesai</strong>
                                            <p>
                                            <?php
                                                $tgl_akhir = $detil_request->Tgl_akhir;
                                                echo $tgl_akhir==NULL?'Belum ditentukan':$tgl_akhir;
                                            ?>
                                            </p>
                                            <strong class="d-block">Keterangan Desain</strong>
                                            <p>
                                            <?php
                                                $ket = $detil_request->Keterangan_design;
                                                echo $ket==NULL?'Tidak Ada Keterangan':$ket;
                                            ?>
                                            </p>
                                            <strong class="d-block">Desainer</strong>
                                            <p>
                                            <?php
                                                // TO DO: ganti jadi nama desainer
                                                $desainer = $data_desainer->Nama_lengkap;
                                                echo $ket==NULL?'Ditentukan Pengelola':$desainer;
                                            ?>
                                            </p>
                                            <strong class="d-block">Hasil Desain</strong>
                                            <div class="mb-4" style="height: 160px;">
                                                <!-- TO DO: ganti direktori dan gambar hasil desain asli-->
                                                <?php
                                                    $hasil_desain = $data_produk->Logo_produk;
                                                    if(!empty($hasil_desain)):
                                                ?>
                                                <img src="<?=base_url()."uploads/logo_produk/".$hasil_desain;?>" alt="hasil desain" class="img-thumbnail" style="height:inherit">
                                                <?php else: ?>
                                                <p>Belum ada</p>
                                                <?php endif; ?>
                                            </div>
                                            <strong class="d-block">Revisi Desain</strong>
                                            <div class="mb-4" style="height: 160px;">
                                                <!-- TO DO: ganti direktori dan gambar hasil desain asli-->
                                                <?php
                                                    $hasil_desain = $data_produk->Foto_produk;
                                                    if(!empty($hasil_desain)):
                                                ?>
                                                <img src="<?=base_url()."uploads/foto_produk/".$hasil_desain;?>" alt="revisi desain" class="img-thumbnail" style="height:inherit">
                                                <?php else: ?>
                                                <p>Belum ada</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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