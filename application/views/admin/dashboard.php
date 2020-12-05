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
                                                <li class="breadcrumb-item active">Dashboard</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Dashboard</h4>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                <!-- Column -->
                                <div class="col-sm-12 col-md-6 col-xl-3">
                                    <div class="card bg-danger m-b-30">
                                        <div class="card-body">
                                            <div class="d-flex row">
                                                <div class="col-3 align-self-center">
                                                    <div class="round">
                                                        <i class="mdi mdi-google-physical-web"></i>
                                                    </div>
                                                </div>
                                                <div class="col-8 ml-auto align-self-center text-center">
                                                    <div class="m-l-10 text-white float-right">
                                                        <h5 class="mt-0 round-inner"><?php echo $umkm->hasil?></h5>
                                                        <p class="mb-0 ">Jumlah UMKM</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <!-- Column -->
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                    <div class="card bg-info m-b-30">
                                        <div class="card-body">
                                            <div class="d-flex row">
                                                <div class="col-3 align-self-center">
                                                    <div class="round">
                                                        <i class="mdi mdi-account-multiple-plus"></i>
                                                    </div>
                                                </div>
                                                <div class="col-8 text-center ml-auto align-self-center">
                                                    <div class="m-l-10 text-white float-right">
                                                        <h5 class="mt-0 round-inner"><?=$designer->hasil?></h5>
                                                        <p class="mb-0 ">Jumlah Designer</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <!-- Column -->
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                    <div class="card bg-success m-b-30">
                                        <div class="card-body">
                                            <div class="d-flex row">
                                                <div class="col-3 align-self-center">
                                                    <div class="round ">
                                                        <i class="mdi mdi-basket"></i>
                                                    </div>
                                                </div>
                                                <div class="col-8 ml-auto align-self-center text-center">
                                                    <div class="m-l-10 text-white float-right">
                                                        <h5 class="mt-0 round-inner"><?=$order->hasil?></h5>
                                                        <p class="mb-0 ">Jumlah Pemesanan</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <!-- Column -->
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                    <div class="card bg-primary m-b-30">
                                        <div class="card-body">
                                            <div class="d-flex row">
                                                <div class="col-3 align-self-center">
                                                    <div class="round">
                                                        <i class="mdi mdi-briefcase-check"></i>
                                                    </div>
                                                </div>
                                                <div class="col-8 ml-auto align-self-center text-center">
                                                    <div class="m-l-10 text-white float-right">
                                                        <h5 class="mt-0 round-inner"><?=$pesanan->hasil?></h5>
                                                        <p class="mb-0">Total Pemesanan Selesai</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xl-6">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h5 class="header-title mb-3 mt-0">Permintaan Order UMKM</h5>
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                          <th class="border-top-0 w-60">Produk</th>
                                                          <th class="border-top-0">Nama Produk</th>
                                                          <th class="border-top-0">Regional</th>
                                                          <th class="border-top-0">Tanggal Order</th>
                                                          <th class="border-top-0">UMKM</th>
                                                          <th class="border-top-0">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                      <?php foreach ($pemesanan as $p): ?>
                                                      <tr>
                                                          <td>
                                                              <img class="" src="<?=base_url()?>uploads/foto_produk/<?=$p->Foto_produk?>" alt="user" width="40"> </td>
                                                          <td>
                                                              <?php echo $p->Nama_produk ?>
                                                          </td>
                                                          <td>
                                                              <?php echo $p->Regional ?>
                                                          </td>
                                                          <td><?php echo $p->Tgl_order ?></td>
                                                          <td><?php echo $p->Nama_umkm ?></td>
                                                          <td>
                                                                <?php if ($p->Status == '0'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-secondary" name="button">Pending</button>
                                                                <?php }else if($p->Status == '1'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-primary" name="button">Permintaan Design Fix</button>
                                                                <?php }else if($p->Status == '2'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-warning" name="button">On Going</button>
                                                                <?php }else if($p->Status == '3'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-info" name="button">Design Fix</button>
                                                                <?php }else if($p->Status == '4'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-danger" name="button">Review Hasil</button>
                                                                <?php }else if($p->Status == '5'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-success" name="button">Pemesanan Fix</button>
                                                                <?php }else if($p->Status == '8'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-danger" name="button">Cancel</button>
                                                                <?php }else{ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-dark" name="button">Selesai</button>
                                                                <?php } ?>
                                                          </td>
                                                      </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xl-6">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h5 class="header-title mb-3 mt-0">Order On Going UMKM</h5>
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                          <th class="border-top-0 w-60">Produk</th>
                                                          <th class="border-top-0">Nama Produk</th>
                                                          <th class="border-top-0">Regional</th>
                                                          <th class="border-top-0">Tanggal Order</th>
                                                          <th class="border-top-0">UMKM</th>
                                                          <th class="border-top-0">Tanggal Mulai</th>
                                                          <th class="border-top-0">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                      <?php foreach ($ongoing as $p): ?>
                                                      <tr>
                                                          <td>
                                                              <img class="" src="<?=base_url()?>uploads/foto_produk/<?=$p->Foto_produk?>" alt="user" width="40"> </td>
                                                          <td>
                                                              <?php echo $p->Nama_produk ?>
                                                          </td>
                                                          <td>
                                                              <?php echo $p->Regional ?>
                                                          </td>
                                                          <td><?php echo $p->Tgl_order ?></td>
                                                          <td><?php echo $p->Nama_umkm ?></td>
                                                          <td><?php echo $p->Tgl_mulai ?></td>
                                                          <td>
                                                                <?php if ($p->Status == '0'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-secondary" name="button">Pending</button>
                                                                <?php }else if($p->Status == '1'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-primary" name="button">Permintaan Design Fix</button>
                                                                <?php }else if($p->Status == '2'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-warning" name="button">On Going</button>
                                                                <?php }else if($p->Status == '3'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-info" name="button">Design Fix</button>
                                                                <?php }else if($p->Status == '4'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-danger" name="button">Review Hasil</button>
                                                                <?php }else if($p->Status == '5'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-success" name="button">Pemesanan Fix</button>
                                                                <?php }else if($p->Status == '8'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-danger" name="button">Cancel</button>
                                                                <?php }else{ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-dark" name="button">Selesai</button>
                                                                <?php } ?>
                                                          </td>
                                                      </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-xl-6">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h5 class="header-title mb-3 mt-0">Order Selesai UMKM</h5>
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                          <th class="border-top-0 w-60">Produk</th>
                                                          <th class="border-top-0">Nama Produk</th>
                                                          <th class="border-top-0">Regional</th>
                                                          <th class="border-top-0">Tanggal Order</th>
                                                          <th class="border-top-0">UMKM</th>
                                                          <th class="border-top-0">Tanggal Mulai</th>
                                                          <th class="border-top-0">Tanggal Akhir</th>
                                                          <th class="border-top-0">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                      <?php foreach ($selesai as $p): ?>
                                                      <tr>
                                                          <td>
                                                              <img class="" src="<?=base_url()?>uploads/foto_produk/<?=$p->Foto_produk?>" alt="user" width="40"> </td>
                                                          <td>
                                                              <?php echo $p->Nama_produk ?>
                                                          </td>
                                                          <td>
                                                              <?php echo $p->Regional ?>
                                                          </td>
                                                          <td><?php echo $p->Tgl_order ?></td>
                                                          <td><?php echo $p->Nama_umkm ?></td>
                                                          <td><?php echo $p->Tgl_mulai ?></td>
                                                          <td><?php echo $p->Tgl_akhir ?></td>
                                                          <td>
                                                                <?php if ($p->Status == '0'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-secondary" name="button">Pending</button>
                                                                <?php }else if($p->Status == '1'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-primary" name="button">Permintaan Design Fix</button>
                                                                <?php }else if($p->Status == '2'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-warning" name="button">On Going</button>
                                                                <?php }else if($p->Status == '3'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-info" name="button">Design Fix</button>
                                                                <?php }else if($p->Status == '4'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-danger" name="button">Review Hasil</button>
                                                                <?php }else if($p->Status == '5'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-success" name="button">Pemesanan Fix</button>
                                                                <?php }else if($p->Status == '8'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-danger" name="button">Cancel</button>
                                                                <?php }else{ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-dark" name="button">Selesai</button>
                                                                <?php } ?>
                                                          </td>
                                                      </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xl-6">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h5 class="header-title mb-3 mt-0">Order Transaksi UMKM</h5>
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                          <th class="border-top-0 w-60">Produk</th>
                                                          <th class="border-top-0">Nama Produk</th>
                                                          <th class="border-top-0">Regional</th>
                                                          <th class="border-top-0">UMKM</th>
                                                          <th class="border-top-0">Tanggal Mulai</th>
                                                          <th class="border-top-0">Tanggal Akhir</th>
                                                          <th class="border-top-0">Harga</th>
                                                          <th class="border-top-0">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                      <?php foreach ($transaksi as $p): ?>
                                                      <tr>
                                                          <td>
                                                              <img class="" src="<?=base_url()?>uploads/foto_produk/<?=$p->Foto_produk?>" alt="user" width="40"> </td>
                                                          <td>
                                                              <?php echo $p->Nama_produk ?>
                                                          </td>
                                                          <td>
                                                              <?php echo $p->Regional ?>
                                                          </td>
                                                          <td><?php echo $p->Nama_umkm ?></td>
                                                          <td><?php echo $p->Tgl_mulai ?></td>
                                                          <td><?php echo $p->Tgl_akhir ?></td>
                                                          <td><?php echo $p->Harga ?></td>
                                                          <td>
                                                                <?php if ($p->Status == '6'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-warning" name="button">Belum Lunas</button>
                                                                <?php }else if($p->Status == '7'){ ?>
                                                                  <button type="button" class="badge badge-boxed  badge-primary" name="button">Lunas</button>
                                                                <?php } ?>
                                                          </td>
                                                      </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12 col-xl-6">
                                  <div class="card m-b-30">
                                      <div class="card-body new-user">
                                          <h5 class="header-title mb-3 mt-0">UMKM Terbaru</h5>
                                          <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="border-top-0 w-60">IDUMKM</th>
                                                    <th class="border-top-0">Nama UMKM</th>
                                                    <th class="border-top-0">Regional</th>
                                                    <th class="border-top-0">Alamat</th>
                                                    <th class="border-top-0">No.Telp</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php foreach ($dataumkm as $a): ?>
                                                <tr>
                                                    <td>
                                                      <?php echo $a->IDUMKM ?> </td>
                                                    <td>
                                                      <?php echo $a->Nama_umkm ?>
                                                    </td>
                                                    <td>
                                                      <?php echo $a->Regional ?>
                                                    </td>
                                                    <td>
                                                      <?php echo $a->Alamat ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $a->No_telp ?>
                                                    </td>
                                                </tr>
                                              <?php endforeach; ?>
                                            </tbody>
                                              </table>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            </div>
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
