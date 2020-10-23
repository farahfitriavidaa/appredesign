<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_created');
		$this->load->model('Model_admin');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun' => $cek,
		);
		$this->load->view('admin/dashboard',$data);
	}

	public function kelolaAkun()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 => $cek,
			'pengelola'	 => $this->Model_admin->getPengelola()
		);
		$this->load->view('admin/kelolaakun',$data);
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

	public function kelolaDesigner()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 => $cek,
			'designer'	 => $this->Model_admin->getDesigner()
		);
		$this->load->view('admin/keloladesigner',$data);
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

	public function tambahPengelola()
	{
		$id 		= $this->Model_created->idUser();
		$idP		= $this->Model_created->idPengelola();
		$data 	= array(
			'IDUser'			=> $id,
			'Username'		=> $this->input->post('username'),
			'Password'		=> md5($this->input->post('password')),
			'Nama_lengkap'=> $this->input->post('namalengkap'),
			'Foto'				=> 'pengelola.png',
			'Email'				=> $this->input->post('email'),
			'Level'				=> 'Pengelola',
			'Status'			=> $this->input->post('status')
		);
		$dataa 	= array(
			'IDPengelola' => $idP,
			'IDUser'			=> $id,
			'No_telp'			=> $this->input->post('notelp')
		);
		$cek	= $this->Model_created->create_user($data);
		$cekk = $this->Model_created->create_pengelola($dataa);
		redirect('Admin/kelolaAkun');
	}

	public function editPengelola($id)
	{
		$data 	= array(
			'Username'		=> $this->input->post('username'),
			'Nama_lengkap'=> $this->input->post('namalengkap'),
			'Email'				=> $this->input->post('email'),
			'Status'			=> $this->input->post('status')
		);
		$dataa 	= array(
			'No_telp'			=> $this->input->post('notelp')
		);
		$cek	= $this->Model_created->update_user($id,$data);
		$cekk = $this->Model_created->update_pengelola($id,$dataa);
		redirect('Admin/kelolaAkun');
	}

	public function hapusPengelola($id)
	{
		$hapus = $this->Model_admin->delete_pengelola($id);
		$hapuss = $this->Model_admin->delete_user($id);
		redirect('Admin/kelolaAkun');
	}

	public function hapusCDC($id)
	{
		$hapus = $this->Model_admin->delete_cdc($id);
		$hapuss = $this->Model_admin->delete_user($id);
		redirect('Admin/kelolaTelkom');
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
		redirect('Admin/kelolaTelkom');
	}

	public function tambahTelkom()
	{
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
			'No_telp'			=> $this->input->post('notelp'),
			'Regional'		=> $this->input->post('regional')
		);
		$cek	= $this->Model_created->create_user($data);
		$cekk = $this->Model_created->create_telkom($dataa);
		redirect('Admin/kelolaTelkom');
	}

	public function statusAktif($id)
	{
		$data = array(
			'Status'	=> 'Aktif'
		);
		$cek = $this->Model_created->update_user($id,$data);
		redirect('Admin/kelolaTelkom');
	}

	public function statusTdkAktif($id)
	{
		$data = array(
			'Status'	=> 'Tidak Aktif'
		);
		$cek = $this->Model_created->update_user($id,$data);
		redirect('Admin/kelolaTelkom');
	}

	public function hapusDesigner($id)
	{
		$hapus = $this->Model_admin->delete_designer($id);
		$hapuss = $this->Model_admin->delete_user($id);
		redirect('Admin/kelolaDesigner');
	}

	public function tambahDesigner()
	{
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
		redirect('Admin/kelolaDesigner');
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
		redirect('Admin/kelolaDesigner');
	}

	public function statussAktif($id)
	{
		$data = array(
			'Status'	=> 'Aktif'
		);
		$cek = $this->Model_created->update_user($id,$data);
		redirect('Admin/kelolaDesigner');
	}

	public function statussTdkAktif($id)
	{
		$data = array(
			'Status'	=> 'Tidak Aktif'
		);
		$cek = $this->Model_created->update_user($id,$data);
		redirect('Admin/kelolaDesigner');
	}

	public function statusAktiff($id)
	{
		$data = array(
			'Status'	=> 'Aktif'
		);
		$cek = $this->Model_created->update_user($id,$data);
		redirect('Admin/kelolaUMKM');
	}

	public function statusTdkAktiff($id)
	{
		$data = array(
			'Status'	=> 'Tidak Aktif'
		);
		$cek = $this->Model_created->update_user($id,$data);
		redirect('Admin/kelolaUMKM');
	}

	public function hapusUMKM($id)
	{
		$hapus = $this->Model_admin->delete_umkm($id);
		$hapuss = $this->Model_admin->delete_user($id);
		redirect('Admin/kelolaUMKM');
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
			redirect('Admin/kelolaUMKM');
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
			redirect('Admin/kelolaUMKM');
		}

}