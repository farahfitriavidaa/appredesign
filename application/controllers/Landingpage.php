<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landingpage extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_created');
		$this->load->model('Model_admin');
    $this->load->model('Model_landingpage');
		$this->load->library('form_validation');
	}

  public function index()
  {
    $this->load->view('landingpage/Lp');
  }

	public function kontak()
	{
		$this->load->view('landingpage/Kontak');
	}

	public function tentang()
	{
		$data = array(
			'user'    => $this->Model_landingpage->jumlahUser(),
			'umkm'     => $this->Model_landingpage->jumlahUMKM(),
			'designer' => $this->Model_landingpage->jumlahDesigner(),
			'order'		 => $this->Model_landingpage->jumlahOrder()
		);
		$this->load->view('landingpage/Tentang',$data);
	}

	public function designer()
	{
		$data = array(
			'designer' => $this->Model_landingpage->getDesigner()
		);
		$this->load->view('landingpage/Designer',$data);
	}

	public function ambilPortofolio($id)
	{
		$data = array(
			'design' => $this->Model_landingpage->getDesignerId($id),
			'portofolio' => $this->Model_landingpage->getPortofolio($id)
		);
		$this->load->view('landingpage/Portofolio',$data);
	}

}
