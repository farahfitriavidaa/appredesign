<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Designer extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		if( !$this->session->has_userdata('user') || $this->session->level!=='designer' )
			redirect('Welcome/login');

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
		
		// var_dump($data);
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
		http_response_code('500');
	}
}