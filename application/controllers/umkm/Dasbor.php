<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbor extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		if( ! $this->session->has_userdata('user') OR $this->session->level !== 'umkm' ){
			session_destroy();
			redirect('Create/login');
		}

		$this->load->model('Model_umkm');
	}

	/**
	 * Menampilkan halaman dashboard
	 * 
	 * Halaman dashboard adalah halaman pertama yang ditampilkan
	 * setelah umkm berhasil log in.
	 * 
	 * re-mapped: base_url()/umkm	 
	 */
	public function index()
	{
		if ( ! $this->session->has_userdata('id_user')) {
			$id_user     = $this->Model_umkm->getIdUser( $this->session->user );
			$this->session->id_user = $id_user->IDUser;

			$id_umkm     = $this->Model_umkm->getIdUmkm( $this->session->id_user );
			$this->session->id_umkm = $id_umkm->IDUMKM;

			$nama_umkm   = $this->Model_umkm->getNamaUmkm( $this->session->id_umkm );
			$this->session->nama_umkm = $nama_umkm->Nama_umkm;

			$foto_profil = $this->Model_umkm->getUserData($this->session->user);
			$this->session->foto_profil	= $foto_profil->Foto;
		}

		$id_umkm         = $this->session->id_umkm;
		$komen_terakhir  = $this->Model_umkm->getKomenTerakhir($id_umkm);
		$request_terbaru = $this->Model_umkm->getRequestTerbaru($id_umkm);

		$data	= array(
			'diskusi_terakhir' => $komen_terakhir,
			'request_terbaru'  => $request_terbaru,
			'level'            => $this->session->level
		);

		$this->load->helper( array('text', 'my_helper', 'status_helper') );
		$this->load->view('umkm/dashboard', $data);
	}
	
	// re-mapped: base_url()/umkm/logout
	public function logout()
	{
		session_destroy();
		redirect('Create/login');
	}
}