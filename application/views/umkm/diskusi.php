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

                            <div class="row align-items-stretch mt-4">
                                <div class="col-lg-6 mb-4">
                                    <!-- Data bagian kiri -->
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

                                            <?php
                                                $path   = $pemesanan->IDPesan;
                                                $path   = trimId('PS', $path);
                                            ?>
                                        </div>

                                        <div class="card-footer">
                                            <a class="btn btn-raised btn-secondary float-right" href="<?=base_url();?>Umkm/editRequest/<?=$path;?>">
                                                Edit Produk
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Data bagian kanan -->
                                <div class="col-lg-6 mb-4">
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

                                            <!-- TO DO: ganti direktori dan gambar hasil desain asli -->
                                            <?php if(empty($pemesanan->Foto_produk)): ?>
                                                <p><i class="text-muted">Belum ada hasil desain</i></p>
                                            <?php else: ?>
                                                <div class="mb-4" style="height: 160px;">
                                                    <img src="<?=base_url()."uploads/foto_kemasan_lama/".$pemesanan->Foto_produk;?>" alt="hasil desain" class="img-thumbnail" style="height:inherit">
                                                </div>
                                            <?php endif; ?>

                                            <strong class="d-block">Revisi Desain</strong>

                                            <!-- TO DO: ganti direktori dan gambar revisi desain asli -->
                                            <?php if(empty($pemesanan->Foto_produk)): ?>
                                                <p><i class="text-muted">Tidak ada revisi desain</i></p>
                                            <?php else: ?>
                                                <div style="height: 160px;">
                                                    <img src="<?=base_url()."uploads/foto_kemasan_lama/".$pemesanan->Foto_produk;?>" alt="revisi desain" class="img-thumbnail" style="height:inherit">
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="card-footer">
                                            <a class="btn btn-raised btn-secondary float-right" href="<?=base_url();?>Umkm/editRequest/<?=$path;?>">
                                                Edit Keterangan
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bagian komentar -->
                                <div class="col-12">
                                    <div class="mb-4">
                                        <div class="mb-4">
                                            <strong>Diskusi dengan Pengelola/Designer/UMKM</strong>
                                        </div>
                                        <div class="px-2" style="overflow-y: auto; max-height: 1080px">

                                            <div class="card mb-3">
                                                <div class="card-header">
                                                    <div class="row ml-0">
                                                        <div class="mr-2">
                                                            <img src="<?=base_url()?>uploads/foto_user/umkm.png" alt="foto profil umkm" class="img-fluid crop-center rounded-circle" style="width:40px;height:40px;"/>
                                                        </div>
                                                        <div>
                                                            <strong class="d-block">Nama User</strong>
                                                            <span class="text-muted">UMKM - [Nama UMKM]/Designer/Pengelola</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magnam eos, ad voluptatum consequuntur dicta ipsa quaerat recusandae sunt excepturi laboriosam doloribus nihil sapiente, at dolorem necessitatibus temporibus odit adipisci et!</p>
                                                </div>
                                                <div class="card-footer">
                                                    <span class="text-13 text-muted float-right"><?=date('d-M-Y', $tgl_order);?></span>
                                                </div>
                                            </div>

                                            <div class="card mb-3">
                                                <div class="card-header">
                                                    <div class="row ml-0">
                                                        <div class="mr-2">
                                                            <img src="<?=base_url()?>uploads/foto_user/umkm.png" alt="foto profil umkm" class="img-fluid crop-center rounded-circle" style="width:40px;height:40px;"/>
                                                        </div>
                                                        <div>
                                                            <strong class="d-block">Nama User</strong>
                                                            <span class="text-muted">UMKM - [Nama UMKM]/Designer/Pengelola</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <img src="<?=base_url();?>uploads/foto_user/umkm.png" alt="foto untuk diskusi" class="img-thumbnail" style="max-width: 160px; max-height: 320px;">
                                                    <a href="<?=base_url();?>uploads/foto_user/umkm.png" class="btn btn-secondary ml-2" download>Download gambar</a>

                                                    <p class="mt-2 mb-2">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Recusandae accusantium fugit ratione temporibus, eum officiis facilis earum, veniam, eos adipisci voluptas quam. Aperiam rerum obcaecati repellendus nam doloremque sapiente ratione?</p>
                                                </div>
                                                <div class="card-footer">
                                                    <span class="text-13 text-muted float-right"><?=date('d-M-Y', $tgl_order);?></span>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Bagian input komentar -->
                                        <div class="card mt-4">
                                            <form action="#" class="mb-0">
                                                <div style="display: flex; flex-flow: row nowrap; padding: 8px 16px;">
                                                    <div class="form-group" style="display:inline; padding:0; margin: 0; flex: auto">
                                                        <input type="text" name="komentar" placeholder="Masukan pesan..." class="form-control" style="display: unset;">
                                                    </div>
                                                    <label for="foto" class="btn btn-secondary mr-2 ml-2"> Tambahkan foto
                                                        <input type="file" name="foto" id="foto" style="display:none;" aria-hidden="true">
                                                    </label>
                                                    <input type="submit" value="Kirim" class="btn btn-primary">
                                                </div>
                                            </form>

                                            <div id="preview-wrapper" style="display: none; max-height: 240px; height: 0; transition: height 0.25s ease-in;">
                                                <img src="" alt="foto yang di upload" class="img-thumbnail" id="foto-upload" style="height: 160px">
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
        
        <!-- Custom script untuk menampilkan preview gambar -->
        <script>
            const input = document.getElementById('foto');

            input.addEventListener('change', tampilPreview);

            function tampilPreview(e) {
                let wrapper = document.getElementById('preview-wrapper');
                wrapper.style.height= 'unset';
                wrapper.style.display= 'block';
                wrapper.classList.add('p-3');

                let preview = document.getElementById('foto-upload');
                preview.src = URL.createObjectURL(event.target.files[0]);
                preview.onload = function(){
                    URL.revokeObjectURL(preview.src);
                }
            }
        </script>

        <?php $this->load->view('umkm/layout/footer') ?>