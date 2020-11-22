<!DOCTYPE html>
<html lang="en" style="scroll-behavior:smooth">

    <?php $this->load->view('admin/layout/Head'); ?>

    <body class="fixed-left">

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

                <?php $this->load->view('admin/layout/Sidebar') ?>
                <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <?php $this->load->view('admin/layout/Navbar') ?>
                    <!-- Top Bar End -->

                    <div class="page-content-wrapper ">

                        <div class="container-fluid">
                            <?php
                                if( ! is_null($this->session->flashdata('alert'))):
                            ?>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-danger alert-dismissible fade show mb-0 mt-3" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <?=$this->session->flashdata('alert');?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ( ! is_null($pemesanan)): ?>
                            <button class="btn btn-raised btn-secondary mt-4" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="detilProduk detilRequest">
                            <i class="mdi mdi-format-align-left"></i>
                                Deskripsi Request
                            </button>

                            <div class="row align-items-stretch mt-4">
                                <!-- Data bagian kiri -->
                                <div class="col-lg-6 mb-4 collapse multi-collapse" id="detilProduk">
                                    <div class="card" style="height:100%;">
                                        <div class="card-body">
                                            <strong class="d-block">Nama Produk</strong>
                                            <p><?=$pemesanan->Nama_produk?></p>

                                            <strong class="d-block">Keterangan</strong>
                                            <p><?=$pemesanan->Keterangan?></p>

                                            <strong class="d-block">Foto Produk</strong>
                                            <?php if(empty($pemesanan->Foto_produk)): ?>
                                            <p><i class="text-muted">Tidak ada foto produk</i></p>
                                            <?php else: ?>
                                            <div class="mb-4" style="height: 160px;">
                                                <img src="<?=base_url()."uploads/foto_produk/".$pemesanan->Foto_produk;?>" alt="foto produk" class="img-thumbnail" style="height:inherit">
                                            </div>
                                            <?php endif; ?>

                                            <strong class="d-block">Logo Produk</strong>
                                            <?php if(empty($pemesanan->Logo_produk)): ?>
                                            <p><i class="text-muted">Tidak ada logo produk</i></p>
                                            <?php else: ?>
                                            <div class="mb-4" style="height: 160px;">
                                                <img src="<?=base_url()."uploads/logo_produk/".$pemesanan->Logo_produk;?>" alt="logo produk" class="img-thumbnail" style="height:inherit">
                                            </div>
                                            <?php endif; ?>

                                            <strong class="d-block">Kemasan Produk</strong>
                                            <?php if(empty($pemesanan->Kemasan_produk)): ?>
                                            <p><i class="text-muted">Tidak ada foto kemasan produk</i></p>
                                            <?php else: ?>
                                            <div class="mb-4" style="height: 160px;">
                                                <img src="<?=base_url()."uploads/foto_kemasan_lama/".$pemesanan->Kemasan_produk;?>" alt="kemasan produk" class="img-thumbnail" style="height:inherit">
                                            </div>
                                            <?php endif; ?>

                                        </div>

                                        <?php if($pemesanan->Status < 5): ?>
                                        <div class="card-footer">
                                            <a class="btn btn-raised btn-secondary float-right" href="#">
                                                Edit Produk
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Data bagian kanan -->
                                <div class="col-lg-6 mb-4 collapse multi-collapse" id="detilRequest">
                                    <div class="card" style="height:100%;">
                                        <div class="card-body">
                                            <strong class="d-block">Tanggal Request</strong>
                                            <p>
                                            <?php
                                                $tgl_order  = $pemesanan->Tgl_order;
                                                $tgl_order  = strtotime($tgl_order);
                                                echo date('d-M-Y', $tgl_order);
                                            ?>
                                            </p>
                                            <strong class="d-block">Status</strong>
                                            <p>
                                            <?php switch($pemesanan->Status){
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
                                            </p>
                                            <strong class="d-block">Harga</strong>
                                            <p>
                                            <?php
                                                $harga = $pemesanan->Harga;
                                                echo $harga==NULL?'<i class="text-muted">Belum ditentukan</i>':$harga;
                                            ?>
                                            </p>
                                            <strong class="d-block">Tanggal Mulai Desain</strong>
                                            <p>
                                            <?php
                                                $tgl_mulai = $pemesanan->Tgl_mulai;
                                                echo $tgl_mulai==NULL?'<i class="text-muted">Belum ditentukan</i>':$tgl_mulai;
                                            ?>
                                            </p>
                                            <strong class="d-block">Rencana Desain Selesai</strong>
                                            <p>
                                            <?php
                                                $tgl_akhir = $pemesanan->Tgl_akhir;
                                                echo $tgl_akhir==NULL?'<i class="text-muted">Belum ditentukan</i>':$tgl_akhir;
                                            ?>
                                            </p>
                                            <strong class="d-block">Keterangan Desain</strong>
                                            <p>
                                            <?php
                                                $ket = $pemesanan->Keterangan_design;
                                                echo $ket==NULL?'<i class="text-muted">Tidak Ada Keterangan</i>':$ket;
                                            ?>
                                            </p>
                                            <strong class="d-block">Desainer</strong>
                                            <p>
                                            <?php if($designer['ada']): ?>
                                                <?=$designer['designer'];?>
                                            <?php else: ?>
                                                <i class="text-muted"><?=$designer['designer']?></i>
                                            <?php endif; ?>
                                            </p>

                                            <strong class="d-block">Hasil Desain</strong>
                                            <?php 
                                                $hasil_design = $pemesanan->Hasil_design;
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
                                                $revisi = $pemesanan->Revisi_design;
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

                                        <div class="card-footer">
                                            <a class="btn btn-raised btn-secondary float-right" href="#">
                                                Edit Keterangan
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bagian komentar -->
                                <div class="col-12">
                                    <div class="mb-4">
                                        <div class="mb-4">
                                            <strong>Diskusi dengan UMKM</strong>
                                        </div>
                                        <div class="px-2" style="overflow-y: auto; max-height: 1920px">
                                        <?php foreach($daftar_komentar as $diskusi): ?>
                                            <div class="card mb-3">
                                                <div class="card-header">
                                                    <div class="row ml-0">
                                                        <div class="mr-2">
                                                            <img src="<?=base_url()?>uploads/foto_user/<?=$diskusi->Foto?>" alt="foto profil" class="img-fluid crop-center rounded-circle" style="width:40px;height:40px;"/>
                                                        </div>
                                                        <div>
                                                            <strong class="d-block"><?=$diskusi->Nama_lengkap?></strong>
                                                            <span class="text-muted">
                                                                <?php
                                                                    if($diskusi->Level==="UMKM")
                                                                        echo $diskusi->Level." - ".$diskusi->Nama_umkm;
                                                                    else
                                                                        echo $diskusi->Level;
                                                                ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <?php if( ! is_null($diskusi->Foto_diskum)): ?>
                                                        <a href="<?=base_url();?>uploads/foto_diskum/<?=$diskusi->Foto_diskum?>" class="btn btn-secondary" download>Download gambar</a>
                                                        <img src="<?=base_url();?>uploads/foto_diskum/<?=$diskusi->Foto_diskum?>" alt="foto untuk diskusi" class="img-thumbnail d-block" style="max-width: 240px; max-height: 480px;">
                                                    <?php endif; ?>

                                                    <p class="mt-2 mb-2"><?=$diskusi->Komentar?></p>
                                                </div>
                                                <div class="card-footer">
                                                    <span class="text-13 text-muted float-right"><?=cetakWaktu($diskusi->Tanggal_waktu);?></span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                        </div>

                                        <!-- Bagian input komentar -->
                                        <div class="card mt-4">
                                            <div id="preview-wrapper" style="display: none; height: 0;">
                                                <button class="btn btn-secondary position-absolute" id="hapus-foto" aria-label="Close" style="top: 24px; right: 24px;background-color: #fff">
                                                    Hapus Foto
                                                </button>
                                                <img src="" alt="foto yang di upload" class="img-thumbnail" id="foto-upload" style="max-height: 320px">
                                            </div>

                                            <form action="<?=base_url();?>Admin/tambahKomentar" method="post" enctype="multipart/form-data" class="mb-0" autocomplete="off">
                                                <div style="display: flex; flex-flow: row nowrap; padding: 8px 16px;">
                                                    <div class="form-group" style="display:inline; padding:0; margin: 0; flex: auto">
                                                        <?php
                                                            $id_pesan   = $pemesanan->IDPesan;
                                                            $id_pesan   = trimId('PS', $id_pesan);
                                                        ?>
                                                        <input type="hidden" name="np" value="<?=$id_pesan?>">
                                                        <input type="text" name="komentar" placeholder="Masukan pesan..." class="form-control" style="display: unset;">
                                                    </div>
                                                    <label for="foto" class="btn btn-secondary mr-2 ml-2"><span id="label">Tambahkan Foto</span>
                                                        <input type="file" name="foto-komentar" id="foto" style="display:none">
                                                    </label>
                                                    <input type="submit" value="Kirim" class="btn btn-primary">
                                                </div>
                                            </form>


                                        </div>
                                    </div>

                                </div>

                            </div> <!-- end row -->
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

        <!-- Custom script untuk menampilkan preview gambar -->
        <script>
            const input = document.getElementById('foto');
            input.addEventListener('change', tampilPreview);

            function tampilPreview(e) {
                let wrapper = document.getElementById('preview-wrapper');
                wrapper.style.height= 'auto';
                wrapper.style.display= 'block';
                wrapper.classList.add('p-3');

                let preview = document.getElementById('foto-upload');
                preview.src = URL.createObjectURL(event.target.files[0]);
                preview.onload = function(){
                    URL.revokeObjectURL(preview.src);
                }

                let label = document.getElementById('label');
                label.innerText = 'Ganti Foto';
            }

            const hapus = document.getElementById('hapus-foto');
            hapus.addEventListener('click', hapusFoto);

            function hapusFoto() {
                input.value = '';

                let preview = document.getElementById('foto-upload');
                preview.src = '';

                let wrapper = document.getElementById('preview-wrapper');
                wrapper.style.height= '0';
                wrapper.style.display= 'none';
                wrapper.classList.remove('p-3');

                let label = document.getElementById('label');
                label.innerText = 'Tambahkan Foto';
            }
        </script>

        <?php $this->load->view('admin/layout/Footer') ?>
