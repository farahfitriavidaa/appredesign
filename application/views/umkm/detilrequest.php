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

                            <?php $id_pesan = trimId('PS', $detil_request->IDPesan);?>
                            <a href="<?=base_url();?>umkm/diskusi/<?=$id_pesan?>" class="btn btn-raised btn-secondary mt-4">
                            <i class="mdi mdi-comment"></i>
                                Diskusi dengan Pengelola
                            </a>

                            <div class="row align-items-stretch mt-4">
                                <div class="col-lg-6 mb-4">
                                    <div class="card" style="height:100%;">
                                        <div class="card-body">
                                            <strong class="d-block">Nama Produk</strong>
                                            <p><?= $data_produk->Nama_produk; ?></p>

                                            <strong class="d-block">Keterangan</strong>
                                            <p><?= $data_produk->Keterangan; ?></p>

                                            <strong class="d-block">Foto Produk</strong>
                                            <?php if(empty($data_produk->Foto_produk)): ?>
                                            <p><i class="text-muted">Tidak ada foto produk</i></p>
                                            <?php else: ?>
                                            <div class="mb-4" style="height: 160px;">
                                                <img src="<?=base_url()."uploads/foto_produk/".$data_produk->Foto_produk;?>" alt="foto produk" class="img-thumbnail" style="max-height: 160px">
                                            </div>
                                            <?php endif; ?>

                                            <strong class="d-block">Logo Produk</strong>
                                            <?php if(empty($data_produk->Logo_produk)): ?>
                                            <p><i class="text-muted">Tidak ada logo produk</i></p>
                                            <?php else: ?>
                                            <div class="mb-4" style="height: 160px;">
                                                <img src="<?=base_url()."uploads/logo_produk/".$data_produk->Logo_produk;?>" alt="logo produk" class="img-thumbnail" style="max-height: 160px">
                                            </div>
                                            <?php endif; ?>

                                            <strong class="d-block">Kemasan Produk</strong>
                                            <?php if(empty($data_produk->Kemasan_produk)): ?>
                                            <p><i class="text-muted">Tidak ada foto kemasan produk</i></p>
                                            <?php else: 
                                                    $kemasan_produk = explode(',', $data_produk->Kemasan_produk);
                                            ?>
                                            <div class="mb-4">
                                                <?php foreach($kemasan_produk as $img):?>
                                                    <img src="<?=base_url()."uploads/foto_kemasan_lama/".$img;?>" alt="kemasan produk" class="img-thumbnail mr-1" style="max-height: 160px;">
                                                <?php endforeach; ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>

                                        <?php if($detil_request->Status < 5): ?>
                                        <div class="card-footer">
                                            <?php
                                                $path   = $detil_request->IDPesan;
                                                $path   = trimId('PS', $path);
                                            ?>
                                            <a class="btn btn-raised btn-secondary float-right" href="<?=base_url();?>umkm/request/editRequest/<?=$path;?>">
                                                Edit Data Produk
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-lg-6 mb-4">
                                    <div class="card" style="height:100%;">
                                        <div class="card-body">
                                            <strong class="d-block">Tanggal Request</strong>
                                            <p>
                                            <?php
                                                $tgl_order  = $detil_request->Tgl_order;
                                                if(!is_null($tgl_order)){
                                                    $tgl_order  = strtotime($tgl_order);
                                                    echo date('d M Y', $tgl_order);
                                                }
                                                else
                                                    echo "<i class=\"text-muted\">Tidak ada</i>"
                                            ?>
                                            </p>
                                            <strong class="d-block">Status</strong>
                                            <p>
                                            <?= cetakStatus($detil_request->Status, $level, false); ?>
                                            </p>
                                            <strong class="d-block">Harga</strong>
                                            <p>
                                            <?php
                                                $harga = $detil_request->Harga;
                                                echo $harga==NULL?'<i class="text-muted">Belum ditentukan</i>':$harga;
                                            ?>
                                            </p>
                                            <strong class="d-block">Tanggal Mulai Desain</strong>
                                            <p>
                                            <?php
                                                $tgl_mulai = $detil_request->Tgl_mulai;
                                                echo $tgl_mulai==NULL?'<i class="text-muted">Belum ditentukan</i>':$tgl_mulai;
                                            ?>
                                            </p>
                                            <strong class="d-block">Rencana Desain Selesai</strong>
                                            <p>
                                            <?php
                                                $tgl_akhir = $detil_request->Tgl_akhir;
                                                echo $tgl_akhir==NULL?'<i class="text-muted">Belum ditentukan</i>':$tgl_akhir;
                                            ?>
                                            </p>
                                            <strong class="d-block">Keterangan Desain</strong>
                                            <p>
                                            <?php
                                                $ket = $detil_request->Keterangan_design;
                                                echo $ket==NULL?'<i class="text-muted">Tidak Ada Keterangan</i>':$ket;
                                            ?>
                                            </p>
                                            <strong class="d-block">Desainer</strong>
                                            <p>
                                            <?php if($desainer['ada']): ?>
                                                <?=$desainer['desainer'];?>
                                            <?php else: ?>
                                                <i class="text-muted"><?=$desainer['desainer']?></i>
                                            <?php endif; ?>
                                            </p>

                                            <strong class="d-block">Hasil Desain</strong>
                                            <?php 
                                                $hasil_design = $detil_request->Hasil_design;
                                                if(empty($hasil_design)): ?>
                                                    <p><i class="text-muted">Belum ada hasil desain</i></p>
                                            <?php 
                                                else: 
                                                $hasil_design = explode(',', $hasil_design) ?>
                                                <div class="mb-4">
                                                    <?php foreach($hasil_design as $img):?>
                                                        <img src="<?=base_url()."uploads/hasil_design/".$img?>" alt="hasil desain" class="img-thumbnail mr-2 mb-2" style="max-height:240px;">
                                                    <?php endforeach;?>
                                                </div>
                                            <?php endif; ?>

                                            <strong class="d-block">Revisi Desain</strong>
                                            <?php 
                                                $revisi = $detil_request->Revisi_design;
                                                if(empty($revisi)): ?>
                                                    <p><i class="text-muted">Belum ada hasil desain</i></p>
                                            <?php 
                                                else: 
                                                $revisi = explode(',', $revisi) ?>
                                                <div class="mb-4">
                                                    <?php foreach($revisi as $img):?>
                                                        <img src="<?=base_url()."uploads/revisi_design/".$img?>" alt="revisi desain" class="img-thumbnail mr-2 mb-2" style="max-height:240px;">
                                                    <?php endforeach;?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <?php if($detil_request->Status < 5): ?>
                                        <div class="card-footer">
                                            <a class="btn btn-raised btn-secondary float-right" href="<?=base_url();?>umkm/request/editRequest/<?=$path;?>">
                                                Edit Keterangan Desain
                                            </a>
                                        </div>
                                        <?php endif; ?>
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