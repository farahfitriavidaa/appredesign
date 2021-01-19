<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbor extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		if( !$this->session->has_userdata('user') || $this->session->level!=='designer' ){
			session_destroy();
			redirect('Create/login');
		}

		$this->load->model('Model_designer');
	}

	// re-mapped: base_url()/designer
	public function index()
	{
		if ( ! $this->session->has_userdata('id_user')) {
			$id_user = $this->Model_designer->getIdUser( $this->session->user );
			$this->session->id_user = $id_user->IDUser;

			$id_designer = $this->Model_designer->getIdDesigner( $this->session->id_user );
			$this->session->id_designer = $id_designer->IDDesigner;

			$foto_profil = $this->Model_designer->getUserData($this->session->user);
			$this->session->foto_profil	= $foto_profil->Foto;
		}

		$id_designer	 	= $this->session->id_designer;
		$ringkasan_request	= $this->Model_designer->getSumRequest($id_designer);
		$komen_terakhir		= $this->Model_designer->getKomenTerakhir($id_designer);
		$request_terbaru	= $this->Model_designer->getRequestTerbaru($id_designer);

		$data	= array(
			'ringkasan' 		=> $ringkasan_request,
			'diskusi_terakhir'	=> $komen_terakhir,
			'request_terbaru'	=> $request_terbaru
		);

		$this->load->helper(array('my_helper', 'status_helper'));
		$this->load->view('designer/dashboard', $data);
    }

	// re-mapped: base_url()/designer/logout
    public function logout()
	{
		session_destroy();
		redirect('Create/login');
	}
}