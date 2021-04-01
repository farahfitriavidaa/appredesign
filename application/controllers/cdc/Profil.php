<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

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
      );
      $this->load->view('cdc/Kelolaprofil',$data);
    }

    public function editProfil($id)
    {
      $this->form_validation->set_rules('nama_lengkap','Nama Lengkap','required',
      array(
        'required' => 'Nama lengkap tidak boleh kosong',
      ));
      $this->form_validation->set_rules('regional','Regional','required',
      array(
        'required' => 'Regional tidak boleh kosong',
      ));
      $this->form_validation->set_rules('password','Password','required|min_length[8]',
      array(
        'required'      => '%s tidak boleh kosong',
        'min_length'    => 'Masukan password minimal 8 character',
      ));
      $this->form_validation->set_rules('no_telp','Nomor Telp','required|min_length[10]|numeric|greater_than[0]',
      array(
        'required'    => '%s tidak boleh kosong',
        'min_length'  => '%s diisi minimal 10angka',
        'numeric'     => '%s wajib menggunakan angka',
        'greater_than'=> '%s tidak boleh minus'
      ));
      $this->form_validation->set_rules('email','Email','required|valid_email',
      array(
      'required'      => 'Email tidak boleh kosong',
      'valid_email'   => 'Harus berformat email yang valid (contoh : email@gmail.com)'
      ));
      if($this->form_validation->run() == FALSE){
        $this->kelolaProfil();
      }else{
      $cek = $this->Model_cdc->cekAkun($this->session->user);
      $email    = $this->input->post('email');
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $nama     = $this->input->post('nama_lengkap');
      $regional = $this->input->post('regional');
      $notelp   = $this->input->post('no_telp');

      $config['upload_path'] = "./uploads/foto_user";
      $config['allowed_types'] = "gif|jpg|png";
      $config['max_size'] = 2000;
      $config['encrypt_name'] = TRUE;

      $this->load->library('upload',$config);

      if ($password == $cek->Password) {
        if ($this->upload->do_upload('fotoprofil')) {
          $foto = $this->upload->data();
        $data   = array(
          'Nama_lengkap'  => $nama,
          'Email'         => $email,
          'Foto'          => $foto['file_name']
        );
        $dataa  = array(
          'Regional'      => $regional,
          'No_telp'       => $notelp
        );
      }else{
        $data   = array(
          'Nama_lengkap'  => $nama,
          'Email'         => $email,
        );
        $dataa  = array(
          'Regional'      => $regional,
          'No_telp'       => $notelp
        );
      }
      }else{
        if ($this->upload->do_upload('fotoprofil')) {
          $foto = $this->upload->data();
        $data   = array(
          'Password'      => md5($password),
          'Nama_lengkap'  => $nama,
          'Email'         => $email,
          'Foto'          => $foto['file_name']
        );
        $dataa  = array(
          'Regional'      => $regional,
          'No_telp'       => $notelp
        );
      }else{
        $data   = array(
          'Password'      => md5($password),
          'Nama_lengkap'  => $nama,
          'Email'         => $email
        );
        $dataa  = array(
          'Regional'      => $regional,
          'No_telp'       => $notelp
        );
        }
      }
      $updateprofil   = $this->Model_cdc->update_profil($id,$data);
      $updateprofil2  = $this->Model_cdc->update_profil2($id,$dataa);
      redirect('cdc/Profil');
    }
  }

}

?>
