<!DOCTYPE html>
<html lang="en">

    <?php $this->load->view('cdc/layout/Head'); ?>

    <body class="fixed-left">

        <div id="wrapper">

            <div class="left side-menu">
                <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                    <i class="mdi mdi-close"></i>
                </button>

                <div class="topbar-left">
                    <div class="text-center">
                        <img src="<?=base_url()?>asset/logo2.png" width="140px" style="margin-top:-10px">
                    </div>
                </div>

              <?php $this->load->view('cdc/layout/Sidebar') ?>

            </div>


            <div class="content-page">

                <div class="content">


                    <?php $this->load->view('cdc/layout/Navbar') ?>

                    <div class="page-content-wrapper dashborad-v">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item active">Kelola Profil</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Kelola Profil</h4>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="md-form" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-12 col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <h4 class="mt-0 header-title">Data Profil</h4>
                                                    <br><br>
                                                    <div class="general-label">
                                                        <?=validation_errors('<div class="error">'.'</div>'); ?>
                                                        <?=form_open_multipart('cdc/Profil/editProfil/'.$akun->IDUser, ['class' => 'mb-0']);?>

                                                          <div class="form-group">
                                                              <img src="<?=base_url()?>uploads/foto_user/<?=$akun->Foto?>" width="100px">
                                                              <label for="exampleInputEmail1" class="bmd-label-floating ">Foto Profil</label>
                                                              <input type="file" name="fotoprofil" class="form-control">
                                                              <span class="bmd-help">Masukan foto profil Anda</span>
                                                          </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1" class="bmd-label-floating ">Email</label>
                                                                <input type="email" class="form-control" required parsley-type="email" name="email" value="<?=$akun->Email?>">
                                                                <span class="bmd-help">Masukan email Anda</span>
                                                            </div>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                <span class="input-group-text">@</span>
                                                                </div>
                                                                <input type="text" name="username" disabled class="form-control" placeholder="Username" aria-describedby="inputGroupPrepend2" required value="<?=$akun->Username?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1" class="bmd-label-floating">Password</label>
                                                                <input type="password" name="password" class="form-control" required value="<?=$akun->Password?>">
                                                                  <span class="bmd-help">Minimal 8 karakter</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1" class="bmd-label-floating ">Nama Lengkap</label>
                                                                <input type="text" name="nama_lengkap" class="form-control" required value="<?=$akun->Nama_lengkap?>">
                                                                <span class="bmd-help">Masukan nama lengkap Anda</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleTextarea" class="bmd-label-floating">Regional</label>
                                                                <textarea class="form-control" name="regional" rows="3"><?=$akun->Regional ?></textarea>
                                                                <span class="bmd-help">Masukan regional Anda</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>No. Telp</label>
                                                                <input type="text" placeholder="" name="no_telp" data-mask="(999) 999-9999" class="form-control" value="<?=$akun->No_telp?>">
                                                                <span class="font-13 text-muted">08x-xxx-xxx-xxx</span>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary btn-raised mb-0">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
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


        <?php $this->load->view('cdc/layout/Footer') ?>
