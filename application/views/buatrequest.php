<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<title>Buat Request</title>
		<meta content="Mannatthemes" name="author" />

		<link rel="shortcut icon" href="<?=base_url()?>asset/admin/images/favicon.ico">

		<link href="<?=base_url()?>asset/admin/plugins/animate/animate.css" rel="stylesheet" type="text/css">
		<link href="<?=base_url()?>asset/admin/css/bootstrap-material-design.min.css" rel="stylesheet" type="text/css">
		<link href="<?=base_url()?>asset/admin/css/icons.css" rel="stylesheet" type="text/css">
		<link href="<?=base_url()?>asset/admin/css/style.css" rel="stylesheet" type="text/css">
	</head>

	<body>

		<div class="accountbg-custom" style="background-image:url('<?=base_url()?>asset/admin/images/background.jpeg');"></div>

		<diV class="container">
			<div class="row py-5" style="align-items: center;">
				<div class="col-md-4 col-lg-6 text-center">
					<img src="<?=base_url()?>asset/admin/images/icon.png" alt="dekorasi" class="img-fluid" style="width: 100%; max-width: 280px;">
				</div>
				<div class="col-md-8 col-lg-6">
					<div class="card">
						<div class="card-body">

							<div class="text-center">
								<img src="<?=base_url()?>asset/logo.png" alt="logo" style="max-width: 200px;"/>
							</div>

							<div class="px-3">
								<?=form_open('Create/buatRequest', ['name' => 'buat-request', 'class' => 'form-horizontal smb-0']);?>

									<?=validation_errors('<div class="error">'.'</div>'); ?>
									
									<!-- hal pertama -->
									<div id="hal-pertama">
										<!-- daftar diri -->
										<div class="form-group bmd-form-group">
											<label for="nama-lengkap" class="bmd-label-floating">Nama Lengkap *</label>
											<input type="text" name="namalengkap" class="form-control" id="nama-lengkap" required>
										</div>

										<div class="form-group bmd-form-group">
											<label for="email" class="bmd-label-floating">Email *</label>
											<input type="email" name="email" class="form-control" id="email" required>
										</div>

										<div class="form-group bmd-form-group">
											<label for="telp" class="bmd-label-floating">No Whatsapp *</label>
											<input type="tel" name="telp" class="form-control" id="telp" required>
										</div>

										<!-- daftar umkm -->
										<div class="form-group bmd-form-group">
											<label for="nama-umkm" class="bmd-label-floating">Nama UMKM *</label>
											<input type="text" name="namaumkm" class="form-control" id="nama-umkm" required>
										</div>

										<div class="form-group bmd-form-group">
											<label for="regional" class="bmd-label-floating">Regional Area *</label>
											<input type="text" name="regional" class="form-control" id="regional" required>
										</div>

										<!-- buat request -->
										<div class="form-group bmd-form-group">
											<p>Jasa *</p>

											<span class="bmd-form-group is-filled">
												<div class="checkbox mb-2">
													<label class="text-dark">
														<input type="checkbox" name="jasa[]" value="0">

														<span class="checkbox-decorator">
															<span class="check"></span>
														</span>

														Re-design kemasan produk
													</label>
												</div>
											</span>

											<span class="bmd-form-group is-filled">
												<div class="checkbox mb-2">
													<label class="text-dark">
														<input type="checkbox" name="jasa[]" value="1">

														<span class="checkbox-decorator">
															<span class="check"></span>
														</span>

														Re-design logo produk
													</label>
												</div>
											</span>
										</div>

										<div class="form-group bmd-form-group">
											<label for="foto">Foto Produk *</label>
											<input type="file" name="foto-produk" class="form-control-file" id="foto" data-input="1" required>
											<div class="error-input-file mt-2">
												<ul class="list-file-error"></ul>
											</div>
										</div>

										<div class="position-relative" id="preview-wrapper-foto" style="display: none; height: 0;">
											<img src="" alt="foto yang akan di upload" class="img-thumbnail" id="preview-foto" style="max-height: 120px">
											<button type="button" class="btn btn-secondary position-absolute ml-2" id="hapus-foto" data-hapus="1" aria-label="Close" style="background-color: #fff">
												Hapus Foto
											</button>
										</div>

										<div class="form-group bmd-form-group">
											<label for="logo">Logo *</label>
											<input type="file" name="logo-produk" class="form-control-file" id="logo" data-input="2" required>
											<div class="error-input-file mt-2">
												<ul class="list-file-error"></ul>
											</div>
										</div>

										<div class="position-relative" id="preview-wrapper-logo" style="display: none; height: 0;">
											<img src="" alt="foto yang akan di upload" class="img-thumbnail" id="preview-logo" style="max-height: 120px">
											<button type="button" class="btn btn-secondary position-absolute ml-2" id="hapus-logo" data-hapus="2" aria-label="Close" style="background-color: #fff">
												Hapus Logo
											</button>
										</div>

										<div class="form-group bmd-form-group">
											<label for="kemasan">Kemasan Produk *</label>
											<input type="file" name="kemasan-produk[]" class="form-control-file" id="kemasan" data-input="3" multiple="multiple" required>
											<small class="text-muted">Tambahkan gambar kemasan yang sekarang dimiliki</small>
											<div class="error-input-file mt-2">
												<ul class="list-file-error"></ul>
											</div>
										</div>

										<div id="preview-wrapper-kemasan" style="display: none; height: 0;">
											<button type="button" class="btn btn-secondary ml-2" id="hapus-kemasan" data-hapus="3" aria-label="Close" style="background-color: #fff">
												Hapus Semua Kemasan
											</button>
											<div id="preview-kemasan"></div>
										</div>

										<div class="form-group bmd-form-group">
											<label for="keterangan-desain" class="bmd-label-floating">Keterangan mengenai desain yang diinginkan *</label>
											<textarea name="keterangan-desain" class="form-control" id="keterangan-produk" rows="4" required></textarea>
										</div>
									</div>

									<!-- hal kedua -->

									<div id="hal-kedua" class="sembunyi">
										<div class="form-group bmd-form-group">
											<label for="uname" class="bmd-label-floating">Username *</label>
											<input class="form-control" id="uname" type="text" name="username" value="" data-changed="false" required>
											<small id="username-notice" style="display: none;"></small>
										</div>

										<div class="form-group bmd-form-group">
											<label for="pass" class="bmd-label-floating">Password *</label>
											<input class="form-control" id="pass" type="password" name="password" required>
										</div>
									</div>

									<div class="form-group">
										<small class="text-muted">*) Wajib</small>
									</div>

									<div class="form-group bmd-form-group text-center">
										<div class="col-12">
											<button class="btn btn-raised btn-primary btn-block waves-effect waves-light sembunyi" id="btn-next" type="button">
												<span>Kirim</span>
												<i class="mdi mdi-send" id="icon-btn"></i>
											</button>

											<!-- <button class="btn btn-raised btn-primary btn-block waves-effect waves-light sembunyi" id="btn-submit" type="submit">
												Kirim
												<i class="mdi mdi-send"></i>
											</button> -->

											<button class="btn btn-raised btn-secondary btn-block waves-effect waves-light" type="button" id="btn-back">
												<span>Selanjutnya</span>
												<i class="mdi mdi-arrow-right"></i>
											</button>
										</div>
									</div>

									<!-- TODO: buat hal 2 -->

								<?=form_close();?>
							</div>

						</div>
					</div>
				</div>
			</div>
		</diV>

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

		 <!-- custom js -->
		 <script src="<?=base_url()?>asset/admin/pages/buatrequest.js"></script>
		 <script src="<?=base_url()?>asset/admin/js/register-request.js"></script>

	</body>
</html>
