<!DOCTYPE html>
<html lang="id" style="scroll-behavior:smooth">

	<?php $this->load->view('diskusi/layouts/head'); ?>

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

							<?php if ( ! is_null($this->session->flashdata('alert'))): ?>
								<div class="row">
									<div class="col-12">
										<div class="alert alert-danger alert-dismissible fade show mb-0 mt-3" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<?=$_SESSION['alert']?>
										</div>
									</div>

									<?php if (isset($_SESSION['btn_back'])): ?>
										<div class="col-12 mt-4">
											<a href="<?=base_url();?><?=$level;?>/diskusi/lihatDiskusi" class="btn btn-raised btn-primary">
												<i class="mdi mdi-arrow-left"></i>
												Kembali
											</a>
										</div>
									<?php endif; ?>
								</div>
							<?php endif; ?>

							<?php if ( ! is_null($pemesanan)): ?>
							<button class="btn btn-raised btn-secondary mt-4" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="detilProduk detilRequest">
								<i class="mdi mdi-format-align-left"></i>
								Deskripsi Request
							</button>

							<div class="row align-items-stretch mt-4">
								<!-- Data bagian kiri -->
								<div class="col-lg-6 mb-4 collapse multi-collapse" id="detilProduk">
									<div class="card" style="height:100%;">
										<div class="card-body">
											<strong class="d-block">Nama Produk</strong>
											<p><?=$pemesanan->Nama_produk?></p>

											<strong class="d-block">Keterangan</strong>
											<p><?=$pemesanan->Keterangan?></p>

											<strong class="d-block">Foto Produk</strong>
											<?php if (empty($pemesanan->Foto_produk)): ?>
												<p><i class="text-muted">Tidak ada foto produk</i></p>
											<?php else: ?>
												<div class="mb-4" style="height: 160px;">
													<img src="<?=base_url()."uploads/foto_produk/".$pemesanan->Foto_produk;?>" alt="foto produk" class="img-thumbnail" style="height:inherit">
												</div>
											<?php endif; ?>

											<strong class="d-block">Logo Produk</strong>
											<?php if (empty($pemesanan->Logo_produk)): ?>
												<p><i class="text-muted">Tidak ada logo produk</i></p>
											<?php else: ?>
												<div class="mb-4" style="height: 160px;">
													<img src="<?=base_url()."uploads/logo_produk/".$pemesanan->Logo_produk;?>" alt="logo produk" class="img-thumbnail" style="height:inherit">
												</div>
											<?php endif; ?>

											<strong class="d-block">Kemasan Produk</strong>
											<?php if (empty($pemesanan->Kemasan_produk)): ?>
												<p><i class="text-muted">Tidak ada foto kemasan produk</i></p>
											<?php else: ?>
											<?php $kemasan_produk = explode(',', $pemesanan->Kemasan_produk); ?>
												<div class="mb-4">
												<?php foreach($kemasan_produk as $img):?>
													<img src="<?=base_url()."uploads/foto_kemasan_lama/".$img;?>" alt="kemasan produk" class="img-thumbnail mr-1" style="max-height: 160px;">
												<?php endforeach; ?>
												</div>
											<?php endif; ?>

										</div>
									</div>
								</div>

								<!-- Data bagian kanan -->
								<div class="col-lg-6 mb-4 collapse multi-collapse" id="detilRequest">
									<div class="card" style="height:100%;">
										<div class="card-body">
											<?php if ($level !== "designer"): ?>
												<strong class="d-block">Tanggal Request</strong>
												<p><?= date('d-M-Y', strtotime($pemesanan->Tgl_order)); ?></p>
											<?php endif; ?>

											<strong class="d-block">Status</strong>
											<p><?= cetakStatus($pemesanan->Status, $level, false); ?></p>

											<?php if ($level !== "designer"): ?>
												<strong class="d-block">Harga</strong>
												<p><?= $harga ??'<i class="text-muted">Belum ditentukan</i>'; ?></p>
											<?php endif; ?>

											<strong class="d-block">Tanggal Mulai Desain</strong>
											<p><?= $pemesanan->Tgl_mulai ?? '<i class="text-muted">Belum ditentukan</i>'; ?></p>

											<strong class="d-block">Rencana Desain Selesai</strong>
											<p><?= $pemesanan->Tgl_akhir ?? '<i class="text-muted">Belum ditentukan</i>'; ?></p>

											<strong class="d-block">Keterangan Desain</strong>
											<p><?= $pemesanan->Keterangan_design ?? '<i class="text-muted">Belum ditentukan</i>'; ?></p>

											<strong class="d-block">Desainer</strong>
											<p><?= $designer ?? '<i class="text-muted">Ditentukan Pengelola</i>'; ?></p>

											<strong class="d-block">Hasil Desain</strong>
											<?php
												$hasil_design = $pemesanan->Hasil_design;
												if (empty($hasil_design)): ?>
													<p><i class="text-muted">Belum ada hasil desain</i></p>
											<?php
												else:
												$hasil_design = explode(',', $hasil_design); ?>
												<div class="mb-4">
													<?php foreach($hasil_design as $img):?>
														<img src="<?=base_url()."uploads/hasil_design/".$img?>" alt="hasil desain" class="img-thumbnail mr-2 mb-2" style="max-height:240px;">
													<?php endforeach;?>
												</div>
											<?php endif; ?>

											<strong class="d-block">Revisi Desain</strong>
											<?php
												$revisi = $pemesanan->Revisi_design;
												if (empty($revisi)): ?>
													<p><i class="text-muted">Belum ada hasil desain</i></p>
											<?php
												else:
												$revisi = explode(',', $revisi) ?>
												<div class="mb-4">
													<?php foreach($revisi as $img):?>
														<img src="<?=base_url()."uploads/revisi_design/".$img?>" alt="revisi desain" class="img-thumbnail mr-2 mb-2" style="max-height:240px;">
													<?php endforeach;?>
												</div>
											<?php endif; ?>
										</div>

										<?php $id_pesan    = trimId('PS', $pemesanan->IDPesan); ?>
										<?php if ($pemesanan->Status <= 4): ?>
											<div class="card-footer">
											<?php if ($level === 'umkm'): ?>
												<a class="btn btn-raised btn-secondary float-right" href="<?=base_url();?>umkm/request/editRequest/<?=$id_pesan;?>">
													Edit Keterangan
												</a>
											<?php elseif ($level === 'designer'): ?>
												<a class="btn btn-raised btn-secondary float-right" href="<?=base_url();?>designers/request/<?=$id_pesan?>">
													Unggah hasil design
												</a>
											<?php endif; ?>
											</div>
										<?php endif; ?>
									</div>
								</div>

								<!-- Bagian komentar -->
								<div class="col-12">
									<div class="mb-4">
										<div class="mb-4">
											<?php if(empty($daftar_komentar)): ?>
												<p>Belum ada diskusi. Mulai diskusi dengan kirim komentar/pesan di bawah.</p>
											<?php else: ?>
												<?php
													$lawan_diskusi = 'Pengelola';
													if ($level === 'admin')
														$lawan_diskusi = $jenis_diskusi === 'diskum' ? 'UMKM' : 'designer';
												?>
												<strong>Diskusi dengan <?= $lawan_diskusi; ?></strong>
											<?php endif; ?>
										</div>

										<div>
										<?php foreach($daftar_komentar as $diskusi): ?>
											<div class="row mb-3" style="flex-flow: nowrap; margin-right: 75px;" >
												<div class="col-auto">
													<div class="rounded-circle p-1" style="background-color: #ffffff;">
														<img src="<?=base_url()?>uploads/foto_user/<?=$diskusi->Foto?>" alt="foto profil" class="img-fluid crop-center rounded-circle" style="width: 30px; height: 30px;"/>
													</div>
												</div>
												<div class="card" style="<?=strtolower($diskusi->Level) === $level ? 'background-color: #cacaff;' : ''; ?>" >
													<div class="card-header">
														<div class="row px-3" style="align-items: baseline;">
															<strong><?=$diskusi->Nama_lengkap?></strong>
															<small class="text-muted ml-2">
																<?php
																	if ($diskusi->Level === "UMKM")
																		echo "(".$diskusi->Level." - ".character_limiter($diskusi->Nama_umkm, 12).")";
																	else
																		echo "(".$diskusi->Level.")";
																?>
															</small>
														</div>
													</div>
													<div class="card-body" style="padding: 0.5rem 1.25rem;">
														<?php if (property_exists($diskusi, 'Foto_diskum')): ?>
															<?php if ( ! is_null($diskusi->Foto_diskum)): ?>
																<a href="<?=base_url();?>uploads/foto_diskum/<?=$diskusi->Foto_diskum?>" class="btn btn-secondary" download>Download gambar</a>
																<img src="<?=base_url();?>uploads/foto_diskum/<?=$diskusi->Foto_diskum?>" alt="foto untuk diskusi" class="img-thumbnail d-block img-diskusi">
															<?php endif; ?>
														<?php else: ?>
															<?php if ( ! is_null($diskusi->Foto_dispro)): ?>
																<a href="<?=base_url();?>uploads/foto_dispro/<?=$diskusi->Foto_dispro?>" class="btn btn-secondary" download>Download gambar</a>
																<img src="<?=base_url();?>uploads/foto_dispro/<?=$diskusi->Foto_dispro?>" alt="foto untuk diskusi" class="img-thumbnail d-block img-diskusi">
															<?php endif; ?>
														<?php endif; ?>

														<p class="mt-2 mb-2"><?=$diskusi->Komentar?></p>

														<div class="w-100 mt-2">
															<small class="text-13 text-muted float-right"><?= cetakWaktu($diskusi->Tanggal_waktu); ?></small>
														</div>
													</div>
												</div>
												<!-- <div style="width: 75px; flex-shrink: 0;"></div> -->
											</div>
										<?php endforeach; ?>
										</div>
									</div>

								</div>

							</div> <!-- end row -->
							<?php endif; ?>

						</div><!-- container -->

					</div> <!-- Page content Wrapper -->

				</div> <!-- content -->

				<!-- Bagian input komentar -->
				<div class="card" id="input-komentar">
					<div id="preview-wrapper" style="display: none; height: 0;">
						<button class="btn btn-secondary position-absolute" id="hapus-foto" aria-label="Close" style="top: 24px; right: 24px; background-color: #fff;">
							Hapus Foto
						</button>
						<img src="" alt="foto yang di upload" class="img-thumbnail" id="foto-upload" style="max-height: 320px;">
					</div>

					<?php $action = $level.'/'.$jenis_diskusi.'/tambahKomentar'; ?>

					<?=form_open_multipart($action, ['class' => 'mb-0', 'autocomplete' => 'off']);?>
						<div style="display: flex; flex-flow: row nowrap; padding: 8px 16px;">
							<div class="form-group" style="display:inline; padding:0; margin: 0; flex: auto">
								<input type="hidden" name="np" value="<?= $id_pesan; ?>">
								<input type="text" name="komentar" placeholder="Masukan pesan..." class="form-control" style="display: unset;">
							</div>
							<label for="foto" class="mx-3 mb-0" style="font-size: 1.4em; cursor: pointer">
								<i class="mdi mdi-camera"></i>
								<input type="file" name="foto-komentar" id="foto" style="display:none">
							</label>
							<label for="submit-button" class="btn btn-primary">
								<i class="mdi mdi-send"></i>
								<input type="submit" id="submit-button" value="Kirim" style="display: none;">
							</label>
						</div>
					<?=form_close();?>
				</div>

				<footer class="footer" style="z-index: 10;">
					© 2018 Urora by Mannatthemes.
				</footer>

			</div>
			<!-- End Right content here -->

		</div>
		<!-- END wrapper -->

		<!-- Custom script untuk menampilkan preview gambar -->
		<script src="<?=base_url();?>asset/admin/pages/diskusi.js"></script>

		<?php $this->load->view('diskusi/layouts/footer') ?>
