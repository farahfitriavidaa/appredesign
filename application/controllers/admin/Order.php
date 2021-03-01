<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_created');
		$this->load->model('Model_admin');
		$this->load->model('Model_diskusi');
		$this->load->library('form_validation');
	}

	public function kelolaPemesanan()
	{
			$cek = $this->Model_admin->cekAkun($this->session->user);
			$data = array(
				'akun'			 => $cek,
				'pemesanan'	 => $this->Model_admin->getPemesanan(),
				'umkm'			 => $this->Model_admin->getUMKM(),
				'designer'	 => $this->Model_admin->getDesigner(),
				'dataumkm'   => $this->Model_admin->getDataaUMKM()
			);
			$this->load->view('admin/kelolapemesanan',$data);
	}

	public function createPortofolio($id)
	{
			$cek = $this->Model_admin->cekAkun($this->session->user);
			$data = array(
				'akun'			 => $cek,
				'desainer'	 => $this->Model_admin->getDesignerId($id),
				'portofolio' => $this->Model_admin->getPortofolio($id),
			);
			$this->load->view('admin/kelolaportofolio',$data);
	}

	public function hapusPemesanan($id)
	{
			$hapus = $this->Model_admin->delete_diskum($id);
			$hapuss = $this->Model_admin->delete_pemesanan($id);
			redirect('admin/Order/kelolaPemesanan');
	}

	public function tambahPemesanan()
	{
					$cek = $this->Model_admin->getAkunPengelola($this->session->user);
					$id 		= $this->Model_created->idPesan();
					$idD		= $this->Model_created->idDiskum();
					$tanggal_waktu	= date('Y-m-d H:i:s');
					$data 	= array(
						'IDPesan'						=> $id,
						'IDDataUMKM'						=> $this->input->post('idumkm'),
						'IDPengelola'				=> $cek->IDPengelola,
						'IDDesigner'				=> $this->input->post('iddesigner'),
						'Tgl_order'					=> $this->input->post('tglorder'),
						'Keterangan_design'	=> $this->input->post('keterangan'),
						'Status'						=> '0'
					);
					$dataa 	= array(
						'IDDiskum'		=> $idD,
						'IDPengelola'	=> $cek->IDPengelola,
						'IDPesan'			=> $id,
						'Komentar'		=> $this->input->post('keterangan'),
						'Tanggal_waktu'=> $tanggal_waktu
					);
					$cek	= $this->Model_admin->create_pemesanan($data);
					$cekk = $this->Model_admin->create_diskum($dataa);
					redirect('admin/Order/kelolaPemesanan');
	}

	public function tambahDataUMKM()
	{
				$config['upload_path'] = "./uploads/foto_produk";
				$config['allowed_types'] = "gif|jpg|png";
				$config['max_size'] = 2000;
				$config['encrypt_name'] = TRUE;

				$this->load->library('upload',$config);

				if ($this->upload->do_upload('foto_produk')) {
				$foto = $this->upload->data();
				$id 		= $this->Model_created->idDataUMKM();
				$data 	= array(
					'IDDataUMKM'				=> $id,
					'IDUMKM'						=> $this->input->post('idumkm'),
					'Nama_produk'				=> $this->input->post('nama_produk'),
					'Foto_produk'				=> $foto['file_name'],
					'Keterangan'				=> $this->input->post('keterangan'),
				);
				$cek	= $this->Model_admin->create_dataumkm($data);
				}else{
					$data 	= array(
						'IDDataUMKM'				=> $id,
						'IDUMKM'						=> $this->input->post('idumkm'),
						'Nama_produk'				=> $this->input->post('nama_produk'),
						'Foto_produk'				=> $this->input->post('foto_produk'),
						'Keterangan'				=> $this->input->post('keterangan'),
					);
				}
				redirect('admin/Order/kelolaPemesanan');
	}

	public function editPemesanan()
	{
					$config['upload_path']		= "./uploads/hasil_design";
					// Sorry, aku batasi dulu untuk upload file hanya boleh gambar jpg/png aja
					// kalau pdf belum ada handling buat milah mana gambar mana file
					$config['allowed_types']	= "jpg|png|rar";
					$config['max_size']			= 2000;
					$config['encrypt_name']		= TRUE;

					$this->load->library('upload',$config);
					$id 	= $this->input->post('idpesan');

					if ($this->upload->do_upload('hasil_design')) {

						$status = $this->input->post('status');
						if ($status<3) {
							$status = '3';
						}

						$foto = $this->upload->data();
						$data = array(
							'IDDesigner'		=> $this->input->post('iddesigner'),
							'Tgl_mulai'			=> $this->input->post('tgl_mulai'),
							'Tgl_akhir'			=> $this->input->post('tgl_akhir'),
							'Keterangan_design'	=> $this->input->post('keterangan'),
							'Hasil_design'		=> $foto['file_name'],
							'Status'			=> $status
						);
					}else{
						$data = array(
							'IDDesigner'		=> $this->input->post('iddesigner'),
							'Tgl_mulai'			=> $this->input->post('tgl_mulai'),
							'Tgl_akhir'			=> $this->input->post('tgl_akhir'),
							'Keterangan_design'	=> $this->input->post('keterangan'),
							'Hasil_design'		=> 'Belum ada',
							'Status'			=> $this->input->post('status')
						);
					}
					$cek = $this->Model_admin->update_pemesanan($id,$data);
					redirect('admin/Order/kelolaPemesanan');
	}

	public function kelolaDataUMKM()
	{
					$cek = $this->Model_admin->cekAkun($this->session->user);
					$data = array(
						'akun'			 => $cek,
						'dataumkm'	 => $this->Model_admin->getDataaUMKM(),
						'umkm'			 => $this->Model_admin->getUMKM()
					);
					$this->load->view('admin/keloladataumkm',$data);
	}

	public function kelolaDataUMKMIo($id)
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 => $cek,
			'umkm'			 => $this->Model_admin->getDataUMKM($id)
		);
		$this->load->view('admin/keloladataumkm3',$data);
	}

	public function hapusDataUMKM($id)
	{
					$hapus = $this->Model_admin->delete_dataumkm($id);
					redirect('admin/Order/kelolaDataUMKM');
	}

	public function UpdateFoto()
	{
		$config['upload_path'] = "./uploads/foto_produk";
		$config['allowed_types'] = "png|jpg|pdf";
		$config['max_size'] = 2000;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload',$config);
		$id 	= $this->input->post('iddataumkm');

		if ($this->upload->do_upload('foto_produk')) {
		$foto = $this->upload->data();
		$data = array(
			'Foto_produk'				=> $foto['file_name'],
		);
		}else{
			$data = array(
				'Foto_produk' 		=> $this->input->post('foto_produk'),
			);
		}
		$cek = $this->Model_admin->update_dataumkm($id,$data);
		redirect('admin/Order/kelolaDataUMKM');
	}

	public function UpdateLogo()
	{
		$config['upload_path'] = "./uploads/logo_produk";
		$config['allowed_types'] = "png|jpg|pdf";
		$config['max_size'] = 2000;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload',$config);
		$id 	= $this->input->post('iddataumkm');

		if ($this->upload->do_upload('logo_produk')) {
		$foto = $this->upload->data();
		$data = array(
			'Logo_produk'				=> $foto['file_name'],
		);
		}else{
			$data = array(
				'Logo_produk' 		=> $this->input->post('logo_produk'),
			);
		}
		$cek = $this->Model_admin->update_dataumkm($id,$data);
		redirect('admin/Order/kelolaDataUMKM');
	}

	public function UpdateKemasan()
	{
		$config['upload_path'] = "./uploads/foto_kemasan_lama";
		$config['allowed_types'] = "png|jpg|pdf";
		$config['max_size'] = 2000;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload',$config);
		$id 	= $this->input->post('iddataumkm');

		if ($this->upload->do_upload('kemasan_produk')) {
		$foto = $this->upload->data();
		$data = array(
			'Kemasan_produk'				=> $foto['file_name'],
		);
		}else{
			$data = array(
				'Kemasan_produk' 		=> $this->input->post('kemasan_produk'),
			);
		}
		$cek = $this->Model_admin->update_dataumkm($id,$data);
		redirect('admin/Order/kelolaDataUMKM');
	}

	public function editDataUMKM($id)
	{
		$data 	= array(
			'Nama_produk'		=> $this->input->post('nama_produk'),
			'Keterangan'		=> $this->input->post('keterangan')
		);
		$cek	= $this->Model_admin->update_dataumkm($id,$data);
		redirect('admin/Order/kelolaDataUMKM');
	}

	public function kelolaOrderDesigner()
	{
			$cek = $this->Model_admin->cekAkun($this->session->user);
			$data = array(
				'akun'			 			=> $cek,
				'orderpemesanan'	=> $this->Model_admin->getOrderPemesanan()
			);
			$this->load->view('admin/kelolaorderdesigner',$data);
	}

	public function hapusDataUMKMp($id)
	{
					$cek = $this->Model_admin->cekUMKMId($id);
					$hapus = $this->Model_admin->delete_dataumkm($id);
					if (!$hapus) {
						echo"<script type='text/javascript'>
							alert('Data Sudah Digunakan');
							</script>";
							redirect('admin/Order/kelolaDataUMKMIo/'.$cek->IDUMKM);
					}else{
					}
	}

	public function UpdateFotop()
	{
		$config['upload_path'] = "./uploads/foto_produk";
		$config['allowed_types'] = "png|jpg|pdf";
		$config['max_size'] = 2000;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload',$config);
		$id 	= $this->input->post('iddataumkm');

		if ($this->upload->do_upload('foto_produk')) {
		$foto = $this->upload->data();
		$data = array(
			'Foto_produk'				=> $foto['file_name'],
		);
		}else{
			$data = array(
				'Foto_produk' 		=> $this->input->post('foto_produk'),
			);
		}
		$cek = $this->Model_admin->update_dataumkm($id,$data);
		$idumkm = $this->input->post('idumkm');
		redirect('admin/Order/kelolaDataUMKMIo/'.$idumkm);
	}

	public function UpdateLogop()
	{
		$config['upload_path'] = "./uploads/logo_produk";
		$config['allowed_types'] = "png|jpg|pdf";
		$config['max_size'] = 2000;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload',$config);
		$id 	= $this->input->post('iddataumkm');

		if ($this->upload->do_upload('logo_produk')) {
		$foto = $this->upload->data();
		$data = array(
			'Logo_produk'				=> $foto['file_name'],
		);
		}else{
			$data = array(
				'Logo_produk' 		=> $this->input->post('logo_produk'),
			);
		}
		$cek = $this->Model_admin->update_dataumkm($id,$data);
		$idumkm = $this->input->post('idumkm');
		redirect('admin/Order/kelolaDataUMKMIo/'.$idumkm);
	}

	public function UpdateKemasanp()
	{
		$config['upload_path'] = "./uploads/foto_kemasan_lama";
		$config['allowed_types'] = "png|jpg|pdf";
		$config['max_size'] = 2000;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload',$config);
		$id 	= $this->input->post('iddataumkm');

		if ($this->upload->do_upload('kemasan_produk')) {
		$foto = $this->upload->data();
		$data = array(
			'Kemasan_produk'				=> $foto['file_name'],
		);
		}else{
			$data = array(
				'Kemasan_produk' 		=> $this->input->post('kemasan_produk'),
			);
		}
		$cek = $this->Model_admin->update_dataumkm($id,$data);
		$idumkm = $this->input->post('idumkm');
		redirect('admin/Order/kelolaDataUMKMIo/'.$idumkm);
	}

	public function editDataUMKMp($id)
	{
		$idumkm = $this->input->post('idumkm');
		$data 	= array(
			'Nama_produk'		=> $this->input->post('nama_produk'),
			'Keterangan'		=> $this->input->post('keterangan')
		);
		$cek	= $this->Model_admin->update_dataumkm($id,$data);
		redirect('admin/Order/kelolaDataUMKMIo/'.$idumkm);
	}

	public function kelolaDataUMKMIp($id)
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 => $cek,
			'umkm'			 => $this->Model_admin->getDataUMKM($id)
		);
		$this->load->view('admin/keloladataumkm4',$data);
	}

	public function hapusDataUMKMM($id)
	{
					$cek = $this->Model_admin->cekUMKMId($id);
					$hapus = $this->Model_admin->delete_dataumkm($id);
					if (!$hapus) {
						echo"<script type='text/javascript'>
							alert('Data Sudah Digunakan');
							</script>";
							redirect('admin/Order/kelolaDataUMKMIp/'.$cek->IDUMKM);
					}else{
					}
	}

	public function UpdateFotoo()
	{
		$config['upload_path'] = "./uploads/foto_produk";
		$config['allowed_types'] = "png|jpg|pdf";
		$config['max_size'] = 2000;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload',$config);
		$id 	= $this->input->post('iddataumkm');

		if ($this->upload->do_upload('foto_produk')) {
		$foto = $this->upload->data();
		$data = array(
			'Foto_produk'				=> $foto['file_name'],
		);
		}else{
			$data = array(
				'Foto_produk' 		=> $this->input->post('foto_produk'),
			);
		}
		$cek = $this->Model_admin->update_dataumkm($id,$data);
		$idumkm = $this->input->post('idumkm');
		redirect('admin/Order/kelolaDataUMKMIp/'.$idumkm);
	}

	public function UpdateLogoo()
	{
		$config['upload_path'] = "./uploads/logo_produk";
		$config['allowed_types'] = "png|jpg|pdf";
		$config['max_size'] = 2000;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload',$config);
		$id 	= $this->input->post('iddataumkm');

		if ($this->upload->do_upload('logo_produk')) {
		$foto = $this->upload->data();
		$data = array(
			'Logo_produk'				=> $foto['file_name'],
		);
		}else{
			$data = array(
				'Logo_produk' 		=> $this->input->post('logo_produk'),
			);
		}
		$cek = $this->Model_admin->update_dataumkm($id,$data);
		$idumkm = $this->input->post('idumkm');
		redirect('admin/Order/kelolaDataUMKMIp/'.$idumkm);
	}

	public function UpdateKemasann()
	{
		$config['upload_path'] = "./uploads/foto_kemasan_lama";
		$config['allowed_types'] = "png|jpg|pdf";
		$config['max_size'] = 2000;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload',$config);
		$id 	= $this->input->post('iddataumkm');

		if ($this->upload->do_upload('kemasan_produk')) {
		$foto = $this->upload->data();
		$data = array(
			'Kemasan_produk'				=> $foto['file_name'],
		);
		}else{
			$data = array(
				'Kemasan_produk' 		=> $this->input->post('kemasan_produk'),
			);
		}
		$cek = $this->Model_admin->update_dataumkm($id,$data);
		$idumkm = $this->input->post('idumkm');
		redirect('admin/Order/kelolaDataUMKMIp/'.$idumkm);
	}

	public function editDataUMKMM($id)
	{
		$idumkm = $this->input->post('idumkm');
		$data 	= array(
			'Nama_produk'		=> $this->input->post('nama_produk'),
			'Keterangan'		=> $this->input->post('keterangan')
		);
		$cek	= $this->Model_admin->update_dataumkm($id,$data);
		redirect('admin/Order/kelolaDataUMKMIp/'.$idumkm);
	}
}

?>
