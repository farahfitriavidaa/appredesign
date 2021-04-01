<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct()
    {
      parent::__construct();
      $this->load->model('Model_cdc');
      $this->load->library('form_validation');
    }

    public function kelolaOrderOnGoing()
    {
      $cek = $this->Model_cdc->cekAkun($this->session->user);
      $data = array(
        'akun' => $cek,
        'orderpemesanan' => $this->Model_cdc->getOrderOnGoing()
      );
      $this->load->view('cdc/Kelolaongoing',$data);
    }

    public function kelolaOrderSelesai()
    {
      $cek = $this->Model_cdc->cekAkun($this->session->user);
      $data = array(
        'akun' => $cek,
        'orderpemesanan' => $this->Model_cdc->getOrderSelesai()
      );
      $this->load->view('cdc/Kelolaselesai',$data);
    }

    public function kelolaOrderTransaksi()
    {
      $cek = $this->Model_cdc->cekAkun($this->session->user);
      $data = array(
        'akun' => $cek,
        'orderpemesanan' => $this->Model_cdc->getOrderTransaksi()
      );
      $this->load->view('cdc/Kelolatransaksi',$data);
    }

    public function statusLunas($id)
    {
      $data = array(
        'Status' => '7',
      );
      $update = $this->Model_cdc->update_status($id,$data);
      redirect('cdc/Report/kelolaOrderTransaksi');
    }

}

?>
