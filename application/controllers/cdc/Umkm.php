<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Umkm extends CI_Controller {

    public function __construct()
    {
      parent::__construct();
      $this->load->model('Model_cdc');
      $this->load->library('form_validation');
    }

    public function kelolaVerifikasi()
    {
      $cek = $this->Model_cdc->cekAkun($this->session->user);
      $data = array(
        'akun' => $cek,
        'verifikasi' => $this->Model_cdc->getDataVerifikasi()
      );
      $this->load->view('cdc/Kelolaverifikasi',$data);
    }

    public function statusAktif($id)
    {
      $data = array(
        'Status' => 'Aktif',
      );
      $update = $this->Model_cdc->update_verifikasi($id,$data);
      redirect('cdc/Umkm/kelolaVerifikasi');
    }

    public function statusTdkAktif($id)
    {
      $data = array(
        'Status' => 'Tidak Aktif',
      );
      $update = $this->Model_cdc->update_verifikasi($id,$data);
      redirect('cdc/Umkm/kelolaVerifikasi');
    }

    public function dataUMKM()
    {
      $cek = $this->Model_cdc->cekAkun($this->session->user);
      $data = array(
        'akun' => $cek,
        'umkm' => $this->Model_cdc->getDataUMKM()
      );
      $this->load->view('cdc/Kelolaumkm',$data);
    }
}

?>
