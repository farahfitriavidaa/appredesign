<!DOCTYPE html>
<html lang="id">

	<?php $this->load->view('diskusi/layouts/head'); ?>

	<body class="fixed-left">

		<!-- Loader -->
		<div id="preloader"><div id="status"><div class="spinner"></div></div></div>

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
						<img src="<?=base_url()?>asset/logo2.png" alt="logo gDESK" style="height:100%;">
					</div>
				</div>

				<?php $this->load->view($level.'/layout/sidebar'); ?>
				<!-- end sidebarinner -->
			</div>
			<!-- Left Sidebar End -->

			<!-- Start right Content here -->

			<div class="content-page">
				<!-- Start content -->
				<div class="content">

					<!-- Top Bar Start -->
					<?php $this->load->view('diskusi/layouts/navbar') ?>
					<!-- Top Bar End -->

					<div class="page-content-wrapper ">

						<div class="container-fluid">

							<div class="row">
								<div class="col-sm-12">
									<div class="page-title-box">
										<h4 class="page-title">Lihat Diskusi</h4>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<!-- end page title end breadcrumb -->

							<div class="row mb-3" style="justify-content: flex-end;">
								<div>
									<a class="btn btn-secondary btn-sm <?=$filter === "semua" ? "btn-outline-secondary" : "border-0"?>" href="<?=base_url();?><?=$level;?>/<?=$jenis_diskusi;?>/lihatDiskusi/semua">
										Semua diskusi
									</a>
								</div>
								<div>
									<a class="btn btn-secondary btn-sm <?=$filter === "belum-selesai" ? "btn-outline-secondary" : "border-0"?>" href="<?=base_url();?><?=$level;?>/<?=$jenis_diskusi;?>/lihatDiskusi/">
										Belum selesai
									</a>
								</div>
								<div>
									<a class="btn btn-secondary btn-sm <?=$filter === "telah-selesai" ? "btn-outline-secondary" : "border-0"?>" href="<?=base_url();?><?=$level;?>/<?=$jenis_diskusi;?>/lihatDiskusi/telah-selesai">
										Telah selesai
									</a>
								</div>
							</div>

							<?php if ( ! $has_dispro): ?>
								<p class="mt-4">Belum ada diskusi untuk kategori ini.</p>
							<?php else: ?>
								<?php foreach($daftar_diskusi as $diskusi): ?>
								<a href="<?=base_url();?><?=$level;?>/<?=$jenis_diskusi;?>/<?=trimId('PS',$diskusi->IDPesan);?>" class="list-diskusi mb-2">
									<div class="card">
										<div class="card-body">
											<strong><?= $diskusi->Nama_produk; ?></strong>
											<p><?= character_limiter($diskusi->Komentar, 47); ?></p>
											<div class="mt-2">
												<span class="text-muted"><?= cetakWaktu($diskusi->Tanggal_waktu); ?></span>
												<?= cetakStatus($diskusi->Status, $level); ?>
											</div>
										</div>
									</div>
								</a>
								<?php endforeach; ?>
							<?php endif; ?>

							<div class="mt-4">
								<?php if ($hal_selanjutnya): ?>
									<a class="float-right btn btn-raised btn-info" href="<?=base_url();?><?=$level?>/<?=$jenis_diskusi;?>/lihatDiskusi/<?=$filter."/".(int)($page + 1)?>">
										Daftar selanjutnya
										<i class="mdi mdi-arrow-right"></i>
									</a>
								<?php endif; ?>

								<?php if ($hal_sebelumnya): ?>
									<a class="float-left btn btn-raised btn-info" href="<?=base_url();?><?=$level?>/<?=$jenis_diskusi;?>/lihatDiskusi/<?=$filter."/".(int)($page - 1)?>">
										<i class="mdi mdi-arrow-left"></i>
										Daftar sebelumnya
									</a>
								<?php endif; ?>
							</div>
						</div><!-- container -->

					</div> <!-- Page content Wrapper -->

				</div> <!-- content -->

				<footer class="footer">
					© 2018 Urora by Mannatthemes.
				</footer>

			</div>
			<!-- End Right content here -->

		</div>
		<!-- END wrapper -->

		<?php $this->load->view('diskusi/layouts/footer') ?>