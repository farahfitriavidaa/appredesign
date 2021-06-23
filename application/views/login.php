<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Log in</title>
        <meta content="Mannatthemes" name="author" />

        <link rel="shortcut icon" href="<?= base_url(); ?>asset/logos/favicons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="<?= base_url(); ?>asset/logos/favicons/android-icon-192x192.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?= base_url(); ?>asset/logos/favicons/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>asset/logos/favicons/apple-icon-180x180.png">

        <link href="<?=base_url()?>asset/admin/plugins/animate/animate.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>asset/admin/css/bootstrap-material-design.min.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>asset/admin/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>asset/admin/css/style.css" rel="stylesheet" type="text/css">

    </head>
    <body>


    <!-- Begin page -->
    <div class="accountbg-custom"></div>
    <div class="wrapper-page">
        <div class="display-table">
            <div class="display-table-cell">
                <diV class="container">
                    <div class="row justify-content-between">
                        <div class="col-md-4">
                            <img src="<?=base_url()?>asset/admin/images/icon.png" alt="" class="img-fluid">
                        </div>
                        <div class="col-md-8 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center pt-3">
                                        <img src="<?=base_url()?>asset/logo.png" alt="logo" style="width:100%;max-width:200px"/>
                                    </div>
                                    <div class="px-3 pb-3">
                                        <?=$this->session->flashdata('alert');?>

                                        <?=form_open('Create/cekUser', ['class' => 'form-horizontal m-t-20 mb-0']);?>

                                            <?=validation_errors('<div class="error">'.'</div>');?>

                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input class="form-control" type="text" name="username" placeholder="Username" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                                                </div>
                                            </div>
                                            <div class="form-group text-right row m-t-20">
                                                <div class="col-12">
                                                    <button class="btn btn-primary btn-raised btn-block waves-effect waves-light" type="submit">Log In</button>
                                                </div>
                                            </div>

                                        <?=form_close();?>

                                        <div style="text-align:center;">
                                            <a href="<?=base_url()?>Create" class="text-muted"><i class="mdi mdi-account-circle"></i> Ingin membuat akun ?</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </diV>
            </div>
        </div>
    </div>



        <!-- jQuery  -->
        <script src="<?=base_url()?>asset/admin/js/jquery.min.js"></script>
        <script src="<?=base_url()?>asset/admin/js/popper.min.js"></script>
        <script src="<?=base_url()?>asset/admin/js/bootstrap-material-design.js"></script>
        <script src="<?=base_url()?>asset/admin/js/modernizr.min.js"></script>
        <script src="<?=base_url()?>asset/admin/js/detect.js"></script>
        <script src="<?=base_url()?>asset/admin/js/fastclick.js"></script>
        <script src="<?=base_url()?>asset/admin/js/jquery.slimscroll.js"></script>
        <script src="<?=base_url()?>asset/admin/js/jquery.blockUI.js"></script>
        <script src="<?=base_url()?>asset/admin/js/waves.js"></script>
        <script src="<?=base_url()?>asset/admin/js/jquery.nicescroll.js"></script>
        <script src="<?=base_url()?>asset/admin/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="<?=base_url()?>asset/admin/js/app.js"></script>

    </body>
</html>
