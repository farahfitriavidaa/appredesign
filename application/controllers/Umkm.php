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
        $id_user    = $this->Model_umkm->getIdUser( $this->session->user );
        $this->session->id_user = $id_user->IDUser;

        $id_umkm    = $this->Model_umkm->getIdUmkm( $this->session->id_user );
        $this->session->id_umkm = $id_umkm->IDUMKM;

        $user   = $this->Model_umkm->getUserData( $this->session->user );
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
        $id_umkm        = $this->session->id_umkm;
        $daftar_request = $this->Model_umkm->getDaftarRequest($id_umkm);

        if( empty($daftar_request) ) {
            $data = array(
                'has_request' => false
            );
        }
        else {
            $data = array(
                'has_request'   => true,
                'request'       => $daftar_request
            );
        }

        $this->load->view('umkm/lihatrequest', $data);

        // var_dump($data);
    }

    public function cekSession()
    {
        print_r($_SESSION);
    }
}