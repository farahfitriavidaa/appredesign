<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Designer extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		if( !$this->session->has_userdata('user') || $this->session->level!=='designer' ){
			session_destroy();
			redirect('Welcome/login');
		}

		$this->load->model('Model_designer');
	}

	public function index()
	{
		$id_user = $this->Model_designer->getIdUser( $this->session->user );
		$this->session->id_user = $id_user->IDUser;

		$id_designer = $this->Model_designer->getIdDesigner( $this->session->id_user );
		$this->session->id_designer = $id_designer->IDDesigner;

		$user	= $this->Model_designer->getUserData( $this->session->user );
		unset($user->Password);

		$data	= array(
			'akun' => $user
		);
		$this->load->view('designer/dashboard', $data);

		// var_dump($_SESSION);
	}

	public function lihatProfil()
	{
		$detil_designer	= $this->Model_designer->getDesigner( $this->session->id_designer );

		unset($detil_designer->Password);

		$data	= array(
			'designer'	=> $detil_designer
		);

		// print_r($data);
		$this->load->view('designer/lihatprofil', $data);
	}

	public function editProfil()
	{
		$detil_designer	= $this->Model_designer->getDesigner( $this->session->id_designer );

		unset($detil_designer->Password);

		$data	= array(
			'designer'	=> $detil_designer
		);

		// print_r($data);
		$this->load->view('designer/editprofil', $data);
	}

	public function updateProfil()
	{
		if($this->input->method() !== 'post') {
			redirect('Designer');
		}

		$nama_lengkap	= $this->input->post('nama-lengkap');
		$username		= $this->input->post('username');
		$email			= $this->input->post('email');
		$no_telp		= $this->input->post('no-telp');
		$keterangan		= $this->input->post('keterangan');

		$data_user		= array();

		if( $_FILES['foto-profil']['error'] != 4 ){
			$this->load->helper('my_helper');
			$alert[0]	= uploadFoto('foto-profil', 'foto_user');

			if( $alert[0]==='sukses') {
				$data_user	+= array(
					'Foto' => $_FILES['foto-profil']['name']
				);
			}
			else {
				$_SESSION['alert'] = $alert;
				$this->session->mark_as_flash('alert');
				redirect('Designer/editProfil');
			}
		}

		$data_user	+= array(
			'Nama_lengkap'	=> $nama_lengkap,
			'Username'		=> $username,
			'Email'			=> $email
		);

		$id_user	= $this->session->id_user;
		$this->Model_designer->updateUser($id_user, $data_user);

		$data_designer	= array(
			'No_telp'	=> $no_telp,
			'Keterangan'=> $keterangan
		);

		$id_designer	= $this->session->id_designer;
		$this->Model_designer->updateDesigner($id_designer, $data_designer);

		$_SESSION['alert'] = 'Profil berhasil diubah.';
		$this->session->mark_as_flash('alert');
		redirect('Designer/lihatProfil');
	}

	public function lihatPortofolio()
	{
		$daftar_portofolio	= $this->Model_designer->getDaftarPortofolio( $this->session->id_designer );

		$data	= array(
			'daftar_portofolio'	=> $daftar_portofolio
		);

		$this->load->helper('my_helper');
		$this->load->view('designer/lihatportofolio', $data);
	}

	public function portofolio($id_portofolio='0')
	{
		if ($id_portofolio=='0') {
			return http_response_code('400');
		}

		$id_portofolio		= 'PRT'.str_pad($id_portofolio, 4, '0', STR_PAD_LEFT);
		$data_portofolio	= $this->Model_designer->getPortofolio($id_portofolio);

		$bukti				= $this->cekBuktiPortofolio($data_portofolio->Bukti_portofolio);

		$data				= array(
			'bukti'				=> $bukti,
			'portofolio'	=> $data_portofolio
		);
		// var_dump($data);

		$this->load->helper('my_helper');
		$this->load->view('designer/detilportofolio', $data);
	}

	public function buatPortofolio()
	{
		$this->load->view('designer/buatportofolio');
	}

	public function tambahPortofolio()
	{
		if ($this->input->method()!=='post') {
			redirect('Designer');
		}

		$judul	= $this->input->post('judul-portofolio');
		$detil	= $this->input->post('detil-portofolio');
		$bukti	= '';

		if ( isset($_FILES['bukti-portofolio']) && $_FILES['bukti-portofolio']['error'] != 4 ) {
			$this->load->helper('my_helper');
			$alert[0]	= uploadFoto('bukti-portofolio', 'bukti_portofolio');

			if ($alert[0]==='sukses')
				$bukti	= $_FILES['bukti-portofolio']['name'];
			else {
				$_SESSION['alert'] = $alert;
				$this->session->mark_as_flash('alert');
				redirect('Designer/buatPortofolio');
			}
		}
		else {
			$bukti	= $this->input->post('link-portofolio');
		}

		$this->load->model('Model_created');
		
		$data	= array(
			'IDPortofolio'		=> $this->Model_created->idPortofolio(),
			'IDDesigner'		=> $this->session->id_designer,
			'Judul'			 	=> $judul,
			'Bukti_portofolio'	=> $bukti,
			'Detail_portofolio'	=> $detil
		);
		// var_dump($data);

		$this->Model_designer->createPortofolio($data);

		$_SESSION['alert'] = array (
			'jenis'	=> 'alert-primary',
			'isi'	=> 'Portofolio berhasil dibuat'
		);
		$this->session->mark_as_flash('alert');
		redirect('Designer/lihatPortofolio');
	}

	public function editPortofolio($id_portofolio='0')
	{
		if ($id_portofolio=='0') {
			return http_response_code('400');
		}
		
		$id_prt_asli		= 'PRT'.str_pad($id_portofolio, 4, '0', STR_PAD_LEFT);
		
		$data_portofolio	= $this->Model_designer->getPortofolio($id_prt_asli);
		
		$bukti				= $this->cekBuktiPortofolio($data_portofolio->Bukti_portofolio);

		$data				= array(
			'id_portofolio'	=> $id_portofolio,
			'bukti'			=> $bukti,
			'portofolio'	=> $data_portofolio
		);

		$this->load->view('designer/editportofolio', $data);
	}

	public function updatePortofolio()
	{
		if ($this->input->method()!=='post') {
			redirect ('Designer');
		}

		$judul	= $this->input->post('judul-portofolio');
		$detil	= $this->input->post('detil-portofolio');
		$bukti	= '';

		if ( isset($_FILES['bukti-portofolio']) && $_FILES['bukti-portofolio']['error'] != 4 ) {
			$this->load->helper('my_helper');
			$alert[0]	= uploadFoto('bukti-portofolio', 'bukti_portofolio');

			if ($alert[0]==='sukses')
				$bukti	= $_FILES['bukti-portofolio']['name'];
			else {
				$_SESSION['alert'] = $alert;
				$this->session->mark_as_flash('alert');
				redirect('Designer/buatPortofolio');
			}
		}
		else {
			$bukti	= $this->input->post('link-portofolio');
		}

		$id_portofolio	= 'PRT'.str_pad($this->input->post('np'), 4, '0', STR_PAD_LEFT);
		$data			= array(
			'Judul'			 	=> $judul,
			'Bukti_portofolio'	=> $bukti,
			'Detail_portofolio'	=> $detil
		);

		$this->Model_designer->updatePortofolio($id_portofolio, $data);

		$_SESSION['alert'] = array (
			'jenis'	=> 'alert-primary',
			'isi'	=> 'Portofolio berhasil diubah'
		);
		$this->session->mark_as_flash('alert');
		redirect('Designer/lihatPortofolio');

	}

	public function logout()
	{
		session_destroy();
		redirect('Welcome/login');
	}

	private function cekBuktiPortofolio(String $bukti)
	{
		if (strchr($bukti, '/'))
			return 'link';
		else
			return 'image';
	}
}