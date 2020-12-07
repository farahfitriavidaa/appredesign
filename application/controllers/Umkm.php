<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Umkm extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		if( !$this->session->has_userdata('user') || $this->session->level!=='umkm' ){
			session_destroy();
			redirect('Welcome/login');
		}

		$this->load->model('Model_umkm');
	}

	public function index()
	{
		if ( ! $this->session->has_userdata('id_user')) {
			$id_user	= $this->Model_umkm->getIdUser( $this->session->user );
			$this->session->id_user = $id_user->IDUser;

			$id_umkm	= $this->Model_umkm->getIdUmkm( $this->session->id_user );
			$this->session->id_umkm = $id_umkm->IDUMKM;

			$nama_umkm	= $this->Model_umkm->getNamaUmkm( $this->session->id_umkm );
			$this->session->nama_umkm = $nama_umkm->Nama_umkm;

			$foto_profil = $this->Model_umkm->getUserData($this->session->user);
			$this->session->foto_profil	= $foto_profil->Foto;
		}

		$id_umkm	 	= $this->session->id_umkm;
		$komen_terakhir		= $this->Model_umkm->getKomenTerakhir($id_umkm);
		$request_terbaru	= $this->Model_umkm->getRequestTerbaru($id_umkm);

		$data	= array(
			'diskusi_terakhir'	=> $komen_terakhir,
			'request_terbaru'	=> $request_terbaru
		);

		$this->load->helper('my_helper');
		$this->load->view('umkm/dashboard', $data);
	}

	public function buatRequest()
	{
		$desainer	= $this->Model_umkm->getDaftarDesainer();

		$data		= array(
			'desainers' => $desainer
		);

		$this->load->helper('my_helper');
		$this->load->view('umkm/buatrequest', $data);
	}

	public function lihatRequest()
	{
		$this->load->helper('my_helper');

		$id_umkm		= $this->session->id_umkm;
		$id_data_umkm	= $this->Model_umkm->getAllIdDataUMKM($id_umkm);

		if (empty($id_data_umkm)) {
			$id_data_umkm = '';
		} else {
			$id_data_umkm	= flattenArray($id_data_umkm);
		}


		$daftar_request	= $this->Model_umkm->getDaftarRequest($id_data_umkm);
		$daftar_produk	= $this->Model_umkm->getDaftarProduk($id_data_umkm);

		if( empty($daftar_request) ) {
			$data = array(
				'has_request' => false
			);
		}
		else {
			$data = array(
				'has_request'	=> true,
				'requests'		=> $daftar_request,
				'produks'		=> $daftar_produk
			);
		}

		$this->load->view('umkm/lihatrequest', $data);
	}

	public function tambahRequest()
	{
		if($this->input->method() == 'post') {
			$nama_produk		= $this->input->post('nama-produk');
			$keterangan_produk	= $this->input->post('keterangan-produk');
			$keterangan_desain	= $this->input->post('keterangan-desain');

			$alert				= ['sukses','sukses','sukses'];
			$this->load->helper('my_helper');
			if( $_FILES['foto-produk']['error'] != 4 )
				$alert[0]		= uploadFoto('foto-produk', 'foto_produk');

			if( $_FILES['logo-produk']['error'] != 4 )
				$alert[1]		= uploadFoto('logo-produk', 'logo_produk');

			if( $_FILES['kemasan-produk']['error'] != 4 )
				$alert[2]		= uploadFoto('kemasan-produk', 'foto_kemasan_lama');

			if( $alert[0]==='sukses' && $alert[1]==='sukses' && $alert[2]==='sukses'){

				$this->load->model('Model_created');

				$id_data_umkm		= $this->Model_created->idDataUMKM();
				$id_umkm			= $this->session->id_umkm;
				$foto_produk		= $_FILES['foto-produk']['name'];
				$logo_produk		= $_FILES['logo-produk']['name'];
				$kemasan_produk		= $_FILES['kemasan-produk']['name'];

				$data_umkm		= array(
					'IDDataUMKM'		=> $id_data_umkm,
					'IDUMKM'			=> $id_umkm,
					'Nama_produk'		=> $nama_produk,
					'Foto_produk'		=> $foto_produk,
					'Keterangan'		=> $keterangan_produk,
					'Logo_produk'		=> $logo_produk,
					'Kemasan_produk'	=> $kemasan_produk
				);

				$this->Model_umkm->createUmkmData($data_umkm);

				$id_pesan		= $this->Model_created->idPesan();
				$id_designer	= $this->input->post('desainer');
				$id_designer	= $id_designer==='0'?NULL:'DG'.str_pad($id_designer, 4, '0', STR_PAD_LEFT);
				$status			= '0';
				$tanggal_order	= date('Y-m-d');

				$data_pemesanan	= array(
					'IDPesan'			=> $id_pesan,
					'IDDataUMKM'		=> $id_data_umkm,
					'IDDesigner'		=> $id_designer,
					'Status'			=> $status,
					'Keterangan_design'	=> $keterangan_desain,
					'Tgl_order'			=> $tanggal_order
				);

				$this->Model_umkm->createPemesanan($data_pemesanan);

				$_SESSION['alert'] = array (
					'jenis'	=> 'alert-primary',
					'isi'	=> 'Request berhasil dibuat dan sekarang menunggu respon dari Pengelola.'
				);
				$this->session->mark_as_flash('alert');
				redirect('Umkm/lihatRequest');
			}
			else{
				$_SESSION['alert'] = $alert;
				$this->session->mark_as_flash('alert');
				redirect('Umkm/buatRequest');
			}
		}
		else
			redirect('Umkm/buatRequest');
	}

	public function detilRequest($id_pesan='0')
	{
		if ($id_pesan!=='0') {
			$id_pesan		= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);
			$id_umkm		= $this->session->id_umkm;

			$detil_request	= $this->Model_umkm->getRequest($id_umkm, $id_pesan);

			if(is_null($detil_request)) {
				$_SESSION['alert'] = array(
					'jenis' => 'alert-danger',
					'isi'	=> 'Request tidak diketahui.'
				);
				$this->session->mark_as_flash('alert');

				redirect('Umkm/lihatRequest');
			}

			$id_data_umkm	= $detil_request->IDDataUMKM;
			$data_produk	= $this->Model_umkm->getUmkmData($id_data_umkm);

			$data_desainer	= array();
			if(is_null($detil_request->IDDesigner)){
				$data_desainer['desainer']	= 'Ditentukan Pengelola';
				$data_desainer['ada']		= FALSE;
			}
			else{
				$desainer 					= $this->Model_umkm->getNamaDesainer($detil_request->IDDesigner);
				$data_desainer['desainer']	= $desainer->Nama_lengkap;
				$data_desainer['ada']		= TRUE;
			}

			$data			= array(
				'detil_request'	=> $detil_request,
				'data_produk'	=> $data_produk,
				'desainer'		=> $data_desainer
			);

			$this->load->helper('my_helper');
			$this->load->view('umkm/detilrequest', $data);
		} else {
			http_response_code('400');
		}
	}

	public function editRequest( $id_pesan='0' )
	{
		if ($id_pesan!=='0') {
			$id_pesan		= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);
			$id_umkm		= $this->session->id_umkm;

			$detil_request	= $this->Model_umkm->getRequest($id_umkm, $id_pesan);

			if(is_null($detil_request)) {
				$_SESSION['alert'] = array(
					'jenis' => 'alert-danger',
					'isi'	=> 'Request tidak diketahui.'
				);
				$this->session->mark_as_flash('alert');

				redirect('Umkm/lihatRequest');
			}
			else {
				$id_data_umkm	= $detil_request->IDDataUMKM;
				$data_produk	= $this->Model_umkm->getUmkmData($id_data_umkm);

				$data			= array(
					'detil_request'	=> $detil_request,
					'data_produk'	=> $data_produk
				);

				$this->load->helper('my_helper');
				$this->load->view('umkm/editrequest', $data);
			}
		}
		else {
			http_response_code('400');
		}
	}

	public function updateRequest()
	{
		if($this->input->method() == 'post') {
			$id_pesan			= 'PS'.str_pad($this->input->post('np'), 4, '0', STR_PAD_LEFT);
			$id_umkm			= $this->session->id_umkm;

			$cekUmkmdanRequest	= $this->Model_umkm->cekUmkmdanRequest($id_umkm, $id_pesan);

			if(is_null($cekUmkmdanRequest)) {
				$_SESSION['alert'] = array(
					'jenis' => 'alert-danger',
					'isi'	=> 'Gagal mengedit request. Request tidak diketahui.'
				);
				$this->session->mark_as_flash('alert');

				redirect('Umkm/lihatRequest');
			} // else {

			$nama_produk		= $this->input->post('nama-produk');
			$keterangan_produk	= $this->input->post('keterangan-produk');
			$keterangan_desain	= $this->input->post('keterangan-desain');

			$data_umkm			= array();
			$alert				= ['sukses','sukses','sukses'];
			$this->load->helper('my_helper');
			if( $_FILES['foto-produk']['error'] != 4 ){
				$alert[0]		= uploadFoto('foto-produk', 'foto_produk');
				$data_umkm		+= array(
					'Foto_produk' => $_FILES['foto-produk']['name']
				);
			}
			if( $_FILES['logo-produk']['error'] != 4 ){
				$alert[1]		= uploadFoto('logo-produk', 'logo_produk');
				$data_umkm		+= array(
					'Logo_produk' => $_FILES['logo-produk']['name']
				);
			}
			if( $_FILES['kemasan-produk']['error'] != 4 ){
				$alert[2]		= uploadFoto('kemasan-produk', 'fto_kemasan_lama');
				$data_umkm		+= array(
					'Kemasan_produk' => $_FILES['kemasan-produk']['name']
				);
			}
			if( $alert[0]==='sukses' && $alert[1]==='sukses' && $alert[2]==='sukses'){

				$id_data_umkm		= $this->Model_umkm->getIdDataUmkmFromIdPesan($id_pesan);

				$data_umkm		+= array(
					'Nama_produk'		=> $nama_produk,
					'Keterangan'		=> $keterangan_produk
				);

				$this->Model_umkm->updateUmkmData($id_data_umkm->IDDataUMKM, $data_umkm);

				$data_pemesanan	= array(
					'Keterangan_design'	=> $keterangan_desain
				);

				$this->Model_umkm->updatePemesanan($id_pesan, $data_pemesanan);

				$_SESSION['alert'] = array (
					'jenis'	=> 'alert-primary',
					'isi'	=> 'Request berhasil diubah.'
				);
				$this->session->mark_as_flash('alert');
				redirect('Umkm/lihatRequest');
			}
			else{
				$_SESSION['alert'] = $alert;
				$this->session->mark_as_flash('alert');
				redirect('Umkm/editRequest/'.$this->input->post('np'));
			}
			// } // end of else;
		}
		else
			redirect('Umkm');
	}

	public function hapusRequest($id_pesan='0')
	{
		if ($id_pesan!=='0') {
			$id_pesan		= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);
			$id_umkm		= $this->session->id_umkm;

			$detil_request	= $this->Model_umkm->getRequest($id_umkm, $id_pesan);

			if(is_null($detil_request)) {
				$_SESSION['alert'] = array(
					'jenis' => 'alert-danger',
					'isi'	=> 'Request tidak diketahui.'
				);
				$this->session->mark_as_flash('alert');

				redirect('Umkm/lihatRequest');
			}
			else {

				if($detil_request->Status == 0){
					$id_data_umkm	= $this->Model_umkm->getIdDataUmkmFromIdPesan($id_pesan);

					$this->Model_umkm->deleteRequest($id_pesan);
					$this->Model_umkm->deleteUmkmData($id_data_umkm->IDDataUMKM);

					$_SESSION['alert'] = array (
						'jenis'	=> 'alert-primary',
						'isi'	=> 'Request berhasil dihapus'
					);
					$this->session->mark_as_flash('alert');
					redirect('Umkm/lihatRequest');
				}
				else{
					$_SESSION['alert'] = array (
						'jenis'	=> 'alert-danger',
						'isi'	=> 'Request tidak bisa dihapus. Diskusikan dengan Pengelola untuk membatalkan request.'
					);
					$this->session->mark_as_flash('alert');
					redirect('Umkm/lihatRequest');
				}
			}

		} else {
			http_response_code('400');
		}
	}

	public function lihatPortofolio($id_designer='0')
	{
		if($id_designer==='0') {
			redirect('Umkm');
		}

		$id_designer_asli	= 'DG'.str_pad($id_designer, 4, '0', STR_PAD_LEFT);

		$this->load->model('Model_designer');
		$daftar_portofolio	= $this->Model_designer->getDaftarPortofolio($id_designer_asli);
		$daftar_designer	= $this->Model_umkm->getDaftarDesainer();
		$data_designer		= $this->Model_umkm->getDesainer($id_designer_asli);

		$data				= array(
			'designer'			=> $data_designer,
			'daftar_portofolio'	=> $daftar_portofolio,
			'daftar_designer'	=> $daftar_designer
		);

		$this->load->helper('my_helper');
		$this->load->view('umkm/lihatportofolio', $data);
	}

	public function lihatProfil()
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

			$data_user			= array();
			$alert				= [''];
			if( $_FILES['foto-profil']['error'] != 4 ){
				$this->load->helper('my_helper');
				$alert			= uploadFoto('foto-profil', 'foto_user');

				if ($alert==='sukses') {
					$data_user		+= array(
						'Foto' => $_FILES['foto-profil']['name']
					);

					$this->session->foto_profil = $_FILES['foto-profil']['name'];
				}
			}
			if( $alert==='sukses' || $alert===''){

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
				redirect('Umkm/lihatProfil');
			}
			else{
				$_SESSION['alert'] = $alert;
				$this->session->mark_as_flash('alert');
				redirect('Umkm/editProfil');
			}
		}
		else
			redirect('Umkm');
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
				redirect('Umkm/lihatProfil');
			}
			else {
				$data		= array(
					'pesan_error'	=> 'Password Lama tidak tepat'
				);

				$this->load->view('umkm/editpassword', $data);
			}

		}

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
			redirect('Umkm/lihatDiskusi');
		}

		$this->load->helper('my_helper');

		// Ambil semua IDPesan berdasarkan IDUMKM
		$id_umkm	= $this->session->id_umkm;
		$id_pesan	= $this->Model_umkm->getAllIdPesan($id_umkm);

		if (empty($id_pesan)) {
			$id_pesan	= '';
		}
		else {
			// Buat array $id_pesan menjadi array numeric dengan bantuan function flattenArray() dari my_helper
			$id_pesan		= flattenArray($id_pesan);
		}

		$this->load->model('Model_diskusi');
		$jumlah_diskusi	= $this->Model_diskusi->getJumlahDiskum($id_pesan, $status);
		$jumlah_diskusi	= $jumlah_diskusi->jumlah;
		// Algoritma pembagian halaman (satu halaman berisi maks. 10 daftar diskum)
		$maks			= 10;
		if ($page > ($jumlah_diskusi/$maks)+1 || $page < 0) {
			redirect('Umkm/lihatDiskusi');
		}

		$hal_selanjutnya	= $page < ($jumlah_diskusi/$maks);
		$hal_sebelumnya		= $page > 1;

		$limit			= $page*$maks;
		$baris			= ($page-1)*$maks;

		// Ambil daftar diskusi dari tb_diskusiumkm berdasarkan IDPesan tadi
		$daftar_diskusi = $this->Model_diskusi->getDaftarDiskum($id_pesan, $status, $baris, $limit);

		// Cek jika daftar diskusi kosong beri status has_diskum=false
		// jika ada daftar diskusi maka beri status has_diskum=true dan masukan ke $data
		if( empty($daftar_diskusi) ) {
			$data = array(
				'has_diskum' 		=> false,
				'filter'			=> $filter,
				'page'				=> $page,
				'hal_selanjutnya'	=> $hal_selanjutnya,
				'hal_sebelumnya'	=> $hal_sebelumnya
			);
		}
		else {
			$data = array(
				'has_diskum'		=> true,
				'daftar_diskusi'	=> $daftar_diskusi,
				'filter'			=> $filter,
				'page'				=> $page,
				'hal_selanjutnya'	=> $hal_selanjutnya,
				'hal_sebelumnya'	=> $hal_sebelumnya
			);
		}

		$this->load->view('umkm/lihatdiskusi', $data);
	}

	public function diskusi($id_pesan='0')
	{
		// Cek IDPesan dan pastikan user tidak input alamat ".../Umkm/diskusi" tanpa IDPesan
		if ($id_pesan!=='0') {
			$id_umkm			= $this->session->id_umkm;

			// Kembalikan IDPesan sesuai format, 1 -> PS0001
			$id_pesan			= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);

			// Dapatkan detil pemesanan/request (gabungan tabel tb_pemesanan dan tb_umkm_data)
			$this->load->model('Model_diskusi');
			$detil_pemesanan	= $this->Model_diskusi->getPemesanan($id_pesan, $id_umkm, 'umkm');

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
				// Jika ada ambil nama designer, jika tidak beri keterangan 'Ditentukan Pengelola'
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

				// Ambil data diskusi berdasarkan IDPesan
				$daftar_diskusi	= $this->Model_diskusi->getDiskum($id_pesan);

				$data			= array(
					'pemesanan'			=> $detil_pemesanan,
					'designer'			=> $data_designer,
					'daftar_diskusi'	=> $daftar_diskusi
				);
			}
			// var_dump($data);
			// Load helper untuk memotong IDPesan, PS0015 -> 15.
			$this->load->helper('my_helper');

			// Load view
			$this->load->view('umkm/diskusi', $data);

		} else {
			http_response_code('400');
		}
	}

	public function tambahKomentar()
	{
		// Cek kalo user ke alamat ini dengan method post (tidak mengetik secara langsung alamat "../Umkm/tambahKomentar")
		if($this->input->method() == 'post') {
			// Kembalikan IDPesan sesuai format, 1 -> PS0001
			$id_terpotong	= $this->input->post('np');
			$id_pesan		= 'PS'.str_pad($id_terpotong, 4, '0', STR_PAD_LEFT);

			$data			= array();
			$alert			= '';

			// Proses upload foto dengan bantuan function uploadFoto() dari my_helper
			// Jika tidak ada foto yang di-upload maka lewati bagian if() ini
			$this->load->helper('my_helper');
			if( $_FILES['foto-komentar']['error'] !== 4 ){
				$alert	= uploadFoto('foto-komentar', 'foto_diskum');
				$data	+= array(
					'Foto_diskum' => $_FILES['foto-komentar']['name']
				);
			}

			// Cek apakah upload foto berhasil
			// Jika berhasil tambahkan ke database, jika tidak berhasil lempar peringatan ke halaman diskusi
			if($alert==='sukses' || $alert===''){
				$this->load->model('Model_created');
				$id_diskum		= $this->Model_created->idDiskum();

				$komentar		= $this->input->post('komentar');
				$tanggal_waktu	= date('Y-m-d h:i:s');
				// Alternatif cara ambil tanggal sekarang jika yg di atas tdk akurat
				// $now				= new DateTime('now',new DateTimeZone('Asia/Jakarta'));
				// $tanggal_waktu	= $now->format('Y-m-d H:i:s');

				// IDPengelola dikosongkan karena pengirim komentar adalah UMKM
				$data 			+= array(
					'IDDiskum'		=> $id_diskum,
					'IDUMKM'		=> $this->session->id_umkm,
					'IDPesan'		=> $id_pesan,
					'Komentar'		=> $komentar,
					'Tanggal_waktu'	=> $tanggal_waktu
				);

				$this->load->model('Model_diskusi');
				$this->Model_diskusi->createDiskum($data);

				redirect('Umkm/diskusi/'.$id_terpotong);

			}
			else{
				$_SESSION['alert'] = $alert;
				$this->session->mark_as_flash('alert');
				redirect('Umkm/diskusi/'.$id_terpotong);
			}
		}
		else
			redirect('Umkm');
	}

	public function logout()
	{
		session_destroy();
		redirect('Welcome/login');
	}
}