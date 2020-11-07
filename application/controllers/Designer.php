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
		if($this->input->method() == 'post') {
			$nama_lengkap	= $this->input->post('nama-lengkap');
			$username		= $this->input->post('username');
			$email			= $this->input->post('email');
			$no_telp		= $this->input->post('no-telp');
			$keterangan		= $this->input->post('keterangan');

			$data_user		= array();
			$alert			= ['sukses'];
			if( $_FILES['foto-profil']['error'] != 4 ){
				$this->load->helper('my_helper');
				$alert[0]	= uploadFoto('foto-profil', 'foto_user');
				$data_user	+= array(
					'Foto' => $_FILES['foto-profil']['name']
				);
			}
			if( $alert[0]==='sukses'){

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

				// var_dump($alert);
				// var_dump($data_user);
				// var_dump($data_designer);

			}
			else{
				$_SESSION['alert'] = $alert;
				$this->session->mark_as_flash('alert');
				redirect('Designer/editProfil');
			}
		}
		else
			redirect('Designer');
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

	public function logout()
	{
		session_destroy();
		redirect('Welcome/login');
	}
}