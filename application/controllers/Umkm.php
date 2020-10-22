<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Umkm extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_umkm');
	}

	public function index()
	{
        $user   = $this->Model_umkm->cekAkun( $this->session->user );
        $data   = array(
            'user' => $user
        );
        $this->load->view('umkm/dashboard', $data);
        
        // var_dump($data);
    }

    public function buatRequest()
	{
        $user   = $this->Model_umkm->cekAkun( $this->session->user );
        $data   = array(
            'user' => $user
        );
        $this->load->view('umkm/dashboard', $data);
        
        // var_dump($data);
    }
}