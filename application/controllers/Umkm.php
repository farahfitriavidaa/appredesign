<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Umkm extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		if( !$this->session->has_userdata('user') )
			redirect('Welcome/login');

		$this->load->model('Model_umkm');
	}

	public function index()
	{
		$id_user = $this->Model_umkm->getIdUser( $this->session->user );
		$this->session->id_user = $id_user->IDUser;

		$id_umkm = $this->Model_umkm->getIdUmkm( $this->session->id_user );
		$this->session->id_umkm = $id_umkm->IDUMKM;

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
		$daftar_request	= $this->Model_umkm->getDaftarRequest($id_umkm);

		if( empty($daftar_request) ) {
			$data = array(
				'has_request' => false
			);
		}
		else {
			$data = array(
				'has_request'	=> true,
				'request'		=> $daftar_request
			);
		}

		$this->load->view('umkm/lihatrequest', $data);

		// var_dump($data);
	}

	public function tambahRequest()
	{
		if($this->input->method() == 'post') {
			$nama_produk		= $this->input->post('nama-produk');
			$keterangan_produk	= $this->input->post('keterangan-produk');
			$keterangan_desain	= $this->input->post('keterangan-desain');

			$alert				= ['sukses','sukses','sukses'];
			if( $_FILES['foto-produk']['error'] != 4 )
				$alert[0]		= $this->uploadFoto('foto-produk');

			if( $_FILES['logo-produk']['error'] != 4 )
				$alert[1]		= $this->uploadFoto('logo-produk');

			if( $_FILES['kemasan-produk']['error'] != 4 )
				$alert[2]		= $this->uploadFoto('kemasan-produk');

			if( $alert[0]==='sukses' && $alert[1]==='sukses' && $alert[2]==='sukses'){

				$this->load->model('Model_created');

				$id_data_umkm		= $this->Model_created->idDataUmkm();
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

				$data_pemesanan	= array(
					'IDPesan'			=> $id_pesan,
					'IDUMKM'			=> $id_umkm,
					'IDDesigner'		=> $id_designer,
					'Status'			=> $status
				);

				$this->Model_umkm->createPemesanan($data_pemesanan);

				$this->load->view('lihatrequest');

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

	private function uploadFoto($img)
	{
		$jenis_foto		= '';
		$target_dir		= '';

		switch($img){
			case 'foto-produk':
				$jenis_foto = 'foto produk';
				$target_dir = './uploads/foto_produk/';
				break;
			case 'logo-produk':
				$jenis_foto='logo produk';
				$target_dir = './uploads/logo_produk/';
				break;
			case 'kemasan-produk':
				$jenis_foto ='kemasan produk';
				$target_dir = './uploads/foto_kemasan_lama/';
				break;
		}

		$target_file	= $target_dir.basename($_FILES[$img]['name']);
		$imageFileType	= strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$check 			= getimagesize($_FILES[$img]['tmp_name']);

		if($check == false) {
			return 'Jenis file '.$jenis_foto.' tidak didukung. Coba ulangi memasukan foto atau gambar.';
		}

		if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif' ) {
		 	return 'Hanya format JPG, JPEG, PNG, dan GIF yang diperbolehkan untuk file '.$jenis_foto.'.';
		}

		if ($_FILES[$img]['size'] > 65000000) {
			return 'Ukuran gambar '.$jenis_foto.' Anda terlalu besar(lebih dari 650MB).';
		}

		if (move_uploaded_file($_FILES[$img]['tmp_name'], $target_file)) {
			return 'sukses';
		} else {
			return 'Maaf, terdapat kesalahan dalam meng-upload file. Coba ulangi lagi';
		}
	}
}