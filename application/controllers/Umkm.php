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
		$id_user	= $this->Model_umkm->getIdUser( $this->session->user );
		$this->session->id_user = $id_user->IDUser;

		$id_umkm	= $this->Model_umkm->getIdUmkm( $this->session->id_user );
		$this->session->id_umkm = $id_umkm->IDUMKM;

		$nama_umkm	= $this->Model_umkm->getNamaUmkm( $this->session->id_umkm );
		$this->session->nama_umkm = $nama_umkm->Nama_umkm;

		$user	= $this->Model_umkm->getUserData( $this->session->user );
		$data	= array(
			'akun' => $user
		);
		$this->load->view('umkm/dashboard', $data);

		// var_dump($data);
	}

	public function buatRequest()
	{
		$this->load->model('Model_admin');
		$desainer	= $this->Model_admin->getDesigner();

		$data		= array(
			'desainers' => $desainer
		);

		$this->load->view('umkm/buatrequest', $data);

		// var_dump($data);
	}

	public function lihatRequest()
	{
		$id_umkm		= $this->session->id_umkm;
		$id_data_umkm	= $this->Model_umkm->getAllIdDataUMKM($id_umkm);
		$id_data_umkm	= $this->flattenArray($id_data_umkm);

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
		// echo $id_umkm."<br>";
		// print_r($id_data_umkm);
		// print_r($data);

		$this->load->helper('my_helper');
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
				$status			= '0';
				$tanggal_order	= date('Y-m-d');

				$data_pemesanan	= array(
					'IDPesan'			=> $id_pesan,
					'IDDataUMKM'		=> $id_data_umkm,
					'IDDesigner'		=> $id_designer==='0'?NULL:$id_designer,
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

				// var_dump($alert);
				// var_dump($data_umkm);
				// var_dump($data_pemesanan);

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
			$detil_request	= $this->Model_umkm->getRequest($id_pesan);

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

			// print_r($data);
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
			$detil_request	= $this->Model_umkm->getRequest($id_pesan);

			$id_data_umkm	= $detil_request->IDDataUMKM;
			$data_produk	= $this->Model_umkm->getUmkmData($id_data_umkm);

			$data			= array(
				'detil_request'	=> $detil_request,
				'data_produk'	=> $data_produk
			);

			// print_r($data);
			// echo "<br>".$data['detil_request']->IDPesan."<br>";
			$this->load->helper('my_helper');
			$this->load->view('umkm/editrequest', $data);
		} else {
			http_response_code('400');
		}
	}

	public function updateRequest()
	{
		if($this->input->method() == 'post') {
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

				$id_pesan			= 'PS'.str_pad($this->input->post('np'), 4, '0', STR_PAD_LEFT);
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
				);;
				$this->session->mark_as_flash('alert');
				redirect('Umkm/lihatRequest');

				// var_dump($alert);
				// var_dump($data_umkm);
				// var_dump($data_pemesanan);

			}
			else{
				$_SESSION['alert'] =$alert;
				$this->session->mark_as_flash('alert');
				redirect('Umkm/editRequest/'.$this->input->post('np'));
			}
		}
		else
			redirect('Umkm');
	}

	public function hapusRequest($id_pesan='0')
	{
		if ($id_pesan!=='0') {
			$id_pesan		= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);
			$detil_request	= $this->Model_umkm->getRequest($id_pesan);

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
		} else {
			http_response_code('400');
		}
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

		// print_r($data);
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

		// print_r($data);
		// echo "<br>".$data['detil_request']->IDPesan."<br>";
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
			$alert				= ['sukses'];
			if( $_FILES['foto-profil']['error'] != 4 ){
				$this->load->helper('my_helper');
				$alert[0]		= uploadFoto('foto-profil', 'foto_user');
				$data_user		+= array(
					'Foto' => $_FILES['foto-profil']['name']
				);
			}
			if( $alert[0]==='sukses'){

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

				// var_dump($alert);
				// var_dump($data_user);
				// var_dump($data_umkm);
				// var_dump($id_user);
				// var_dump($id_umkm);

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

	public function lihatDiskusi()
	{
		// Ambil semua IDPesan berdasarkan IDUMKM
		$id_umkm	= $this->session->id_umkm;
		$id_pesan	= $this->Model_umkm->getAllIdPesan($id_umkm);
		// Buat array $id_pesan menjadi lebih sederhana dengan bantuan function flattenArray() dari my_helper
		$this->load->helper('my_helper');
		$id_pesan	= $this->flattenArray($id_pesan);

		// Get Daftar diskusi dari tb_diskusiumkm berdasarkan IDPesan tadi
		$this->load->model('Model_diskusi');
		$daftar_diskusi = $this->Model_diskusi->getDaftarDiskumUmkm($id_pesan);

		// Cek jika daftar diskusi kosong beri status has_diskum=false
		// jika ada daftar diskusi maka beri status has_diskum=true dan masukan ke $data
		if( empty($daftar_diskusi) ) {
			$data = array(
				'has_diskum' => false
			);
		}
		else {
			$data = array(
				'has_diskum'		=> true,
				'daftar_diskusi'	=> $daftar_diskusi
			);
		}

		// var_dump($data);
		// var_dump($id_umkm);
		// var_dump($id_pesan);
		$this->load->view('umkm/lihatdiskusi', $data);
	}

	public function diskusi($id_pesan='0')
	{
		// Cek IDPesan dan pastikan user tidak input alamat ".../Umkm/diskusi" tanpa IDPesan
		if ($id_pesan!=='0') {

			// Kembalikan IDPesan sesuai format, 1 -> PS0001
			$id_pesan			= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);

			// Dapatkan detil pemesanan/request (gabungan tabel tb_pemesanan dan tb_umkm_data)
			$this->load->model('Model_diskusi');
			$detil_pemesanan	= $this->Model_diskusi->getPemesanan($id_pesan);

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

			$data			= array(
				'pemesanan'	=> $detil_pemesanan,
				'designer'	=> $data_designer
			);

			// Load helper untuk memotong IDPesan, PS0015 -> 15. (bebas mau dipake atau ngga)
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
			$komentar	= $this->input->post('komentar');
			$foto		= $_FILES['foto-diskusi'];

			$data 		= array(
				'Komentar'	=> $komentar,
				'Foto'		=> $foto
			);

			var_dump($data);
		}
		else
			redirect('Umkm');
	}

	private function flattenArray(array $old_array)
	{
		$new_array = array();
		array_walk_recursive($old_array, function($a) use (&$new_array) { $new_array[] = $a; });
		return $new_array;
	}
}