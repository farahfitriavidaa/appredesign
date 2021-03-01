<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_created');
		$this->load->model('Model_admin');
		$this->load->model('Model_diskusi');
		$this->load->library('form_validation');
	}

	public function kelolaTelkom()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 => $cek,
			'cdc'	 => $this->Model_admin->getTelkom()
		);
		$this->load->view('admin/kelolatelkom',$data);
	}

	public function hapusCDC($id)
	{
		$hapus = $this->Model_admin->delete_cdc($id);
		$hapuss = $this->Model_admin->delete_user($id);
		redirect('admin/Pengguna/kelolaTelkom');
	}

	public function editTelkom($id)
	{
		$data 	= array(
			'Username'		=> $this->input->post('username'),
			'Nama_lengkap'=> $this->input->post('namalengkap'),
			'Email'				=> $this->input->post('email'),
			'Status'			=> $this->input->post('status')
		);
		$dataa 	= array(
			'No_telp'			=> $this->input->post('notelp'),
			'Regional'		=> $this->input->post('regional')
		);
		$cek	= $this->Model_created->update_user($id,$data);
		$cekk = $this->Model_created->update_telkom($id,$dataa);
		redirect('admin/Pengguna/kelolaTelkom');
	}

	public function tambahTelkom()
	{
		$this->form_validation->set_rules('username','Username','required|is_unique[tb_user.Username]',
		array(
			'required' => 'Username tidak boleh kosong',
			'is_unique'=> 'Username sudah ada, coba lagi'
		));
		$this->form_validation->set_rules('namalengkap','Nama Lengkap','required',
		array(
			'required' => 'Nama lengkap tidak boleh kosong',
		));
		$this->form_validation->set_rules('password','Password','required|min_length[8]',
		array(
			'required'      => '%s tidak boleh kosong',
			'min_length'    => 'Masukan password minimal 8 character',
		));
		$this->form_validation->set_rules('notelp','Nomor Telp','required|min_length[10]|numeric|greater_than[0]',
		array(
			'required'    => '%s tidak boleh kosong',
			'min_length'  => '%s diisi minimal 10angka',
			'numeric'     => '%s wajib menggunakan angka',
			'greater_than'=> '%s tidak boleh minus'
		));
		$this->form_validation->set_rules('email','Email','required|valid_email',
		array(
		'required'      => 'Email tidak boleh kosong',
		'valid_email'   => 'Harus berformat email yang valid (contoh : email@gmail.com)'
		));
		$this->form_validation->set_rules('status','Status','required',
		array(
		'required'      => 'Status harus diisi',
		));
		$this->form_validation->set_rules('regional','Regional','required',
		array(
		'required'      => 'Regional harus diisi',
		));
		if($this->form_validation->run() == FALSE){
			$this->kelolaTelkom();
		}else{
		$id 		= $this->Model_created->idUser();
		$idP		= $this->Model_created->idTelkom();
		$data 	= array(
			'IDUser'			=> $id,
			'Username'		=> $this->input->post('username'),
			'Password'		=> md5($this->input->post('password')),
			'Nama_lengkap'=> $this->input->post('namalengkap'),
			'Foto'				=> 'cdc.png',
			'Email'				=> $this->input->post('email'),
			'Level'				=> 'CDC',
			'Status'			=> $this->input->post('status')
		);
		$dataa 	= array(
			'IDTelkom' => $idP,
			'IDUser'			=> $id,
			'Regional'		=> $this->input->post('regional'),
			'No_telp'			=> $this->input->post('notelp')
		);
		$cek	= $this->Model_created->create_user($data);
		$cekk = $this->Model_created->create_telkom($dataa);
		redirect('admin/Pengguna/kelolaTelkom');
		}
	}

	public function statusAktif($id)
	{
		$data = array(
			'Status'	=> 'Aktif'
		);
		$cek = $this->Model_created->update_user($id,$data);
		redirect('admin/Pengguna/kelolaTelkom');
	}

	public function statusTdkAktif($id)
	{
		$data = array(
			'Status'	=> 'Tidak Aktif'
		);
		$cek = $this->Model_created->update_user($id,$data);
		redirect('admin/Pengguna/kelolaTelkom');
	}

	public function kelolaDesigner()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 => $cek,
			'designer'	 => $this->Model_admin->getDesigner()
		);
		$this->load->view('admin/keloladesigner',$data);
	}

	public function hapusDesigner($id)
	{
		$hapus = $this->Model_admin->delete_designer($id);
		$hapuss = $this->Model_admin->delete_user($id);
		redirect('admin/Pengguna/kelolaDesigner');
	}

	public function tambahDesigner()
	{
		$this->form_validation->set_rules('username','Username','required|is_unique[tb_user.Username]',
		array(
			'required' => 'Username tidak boleh kosong',
			'is_unique'=> 'Username sudah ada, coba lagi'
		));
		$this->form_validation->set_rules('namalengkap','Nama Lengkap','required',
		array(
			'required' => 'Nama lengkap tidak boleh kosong',
		));
		$this->form_validation->set_rules('password','Password','required|min_length[8]',
		array(
			'required'      => '%s tidak boleh kosong',
			'min_length'    => 'Masukan password minimal 8 character',
		));
		$this->form_validation->set_rules('notelp','Nomor Telp','required|min_length[10]|numeric|greater_than[0]',
		array(
			'required'    => '%s tidak boleh kosong',
			'min_length'  => '%s diisi minimal 10angka',
			'numeric'     => '%s wajib menggunakan angka',
			'greater_than'=> '%s tidak boleh minus'
		));
		$this->form_validation->set_rules('email','Email','required|valid_email',
		array(
		'required'      => 'Email tidak boleh kosong',
		'valid_email'   => 'Harus berformat email yang valid (contoh : email@gmail.com)'
		));
		$this->form_validation->set_rules('status','Status','required',
		array(
		'required'      => 'Status harus diisi',
		));
		$this->form_validation->set_rules('keterangan','Keterangan','required',
		array(
		'required'      => 'Keterangan harus diisi',
		));
		if($this->form_validation->run() == FALSE){
			$this->kelolaDesigner();
		}else{
		$id 		= $this->Model_created->idUser();
		$idP		= $this->Model_created->idDesigner();
		$data 	= array(
			'IDUser'			=> $id,
			'Username'		=> $this->input->post('username'),
			'Password'		=> md5($this->input->post('password')),
			'Nama_lengkap'=> $this->input->post('namalengkap'),
			'Foto'				=> 'designer.png',
			'Email'				=> $this->input->post('email'),
			'Level'				=> 'Designer',
			'Status'			=> $this->input->post('status')
		);
		$dataa 	= array(
			'IDDesigner' => $idP,
			'IDUser'			=> $id,
			'No_telp'			=> $this->input->post('notelp'),
			'Keterangan'		=> $this->input->post('keterangan')
		);
		$cek	= $this->Model_created->create_user($data);
		$cekk = $this->Model_created->create_design($dataa);
		redirect('admin/Pengguna/kelolaDesigner');
		}
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

	public function editDesigner($id)
	{
		$data 	= array(
			'Username'		=> $this->input->post('username'),
			'Nama_lengkap'=> $this->input->post('namalengkap'),
			'Email'				=> $this->input->post('email'),
			'Status'			=> $this->input->post('status')
		);
		$dataa 	= array(
			'No_telp'			=> $this->input->post('notelp'),
			'Keterangan'		=> $this->input->post('keterangan')
		);
		$cek	= $this->Model_created->update_user($id,$data);
		$cekk = $this->Model_created->update_design($id,$dataa);
		redirect('admin/Pengguna/kelolaDesigner');
	}

	public function statussAktif($id)
	{
		$data = array(
			'Status'	=> 'Aktif'
		);
		$cek = $this->Model_created->update_user($id,$data);
		redirect('admin/Pengguna/kelolaDesigner');
	}

	public function statussTdkAktif($id)
	{
		$data = array(
			'Status'	=> 'Tidak Aktif'
		);
		$cek = $this->Model_created->update_user($id,$data);
		redirect('admin/Pengguna/kelolaDesigner');
	}

	public function kelolaUMKM()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 => $cek,
			'umkm'	 		=> $this->Model_admin->getUMKM()
		);
		$this->load->view('admin/kelolaumkm',$data);
	}

	public function tambahUMKM()
	{
			$id 		= $this->Model_created->idUser();
			$idP		= $this->Model_created->idUMKM();
			$data 	= array(
				'IDUser'			=> $id,
				'Username'		=> $this->input->post('username'),
				'Password'		=> md5($this->input->post('password')),
				'Nama_lengkap'=> $this->input->post('namalengkap'),
				'Foto'				=> 'umkm.png',
				'Email'				=> $this->input->post('email'),
				'Level'				=> 'UMKM',
				'Status'			=> $this->input->post('status')
			);
			$dataa 	= array(
				'IDUMKM' 			=> $idP,
				'IDUser'			=> $id,
				'Nama_umkm'		=> $this->input->post('namaumkm'),
				'No_telp'			=> $this->input->post('notelp'),
				'Regional'		=> $this->input->post('regional'),
				'Alamat'			=> $this->input->post('alamat')
			);
			$cek	= $this->Model_created->create_user($data);
			$cekk = $this->Model_created->create_umkm($dataa);
			redirect('admin/Pengguna/kelolaUMKM');
		}

	public function editUMKM($id)
	{
			$data 	= array(
				'Username'		=> $this->input->post('username'),
				'Nama_lengkap'=> $this->input->post('namalengkap'),
				'Email'				=> $this->input->post('email'),
				'Status'			=> $this->input->post('status')
			);
			$dataa 	= array(
				'No_telp'			=> $this->input->post('notelp'),
				'Regional'		=> $this->input->post('regional'),
				'Nama_umkm'		=> $this->input->post('namaumkm'),
				'Alamat'			=> $this->input->post('alamat')
			);
			$cek	= $this->Model_created->update_user($id,$data);
			$cekk = $this->Model_created->update_umkm($id,$dataa);
			redirect('admin/Pengguna/kelolaUMKM');
		}

		public function statusAktiff($id)
		{
			$data = array(
				'Status'	=> 'Aktif'
			);
			$cek = $this->Model_created->update_user($id,$data);
			redirect('admin/Pengguna/kelolaUMKM');
		}

	public function statusTdkAktiff($id)
	{
		$data = array(
			'Status'	=> 'Tidak Aktif'
		);
		$cek = $this->Model_created->update_user($id,$data);
		redirect('admin/Pengguna/kelolaUMKM');
	}

	public function hapusUMKM($id)
	{
		$hapus = $this->Model_admin->delete_umkm($id);
		$hapuss = $this->Model_admin->delete_user($id);
		redirect('admin/Pengguna/kelolaUMKM');
	}

	public function kelolaDataUMKMId($id)
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 => $cek,
			'umkm'			 => $this->Model_admin->getDataUMKM($id)
		);
		$this->load->view('admin/keloladataumkm2',$data);
	}

	public function hapusDataUMKM($id)
	{
					$cek = $this->Model_admin->cekUMKMId($id);
					$hapus = $this->Model_admin->delete_dataumkm($id);
					if (!$hapus) {
						echo"<script type='text/javascript'>
      				alert('Data Sudah Digunakan');
      				</script>";
							redirect('admin/Pengguna/kelolaDataUMKMId/'.$cek->IDUMKM);
					}else{
					}
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
		$idumkm = $this->input->post('idumkm');
		redirect('admin/Pengguna/kelolaDataUMKMId/'.$idumkm);
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
		$idumkm = $this->input->post('idumkm');
		redirect('admin/Pengguna/kelolaDataUMKMId/'.$idumkm);
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
		$idumkm = $this->input->post('idumkm');
		redirect('admin/Pengguna/kelolaDataUMKMId/'.$idumkm);
	}

	public function editDataUMKM($id)
	{
		$idumkm = $this->input->post('idumkm');
		$data 	= array(
			'Nama_produk'		=> $this->input->post('nama_produk'),
			'Keterangan'		=> $this->input->post('keterangan')
		);
		$cek	= $this->Model_admin->update_dataumkm($id,$data);
		redirect('admin/Pengguna/kelolaDataUMKMId/'.$idumkm);
	}


}

?>
