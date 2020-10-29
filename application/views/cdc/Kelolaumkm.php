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
                                              <li class="breadcrumb-item"><a href="#">UMKM</a></li>
                                              <li class="breadcrumb-item"><a href="#">Data UMKM</a></li>
                                          </ol>
                                      </div>
                                      <h4 class="page-title">Data UMKM</h4>
                                  </div>
                              </div>
                              <div class="clearfix"></div>
                          </div>
                          <!-- end page title end breadcrumb -->
                          <div class="row">
                              <div class="col-12">
                                  <div class="card m-b-30">
                                      <div class="card-body">
                                          <h4 class="mt-0 header-title">UMKM</h4>
                                          <p>Data-data UMKM yang telah terverifikasi</p>
                                          <br>
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
                                                  <th>Status</th>
                                              </tr>
                                              </thead>
                                              <tbody>
                                                <?php
                                                  $no = 1;
                                                  foreach($umkm as $a): ?>
                                              <tr>
                                                  <td><?php echo $no++ ?></td>
                                                  <td><?php echo $a->Nama_lengkap ?></td>
                                                  <td><?php echo $a->IDUMKM ?></td>
                                                  <td><?php echo $a->Nama_umkm ?></td>
                                                  <td><?php echo $a->Regional ?></td>
                                                  <td><?php echo $a->Alamat ?></td>
                                                  <td><?php echo $a->No_telp ?></td>
                                                  <td><?php echo $a->Status ?></td>
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

        <?php $this->load->view('cdc/layout/Footer') ?>
