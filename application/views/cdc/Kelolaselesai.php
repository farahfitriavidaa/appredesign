<!DOCTYPE html>
<html lang="en">

    <?php $this->load->view('cdc/layout/Head'); ?>

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
                        <a href="#" class="logo" style="font-size:40px" >gDesk</a>
                    </div>
                </div>

              <?php $this->load->view('cdc/layout/Sidebar') ?>
                <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <?php $this->load->view('cdc/layout/Navbar') ?>
                    <!-- Top Bar End -->

                    <div class="page-content-wrapper dashborad-v">

                        <div class="container-fluid">
                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="page-title-box">
                                      <div class="btn-group float-right">
                                          <ol class="breadcrumb hide-phone p-0 m-0">
                                              <li class="breadcrumb-item"><a href="#">Kelola Report</a></li>
                                              <li class="breadcrumb-item"><a href="#">Report Selesai</a></li>
                                          </ol>
                                      </div>
                                      <h4 class="page-title">Kelola Report</h4>
                                  </div>
                              </div>
                              <div class="clearfix"></div>
                          </div>
                          <!-- end page title end breadcrumb -->
                          <div class="row">
                              <div class="col-12">
                                  <div class="card m-b-30">
                                      <div class="card-body">
                                          <h4 class="mt-0 header-title">Data Order Selesai</h4>
                                          <p>Data pemesanan re-design dengan status <span style="color:blue">selesai</span> </p>
                                          <table id="datatable" class="table table-bordered">
                                              <thead>
                                              <tr>
                                                  <th>No.</th>
                                                  <th>ID Pesan</th>
                                                  <th>ID Pengelola</th>
                                                  <th>ID Designer</th>
                                                  <th>Nama UMKM</th>
                                                  <th>Data UMKM</th>
                                                  <th>Tanggal Mulai</th>
                                                  <th>Hasil Design</th>
                                                  <th>Tanggal Berakhir</th>
                                                  <th>Status</th>
                                              </tr>
                                              </thead>
                                              <tbody>
                                                <?php
                                                  $no = 1;
                                                  foreach($orderpemesanan as $a): ?>
                                              <tr>
                                                  <td><?php echo $no++ ?></td>
                                                  <td><?php echo $a->IDPesan ?></td>
                                                  <td><?php echo $a->IDPengelola ?></td>
                                                  <td><?php echo $a->IDDesigner ?></td>
                                                  <td><?php echo $a->Nama_umkm ?></td>
                                                  <td> <a class="btn btn-dark" data-toggle="modal" data-target="#dataumkm<?=$a->IDPesan?>">Data UMKM</a> </td>
                                                  <td><?php echo $a->Tgl_mulai ?></td>
                                                  <td><a class="btn btn-primary" data-toggle="modal" data-target="#hasil<?=$a->IDPesan?>">Hasil</a></td>
                                                  <td><?php echo $a->Tgl_akhir ?></td>
                                                  <td>
                                                    <?php if($a->Status == '5'){ ?>
                                                      <button type="button" class="badge badge-pill badge-success" name="button">Selesai</button>
                                                    <?php } ?>
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
        <!-- END wrapper -->

        <?php foreach ($orderpemesanan as $key) { ?>
        <div class="modal fade" id="hasil<?=$key->IDPesan?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
             <h4 class="modal-title" id="ExampleModalLabel">Hasil Design</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
              </div>
           <div class="modal-body">
             <?php if (!$key->Hasil_design) { ?>
               <p style="color:red">Hasil Design Belum Tertera</p>
             <?php }else if($key->Hasil_design == 'Belum ada'){ ?>
               <p style="color:red">Hasil Design Belum Tertera</p>
             <?php }else if($key->Hasil_design){ ?>
               <img src="<?=base_url()?>uploads/hasil_design/<?=$key->Hasil_design?>" width="350px" alt="Design"><br>
               <a class="btn btn-success" href="<?=base_url()?>uploads/hasil_design/<?=$key->Hasil_design?>" target="_blank" rel="nofollow">
                 <i class="mdi mdi-arrow-down-bold-circle"></i>
                 Unduh</a>
             <?php }else{ ?>

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

        <?php foreach ($orderpemesanan as $key) { ?>
        <div class="modal fade" id="dataumkm<?=$key->IDPesan?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
             <h4 class="modal-title" id="ExampleModalLabel">Data UMKM <?=$key->IDUMKM?></h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
              </div>
           <div class="modal-body">
             <table width="100%">
               <tr>
                 <td>Nama UMKM</td>
                 <td>:</td>
                 <td>
                   <?=$key->Nama_umkm?>
                 </td>
                </tr>
                <tr>
                  <td>Nama Produk</td>
                  <td>:</td>
                  <td><?=$key->Nama_produk?></td>
                </tr>
                <tr>
                  <td>Foto Produk</td>
                  <td>:</td>
                  <td> <img src="<?=base_url()?>uploads/foto_produk/<?=$key->Foto_produk?>" width="350px"> </td>
                </tr>
                <tr>
                  <td>Keterangan</td>
                  <td>:</td>
                  <td><textarea name="keterangan" class="form-control" rows="8" cols="80"></textarea> </td>
                </tr>
              </table>
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


        <?php $this->load->view('cdc/layout/Footer') ?>
