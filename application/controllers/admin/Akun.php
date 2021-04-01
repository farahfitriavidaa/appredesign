<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_created');
		$this->load->model('Model_admin');
		$this->load->model('Model_diskusi');
		$this->load->library('form_validation');
	}

  public function kelolaProfil()
  {
    $cek = $this->Model_admin->cekAkun($this->session->user);
    $data = array(
      'akun' => $cek,
    );
    $this->load->view('admin/Kelolaprofil',$data);
  }

  public function editProfil($id)
  {
    $this->form_validation->set_rules('nama_lengkap','Nama Lengkap','required',
    array(
      'required' => 'Nama lengkap tidak boleh kosong',
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
    $cek = $this->Model_admin->cekAkun($this->session->user);
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
        'No_telp'       => $notelp
      );
    }else{
      $data   = array(
        'Nama_lengkap'  => $nama,
        'Email'         => $email,
      );
      $dataa  = array(
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
        'No_telp'       => $notelp
      );
    }else{
      $data   = array(
        'Password'      => md5($password),
        'Nama_lengkap'  => $nama,
        'Email'         => $email
      );
      $dataa  = array(
        'No_telp'       => $notelp
      );
      }
    }
    $updateprofil   = $this->Model_admin->update_profil($id,$data);
    $updateprofil2  = $this->Model_admin->update_profil2($id,$dataa);
    redirect('admin/Akun/kelolaProfil');
  }
  }

  public function kelolaAkun()
  {
    $cek = $this->Model_admin->cekAkun($this->session->user);
    $data = array(
      'akun'			 => $cek,
      'pengelola'	 => $this->Model_admin->getPengelola()
    );
    $this->load->view('admin/kelolaakun',$data);
  }

  public function tambahPengelola()
	{
		$this->form_validation->set_rules('username','Username','required|is_unique[tb_user.Username]',
		array(
			'required' => 'Username tidak boleh kosong',
			'is_unique'=> 'Username sudah ada, coba lagi'
		));
		$this->form_validation->set_rules('namalengkap','Nama Lengkap','required',
		array(
			'required' => 'Nama lengkap tidak boleh kosong',
		));
		$this->form_validation->set_rules('password','Password','required|min_length[8]',
		array(
			'required'      => '%s tidak boleh kosong',
			'min_length'    => 'Masukan password minimal 8 character',
		));
		$this->form_validation->set_rules('notelp','Nomor Telp','required|min_length[10]|numeric|greater_than[0]',
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
		$this->form_validation->set_rules('status','Status','required',
		array(
		'required'      => 'Status harus diisi',
		));
		if($this->form_validation->run() == FALSE){
			$this->kelolaAkun();
		}else{
		$id 		= $this->Model_created->idUser();
		$idP		= $this->Model_created->idPengelola();
		$data 	= array(
			'IDUser'			=> $id,
			'Username'		=> $this->input->post('username'),
			'Password'		=> md5($this->input->post('password')),
			'Nama_lengkap'=> $this->input->post('namalengkap'),
			'Foto'				=> 'pengelola.png',
			'Email'				=> $this->input->post('email'),
			'Level'				=> 'Pengelola',
			'Status'			=> $this->input->post('status')
		);
		$dataa 	= array(
			'IDPengelola' => $idP,
			'IDUser'			=> $id,
			'No_telp'			=> $this->input->post('notelp')
		);
		$cek	= $this->Model_created->create_user($data);
		$cekk = $this->Model_created->create_pengelola($dataa);
		redirect('admin/Akun/kelolaAkun');
		}
	}

	public function editPengelola($id)
	{
		$data 	= array(
			'Username'		=> $this->input->post('username'),
			'Nama_lengkap'=> $this->input->post('namalengkap'),
			'Email'				=> $this->input->post('email'),
			'Status'			=> $this->input->post('status')
		);
		$dataa 	= array(
			'No_telp'			=> $this->input->post('notelp')
		);
		$cek	= $this->Model_created->update_user($id,$data);
		$cekk = $this->Model_created->update_pengelola($id,$dataa);
			redirect('admin/Akun/kelolaAkun');
	}

	public function hapusPengelola($id)
	{
		$hapus = $this->Model_admin->delete_pengelola($id);
		$hapuss = $this->Model_admin->delete_user($id);
			redirect('admin/Akun/kelolaAkun');
	}



}

?>
