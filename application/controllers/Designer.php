<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Designer extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		if( !$this->session->has_userdata('user') || $this->session->level!=='designer' ){
			session_destroy();
			redirect('Welcome/login');
		}

		$this->load->model('Model_designer');
	}

	public function index()
	{
		$id_user = $this->Model_designer->getIdUser( $this->session->user );
		$this->session->id_user = $id_user->IDUser;

		$id_designer = $this->Model_designer->getIdDesigner( $this->session->id_user );
		$this->session->id_designer = $id_designer->IDDesigner;

		$user	= $this->Model_designer->getUserData( $this->session->user );
		unset($user->Password);

		$data	= array(
			'akun' => $user
		);
		$this->load->view('designer/dashboard', $data);

		// var_dump($_SESSION);
	}

	public function lihatProfil()
	{
		$detil_designer	= $this->Model_designer->getDesigner( $this->session->id_designer );

		unset($detil_designer->Password);

		$data	= array(
			'designer'	=> $detil_designer
		);

		// print_r($data);
		$this->load->view('designer/lihatprofil', $data);
	}

	public function editProfil()
	{
		$detil_designer	= $this->Model_designer->getDesigner( $this->session->id_designer );

		unset($detil_designer->Password);

		$data	= array(
			'designer'	=> $detil_designer
		);

		// print_r($data);
		$this->load->view('designer/editprofil', $data);
	}

	public function updateProfil()
	{
		if($this->input->method() !== 'post') {
			redirect('Designer');
		}

		$nama_lengkap	= $this->input->post('nama-lengkap');
		$username		= $this->input->post('username');
		$email			= $this->input->post('email');
		$no_telp		= $this->input->post('no-telp');
		$keterangan		= $this->input->post('keterangan');

		$data_user		= array();

		if( $_FILES['foto-profil']['error'] != 4 ){
			$this->load->helper('my_helper');
			$alert[0]	= uploadFoto('foto-profil', 'foto_user');

			if( $alert[0]==='sukses') {
				$data_user	+= array(
					'Foto' => $_FILES['foto-profil']['name']
				);
			}
			else {
				$_SESSION['alert'] = $alert;
				$this->session->mark_as_flash('alert');
				redirect('Designer/editProfil');
			}
		}

		$data_user	+= array(
			'Nama_lengkap'	=> $nama_lengkap,
			'Username'		=> $username,
			'Email'			=> $email
		);

		$id_user	= $this->session->id_user;
		$this->Model_designer->updateUser($id_user, $data_user);

		$data_designer	= array(
			'No_telp'	=> $no_telp,
			'Keterangan'=> $keterangan
		);

		$id_designer	= $this->session->id_designer;
		$this->Model_designer->updateDesigner($id_designer, $data_designer);

		$_SESSION['alert'] = 'Profil berhasil diubah.';
		$this->session->mark_as_flash('alert');
		redirect('Designer/lihatProfil');
	}

	public function editPwd()
	{
		if ($this->input->method()!=='post') {
			return $this->load->view('designer/editpassword');
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
			$this->load->view('designer/editpassword');
		}
		else
		{
			$user			= $this->Model_designer->getUserData( $this->session->user );
			$id_user		= $user->IDUser;
			$db_pwd_lama	= $user->Password;
			$input_pwd_lama	= md5($this->input->post('password-lama'));

			if ($input_pwd_lama === $db_pwd_lama) {

				$password = md5($this->input->post('password-baru'));

				$this->Model_designer->updatePassword($id_user, $password);

				$_SESSION['alert'] = 'Password berhasil diubah.';
				$this->session->mark_as_flash('alert');
				redirect('designer/lihatProfil');
			}
			else {
				$data		= array(
					'pesan_error'	=> 'Password Lama tidak tepat'
				);

				$this->load->view('designer/editpassword', $data);
			}

		}

	}

	public function lihatPortofolio()
	{
		$id_designer		= $this->session->id_designer;
		$daftar_portofolio	= $this->Model_designer->getDaftarPortofolio($id_designer);
		$detil_designer		= $this->Model_designer->getSimpleDesigner($id_designer);

		$data				= array(
			'designer'			=> $detil_designer,
			'daftar_portofolio'	=> $daftar_portofolio
		);

		$this->load->helper('my_helper');
		$this->load->view('designer/lihatportofolio', $data);
	}

	// deprecated function and view it loaded
	public function portofolio($id_portofolio='0')
	{
		if ($id_portofolio=='0') {
			return http_response_code('400');
		}

		$id_portofolio		= 'PRT'.str_pad($id_portofolio, 4, '0', STR_PAD_LEFT);
		$data_portofolio	= $this->Model_designer->getPortofolio($id_portofolio);

		$bukti				= $this->cekBuktiPortofolio($data_portofolio->Bukti_portofolio);

		$data				= array(
			'bukti'				=> $bukti,
			'portofolio'	=> $data_portofolio
		);
		// var_dump($data);

		$this->load->helper('my_helper');
		$this->load->view('designer/detilportofolio', $data);
	}

	public function buatPortofolio()
	{
		$this->load->view('designer/buatportofolio');
	}

	public function tambahPortofolio()
	{
		if ($this->input->method()!=='post') {
			redirect('Designer');
		}

		$judul	= $this->input->post('judul-portofolio');
		$detil	= $this->input->post('detil-portofolio');
		$bukti	= '';

		if ( isset($_FILES['bukti-portofolio']) && $_FILES['bukti-portofolio']['error'] != 4 ) {
			$this->load->helper('my_helper');
			$alert[0]	= uploadFoto('bukti-portofolio', 'bukti_portofolio');

			if ($alert[0]==='sukses')
				$bukti	= $_FILES['bukti-portofolio']['name'];
			else {
				$_SESSION['alert'] = $alert;
				$this->session->mark_as_flash('alert');
				redirect('Designer/buatPortofolio');
			}
		}
		else {
			$bukti	= $this->input->post('link-portofolio');
		}

		$this->load->model('Model_created');
		
		$data	= array(
			'IDPortofolio'		=> $this->Model_created->idPortofolio(),
			'IDDesigner'		=> $this->session->id_designer,
			'Judul'			 	=> $judul,
			'Bukti_portofolio'	=> $bukti,
			'Detail_portofolio'	=> $detil
		);
		// var_dump($data);

		$this->Model_designer->createPortofolio($data);

		$_SESSION['alert'] = array (
			'jenis'	=> 'alert-primary',
			'isi'	=> 'Portofolio berhasil dibuat'
		);
		$this->session->mark_as_flash('alert');
		redirect('Designer/lihatPortofolio');
	}

	public function editPortofolio($id_portofolio='0')
	{
		if ($id_portofolio=='0') {
			return http_response_code('400');
		}
		
		$id_prt_asli		= 'PRT'.str_pad($id_portofolio, 4, '0', STR_PAD_LEFT);
		
		$data_portofolio	= $this->Model_designer->getPortofolio($id_prt_asli);
		
		$bukti				= $this->cekBuktiPortofolio($data_portofolio->Bukti_portofolio);

		$data				= array(
			'id_portofolio'	=> $id_portofolio,
			'bukti'			=> $bukti,
			'portofolio'	=> $data_portofolio
		);

		$this->load->view('designer/editportofolio', $data);
	}

	public function updatePortofolio()
	{
		if ($this->input->method()!=='post') {
			redirect ('Designer');
		}

		$judul	= $this->input->post('judul-portofolio');
		$detil	= $this->input->post('detil-portofolio');
		$bukti	= '';

		if ( isset($_FILES['bukti-portofolio']) && $_FILES['bukti-portofolio']['error'] != 4 ) {
			$this->load->helper('my_helper');
			$alert[0]	= uploadFoto('bukti-portofolio', 'bukti_portofolio');

			if ($alert[0]==='sukses')
				$bukti	= $_FILES['bukti-portofolio']['name'];
			else {
				$_SESSION['alert'] = $alert;
				$this->session->mark_as_flash('alert');
				redirect('Designer/buatPortofolio');
			}
		}
		else {
			$bukti	= $this->input->post('link-portofolio');
		}

		$id_portofolio	= 'PRT'.str_pad($this->input->post('np'), 4, '0', STR_PAD_LEFT);
		$data			= array(
			'Judul'			 	=> $judul,
			'Bukti_portofolio'	=> $bukti,
			'Detail_portofolio'	=> $detil
		);

		$this->Model_designer->updatePortofolio($id_portofolio, $data);

		$_SESSION['alert'] = array (
			'jenis'	=> 'alert-primary',
			'isi'	=> 'Portofolio berhasil diubah'
		);
		$this->session->mark_as_flash('alert');
		redirect('Designer/lihatPortofolio');

	}

	public function hapusPortofolio($id_portofolio='0')
	{
		if($id_portofolio==='0'){
			return http_response_code('400');
		}

		$id_prt_asli	= 'PRT'.str_pad($id_portofolio, 4, '0', STR_PAD_LEFT);

		$this->Model_designer->deletePortofolio($id_prt_asli);

		$_SESSION['alert'] = array (
			'jenis'	=> 'alert-primary',
			'isi'	=> 'Portofolio berhasil dihapus'
		);
		$this->session->mark_as_flash('alert');
		redirect('Designer/lihatPortofolio');

	}

	public function lihatDiskusi($filter='belum-selesai', $page=1)
	{
		if ($filter==='belum-selesai') {
			$status = ['0', '1', '2', '3' ,'4', '5', '6'];
		}
		elseif ($filter==='semua') {
			$status = ['0', '1', '2', '3' ,'4', '5', '6', '7'];
		}
		elseif ($filter==='telah-selesai') {
			$status = ['7'];
		}
		else {
			redirect('Designer/lihatDiskusi');
		}

		// Ambil semua IDPesan berdasarkan IDPengelola di tb_pemesanan
		$id_designer	= $this->session->id_designer;
		$id_pesan		= $this->Model_designer->getAllIdPesan($id_designer);

		// Buat array $id_pesan menjadi array numeric dengan bantuan function flattenArray() dari my_helper
		$this->load->helper('my_helper');
		$id_pesan		= flattenArray($id_pesan);

		$this->load->model('Model_diskusi');
		$jumlah_dispro	= $this->Model_diskusi->getJumlahDispro($id_pesan, $status);
		$jumlah_dispro	= $jumlah_dispro->jumlah;
		// Algoritma pembagian halaman (satu halaman berisi maks. 50 daftar diskum)
		$maks 			= 50;
		if ($page > ($jumlah_dispro/$maks)+1 || $page < 0) {
			redirect('Designer/lihatDiskum');
		}

		$hal_selanjutnya	= $page < ($jumlah_dispro/$maks);
		$hal_sebelumnya		= $page>1;

		$limit			= $page*$maks;
		$baris			= ($page-1)*$maks;

		// Ambil daftar diskusi dari tb_diskusiproduk berdasarkan IDPesan tadi
		$daftar_diskusi = $this->Model_diskusi->getDaftarDispro($id_pesan, $status, $baris, $limit);

		// Cek jika $daftar_diskusi kosong beri status has_dispro=false
		// jika ada $daftar_diskusi maka beri status has_dispro=true dan masukan ke $data
		if( empty($daftar_diskusi) && $filter!=='telah-selesai') {
			$data = array(
				'has_dispro'		=> false,
				'filter'			=> $filter,
				'page'				=> $page,
				'hal_selanjutnya'	=> $hal_selanjutnya,
				'hal_sebelumnya'	=> $hal_sebelumnya
			);
		}
		else {
			$data = array(
				'has_dispro'		=> true,
				'daftar_diskusi'	=> $daftar_diskusi,
				'filter'			=> $filter,
				'page'				=> $page,
				'hal_selanjutnya'	=> $hal_selanjutnya,
				'hal_sebelumnya'	=> $hal_sebelumnya
			);
		}

		$this->load->view('designer/lihatdiskusi', $data);
	}

	public function diskusi($id_pesan='0')
	{
		if ($id_pesan==='0') {
			return http_response_code('400');
		}

		$id_pesan 			='PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);
		// Dapatkan detil pemesanan/request (gabungan tabel tb_pemesanan dan tb_umkm_data)
		$this->load->model('Model_diskusi');
		$detil_pemesanan	= $this->Model_diskusi->getPemesanan($id_pesan);

		// Cek designer
		// Jika designer ada, ambil nama designer. Jika tidak, beri keterangan 'Ditentukan Pengelola'
		$data_designer		= array();
		if( is_null($detil_pemesanan->IDDesigner) ){
			$data_designer['designer']	= 'Ditentukan Pengelola';
			$data_designer['ada']		= FALSE;
		}
		else{
			$designer 					= $this->Model_diskusi->getNamaDesainer($detil_pemesanan->IDDesigner);
			$data_designer['designer']	= $designer->Nama_lengkap;
			$data_designer['ada']		= TRUE;
		}

		// Ambil data diskusi(komentar-komentar) berdasarkan IDPesan
		$daftar_komentar = $this->Model_diskusi->getDispro($id_pesan);

		$data = array(
			'pemesanan'			=> $detil_pemesanan,
			'designer'			=> $data_designer,
			'daftar_komentar'	=> $daftar_komentar
		);
		// var_dump($data); // untuk liat isi array $data

		$this->load->helper('my_helper');
		$this->load->view('designer/diskusi', $data);
	}

	public function logout()
	{
		session_destroy();
		redirect('Welcome/login');
	}

	private function cekBuktiPortofolio(String $bukti)
	{
		if (strchr($bukti, '/'))
			return 'link';
		else
			return 'image';
	}
}