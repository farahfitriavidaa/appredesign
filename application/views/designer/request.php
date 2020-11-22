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
                                            <?php switch($request->Status){
                                                case 1:
                                                    $status = "Request baru";
                                                    $badge  = "light";
                                                    break;
                                                case 2:
                                                    $status = "Mulai dikerjakan";
                                                    $badge  = "warning";
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
                                                case 6:
                                                case 7:
                                                    $status = "Desain disetujui";
                                                    $badge  = "success";
                                                    break;
                                                case 8:
                                                    $status = "Cancel";
                                                    $badge  = "danger";
                                                    break;
                                                default:
                                                    $status = "Unknown";
                                                    $badge  = "light";
                                                    break;
                                            }?>
                                                <span class="badge badge-<?=$badge?>" style="font-size:unset"><?=$status?></span>
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
                                            <?php else: ?>
                                            <div class="mb-4" style="height: 160px;">
                                                <img src="<?=base_url()."uploads/foto_kemasan_lama/".$request->Kemasan_produk;?>" alt="kemasan produk" class="img-thumbnail" style="height:inherit">
                                            </div>
                                            <?php endif; ?>
                                        </div>

                                        <?php if($request->Status < 5): ?>
                                        <div class="card-footer">
                                            <?php
                                                $path   = $request->IDPesan;
                                                $path   = trimId('PS', $path);
                                            ?>
                                            <a class="btn btn-raised btn-secondary float-right" href="<?=base_url();?>Umkm/editRequest/<?=$path;?>">
                                                Edit Data Produk
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-lg-6 mb-4">
                                    <div class="card" style="height:100%;">
                                        <div class="card-body">
                                            
                                            <form action="<?=base_url();?>Designer/uploadDesign" method="POST" enctype="multipart/form-data" autocomplete="off">
                                                <div class="form-group">
                                                    <strong class="mb-0">Unggah hasil desain</strong>
                                                    <p class="text-muted">Dengan mengunggah hasil desain maka akan mengubah status request menjadi "Selesai didesain".</p>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <input type="file" name="bukti-portofolio" id="input-file-now" class="dropify" multiple/>
                                                    <small class="text-muted">format .jpg atau .png</small>
                                                </div>

                                                <div class="form-group mt-4">
                                                    <button type="submit" class="btn btn-primary btn-raised float-right">Submit</button>
                                                    <a href="<?=base_url();?>Designer/lihatPortofolio" class="btn btn-secondary border-0 float-right">Batal</a>
                                                </div>

                                                <div class="clearfix"></div>
                                            </form>

                                            <strong class="d-block">Hasil Desain</strong>
                                            <!-- TO DO: ganti direktori dan gambar hasil desain asli -->
                                            <?php if(empty($request->Foto_produk)): ?>
                                            <p><i class="text-muted">Belum ada hasil desain</i></p>
                                            <?php else: ?>
                                            <div class="mb-4" style="height: 160px;">
                                                <img src="<?=base_url()."uploads/foto_kemasan_lama/".$request->Foto_produk;?>" alt="hasil desain" class="img-thumbnail" style="height:inherit">
                                            </div>
                                            <?php endif; ?>

                                            <strong class="d-block">Revisi Desain</strong>
                                            <!-- TO DO: ganti direktori dan gambar revisi desain asli -->
                                            <?php if(empty($request->Foto_produk)): ?>
                                            <p><i class="text-muted">Tidak ada revisi desain</i></p>
                                            <?php else: ?>
                                            <div style="height: 160px;">
                                                <img src="<?=base_url()."uploads/foto_kemasan_lama/".$request->Foto_produk;?>" alt="revisi desain" class="img-thumbnail" style="height:inherit">
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