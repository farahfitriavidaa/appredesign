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
                                if( ! is_null($this->session->flashdata('alert'))):
                                    $alert = $this->session->flashdata('alert');
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

                            <?php $id_pesan = trimId('PS', $request->IDPesan);?>
                            <a href="<?=base_url();?>designer/diskusi/<?=$id_pesan?>" class="btn btn-raised btn-secondary mt-4">
                            <i class="mdi mdi-comment"></i>
                                Diskusi dengan Pengelola
                            </a>

                            <div class="row align-items-stretch mt-4">
                                <div class="col-lg-6 mb-4">
                                    <div class="card" style="height:100%;">
                                        <div class="card-body">
                                            <strong class="d-block">Tanggal Request Dibuat</strong>
                                            <p>
                                            <?php
                                                $tgl_order  = $request->Tgl_order;
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
                                                <?php cetakStatus($request->Status, false); ?>    
                                            </p>
                                            <strong class="d-block">Tanggal Mulai Desain</strong>
                                            <p>
                                            <?php
                                                $tgl_mulai = $request->Tgl_mulai;
                                                echo $tgl_mulai==NULL?'<i class="text-muted">Belum ditentukan</i>':$tgl_mulai;
                                            ?>
                                            </p>
                                            <strong class="d-block">Rencana Desain Selesai</strong>
                                            <p>
                                            <?php
                                                $tgl_akhir = $request->Tgl_akhir;
                                                echo $tgl_akhir==NULL?'<i class="text-muted">Belum ditentukan</i>':$tgl_akhir;
                                            ?>
                                            </p>
                                            <strong class="d-block">Keterangan Desain</strong>
                                            <p>
                                            <?php
                                                $ket = $request->Keterangan_design;
                                                echo $ket==NULL?'<i class="text-muted">Tidak Ada Keterangan</i>':$ket;
                                            ?>
                                            </p>
                                            <br>
                                            <strong class="d-block">Nama Produk</strong>
                                            <p><?=$request->Nama_produk?></p>

                                            <strong class="d-block">Keterangan</strong>
                                            <p><?=$request->Keterangan?></p>

                                            <strong class="d-block">Foto Produk</strong>
                                            <?php if(empty($request->Foto_produk)): ?>
                                            <p><i class="text-muted">Tidak ada foto produk</i></p>
                                            <?php else: ?>
                                            <div class="mb-4" style="height: 160px;">
                                                <img src="<?=base_url()."uploads/foto_produk/".$request->Foto_produk;?>" alt="foto produk" class="img-thumbnail" style="height:inherit">
                                            </div>
                                            <?php endif; ?>

                                            <strong class="d-block">Logo Produk</strong>
                                            <?php if(empty($request->Logo_produk)): ?>
                                            <p><i class="text-muted">Tidak ada logo produk</i></p>
                                            <?php else: ?>
                                            <div class="mb-4" style="height: 160px;">
                                                <img src="<?=base_url()."uploads/logo_produk/".$request->Logo_produk;?>" alt="logo produk" class="img-thumbnail" style="height:inherit">
                                            </div>
                                            <?php endif; ?>

                                            <strong class="d-block">Kemasan Produk</strong>
                                            <?php if(empty($request->Kemasan_produk)): ?>
                                            <p><i class="text-muted">Tidak ada foto kemasan produk</i></p>
                                            <?php else: 
                                                    $kemasan_produk = explode(',', $request->Kemasan_produk);
                                            ?>
                                            <div class="mb-4">
                                                <?php foreach($kemasan_produk as $img):?>
                                                    <img src="<?=base_url()."uploads/foto_kemasan_lama/".$img;?>" alt="kemasan produk" class="img-thumbnail mr-1" style="max-height: 160px;">
                                                <?php endforeach; ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-lg-6 mb-4">
                                    <div class="card" style="height:100%;">
                                        <div class="card-body">
                                            <?php if($status_rq<5): ?>

                                            <?=form_open_multipart('designer/request/uploadDesain', ['autocomplete' => 'off']);?>

                                                <input type="hidden" name="np" value="<?=$id_pesan?>">
                                                <div class="form-group">
                                                    <strong class="mb-0">Unggah <?=$status_rq <= 3 ? 'hasil desain' : 'revisi'?></strong>
                                                    <p class="text-muted">
                                                    <?php
                                                        if($status_rq <= 3)
                                                            echo 'Dengan mengunggah hasil desain maka akan mengubah status request menjadi "Selesai didesain".'
                                                    ?>
                                                    </p>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <input type="file" name="hasil-design[]" id="input-file-now" class="dropify" multiple="multiple" required/>
                                                    <small class="text-muted">format .jpg atau .png</small>
                                                </div>

                                                <div class="form-group mt-4">
                                                    <button type="submit" class="btn btn-primary btn-raised float-right">Unggah</button>
                                                </div>

                                                <div class="clearfix"></div>
                                            </form>
                                            <?php endif; ?>

                                            <strong class="d-block">Hasil Desain</strong>
                                            <?php 
                                                $hasil_design = $request->Hasil_design;
                                                if(empty($hasil_design)): ?>
                                                    <p><i class="text-muted">Belum ada hasil desain</i></p>
                                            <?php 
                                                else:
                                                    $hasil_design = explode(',', $hasil_design); ?>
                                                    <?php if($status_rq<=3): ?>
                                                        <button class="btn btn-danger" data-toggle="modal" data-target="#konfirmasi-hapus-hasil">Hapus hasil desain</button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="konfirmasi-hapus-hasil" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModal" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <span class="header-title">Apakah Anda yakin ingin menghapus hasil desain?</span>
                                                                        <p class="text-muted mt-3">Tindakan ini akan <strong>menghapus semua</strong> hasil desain yang pernah Anda unggah dan status request ini.</p>
                                                                    </div>
                                                                    <div class="modal-footer">                                                            
                                                                        <button type="button" class="btn btn-raised btn-primary" data-dismiss="modal">Batalkan</button>
                                                                        <a class="btn btn-raised btn-danger ml-2" href="<?=base_url();?>designer/request/hapusDesain/<?=$id_pesan?>">Iya, Saya yakin</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif;?>
                                                    <div class="mb-4">
                                                    <?php foreach($hasil_design as $img):?>
                                                        <img src="<?=base_url()."uploads/hasil_design/".$img?>" alt="hasil desain" class="img-thumbnail mr-2 mb-2">
                                                    <?php endforeach;?>
                                                    </div>
                                            <?php endif; ?>

                                            <strong class="d-block">Revisi Desain</strong>
                                            <?php 
                                                $revisi = $request->Revisi_design;
                                                if(empty($revisi)): ?>
                                                    <p><i class="text-muted">Tidak ada revisi desain</i></p>
                                            <?php
                                                else: 
                                                    $revisi = explode(',', $revisi)?>
                                                    <?php if($status_rq==4): ?>
                                                        <button class="btn btn-danger" data-toggle="modal" data-target="#konfirmasi-hapus-revisi">Hapus revisi</button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="konfirmasi-hapus-revisi" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModal" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <span class="header-title">Apakah Anda yakin ingin menghapus revisi?</span>
                                                                        <p class="text-muted mt-3">Tindakan ini akan <strong>menghapus semua</strong> revisi yang telah Anda unggah.</p>
                                                                    </div>
                                                                    <div class="modal-footer">                                                            
                                                                        <button type="button" class="btn btn-raised btn-primary" data-dismiss="modal">Batalkan</button>
                                                                        <a class="btn btn-raised btn-danger ml-2" href="<?=base_url();?>designer/request/hapusRevisi/<?=$id_pesan;?>">Iya, Saya yakin</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif;?>
                                                    <div>
                                                    <?php foreach($revisi as $img): ?>
                                                        <img src="<?=base_url()."uploads/revisi_design/".$img;?>" alt="revisi desain" class="img-thumbnail mr-2 mb-2">
                                                    <?php endforeach; ?>
                                                    </div>
                                            <?php endif; ?>
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

        <?php $this->load->view('designer/layout/footer') ?>