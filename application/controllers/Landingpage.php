<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landingpage extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_created');
		$this->load->model('Model_admin');
    // $this->load->model('Model_landingpage');
		$this->load->library('form_validation');
	}

  public function index()
  {
    $this->load->view('landingpage/Lp');
  }

}
