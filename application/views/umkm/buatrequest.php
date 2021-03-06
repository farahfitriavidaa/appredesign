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
                                            <ul>
                                            <?php
                                                foreach($alert as $a):
                                                    if(!empty($a) && $a!=='sukses'):
                                            ?>
                                                        <li><?=$a?>
                                                    <?php  endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- end alert -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <h4 class="page-title">Buat Request Baru</h4>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!-- end page title end breadcrumb -->

                            <div class="row">
                                <div class="col-md-12 col-xl-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <?=form_open_multipart('umkm/request/tambahRequest', ['class' => 'mb-0', 'autocomplete' => 'off']);?>
                                                <div class="form-group">
                                                    <label for="nama-produk" class="bmd-label-floating">Nama Produk</label>
                                                    <input type="text" name="nama-produk" class="form-control" id="nama-produk" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="keterangan-produk" class="bmd-label-floating">Keterangan singkat mengenai produk Anda</label>
                                                    <textarea name="keterangan-produk" class="form-control" id="keterangan-produk" required></textarea>
                                                </div>

                                                <div class="form-group bmd-form-group">
                                                    <label for="foto">Foto Produk</label>
                                                    <input type="file" name="foto-produk" class="form-control-file" id="foto">
                                                </div>

                                                <div class="position-relative" id="preview-wrapper-foto" style="display: none; height: 0;">
                                                    <img src="" alt="foto yang akan di upload" class="img-thumbnail" id="preview-foto" style="max-height: 120px">
                                                    <button type="button" class="btn btn-secondary position-absolute ml-2" id="hapus-foto" aria-label="Close" style="background-color: #fff">
                                                        Hapus Foto
                                                    </button>
                                                </div>

                                                <div class="form-group bmd-form-group">
                                                    <label for="logo">Logo Produk</label>
                                                    <input type="file" name="logo-produk" class="form-control-file" id="logo">
                                                    <small class="text-muted">Tambahkan logo produk jika ada</small>
                                                </div>

                                                <div class="position-relative" id="preview-wrapper-logo" style="display: none; height: 0;">
                                                    <img src="" alt="foto yang akan di upload" class="img-thumbnail" id="preview-logo" style="max-height: 120px">
                                                    <button type="button" class="btn btn-secondary position-absolute ml-2" id="hapus-logo" aria-label="Close" style="background-color: #fff">
                                                        Hapus Logo
                                                    </button>
                                                </div>

                                                <div class="form-group bmd-form-group">
                                                    <label for="kemasan">Kemasan Produk (diperlukan)</label>
                                                    <input type="file" name="kemasan-produk[]" class="form-control-file" id="kemasan" multiple="multiple" required>
                                                    <small class="text-muted">Tambahkan gambar kemasan yang sekarang dimiliki</small>
                                                </div>

                                                <div id="preview-wrapper-kemasan" style="display: none; height: 0;">
                                                    <button type="button" class="btn btn-secondary ml-2" id="hapus-kemasan" aria-label="Close" style="background-color: #fff">
                                                        Hapus Semua Kemasan
                                                    </button>
                                                    <div id="preview-kemasan"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="keterangan-desain" class="bmd-label-floating">Keterangan mengenai desain yang diinginkan</label>
                                                    <textarea name="keterangan-desain" class="form-control" id="keterangan-produk" required></textarea>
                                                </div>

                                                <div class="form-group bmd-form-group">
                                                    <span class="text-secondary">Pilih designer</span>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio" name="desainer" id="tidak-ada" value="0" checked>
                                                        <label class="form-check-label text-dark" for="tidak-ada">
                                                            Dipilihkan pengelola saja
                                                        </label>
                                                    </div>
                                                    <?php
                                                        $no = 0;
                                                        foreach ($desainers as $desainer):
                                                            $path   = trimId('DG', $desainer->IDDesigner);
                                                    ?>
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="radio" name="desainer" id="<?='desainer-'.$no?>" value="<?=$path?>">
                                                            <label class="form-check-label text-dark" for="<?='desainer-'.$no?>">
                                                                <?=$desainer->Nama_lengkap?>
                                                            </label>
                                                            <a href="<?=base_url();?>umkm/request/lihatPortofolio/<?=$path?>" target="_blank" class="ml-2 text-muted" noopener noreferer>(Lihat Portofolio)</a>
                                                        </div>
                                                    <?php
                                                        $no++;
                                                        endforeach;
                                                    ?>

                                                </div>

                                                <div class="form-group bmd-form-group">
                                                    <a href="<?=base_url();?>umkm/request" class="btn btn-secondary border-0 mr-2">Batal</a>
                                                    <button type="submit" class="btn btn-primary btn-raised">Kirim Request</button>
                                                </div>
                                            <?=form_close();?>
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
        <script>
            var file = [
                {
                    "input": "foto",
                    "wrapper": "preview-wrapper-foto",
                    "preview": "preview-foto",
                },
                {
                    "input": "logo",
                    "wrapper": "preview-wrapper-logo",
                    "preview": "preview-logo"
                },
                {
                    "input": "kemasan",
                    "wrapper": "preview-wrapper-kemasan",
                    "preview": "preview-kemasan"
                }
            ];

            document.getElementById('foto').addEventListener('change', previewFoto.bind(event, 0));
            document.getElementById('logo').addEventListener('change', previewFoto.bind(event, 1));
            document.getElementById('kemasan').addEventListener('change', previewImgs.bind(event, 2));

            function previewFoto(idx) {
                // console.log(idx);
                // console.log(file[idx]);
                // console.log(file[idx].wrapper);
                let wrapper = document.getElementById(file[idx].wrapper);
                wrapper.style.height= 'auto';
                wrapper.style.display= 'block';

                let preview = document.getElementById(file[idx].preview);
                preview.src = URL.createObjectURL(event.target.files[0]);
                preview.onload = function(){
                    URL.revokeObjectURL(preview.src);
                }
            }

            function previewImgs(idx) {
                let wrapper = document.getElementById(file[idx].wrapper);
                wrapper.style.height= 'auto';
                wrapper.style.display= 'block';
                
                let preview = document.getElementById(file[idx].preview);

                const fileKemasan = event.target.files;

                for (let i = 0; i < fileKemasan.length; i++) {
                    let img = document.createElement('img');

                    img.alt = 'gambar kemasan yang akan di-upload';
                    img.classList.add('img-thumbnail', 'm-2', 'kemasan');
                    img.style.maxHeight = '160px';
                    img.src = URL.createObjectURL(fileKemasan[i]);
                    img.onload = function(){
                        URL.revokeObjectURL(img.src);
                    }

                    // console.log("file: "+fileKemasan[i]);

                    preview.appendChild(img);
                }
            }

            document.getElementById('hapus-foto').addEventListener('click', hapusImg.bind(null, 0));
            document.getElementById('hapus-logo').addEventListener('click', hapusImg.bind(null, 1));
            document.getElementById('hapus-kemasan').addEventListener('click', hapusImgs.bind(null, 2));

            function hapusImg(idx) {
                document.getElementById( file[idx].input ).value = '';

                let preview = document.getElementById(file[idx].preview);
                preview.src = '';

                let wrapper = document.getElementById(file[idx].wrapper);
                wrapper.style.height= '0';
                wrapper.style.display= 'none';
            }

            function hapusImgs(idx) {
                document.getElementById( file[idx].input ).value = '';

                let preview = document.getElementById(file[idx].preview);

                while (preview.firstChild) {
                    preview.removeChild(preview.lastChild);
                }

                let wrapper = document.getElementById(file[idx].wrapper);
                wrapper.style.height= '0';
                wrapper.style.display= 'none';
            }
        </script>

        <?php $this->load->view('umkm/layout/footer') ?>