<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_created');
		$this->load->model('Model_admin');
		$this->load->model('Model_diskusi');
		$this->load->library('form_validation');
	}

	public function kelolaOrderPermintaan()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 			=> $cek,
			'orderpemesanan'	=> $this->Model_admin->getOrderPermintaan()
		);
		$this->load->view('admin/kelolaorderpermintaan',$data);
	}

	public function kelolaDataUMKMIc($id)
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 => $cek,
			'umkm'			 => $this->Model_admin->getDataUMKM($id)
		);
		$this->load->view('admin/keloladataumkm5',$data);
	}

	public function kelolaOrderOnGoing()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 			=> $cek,
			'orderpemesanan'	=> $this->Model_admin->getOrderOnGoing()
		);
		$this->load->view('admin/kelolaongoing',$data);
	}

	public function kelolaOrderSelesai()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 			=> $cek,
			'orderpemesanan'	=> $this->Model_admin->getOrderSelesai()
		);
		$this->load->view('admin/kelolaorderselesai',$data);
	}

	public function kelolaTransaksi()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 			=> $cek,
			'orderpemesanan'	=> $this->Model_admin->getOrderTransaksi()
		);
		$this->load->view('admin/kelolatransaksi',$data);
	}

}

?>
