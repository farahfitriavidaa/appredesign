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
                                              <li class="breadcrumb-item active"><a href="#">On Going</a></li>
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
                                          <h4 class="mt-0 header-title">Data On Going UMKM</h4>
                                          <p class="text-muted font-14">Berikut adalah data on going order para UMKM gDESK
                                          </p>
                                          <table id="datatable" class="table table-bordered">
                                              <thead>
                                              <tr>
                                                  <th>No.</th>
                                                  <th>ID Pesan</th>
                                                  <th>ID Pengelola</th>
                                                  <th>ID Designer</th>
                                                  <th>Nama UMKM</th>
                                                  <th>Tanggal Mulai</th>
                                                  <th>Hasil Design</th>
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
                                                  <td><?php echo $a->Tgl_mulai ?></td>
                                                  <td><a class="btn btn-primary" data-toggle="modal" data-target="#hasil<?=$a->IDPesan?>">Hasil</a></td>
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
        <div class="modal fade" id="hapus<?=$key->IDPesan?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
             <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Hapus Pemesanan</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
              </div>
           <div class="modal-body">
             <p>Anda Yakin Ingin Menghapus Pemesanan UMKM <?= $key->Nama_umkm ?>?</p>
             <p>Dengan pemesanan ID <?=$key->IDPesan?></p>
           </div>
           <div class="modal-footer justify-content-between">
             <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
             <a href="<?= site_url()?>Admin/hapusPemesanan/<?= $key->IDPesan ?>" class="btn btn-danger">Iya</a>
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
               <h4 class="modal-title" id="ExampleModalLabel">Tambah Data Pemesanan</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
               </div>
               <div class="modal-body">
                 <?=form_open('Admin/tambahPemesanan');?>

                   <table width="100%">
                     <tr>
                       <td>Nama UMKM</td>
                       <td>:</td>
                       <td>
                         <select class="form-control" name="idumkm">
                           <option value="">-- Pilih UMKM --</option>
                           <?php foreach ($umkm as $u): ?>
                             <option value="<?=$u->IDUMKM?>"><?=$u->Nama_umkm?></option>
                           <?php endforeach; ?>
                         </select>
                       </td>
                     </tr>
                     <tr>
                       <td>Nama Designer</td>
                       <td>:</td>
                       <td>
                         <select class="form-control" name="iddesigner">
                           <option value="">-- Pilih Designer --</option>
                           <?php foreach ($designer as $d): ?>
                             <option value="<?=$d->IDDesigner?>"><?=$d->Nama_lengkap?></option>
                           <?php endforeach; ?>
                         </select>
                       </td>
                     </tr>
                     <tr>
                       <td>Tanggal Mulai</td>
                       <td>:</td>
                       <td><input type="date" class="form-control" name="tglmulai"></td>
                     </tr>
                     <tr>
                       <td>Apakah sudah ada data UMKM nya?</td>
                       <td>:</td>
                       <td>
                         <input type="radio" name="status" value="Ada"> Ada
                         <input type="radio" name="status" value="Tidak Ada"> Tidak Ada
                      </td>
                     </tr>
                     <tr>
                       <td>Permintaan Design</td>
                       <td>:</td>
                       <td><textarea class="form-control" name="keterangan" rows="8" cols="80" placeholder="Tuliskan ID Data UMKM"></textarea> </td>
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
                     <?=form_open_multipart('Admin/tambahDataUMKM');?>

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
                              <!-- <td>Atau</td>
                              <td> <input type="file" name="foto_produk" class="form-control"> </td> -->
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

              <?php foreach ($orderpemesanan as $key) { ?>
              <div class="modal fade" id="edit<?=$key->IDPesan?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
              <div class="modal-dialog" role="document">
               <div class="modal-content">
                 <div class="modal-header">
                   <h4 class="modal-title" id="ExampleModalLabel">Edit Data Pemesanan</h4>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>
                 <div class="modal-body">
                   <?=form_open_multipart('Admin/editPemesanan/'.$key->IDPesan);?>

                     <input type="hidden" name="idpesan" value="<?=$key->IDPesan?>">
                     <table width="100%">
                       <tr>
                         <td>ID Pesan</td>
                         <td>:</td>
                         <td><input type="text" class="form-control" name="idpesann" disabled value="<?=$key->IDPesan?>"></td>
                       </tr>
                       <tr>
                         <td>Nama UMKM</td>
                         <td>:</td>
                         <td><input type="text" class="form-control" name="idumkm" disabled value="<?=$key->Nama_umkm?>"></td>
                       </tr>
                       <tr>
                         <td>ID Designer</td>
                         <td>:</td>
                         <td>
                           <select class="form-control" name="iddesigner">
                             <option value="<?=$key->IDDesigner?>"><?=$key->IDDesigner?></option>
                             <?php foreach ($designer as $k): ?>
                              <option value="<?=$k->IDDesigner?>"><?=$k->Nama_lengkap?> - <?=$k->IDDesigner?></option>
                             <?php endforeach; ?>
                           </select>
                         </td>
                       </tr>
                       <tr>
                         <td>Tanggal Mulai Design</td>
                         <td>:</td>
                         <td><input type="date" class="form-control" name="tgl_mulai" value="<?=$key->Tgl_mulai?>"></td>
                       </tr>
                       <tr>
                         <td>Tanggal Akhir Design</td>
                         <td>:</td>
                         <td><input type="date" class="form-control" name="tgl_akhir" value="<?=$key->Tgl_akhir?>"></td>
                       </tr>
                       <tr>
                         <td>Keterangan Design</td>
                         <td>:</td>
                         <td><textarea class="form-control" name="keterangan" rows="8" cols="80"><?=$key->Keterangan_design?></textarea></td>
                       </tr>
                       <tr>
                         <td>Hasil Design</td>
                         <td>:</td>
                         <td><input type="file" class="form-control" name="hasil_design"></td>
                       </tr>
                       <tr>
                         <td>Status</td>
                         <td>:</td>
                         <td>
                              <select class="form-control" name="status">
                                <?php if ($a->Status == '0'){ ?>
                                  <option value="<?=$key->Status?>">Pending</option>
                                <?php }else if($a->Status == '1'){ ?>
                                  <option value="<?=$key->Status?>">Permintaan Design Fix</option>
                                <?php }else if($a->Status == '2'){ ?>
                                  <option value="<?=$key->Status?>">On Going</option>
                                <?php }else if($a->Status == '3'){ ?>
                                  <option value="<?=$key->Status?>">Design Fix</option>
                                <?php }else if($a->Status == '4'){ ?>
                                  <option value="<?=$key->Status?>">Review Hasil</option>
                                <?php }else if($a->Status == '5'){ ?>
                                  <option value="<?=$key->Status?>">Pemesanan Fix</option>
                                <?php }else if($a->Status == '8'){ ?>
                                  <option value="<?=$key->Status?>">Cancel</option>
                                <?php }else{ ?>
                                  <option value="">Selesai</option>
                                <?php } ?>
                                <option value="0">Pending</option>
                                <option value="1">Permintaan Design Fix</option>
                                <option value="2">On Going</option>
                                <option value="3">Design Fix</option>
                                <option value="4">Review Hasil</option>
                                <option value="5">Pemesanan Fix</option>
                                <option value="8">Cancel</option>
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

              <?php foreach ($orderpemesanan as $key) { ?>
              <div class="modal fade" id="detail<?=$key->IDPesan?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
              <div class="modal-dialog" role="document">
               <div class="modal-content">
                 <div class="modal-header">
                   <h4 class="modal-title" id="ExampleModalLabel">Detail Data Pemesanan</h4>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>
                 <div class="modal-body">
                   <!-- Tidak ada action-nya? -->
                   <!-- <form class="" action="" method="POST" enctype="multipart/form-data"> -->
                   <?=form_open_multipart('');?>

                     <input type="hidden" name="idpesan" value="<?=$key->IDPesan?>">
                     <table width="100%">
                       <tr>
                         <td>ID Pesan</td>
                         <td>:</td>
                         <td><input type="text" class="form-control" name="idpesann" value="<?=$key->IDPesan?>"></td>
                       </tr>
                       <tr>
                         <td>Nama UMKM</td>
                         <td>:</td>
                         <td><input type="text" class="form-control" name="idumkm" value="<?=$key->Nama_umkm?>"></td>
                       </tr>
                       <tr>
                         <td>ID Designer</td>
                         <td>:</td>
                         <td>
                           <input type="text" class="form-control" name="iddesigner" value="<?=$key->IDDesigner?>">
                         </td>
                       </tr>
                       <tr>
                         <td>Tanggal Mulai Design</td>
                         <td>:</td>
                         <td><input type="date" class="form-control" name="tgl_mulai" value="<?=$key->Tgl_mulai?>"></td>
                       </tr>
                       <tr>
                         <td>Tanggal Akhir Design</td>
                         <td>:</td>
                         <td><input type="date" class="form-control" name="tgl_akhir" value="<?=$key->Tgl_akhir?>"></td>
                       </tr>
                       <tr>
                         <td>Keterangan Design</td>
                         <td>:</td>
                         <td><textarea class="form-control" name="keterangan" rows="8" cols="80"><?=$key->Keterangan_design?></textarea></td>
                       </tr>
                       <tr>
                         <td>Status</td>
                         <td>:</td>
                         <td>
                              <select class="form-control" name="status">
                                <?php if ($a->Status == '0'){ ?>
                                  <option value="<?=$key->Status?>">Pending</option>
                                <?php }else if($a->Status == '1'){ ?>
                                  <option value="<?=$key->Status?>">Permintaan Design Fix</option>
                                <?php }else if($a->Status == '2'){ ?>
                                  <option value="<?=$key->Status?>">On Going</option>
                                <?php }else if($a->Status == '3'){ ?>
                                  <option value="<?=$key->Status?>">Design Fix</option>
                                <?php }else if($a->Status == '4'){ ?>
                                  <option value="<?=$key->Status?>">Review Hasil</option>
                                <?php }else if($a->Status == '5'){ ?>
                                  <option value="<?=$key->Status?>">Pemesanan Fix</option>
                                <?php }else if($a->Status == '8'){ ?>
                                  <option value="<?=$key->Status?>">Cancel</option>
                                <?php }else{ ?>
                                  <option value="">Selesai</option>
                                <?php } ?>
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

        <?php $this->load->view('admin/layout/footer') ?>
