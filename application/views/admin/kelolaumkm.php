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
                                              <li class="breadcrumb-item"><a href="#">Urora</a></li>
                                              <li class="breadcrumb-item"><a href="#">Tables</a></li>
                                              <li class="breadcrumb-item active">Datatable</li>
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
                                          <h4 class="mt-0 header-title">Data Akun UMKM</h4>
                                          <p class="text-muted font-14">DataTables has most features enabled by
                                              default, so all you need to do to use it with your own tables is to call
                                              the construction function: <code>$().DataTable();</code>.
                                          </p>
                                          <a class="btn btn-raised btn-primary" href="" data-toggle="modal" data-target="#tambah">
                                          <i class="mdi mdi-plus mr-2 text-white-400"></i>
                                            Tambah Akun
                                          </a>
                                          <br><br>
                                          <table id="datatable" class="table table-bordered">
                                              <thead>
                                              <tr>
                                                  <th>No.</th>
                                                  <th>Username</th>
                                                  <th>Nama Lengkap</th>
                                                  <th>Nama UMKM</th>
                                                  <th>No Telp</th>
                                                  <th>Email</th>
                                                  <th>Regional</th>
                                                  <th>Data UMKM</th>
                                                  <th>Status</th>
                                                  <th>Aksi</th>
                                              </tr>
                                              </thead>
                                              <tbody>
                                                <?php
                                                  $no = 1;
                                                  foreach($umkm as $a): ?>
                                              <tr>
                                                  <td><?php echo $no++ ?></td>
                                                  <td><?php echo $a->Username ?></td>
                                                  <td><?php echo $a->Nama_lengkap ?></td>
                                                  <td><?php echo $a->Nama_umkm ?></td>
                                                  <td><?php echo $a->No_telp ?></td>
                                                  <td><?php echo $a->Email ?></td>
                                                  <td><?php echo $a->Regional ?></td>
                                                  <td>
                                                    <a class="btn btn-raised btn-info" href="" data-toggle="modal" data-target="#dataUMKM<?=$a->IDUser?>">
                                                      <i class="mdi mdi-information mr-2 text-white-400"></i>
                                                        Data UMKM
                                                    </a>
                                                  </td>
                                                  <td><?php echo $a->Status ?></td>
                                                  <td>
                                                    <a class="btn btn-raised btn-info" href="" data-toggle="modal" data-target="#detail<?=$a->IDUser?>">
                                                      <i class="mdi mdi-information mr-2 text-white-400"></i>
                                                        Detail
                                                    </a>
                                                    <?php if ($a->Status == 'Aktif'){ ?>
                                                      <a class="btn btn-raised btn-secondary" href="<?=base_url()?>Admin/statusTdkAktiff/<?=$a->IDUser?>">
                                                        <i class="mdi mdi-account-minus mr-2 text-white-400"></i>
                                                          Tidak Aktif
                                                      </a>
                                                    <?php }else if($a->Status == 'Tidak Aktif'){ ?>
                                                        <a class="btn btn-raised btn-warning" href="<?=base_url()?>Admin/statusAktiff/<?=$a->IDUser?>">
                                                        <i class="mdi mdi-account-check mr-2 text-white-400"></i>
                                                          Aktif
                                                      </a>
                                                    <?php } ?>
                                                      <a class="btn btn-raised btn-primary" href="" data-toggle="modal" data-target="#edit<?=$a->IDUser?>">
                                                      <i class="mdi mdi-grease-pencil mr-2 text-white-400"></i>
                                                        Edit
                                                    </a>
                                                    <a class="btn btn-raised btn-danger" href="" data-toggle="modal" data-target="#hapus<?=$a->IDUser?>">
                                                      <i class="mdi mdi-delete mr-2 text-white-400"></i>
                                                        Hapus
                                                    </a>
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

        <?php foreach ($umkm as $key) { ?>
        <div class="modal fade" id="hapus<?=$key->IDUser?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
        <div class="modal-dialog" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Hapus Akun</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <p>Anda Yakin Ingin Menghapus Akun <?= $key->Nama_lengkap ?>?</p>
           </div>
           <div class="modal-footer justify-content-between">
             <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
             <a href="<?= site_url()?>Admin/hapusUMKM/<?= $key->IDUser ?>" class="btn btn-danger">Iya</a>
           </div>
         </div>
         <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <?php } ?>

        <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
          <div class="modal-dialog" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h4 class="modal-title" id="ExampleModalLabel">Tambah Data Akun</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
               </div>
               <div class="modal-body">
                 <form class="" action="<?=base_url()?>Admin/tambahUMKM" method="POST">
                   <table width="100%">
                     <tr>
                       <td>Username</td>
                       <td>:</td>
                       <td><input type="text" class="form-control" name="username"></td>
                     </tr>
                     <tr>
                       <td>Password</td>
                       <td>:</td>
                       <td><input type="password" class="form-control" name="password"></td>
                     </tr>
                     <tr>
                       <td>Nama Lengkap</td>
                       <td>:</td>
                       <td><input type="text" class="form-control" name="namalengkap"></td>
                     </tr>
                     <tr>
                       <td>Email</td>
                       <td>:</td>
                       <td><input type="email" class="form-control" name="email"></td>
                     </tr>
                     <tr>
                       <td>No. Telp</td>
                       <td>:</td>
                       <td><input type="text" class="form-control" name="notelp"></td>
                     </tr>
                     <tr>
                       <td>Nama UMKM</td>
                       <td>:</td>
                       <td><input type="text" class="form-control" name="namaumkm"></td>
                     </tr>
                     <tr>
                       <td>Regional</td>
                       <td>:</td>
                       <td><input type="text" class="form-control" name="regional"></td>
                     </tr>
                     <tr>
                       <td>Alamat</td>
                       <td>:</td>
                       <td> <textarea name="alamat" class="form-control" rows="8" cols="80"></textarea> </td>
                     </tr>
                     <tr>
                       <td>Status</td>
                       <td>:</td>
                       <td>
                            <select class="form-control" name="status">
                              <option value="Aktif">Aktif</option>
                              <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                       </td>
                     </tr>
                   </table>
               </div>
               <div class="modal-footer justify-content-between">
                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
                 <input type="submit" class="btn btn-danger" value="Iya">
               </div>
             </form>
             </div>
             <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
            </div>


                        <?php foreach ($umkm as $key) { ?>
                        <div class="modal fade" id="hapus<?=$key->IDUser?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
                        <div class="modal-dialog" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Hapus Akun</h4>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                             <p>Anda Yakin Ingin Menghapus Akun <?= $key->Nama_lengkap ?>?</p>
                           </div>
                           <div class="modal-footer justify-content-between">
                             <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
                             <a href="<?= site_url()?>Admin/hapusDesigner/<?= $key->IDUser ?>" class="btn btn-danger">Iya</a>
                           </div>
                         </div>
                         <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                        <?php } ?>

                        <?php foreach ($umkm as $key) { ?>
                        <div class="modal fade" id="detail<?=$key->IDUser?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
                        <div class="modal-dialog" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h4 class="modal-title" id="ExampleModalLabel">Detail Data UMKM <?=$key->Nama_umkm?></h4>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                             <form class="" action="">
                               <table width="100%">
                                 <tr>
                                   <td>ID UMKM</td>
                                   <td>:</td>
                                   <td><input type="text" class="form-control" name="idumkm" disabled value="<?=$key->IDUMKM?>"></td>
                                 </tr>
                                 <tr>
                                   <td>Username</td>
                                   <td>:</td>
                                   <td><input type="text" class="form-control" name="username" value="<?=$key->Username ?>"></td>
                                 </tr>
                                 <tr>
                                   <td>Nama Lengkap</td>
                                   <td>:</td>
                                   <td><input type="text" class="form-control" name="namalengkap" value="<?=$key->Nama_lengkap ?>"></td>
                                 </tr>
                                 <tr>
                                   <td>Email</td>
                                   <td>:</td>
                                   <td><input type="email" class="form-control" name="email" value="<?=$key->Email ?>"></td>
                                 </tr>
                                 <tr>
                                   <td>Nama UMKM</td>
                                   <td>:</td>
                                   <td><input type="text" class="form-control" name="namaumkm" value="<?=$key->Nama_umkm ?>"></td>
                                 </tr>
                                 <tr>
                                   <td>No. Telp</td>
                                   <td>:</td>
                                   <td><input type="text" class="form-control" name="notelp" value="<?=$key->No_telp ?>"></td>
                                 </tr>
                                 <tr>
                                   <td>Regional</td>
                                   <td>:</td>
                                   <td><input type="text" class="form-control" name="regional" value="<?=$key->Regional ?>"></td>
                                 </tr>
                                 <tr>
                                   <td>Alamat</td>
                                   <td>:</td>
                                   <td> <textarea class="form-control" name="alamat" rows="8" cols="80"><?=$key->Alamat?></textarea> </td>
                                 </tr>
                                 <tr>
                                   <td>Status</td>
                                   <td>:</td>
                                   <td>
                                        <select class="form-control" name="status">
                                          <option value="<?=$key->Status?>"><?=$key->Status?></option>
                                          <option value="Aktif">Aktif</option>
                                          <option value="Tidak Aktif">Tidak Aktif</option>
                                        </select>
                                   </td>
                                 </tr>
                               </table>
                           </div>
                           <div class="modal-footer justify-content-between">
                             <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                           </div>
                         </form>
                         </div>
                         <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                        <?php } ?>


                        <?php foreach ($umkm as $key) { ?>
                        <div class="modal fade" id="edit<?=$key->IDUser?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
                        <div class="modal-dialog" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h4 class="modal-title" id="ExampleModalLabel">Edit Data</h4>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                             <form class="" action="<?=base_url()?>Admin/editUMKM/<?=$key->IDUser?>" method="POST">
                               <input type="hidden" name="IDUser" value="<?=$key->IDUser?>">
                               <table width="100%">
                                 <tr>
                                   <td>ID UMKM</td>
                                   <td>:</td>
                                   <td><input type="text" class="form-control" name="idumkm" disabled value="<?=$key->IDUMKM?>"></td>
                                 </tr>
                                 <tr>
                                   <td>Username</td>
                                   <td>:</td>
                                   <td><input type="text" class="form-control" name="username" value="<?=$key->Username ?>"></td>
                                 </tr>
                                 <tr>
                                   <td>Nama Lengkap</td>
                                   <td>:</td>
                                   <td><input type="text" class="form-control" name="namalengkap" value="<?=$key->Nama_lengkap ?>"></td>
                                 </tr>
                                 <tr>
                                   <td>Email</td>
                                   <td>:</td>
                                   <td><input type="email" class="form-control" name="email" value="<?=$key->Email ?>"></td>
                                 </tr>
                                 <tr>
                                   <td>Nama UMKM</td>
                                   <td>:</td>
                                   <td><input type="text" class="form-control" name="namaumkm" value="<?=$key->Nama_umkm ?>"></td>
                                 </tr>
                                 <tr>
                                   <td>No. Telp</td>
                                   <td>:</td>
                                   <td><input type="text" class="form-control" name="notelp" value="<?=$key->No_telp ?>"></td>
                                 </tr>
                                 <tr>
                                   <td>Regional</td>
                                   <td>:</td>
                                   <td><input type="text" class="form-control" name="regional" value="<?=$key->Regional ?>"></td>
                                 </tr>
                                 <tr>
                                   <td>Alamat</td>
                                   <td>:</td>
                                   <td> <textarea class="form-control" name="alamat" rows="8" cols="80"><?=$key->Alamat?></textarea> </td>
                                 </tr>
                                 <tr>
                                   <td>Status</td>
                                   <td>:</td>
                                   <td>
                                        <select class="form-control" name="status">
                                          <option value="<?=$key->Status?>"><?=$key->Status?></option>
                                          <option value="Aktif">Aktif</option>
                                          <option value="Tidak Aktif">Tidak Aktif</option>
                                        </select>
                                   </td>
                                 </tr>
                               </table>
                           </div>
                           <div class="modal-footer justify-content-between">
                             <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
                             <input type="submit" class="btn btn-danger" value="Iya">
                           </div>
                         </form>
                         </div>
                         <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                        <?php } ?>

        <?php $this->load->view('admin/layout/footer') ?>
