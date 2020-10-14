<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Urora - Responsive Bootstrap 4 Admin Dashboard</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Mannatthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="<?=base_url()?>asset/admin/images/favicon.ico">

        <link href="<?=base_url()?>asset/admin/plugins/animate/animate.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>asset/admin/css/bootstrap-material-design.min.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>asset/admin/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>asset/admin/css/style.css" rel="stylesheet" type="text/css">

    </head>
    <body>


    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="wrapper-page">
        <div class="display-table">
            <div class="display-table-cell">
                <diV class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="<?=base_url()?>asset/admin/images/extra.png" alt="" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center pt-3">
                                        <a href="index.html">
                                            <!-- <img src="<?=base_url()?>asset/admin/images/logo-dark.png" alt="logo" height="22" /> -->
                                              <h1>gDESK</h1>
                                        </a>
                                    </div>
                                    <div class="px-3 pb-3">
                                        <form class="form-horizontal m-t-20 mb-0" action="<?=base_url()?>Create/cekUser" method="POST">

                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input class="form-control" type="text" required="" name="username" placeholder="Username">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input class="form-control" type="password" required="" name="password" placeholder="Password">
                                                </div>
                                            </div>

                                            <!-- <div class="form-group row">
                                                <div class="col-12">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1">Remember me</label>
                                                    </div>
                                                </div>
                                            </div> -->

                                            <div class="form-group text-right row m-t-20">
                                                <div class="col-12">
                                                    <button class="btn btn-primary btn-raised btn-block waves-effect waves-light" type="submit">Log In</button>
                                                </div>
                                            </div>

                                          </form>
                                            <div class="form-group m-t-10 mb-0 row">

                                                <div class="col-sm-5 m-t-20">
                                                    <a href="<?=base_url()?>Create" class="text-muted"><i class="mdi mdi-account-circle"></i> Ingin membuat akun ?</a>
                                                </div>
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
