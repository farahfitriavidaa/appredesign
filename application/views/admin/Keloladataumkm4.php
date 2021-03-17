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
                                              <li class="breadcrumb-item"><a href="#">UMKM</a></li>
                                              <li class="breadcrumb-item active">Data UMKM</li>
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
                                          <h4 class="mt-0 header-title">Data UMKM-UMKM</h4>
                                          <p class="text-muted font-14">
                                            Berikut ini adalah data UMKM-UMKM gDESK
                                          </p>
                                          <table id="datatable" class="table table-bordered">
                                              <thead>
                                              <tr>
                                                  <th>No.</th>
                                                  <th>Nama UMKM</th>
                                                  <th>Nama Produk</th>
                                                  <th>Foto Produk</th>
                                                  <th>Logo Produk</th>
                                                  <th>Kemasan Produk</th>
                                                  <th>Keterangan</th>
                                                  <th>Aksi</th>
                                              </tr>
                                              </thead>
                                              <tbody>
                                                <?php
                                                  $no = 1;
                                                  foreach($umkm as $a): ?>
                                              <tr>
                                                  <td><?php echo $no++ ?></td>
                                                  <td><?php echo $a->Nama_umkm ?></td>
                                                  <td><?php echo $a->Nama_produk ?></td>
                                                  <td><a class="btn btn-info" data-toggle="modal" data-target="#foto<?=$a->IDDataUMKM?>">Foto Produk</a></td>
                                                  <td><a class="btn btn-info" data-toggle="modal" data-target="#logo<?=$a->IDDataUMKM?>">Logo Produk</a></td>
                                                  <td><a class="btn btn-info" data-toggle="modal" data-target="#kemasan<?=$a->IDDataUMKM?>">Kemasan Produk</a></td>
                                                  <td><?php echo $a->Keterangan ?></td>
                                                  <td>
                                                      <a class="btn btn-raised btn-primary" href="" data-toggle="modal" data-target="#edit<?=$a->IDDataUMKM?>">
                                                      <i class="mdi mdi-grease-pencil mr-2 text-white-400"></i>
                                                        Edit
                                                    </a>
                                                    <a class="btn btn-raised btn-danger" href="" data-toggle="modal" data-target="#hapus<?=$a->IDDataUMKM?>">
                                                      <i class="mdi mdi-delete mr-2 text-white-400"></i>
                                                        Hapus
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
                              </div>
                          </div>
                          <a class="btn btn-raised btn-danger" href="<?=base_url()?>admin/Order/kelolaOrderDesigner">
                            <i class="mdi mdi-arrow-left-bold-circle mr-2 text-white-400"></i>
                              Kembali
                          </a>
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
        <div class="modal fade" id="foto<?=$key->IDDataUMKM?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
             <h4 class="modal-title" id="ExampleModalLabel">Foto Produk</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
              </div>
           <div class="modal-body">
             <?=form_open_multipart('admin/Order/UpdateFotoo', ['style' => 'margin-left: 8px;']);?>
               <input type="hidden" name="iddataumkm" value="<?=$key->IDDataUMKM?>">
                <input type="hidden" name="idumkm" value="<?=$key->IDUMKM?>">
             <?php if (!$key->Foto_produk) { ?>
               <p style="color:red">Belum upload foto produk</p>
             <?php }else if($key->Foto_produk){?>
              <img src="<?=base_url()?>uploads/foto_produk/<?=$key->Foto_produk?>" width="450px" alt="Design">
              <a class="btn btn-success" style="margin-left:40%" href="<?=base_url()?>uploads/foto_produk/<?=$key->Foto_produk?>" target="_blank" rel="nofollow">
                <i class="mdi mdi-arrow-down-bold-circle"></i>
                Unduh</a>
                <br><br>
            <?php } ?>
              <table style="margin-left:50px">
                <tr>
                  <td>Upload or Edit Foto Produk</td>
                </tr>
                <tr>
                  <td>
                    <input type="file" name="foto_produk" class="btn btn-success">
                  </td>
                </tr>
                <tr>
                  <td>
                    <br><br>
                  </td>
                </tr>
                <tr>
                  <td>
                    <input type="submit" name="submit" value="Submit" class="badge-danger form-control">
                  </td>
                </tr>
              </table>
          </form>
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


        <?php foreach ($umkm as $key) { ?>
        <div class="modal fade" id="logo<?=$key->IDDataUMKM?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
             <h4 class="modal-title" id="ExampleModalLabel">Logo Produk</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
              </div>
           <div class="modal-body">
             <?=form_open_multipart('admin/Order/UpdateLogoo', ['style' => 'margin-left: 8px;']);?>
               <input type="hidden" name="iddataumkm" value="<?=$key->IDDataUMKM?>">
                <input type="hidden" name="idumkm" value="<?=$key->IDUMKM?>">
             <?php if (!$key->Logo_produk) { ?>
               <p style="color:red">Belum upload logo produk</p>
             <?php }else if($key->Logo_produk){ ?>
              <img src="<?=base_url()?>uploads/logo_produk/<?=$key->Logo_produk?>" width="450px" alt="Design"><br><br>
            <?php } ?>
              <table style="margin-left:50px">
                <tr>
                  <td>Upload or Edit Logo Produk</td>
                </tr>
                <tr>
                  <td>
                    <input type="file" name="logo_produk" class="btn btn-success">
                  </td>
                </tr>
                <!-- <tr>
                  <td>
                    <p>Atau</p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <input type="text" name="logo_produk" class="form-control" placeholder="Link logo">
                  </td>
                </tr> -->
                <tr>
                  <td>
                    <br><br>
                  </td>
                </tr>
                <tr>
                  <td>
                    <input type="submit" name="submit" value="Submit" class="badge-danger form-control">
                  </td>
                </tr>
              </table>
          </form>
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

        <?php foreach ($umkm as $key) { ?>
        <div class="modal fade" id="kemasan<?=$key->IDDataUMKM?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
             <h4 class="modal-title" id="ExampleModalLabel">Kemasan Produk</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
              </div>
           <div class="modal-body">
             <?=form_open_multipart('admin/Order/UpdateKemasann', ['style' => 'margin-left: 8px;']);?>
               <input type="hidden" name="iddataumkm" value="<?=$key->IDDataUMKM?>">
                <input type="hidden" name="idumkm" value="<?=$key->IDUMKM?>">
             <?php if (!$key->Kemasan_produk) { ?>
               <p style="color:red">Belum upload kemasan produk</p>
             <?php }else if($key->Kemasan_produk){ ?>
              <img src="<?=base_url()?>uploads/foto_kemasan_lama/<?=$key->Kemasan_produk?>" width="450px" alt="Design"><br><br>
            <?php } ?>
              <table style="margin-left:50px">
                <tr>
                  <td>Upload or Edit Kemasan Produk</td>
                </tr>
                <tr>
                  <td>
                    <input type="file" name="kemasan_produk" class="btn btn-success">
                  </td>
                </tr>
                <tr>
                  <td>
                    <br><br>
                  </td>
                </tr>
                <tr>
                  <td>
                    <input type="submit" name="submit" value="Submit" class="badge-danger form-control">
                  </td>
                </tr>
              </table>
          </form>
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

        <?php foreach ($umkm as $key) { ?>
        <div class="modal fade" id="hapus<?=$key->IDDataUMKM?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
             <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Hapus Data UMKM</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
              </div>
           <div class="modal-body">
             <p>Anda Yakin Ingin Menghapus Data UMKM <?= $key->Nama_umkm ?>?</p>
           </div>
           <div class="modal-footer justify-content-between">
             <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
             <a href="<?= site_url()?>admin/Order/hapusDataUMKMM/<?= $key->IDDataUMKM ?>" class="btn btn-danger">Iya</a>
           </div>
          </div>
         <!-- /.modal-content -->
          </div>
        <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <?php } ?>

            <div class="modal fade" id="tambahumkm" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
                <div class="modal-dialog" role="document">
                   <div class="modal-content">
                     <div class="modal-header">
                       <h4 class="modal-title" id="ExampleModalLabel">Tambah Data UMKM</h4>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                       </button>
                     </div>
                     <div class="modal-body">
                     <?=form_open_multipart('admin/Order/tambahDataUMKMM');?>

                         <table width="100%">
                           <tr>
                             <td>Nama UMKM</td>
                             <td>:</td>
                             <td>
                               <select class="form-control" name="idumkm">
                                 <option value="">-- Pilih UMKM -- </option>
                                 <?php foreach ($umkm as $u): ?>
                                   <option value="<?=$u->IDUMKM?>"><?=$u->Nama_umkm?></option>
                                     <?php endforeach; ?>
                                </select>
                             </td>
                            </tr>
                            <tr>
                              <td>Nama Produk</td>
                              <td>:</td>
                              <td><input type="text" name="nama_produk" class="form-control"></td>
                            </tr>
                            <tr>
                              <td>Foto Produk</td>
                              <td>:</td>
                              <td>*Pilih salah satu*</td>
                            </tr>
                            <tr>
                              <td><input type="text" name="foto_produk" placeholder="link foto" class="form-control"></td>
                              <td>Atau</td>
                              <td> <input type="file" name="foto_produk" class="form-control"> </td>
                            </tr>
                            <tr>
                              <td>Keterangan</td>
                              <td>:</td>
                              <td><textarea name="keterangan" class="form-control" rows="8" cols="80"></textarea> </td>
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
              <div class="modal fade" id="edit<?=$key->IDDataUMKM?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
              <div class="modal-dialog" role="document">
               <div class="modal-content">
                 <div class="modal-header">
                   <h4 class="modal-title" id="ExampleModalLabel">Edit Data UMKM</h4>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>
                 <div class="modal-body">
                   <?=form_open_multipart('admin/Order/editDataUMKMM/'.$key->IDDataUMKM);?>

                     <input type="hidden" name="iddataumkm" value="<?=$key->IDDataUMKM?>">
                     <input type="hidden" name="idumkm" value="<?=$key->IDUMKM?>">
                     <table width="100%">
                       <tr>
                         <td>Nama UMKM</td>
                         <td>:</td>
                         <td>
                           <input type="text" name="namaumkm" disabled value="<?=$key->Nama_umkm?>" class="form-control">
                         </td>
                        </tr>
                        <tr>
                          <td>Nama Produk</td>
                          <td>:</td>
                          <td><input type="text" name="nama_produk" class="form-control" value="<?=$key->Nama_produk?>"></td>
                        </tr>
                        <tr>
                          <td>Keterangan</td>
                          <td>:</td>
                          <td><textarea name="keterangan" class="form-control" rows="8" cols="80"><?php echo $key->Keterangan ?></textarea> </td>
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
