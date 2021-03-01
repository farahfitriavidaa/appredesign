<!DOCTYPE html>
<html lang="en">

    <?php $this->load->view('cdc/layout/head'); ?>

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
                      <img src="<?=base_url()?>asset/logo2.png" width="140px" style="margin-top:-10px">
                    </div>
                </div>

              <?php $this->load->view('cdc/layout/sidebar') ?>
                <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <?php $this->load->view('cdc/layout/navbar') ?>
                    <!-- Top Bar End -->

                    <div class="page-content-wrapper dashborad-v">

                        <div class="container-fluid">
                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="page-title-box">
                                      <div class="btn-group float-right">
                                          <ol class="breadcrumb hide-phone p-0 m-0">
                                              <li class="breadcrumb-item"><a href="#">UMKM</a></li>
                                              <li class="breadcrumb-item"><a href="#">Kelola Verifikasi</a></li>
                                          </ol>
                                      </div>
                                      <h4 class="page-title">Kelola Verifikasi</h4>
                                  </div>
                              </div>
                              <div class="clearfix"></div>
                          </div>
                          <!-- end page title end breadcrumb -->
                          <div class="row">
                              <div class="col-12">
                                  <div class="card m-b-30">
                                      <div class="card-body">
                                          <h4 class="mt-0 header-title">Verifikasi UMKM</h4>
                                          <table id="datatable" class="table table-bordered">
                                              <thead>
                                              <tr>
                                                  <th>No.</th>
                                                  <th>Nama Pengguna</th>
                                                  <th>ID UMKM</th>
                                                  <th>Nama UMKM</th>
                                                  <th>Regional</th>
                                                  <th>Alamat</th>
                                                  <th>No Telp</th>
                                                  <th>Aksi</th>
                                              </tr>
                                              </thead>
                                              <tbody>
                                                <?php
                                                  $no = 1;
                                                  foreach($verifikasi as $a): ?>
                                              <tr>
                                                  <td><?php echo $no++ ?></td>
                                                  <td><?php echo $a->Nama_lengkap ?></td>
                                                  <td><?php echo $a->IDUMKM ?></td>
                                                  <td><?php echo $a->Nama_umkm ?></td>
                                                  <td><?php echo $a->Regional ?></td>
                                                  <td><?php echo $a->Alamat ?></td>
                                                  <td><?php echo $a->No_telp ?></td>
                                                  <td>
                                                    <a class="btn btn-raised btn-info" href="" data-toggle="modal" data-target="#aktif<?=$a->IDUser?>">
                                                      <i class="mdi mdi-account-check mr-2 text-white-400"></i>
                                                        Aktifkan
                                                    </a>
                                                      <a class="btn btn-raised btn-danger" href="" data-toggle="modal" data-target="#tdkaktif<?=$a->IDUser?>">
                                                        <i class="mdi mdi-account-minus mr-2 text-white-400"></i>
                                                          Tidak Aktif
                                                      </a>
                                                  </td>
                                              </tr>
                                            <?php endforeach; ?>
                                              <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                              </tr>
                                              </tbody>
                                          </table>

                                      </div>
                                  </div>
                              </div> <!-- end col -->
                          </div> <!-- end row -->

                        </div>
                        <!-- container -->

                    </div>
                    <!-- Page content Wrapper -->
                </div>
                <!-- content -->

                <footer class="footer">
                    © 2018 Urora by Mannatthemes.
                </footer>

            </div>
            <!-- End Right content here -->

        </div>

          <?php foreach ($verifikasi as $key) { ?>
            <div class="modal fade" id="aktif<?=$key->IDUser?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
            <div class="modal-dialog" role="document">
             <div class="modal-content">
               <div class="modal-header">
                 <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Verifikasi UMKM</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <p>Apakah Anda yakin ingin melakukan verifikasi bahwa UMKM <span style="color:red"><?= $key->Nama_umkm ?></span> akan diaktifkan?</p>
               </div>
               <div class="modal-footer justify-content-between">
                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
                 <a href="<?= site_url()?>cdc/Umkm/statusAktif/<?= $key->IDUser ?>" class="btn btn-danger">Iya</a>
               </div>
             </div>
             <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <?php } ?>

            <?php foreach ($verifikasi as $key) { ?>
              <div class="modal fade" id="tdkaktif<?=$key->IDUser?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
              <div class="modal-dialog" role="document">
               <div class="modal-content">
                 <div class="modal-header">
                   <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Verifikasi UMKM</h4>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>
                 <div class="modal-body">
                   <p>Apakah Anda yakin ingin melakukan verifikasi bahwa UMKM <span style="color:red"><?= $key->Nama_umkm ?></span> tidak akan diaktifkan?</p>
                 </div>
                 <div class="modal-footer justify-content-between">
                   <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
                   <a href="<?= site_url()?>cdc/Umkm/statusTdkAktif/<?= $key->IDUser ?>" class="btn btn-danger">Iya</a>
                 </div>
               </div>
               <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
              <?php } ?>


        <?php $this->load->view('cdc/layout/footer') ?>
