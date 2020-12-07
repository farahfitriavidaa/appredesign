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
		if ( ! $this->session->has_userdata('id_user')) {
			$id_user = $this->Model_designer->getIdUser( $this->session->user );
			$this->session->id_user = $id_user->IDUser;

			$id_designer = $this->Model_designer->getIdDesigner( $this->session->id_user );
			$this->session->id_designer = $id_designer->IDDesigner;

			$foto_profil = $this->Model_designer->getUserData($this->session->user);
			$this->session->foto_profil	= $foto_profil->Foto;
		}

		$id_designer	 	= $this->session->id_designer;
		$ringkasan_request	= $this->Model_designer->getSumRequest($id_designer);
		$komen_terakhir		= $this->Model_designer->getKomenTerakhir($id_designer);
		$request_terbaru	= $this->Model_designer->getRequestTerbaru($id_designer);

		$data	= array(
			'ringkasan' 		=> $ringkasan_request,
			'diskusi_terakhir'	=> $komen_terakhir,
			'request_terbaru'	=> $request_terbaru
		);

		$this->load->helper('my_helper');
		$this->load->view('designer/dashboard', $data);
	}

	public function lihatRequest()
	{
		$id_designer	= $this->session->id_designer;
		$daftar_request	= $this->Model_designer->getAllRequest($id_designer);

		if( empty($daftar_request) ) {
			$data = array(
				'has_request' => false
			);
		}
		else {
			$data = array(
				'has_request'		=> true,
				'daftar_request'	=> $daftar_request,
			);
		}

		$this->load->helper('my_helper');
		$this->load->view('designer/lihatrequest', $data);
	}

	public function request($id_pesan='0')
	{
		if ($id_pesan==='0') {
			return http_response_code(400);
		}

		$id_pesan		= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);
		$detil_request	= $this->Model_designer->getRequest($id_pesan, $this->session->id_designer);

		if(is_null($detil_request)){
			$data = array(
				'detil_request'	=> null
			);

			$_SESSION['alert'] = 'Data request tidak ditemukan';
			$this->session->mark_as_flash('alert');
			redirect('Designer/lihatRequest');
		}

		$data			= array(
			'request'	=> $detil_request
		);

		// print_r($data);
		$this->load->helper('my_helper');
		$this->load->view('designer/request', $data);
	}

	public function uploadDesain()
	{
		if ($this->input->method()!=="post") {
			return http_response_code(400);
		}

		$this->load->helper('my_helper');
		$id_designer	= trimId('DG',$this->session->id_designer);

		$id_pesan		= $this->input->post('np');
		$id_pesan_asli	= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);

		$status			= $this->Model_designer->getStatusRequest($id_pesan_asli, $this->session->id_designer);

		if (is_null($status)) {
			$_SESSION['alert'] = array(
				'jenis'		=> 'alert-danger',
				'isi'		=> 'Gagal mengunggah file'
			);
			$this->session->mark_as_flash('alert');

			redirect('Designer/request/'.$id_pesan);
		}

		$files			= $_FILES['hasil-design'];
		$jumlah_file	= count($files['name']);
		$upload			= true;
		$file_terunggah	= '';

		$this->load->library('upload');
		for ($i=0; $i < $jumlah_file; $i++) {
			$config['allowed_types']	= 'jpg|png';
			$config['max_size']			= 32000;
			$config['overwrite']		= TRUE;

			if ($status<=3) {
				$config['upload_path']		= './uploads/hasil_design/';
				$config['file_name']	  	= 'H_'.($id_pesan+16).($id_pesan*$id_designer).($id_designer+4).$i;
			}
			else {
				$config['upload_path']		= './uploads/revisi_design/';
				$config['file_name']	  	= 'R_'.($id_pesan+16).($id_pesan*$id_designer).($id_designer+4).$i;
			}

			$this->upload->initialize($config);

			$_FILES['file']['name']		= $files['name'][$i];
			$_FILES['file']['type']		= $files['type'][$i];
			$_FILES['file']['tmp_name']	= $files['tmp_name'][$i];
			$_FILES['file']['error']	= $files['error'][$i];
			$_FILES['file']['size']		= $files['size'][$i];

			if ( ! $this->upload->do_upload('file')) {
				$isi_pesan	= $this->upload->display_errors('<span>', '</span>').' ('.$this->upload->data('file_name').')';

				$_SESSION['alert'] = array(
					'jenis'		=> 'alert-danger',
					'isi'		=> $isi_pesan
				);
				$upload = false;
				break;
			}
			else {
				$komah=$i==$jumlah_file-1?'':',';
				$file_terunggah .= $this->upload->data('file_name').$komah;
			}
		}

		var_dump($file_terunggah);

		if ($upload) {
			if ($status<=3) {

				$this->Model_designer->uploadDesain($file_terunggah, $id_pesan_asli);
				$this->Model_designer->updateStatus('3', $id_pesan_asli);

				$_SESSION['alert'] = array(
					'jenis'		=> 'alert-primary',
					'isi'		=> 'Berhasil mengunggah hasil desain'
				);
			} else {

				$this->Model_designer->uploadRevisi($file_terunggah, $id_pesan_asli);

				$_SESSION['alert'] = array(
					'jenis'		=> 'alert-primary',
					'isi'		=> 'Berhasil mengunggah revisi'
				);
			}
		}

		$this->session->mark_as_flash('alert');
		redirect('Designer/request/'.$id_pesan);
	}

	public function hapusDesain($id_pesan='0')
	{
		if ($id_pesan==='0') {
			return http_response_code(400);
		}

		$id_pesan_asli	= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);
		$id_designer	= $this->session->id_designer;

		$status			= $this->Model_designer->getStatusRequest($id_pesan_asli, $id_designer);

		if($status>3) {
			$_SESSION['alert'] = array (
				'jenis'	=> 'alert-danger',
				'isi'	=> 'Hasil desain tidak bisa dihapus karena desain masih di-review atau sudah disetujui'
			);

			$this->session->mark_as_flash('alert');
			redirect('Designer/request/'.$id_pesan);
		}

		$hapus			= $this->Model_designer->deleteDesain($id_pesan_asli, $id_designer);

		if (!$hapus) {
			$_SESSION['alert'] = 'Gagal menghapus hasil desain';

			$this->session->mark_as_flash('alert');
			redirect('Designer/lihatRequest');
		}
		else {
			$_SESSION['alert'] = array (
				'jenis'	=> 'alert-primary',
				'isi'	=> 'Hasil desain berhasil dihapus'
			);

			$this->Model_designer->updateStatus('2', $id_pesan_asli);


			$this->session->mark_as_flash('alert');
			redirect('Designer/request/'.$id_pesan);
		}
	}

	public function hapusRevisi($id_pesan='0')
	{
		if ($id_pesan==='0') {
			return http_response_code(400);
		}

		$id_pesan_asli	= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);
		$id_designer	= $this->session->id_designer;

		$status			= $this->Model_designer->getStatusRequest($id_pesan_asli, $id_designer);

		if($status>5) {
			$_SESSION['alert'] = array (
				'jenis'	=> 'alert-danger',
				'isi'	=> 'Revisi tidak bisa dihapus karena desain sudah disetujui'
			);

			$this->session->mark_as_flash('alert');
			redirect('Designer/request/'.$id_pesan);
		}

		$hapus			= $this->Model_designer->deleteRevisi($id_pesan_asli, $id_designer);

		if (!$hapus) {
			$_SESSION['alert'] = 'Gagal menghapus revisi';

			$this->session->mark_as_flash('alert');
			redirect('Designer/lihatRequest');
		}
		else {
			$_SESSION['alert'] = array (
				'jenis'	=> 'alert-primary',
				'isi'	=> 'Revisi berhasil dihapus'
			);

			$this->session->mark_as_flash('alert');
			redirect('Designer/request/'.$id_pesan);
		}


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

				$this->session->foto_profil = $_FILES['foto-profil']['name'];
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

	// unused function
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
		$id_designer		= $this->session->id_designer;

		$data_portofolio	= $this->Model_designer->getPortofolio($id_designer, $id_prt_asli);

		if (is_null($data_portofolio)) {
			$_SESSION['alert'] = array(
				'jenis' => 'alert-danger',
				'isi'	=> 'Portofolio tidak diketahui.'
			);
			$this->session->mark_as_flash('alert');

			redirect('Designer/lihatPortofolio');
		}

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

		$id_portofolio		= 'PRT'.str_pad($this->input->post('np'), 4, '0', STR_PAD_LEFT);
		$id_designer		= $this->session->id_designer;

		$data_portofolio	= $this->Model_designer->getPortofolio($id_designer, $id_portofolio);

		if (is_null($data_portofolio)) {
			$_SESSION['alert'] = array(
				'jenis' => 'alert-danger',
				'isi'	=> 'Portofolio tidak diketahui.'
			);
			$this->session->mark_as_flash('alert');

			redirect('Designer/lihatPortofolio');
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
		$id_designer		= $this->session->id_designer;

		$data_portofolio	= $this->Model_designer->getPortofolio($id_designer, $id_prt_asli);

		if (is_null($data_portofolio)) {
			$_SESSION['alert'] = array(
				'jenis' => 'alert-danger',
				'isi'	=> 'Portofolio tidak diketahui.'
			);
			$this->session->mark_as_flash('alert');

			redirect('Designer/lihatPortofolio');
		}

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
			$status = ['1', '2', '3' ,'4'];
		}
		elseif ($filter==='semua') {
			$status = ['1', '2', '3' ,'4', '5','6', '7'];
		}
		elseif ($filter==='telah-selesai') {
			$status = ['5','6', '7'];
		}
		else {
			redirect('Designer/lihatDiskusi');
		}

		$this->load->helper('my_helper');

		// Ambil semua IDPesan berdasarkan IDPengelola di tb_pemesanan
		$id_designer	= $this->session->id_designer;
		$id_pesan		= $this->Model_designer->getAllIdPesan($id_designer);

		if (empty($id_pesan)) {
			$id_pesan	= '';
		}
		else {
			// Buat array $id_pesan menjadi array numeric dengan bantuan function flattenArray() dari my_helper
			$id_pesan		= flattenArray($id_pesan);
		}

		$this->load->model('Model_diskusi');
		$jumlah_dispro	= $this->Model_diskusi->getJumlahDispro($id_pesan, $status);
		$jumlah_dispro	= $jumlah_dispro->jumlah;
		// Algoritma pembagian halaman (satu halaman berisi maks. 50 daftar diskum)
		$maks 			= 50;
		if ($page > ($jumlah_dispro/$maks)+1 || $page < 0) {
			redirect('Designer/lihatDiskusi');
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

		$id_pesan 			= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);
		$id_designer		= $this->session->id_designer;
		// Dapatkan detil pemesanan/request (gabungan tabel tb_pemesanan dan tb_umkm_data)
		$this->load->model('Model_diskusi');
		$detil_pemesanan	= $this->Model_diskusi->getPemesanan($id_pesan, $id_designer, 'designer');

		// Cek jika pemesanan ada hubungannya dengan designer
		if ( is_null($detil_pemesanan) ) {
			$data = array(
				'pemesanan'			=> null
			);

			$_SESSION['alert'] = 'Diskusi tidak ditemukan';
			$this->session->mark_as_flash('alert');
		}
		else{
			unset($_SESSION['alert']);

			// Cek designer
			// Jika designer ada, ambil nama designer. Jika tidak, beri keterangan 'Ditentukan Pengelola'
			$data_designer		= array();
			if ( is_null($detil_pemesanan->IDDesigner) ){
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
			// var_dump($detil_pemesanan);

		}

		$this->load->helper('my_helper');
		$this->load->view('designer/diskusi', $data);
	}

	public function tambahKomentar()
	{
		if($this->input->method() == 'post') {

			// Kembalikan IDPesan sesuai format, 1 -> PS0001
			$id_pesan		= $this->input->post('np');
			$id_pesan_asli	= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);

			$data			= array();
			$alert			= '';

			// Proses upload foto dengan bantuan function uploadFoto() dari my_helper
			// Jika tidak ada foto yang di-upload maka lewati bagian if() ini
			$this->load->helper('my_helper');
			if( $_FILES['foto-komentar']['error'] !== 4 ){
				$alert	= uploadFoto('foto-komentar', 'foto_diskum');
				$data	+= array(
					'Foto_dispro' => $_FILES['foto-komentar']['name']
				);
			}

			// Cek apakah upload foto berhasil
			// Jika berhasil tambahkan ke database, jika tidak berhasil lempar peringatan ke halaman diskusi
			if($alert==='sukses' || $alert===''){
				$this->load->model('Model_created');
				$id_dispro		= $this->Model_created->idDispro();

				$komentar		= $this->input->post('komentar');
				$tanggal_waktu	= date('Y-m-d h:i:s');
				// $now			= new DateTime('now',new DateTimeZone('Asia/Jakarta'));
				// $tanggal_waktu	= $now->format('Y-m-d H:i:s');

				// IDUMKM dikosongkan karena pengirim komentar adalah Pengelola
				$data 			+= array(
					'IDDispro'		=> $id_dispro,
					'IDDesigner'	=> $this->session->id_designer,
					'IDPesan'		=> $id_pesan_asli,
					'Komentar'		=> $komentar,
					'Tanggal_waktu'	=> $tanggal_waktu
				);
				// var_dump($data);

				$this->load->model('Model_diskusi');
				$this->Model_diskusi->createDispro($data);

				redirect('Designer/diskusi/'.$id_pesan);

			}
			else{
				$_SESSION['alert'] = $alert;
				$this->session->mark_as_flash('alert');
				redirect('Designer/diskusi/'.$id_pesan);
			}
		}
		else
			redirect('Designer');
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