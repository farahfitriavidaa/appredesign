<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Create extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_created');
		$this->load->model('Model_cdc');
		$this->load->model('Model_admin');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->view('register');
	}

	public function login()
	{
		$this->load->view('login');
	}

	public function register()
	{
		$level = $this->input->post('level');
		$id    = $this->Model_created->idUser();
		$idP   = $this->Model_created->idPengelola();
		if($level == 'Pengelola'){
			$data = array(
				'IDUser'			=> $id,
				'Username'		=> $this->input->post('username'),
				'Password'		=> md5($this->input->post('password')),
				'Nama_lengkap'=> $this->input->post('namalengkap'),
				'Foto'				=> 'pengelola.png',
				'Email'				=> $this->input->post('email'),
				'Level'				=> 'Pengelola',
				'Status'			=> 'Aktif'
			);
			$dataa = array(
				'IDUser'			=> $id,
				'IDPengelola'	=> $idP,
				'No_telp'			=> $this->input->post('telp')
			);
			$cek 	= $this->Model_created->create_user($data);
			$cekk	= $this->Model_created->create_pengelola($dataa);
			redirect('Create/login');
		}else if($level == 'Designer'){
			$idD = $this->Model_created->idDesigner();
			$data = array(
				'IDUser'			=> $id,
				'Username'		=> $this->input->post('username'),
				'Password'		=> md5($this->input->post('password')),
				'Nama_lengkap'=> $this->input->post('namalengkap'),
				'Foto'				=> 'designer.png',
				'Email'				=> $this->input->post('email'),
				'Level'				=> 'Designer',
				'Status'			=> 'Aktif'
			);
			$dataa = array(
				'IDUser'			=> $id,
				'IDDesigner'	=> $idD,
				'No_telp'			=> $this->input->post('telp')
			);
			$cek = $this->Model_created->create_user($data);
			$cekk = $this->Model_created->create_design($dataa);
			$d = array(
				'id' => $id
			);
			$this->load->view('registerdesigner',$d);
		}else if($level == 'UMKM'){
			$idU = $this->Model_created->idUMKM();
			$data = array(
				'IDUser'			=> $id,
				'Username'		=> $this->input->post('username'),
				'Password'		=> md5($this->input->post('password')),
				'Nama_lengkap'=> $this->input->post('namalengkap'),
				'Foto'				=> 'umkm.png',
				'Email'				=> $this->input->post('email'),
				'Level'				=> 'UMKM',
				'Status'			=> 'Aktif'
			);
			$dataa = array(
				'IDUMKM'			=> $idU,
				'IDUser'			=> $id,
				'No_telp'			=> $this->input->post('telp')
			);
			$cek = $this->Model_created->create_user($data);
			$cekk = $this->Model_created->create_umkm($dataa);
			$d = array(
				'id' => $id
			);
			$this->load->view('registerumkm',$d);
		}else if($level == 'CDC Telkom'){
			$idT = $this->Model_created->idTelkom();
			$data = array(
				'IDUser'			=> $id,
				'Username'		=> $this->input->post('username'),
				'Password'		=> md5($this->input->post('password')),
				'Nama_lengkap'=> $this->input->post('namalengkap'),
				'Foto'				=> 'cdc.png',
				'Email'				=> $this->input->post('email'),
				'Level'				=> 'CDC',
				'Status'			=> 'Aktif'
			);
			$dataa = array(
				'IDTelkom'			=> $idT,
				'IDUser'			=> $id,
				'No_telp'			=> $this->input->post('telp')
			);
			$cek = $this->Model_created->create_user($data);
			$cekk = $this->Model_created->create_telkom($dataa);
			$d = array(
				'id' => $id
			);
			$this->load->view('registertelkom',$d);
		}else{
			echo "Mohon registrasi ulang";
		}
	}

	public function registerDesigner()
	{
		$id  = $this->input->post('iduser');
		$dataa = array(
			'Keterangan'	=> $this->input->post('keterangan')
		);
		$cekk	= $this->Model_created->update_design($id,$dataa);
		redirect('Create/login');
	}

	public function registerUMKM()
	{
		$id  = $this->input->post('iduser');
		$dataa = array(
			'Nama_umkm'		=> $this->input->post('namaumkm'),
			'Regional'		=> $this->input->post('regional'),
			'Alamat'			=> $this->input->post('alamat'),
		);
		$cekk	= $this->Model_created->update_umkm($id,$dataa);
		redirect('Create/login');
	}

	public function registerTelkom()
	{
		$id  = $this->input->post('iduser');
		$dataa = array(
			'Regional'		=> $this->input->post('regional')
		);
		$cekk	= $this->Model_created->update_telkom($id,$dataa);
		redirect('Create/login');
	}

	public function cekUser()
	{
		$user	= $this->input->post('username');
		$pass	= $this->input->post('password');
		$cek	= $this->Model_created->login($user, md5($pass));
		
		if( $cek->Level == 'Pengelola' ){
			$this->session->user = $user;
			$data = array(
				'akun' => $cek
			);
			$this->load->view('admin/dashboard',$data);
		}
		else if( $cek->Level == 'UMKM' ){
			$this->session->user = $user;
			$this->session->level = 'umkm';
			redirect('/Umkm');
		}
		else if( $cek->Level == 'CDC' ){
		$this->session->user = $user;
		$data = array(
  		'akun' => $cek,
        'jumlahumkm'      => $this->Model_cdc->getJumlahUMKM(),
        'jumlahreq'       => $this->Model_cdc->getJumlahReq(),
        'jumlahongoing'   => $this->Model_cdc->getJumlahOnGoing(),
        'jumlahselesai'   => $this->Model_cdc->getJumlahSelesai(),
        'pemesanan'       => $this->Model_cdc->dataPemesanan(),
        'umkm'            => $this->Model_cdc->dataUMKM()
  		);
  		$this->load->view('cdc/Dashboard',$data);
		}
		else if( $cek->Level == 'Designer' ){
			$this->session->user = $user;
			$this->session->level = 'designer';
			redirect('/Designer');
		}
	}
	
	public function logout()
	{
		session_destroy();
		redirect('Create');
	}
}
