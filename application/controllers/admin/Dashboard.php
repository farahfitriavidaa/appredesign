<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_created');
		$this->load->model('Model_admin');
		$this->load->model('Model_diskusi');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun' 				=> $cek,
			'umkm'				=> $this->Model_admin->jumlahUMKM(),
			'designer'		=> $this->Model_admin->jumlahDesigner(),
			'order'				=> $this->Model_admin->jumlahOrder(),
			'pesanan'			=> $this->Model_admin->jumlahOrderan(),
			'pemesanan'		=> $this->Model_admin->dataPemesananPending(),
			'ongoing'			=> $this->Model_admin->dataOrderOnGoing(),
			'selesai'			=> $this->Model_admin->dataOrderSelesai(),
			'transaksi'		=> $this->Model_admin->dataOrderTransaksi(),
			'dataumkm'		=> $this->Model_admin->dataUMKMNew()
		);
		$this->load->view('admin/dashboard',$data);
	}

}

?>
