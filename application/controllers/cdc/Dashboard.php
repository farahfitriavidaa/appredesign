<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
      parent::__construct();
      $this->load->model('Model_cdc');
      $this->load->library('form_validation');
    }

    public function index()
  	{
  		$cek = $this->Model_cdc->cekAkun($this->session->user);
  		$data = array(
  		'akun' => $cek,
        'jumlahumkm'      => $this->Model_cdc->getJumlahUMKM(),
        'jumlahreq'       => $this->Model_cdc->getJumlahReq(),
        'jumlahongoing'   => $this->Model_cdc->getJumlahOnGoing(),
        'jumlahselesai'   => $this->Model_cdc->getJumlahSelesai(),
        'pemesanan'       => $this->Model_cdc->dataPemesanan(),
        'umkm'            => $this->Model_cdc->dataUMKM()
  		);
  		$this->load->view('cdc/dashboard',$data);
  	}

  }

  ?>
