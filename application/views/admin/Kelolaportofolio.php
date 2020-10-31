<!DOCTYPE html>
<html lang="en">

    <?php $this->load->view('admin/layout/head'); ?>

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

              <?php $this->load->view('admin/layout/sidebar') ?>
                <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <?php $this->load->view('admin/layout/navbar') ?>
                    <!-- Top Bar End -->

                    <div class="page-content-wrapper dashborad-v">

                        <div class="container-fluid">
                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="page-title-box">
                                      <div class="btn-group float-right">
                                          <ol class="breadcrumb hide-phone p-0 m-0">
                                              <li class="breadcrumb-item"><a href="#">Kelola Pengguna</a></li>
                                              <li class="breadcrumb-item">Designer</li>
                                              <li class="breadcrumb-item active">Portofolio</li>
                                          </ol>
                                      </div>
                                      <h4 class="page-title">Kelola Pengguna</h4>
                                  </div>
                              </div>
                              <div class="clearfix"></div>
                          </div>
                          <!-- end page title end breadcrumb -->
                          <div class="row">
                              <div class="col-12">
                                  <div class="card m-b-30">
                                      <div class="card-body">
                                          <h4 class="mt-0 header-title">Data Portofolio Designer <?=$desainer->Nama_lengkap?> - (<?=$desainer->IDDesigner?>)</h4>
                                          <p>Berikut adalah data-data portofolio designer gDESK</p>
                                          <table id="datatable" class="table table-bordered">
                                              <thead>
                                              <tr>
                                                  <th>No.</th>
                                                  <th>ID Portofolio</th>
                                                  <th>ID Designer</th>
                                                  <th>Judul</th>
                                                  <th>Bukti Portofolio</th>
                                                  <th>Detail Portofolio</th>
                                              </tr>
                                              </thead>
                                              <tbody>
                                                <?php
                                                  $no = 1;
                                                  foreach($portofolio as $a): ?>
                                              <tr>
                                                  <td><?php echo $no++ ?></td>
                                                  <td><?php echo $a->IDPortofolio ?></td>
                                                  <td><?php echo $a->IDDesigner ?></td>
                                                  <td><?php echo $a->Judul ?></td>
                                                  <td>
                                                    <a class="btn btn-raised btn-warning"  href="" data-toggle="modal" data-target="#detail<?=$a->IDPortofolio?>">
                                                      <i class="mdi mdi-file-document-box mr-2 text-white-400"></i>
                                                        Portofolio
                                                    </a>
                                                  </td>
                                                  <td><?php echo $a->Detail_portofolio ?></td>
                                              </tr>
                                            <?php endforeach; ?>
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
        <!-- END wrapper -->

        <?php foreach ($portofolio as $key) { ?>
        <div class="modal fade" id="detail<?=$key->IDPortofolio?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
             <h4 class="modal-title" id="ExampleModalLabel">Portofolio</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
              </div>
           <div class="modal-body">
             <?php if (!$key->Bukti_portofolio) { ?>
               <p style="color:red">Portofolio Belum Tertera</p>
             <?php }else if($key->Bukti_portofolio){ ?>
               <img src="<?=base_url()?>uploads/hasil_design/<?=$key->Bukti_portofolio?>" width="350px" alt="Portofolio"><br>
               <p><?=$key->Bukti_portofolio?></p>
               <a class="btn btn-success" href="<?=base_url()?>uploads/hasil_design/<?=$key->Bukti_portofolio?>" target="_blank" rel="nofollow">
                 <i class="mdi mdi-arrow-down-bold-circle"></i>
                 Unduh</a>
            <?php } ?>
           </div>
           <div class="modal-footer justify-content-between">
             <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
           </div>
          </div>
         <!-- /.modal-content -->
          </div>
        <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <?php } ?>

        <?php $this->load->view('admin/layout/footer') ?>
