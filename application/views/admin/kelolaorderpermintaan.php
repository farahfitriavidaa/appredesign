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
                                              <li class="breadcrumb-item"><a href="#">Kelola Report</a></li>
                                              <li class="breadcrumb-item"><a href="#">Kelola Order Permintaan</a></li>
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
                                          <h4 class="mt-0 header-title">Data Order Permintaan UMKM</h4>
                                          <p class="text-muted font-14">
                                            Berikut adalah data selesai order para UMKM gDESK
                                          </p>
                                        <!--  <div class="row">
                                            <div class="col-md-2">
                                              <p>Berdasarkan bulan :</p>
                                            </div>
                                             <div class="col-md-2">
                                              <form action="<?=base_url()?>Admin/cariOrderPermintaan" method="POST">
                                              <select class="form-control" name="bulan">
                                                <option value="">Bulan</option>
                                                <option value="01">Januari</option>
                                                <option value="02">Februari</option>
                                                <option value="03">Maret</option>
                                                <option value="04">April</option>
                                                <option value="05">Mei</option>
                                                <option value="06">Juni</option>
                                                <option value="07">Juli</option>
                                                <option value="08">Agustus</option>
                                                <option value="09">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                              </select>
                                              <select class="form-control" name="tahun">
                                                <option value="">Tahun</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                                <option value="2027">2027</option>
                                                <option value="2028">2028</option>
                                                <option value="2029">2029</option>
                                                <option value="2030">2030</option>
                                              </select>
                                              <input type="submit" value="Cari" class="btn btn-primary">
                                            </form>
                                            </div>
                                          </div> -->
                                          <table id="datatable" class="table table-bordered">
                                              <thead>
                                              <tr>
                                                  <th>No.</th>
                                                  <th>ID Pesan</th>
                                                  <th>ID Pengelola</th>
                                                  <th>ID Designer</th>
                                                  <th>Nama UMKM</th>
                                                  <th>Data UMKM</th>
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
                                                  <td> <a class="btn btn-raised btn-info" href="<?=base_url()?>admin/Report/kelolaDataUMKMIc/<?=$a->IDUMKM?>">
                                                    <i class="mdi mdi-information mr-2 text-white-400"></i>
                                                      Data UMKM
                                                  </a> </td>
                                                  <td>
                                                    <?php if ($a->Status == '0'){ ?>
                                                      <button type="button" class="badge badge-pill badge-secondary" name="button">Pending</button>
                                                    <?php }else if($a->Status == '1'){ ?>
                                                      <button type="button" class="badge badge-pill badge-primary" name="button">Permintaan Design Fix</button>
                                                    <?php }else if($a->Status == '2'){ ?>
                                                      <button type="button" class="badge badge-pill badge-warning" name="button">On Going</button>
                                                    <?php }else if($a->Status == '3'){ ?>
                                                      <button type="button" class="badge badge-pill badge-info" name="button">Design Fix</button>
                                                    <?php }else if($a->Status == '4'){ ?>
                                                      <button type="button" class="badge badge-pill badge-danger" name="button">Review Hasil</button>
                                                    <?php }else if($a->Status == '5'){ ?>
                                                      <button type="button" class="badge badge-pill badge-success" name="button">Pemesanan Fix</button>
                                                    <?php }else if($a->Status == '8'){ ?>
                                                      <button type="button" class="badge badge-pill badge-danger" name="button">Cancel</button>
                                                    <?php }else{ ?>
                                                      <button type="button" class="badge badge-pill badge-dark" name="button">Selesai</button>
                                                    <?php } ?>
                                                  </td>
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

        <?php $this->load->view('admin/layout/footer') ?>
