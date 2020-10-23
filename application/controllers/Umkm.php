<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Umkm extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
        
        if( !$this->session->has_userdata('user') ) 
            redirect('Welcome/login');

		$this->load->model('Model_umkm');
	}

	public function index()
	{
        $user   = $this->Model_umkm->cekAkun( $this->session->user );
        $data   = array(
            'akun' => $user
        );
        $this->load->view('umkm/dashboard', $data);
        
        // var_dump($data);
    }

    public function buatRequest()
	{
        $this->load->view('umkm/buatrequest');
        
        // var_dump($data);
    }

    public function lihatRequest()
    {
        $this->load->view('umkm/lihatrequest');
    }
}