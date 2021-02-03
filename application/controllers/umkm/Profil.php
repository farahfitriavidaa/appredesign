<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		if( !$this->session->has_userdata('user') || $this->session->level!=='umkm' ){
			session_destroy();
			redirect('Create/login');
		}

		$this->load->model('Model_umkm');
    }

    public function index()
	{
		$detil_umkm	= $this->Model_umkm->getUmkm( $this->session->id_umkm );
		$detil_user	= $this->Model_umkm->getUserData( $this->session->user );

		unset($detil_user->Password);

		$data	= array(
			'user'	=> $detil_user,
			'umkm'	=> $detil_umkm
		);

        $this->load->view('umkm/lihatprofil', $data);
	}

	public function editProfil()
	{
		$detil_umkm	= $this->Model_umkm->getUmkm( $this->session->id_umkm );
		$detil_user	= $this->Model_umkm->getUserData( $this->session->user );

		unset($detil_user->Password);

		$data	= array(
			'user'	=> $detil_user,
			'umkm'	=> $detil_umkm
		);

		$this->load->view('umkm/editprofil', $data);
	}

	public function updateProfil()
	{
		if($this->input->method() == 'post') {
			$nama_lengkap	= $this->input->post('nama-lengkap');
			$username		= $this->input->post('username');
			$email			= $this->input->post('email');

			$nama_umkm		= $this->input->post('nama-umkm');
			$no_telp		= $this->input->post('no-telp');
			$alamat			= $this->input->post('alamat');

			$data_user		= array();

			if( $_FILES['foto-profil']['error'] != 4 ){

				$this->load->library('upload');

				$config['upload_path']		= './uploads/foto_user/';
				$config['allowed_types']	= 'png|jpg|jpeg';
				$config['max_size']			= '65000';

				$this->upload->initialize($config);

				if ( ! $this->upload->do_upload('foto-profil') ) {
					$isi_pesan	= $this->upload->display_errors();

					$_SESSION['alert'] = $isi_pesan;
					$this->session->mark_as_flash('alert');
					
					redirect('umkm/profil/editProfil');
				}
				else {
					$data_user	+= array(
						'Foto' => $this->upload->data('file_name')
					);

					$this->session->foto_profil = $this->upload->data('file_name');
				}
			}

			$data_user		+= array(
				'Nama_lengkap'	=> $nama_lengkap,
				'Username'		=> $username,
				'Email'			=> $email
			);

			$id_user	= $this->Model_umkm->getIdUser( $this->session->user );
			$this->Model_umkm->updateUser($id_user->IDUser, $data_user);

			$data_umkm	= array(
				'Nama_umkm'	=> $nama_umkm,
				'No_telp'	=> $no_telp,
				'Alamat'	=> $alamat
			);

			$id_umkm	= $this->session->id_umkm;
			$this->Model_umkm->updateUmkm($id_umkm, $data_umkm);

			$_SESSION['alert'] = 'Profil berhasil diubah.';
			$this->session->mark_as_flash('alert');
			redirect('umkm/profil');
		}
		else
			redirect('umkm');
	}

	public function editPwd()
	{
		if ($this->input->method()!=='post') {
			return $this->load->view('umkm/editpassword');
		}

		$this->load->library('form_validation');
		$this->load->language('form_validation','indonesian');

		$this->form_validation->set_rules('password-lama', 'Password Lama', 'htmlspecialchars|required');
		$this->form_validation->set_rules('password-baru', 'Password Baru', 'htmlspecialchars|required|min_length[5]|differs[password-lama]');
		$this->form_validation->set_rules('konfirmasi', 'Konfirmasi Password Baru', 'htmlspecialchars|required|min_length[5]|matches[password-baru]');

		$this->form_validation->set_message('required', $this->lang->line('form_validation_required'));
		$this->form_validation->set_message('min_length', $this->lang->line('form_validation_min_length'));
		$this->form_validation->set_message('matches', $this->lang->line('form_validation_matches'));
		$this->form_validation->set_message('differs', $this->lang->line('form_validation_differs'));

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('umkm/editpassword');
		}
		else
		{
			$id_user		= $this->Model_umkm->getIdUser( $this->session->user )->IDUser;
			$input_pwd_lama	= md5($this->input->post('password-lama'));
			$db_pwd_lama	= $this->Model_umkm->getPassword($id_user)->Password;

			if ($input_pwd_lama === $db_pwd_lama) {

				$password = md5($this->input->post('password-baru'));

				$this->Model_umkm->updatePassword($id_user, $password);

				$_SESSION['alert'] = 'Password berhasil diubah.';
				$this->session->mark_as_flash('alert');
				redirect('umkm/profil');
			}
			else {
				$data		= array(
					'pesan_error'	=> 'Password Lama tidak tepat'
				);

				$this->load->view('umkm/editpassword', $data);
			}

		}
	}
}